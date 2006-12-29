<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Knowledgebase / FAQ and Article database
|
| File:		ext_knowledgebase.php
| Version:	0.4.0
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');





if(isset($_GET['cmd'])){ $cmd = $_GET['cmd']; }
if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_GET['article'])){ $article = $_GET['article']; }






if(trim($faq_enabled) == 1){
	if(!isset($cmd) || $cmd == 'showall') $cmd = 'list';
	
	
	if($cmd == 'list'){
		if(trim($faq_title) != '')
			echo tcms_html::contentheading($faq_title);
		
		if(trim($faq_subtitle) != '')
			echo tcms_html::contentstamp($faq_subtitle).'<br />';
		
		if(trim($faq_text) != '')
			echo tcms_html::contentmain($faq_text).'<br />';
		
		if(trim($faq_subtitle == '' && trim($faq_text) == ''))
			echo '<br />';
		
		
		$displayDownload = true;
		
		
		if($choosenDB == 'xml'){
			$arr_files = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_knowledgebase/');
			
			$count = 0;
			
			
			/*
				access
			*/
			if($tcms_main->isReal($category)){
				$xml      = new xmlparser($tcms_administer_site.'/tcms_knowledgebase/'.$category.'.xml','r');
				$checkAcc = $xml->read_section('faq', 'access');
				
				/*
					access
				*/
				$displayDownload = $tcms_main->checkAccess($checkAcc, $is_admin);
				
				$xml->flush();
				$xml->_xmlparser();
				unset($xml);
			}
			
			
			if($displayDownload){
				if(is_array($arr_files)){
					foreach($arr_files as $key => $value){
						if($value != 'index.html'){
							$menu_xml = new xmlparser($tcms_administer_site.'/tcms_knowledgebase/'.$value,'r');
							$checkCat = $menu_xml->read_section('faq', 'category');
							
							
							/*
								rules
							*/
							if(!isset($category) || $category == ''){
								if($checkCat == '') $countThis = true;
								else $countThis = false;
							}
							else{
								if($checkCat == $category) $countThis = true;
								else $countThis = false;
							}
							
							
							if($countThis){
								$checkPub = $menu_xml->read_section('faq', 'publish_state');
								
								
								// show pub
								if($checkPub == 2){
									$checkAcc = $menu_xml->read_section('faq', 'access');
									
									
									/*
										access
									*/
									$showThis = $tcms_main->checkAccess($checkAcc, $is_admin);
									
									
									// show access
									if($showThis){
										$arrFAQ['title'][$count]   = $menu_xml->read_section('faq', 'title');
										$arrFAQ['subt'][$count]    = $menu_xml->read_section('faq', 'subtitle');
										$arrFAQ['content'][$count] = $menu_xml->read_section('faq', 'content');
										$arrFAQ['date'][$count]    = $menu_xml->read_section('faq', 'date');
										$arrFAQ['type'][$count]    = $menu_xml->read_section('faq', 'type');
										$arrFAQ['sort'][$count]    = $menu_xml->read_section('faq', 'sort');
										$arrFAQ['img'][$count]     = $menu_xml->read_section('faq', 'image');
										$arrFAQ['pub'][$count]     = $menu_xml->read_section('faq', 'publish_state');
										$arrFAQ['access'][$count]  = $menu_xml->read_section('faq', 'access');
										$arrFAQ['autor'][$count]   = $menu_xml->read_section('faq', 'autor');
										$arrFAQ['cat'][$count]     = $menu_xml->read_section('faq', 'category');
										$arrFAQ['uid'][$count]     = substr($value, 0, 10);
										
										// CHARSETS
										$arrFAQ['title'][$count]   = $tcms_main->decodeText($arrFAQ['title'][$count], '2', $c_charset);
										$arrFAQ['subt'][$count]    = $tcms_main->decodeText($arrFAQ['subt'][$count], '2', $c_charset);
										$arrFAQ['content'][$count] = $tcms_main->decodeText($arrFAQ['content'][$count], '2', $c_charset);
										
										$count++;
										$checkCatAmount = $count;
									}
								}
							}
						}
					}
				}
			}
			
			unset($arr_files);
			
			if(is_array($arrFAQ)){
				array_multisort(
					$arrFAQ['sort'], SORT_ASC, 
					$arrFAQ['date'], SORT_ASC, 
					$arrFAQ['title'], SORT_ASC, 
					$arrFAQ['subt'], SORT_ASC, 
					$arrFAQ['content'], SORT_ASC, 
					$arrFAQ['type'], SORT_ASC, 
					$arrFAQ['cat'], SORT_ASC, 
					$arrFAQ['img'], SORT_ASC, 
					$arrFAQ['pub'], SORT_ASC, 
					$arrFAQ['access'], SORT_ASC, 
					$arrFAQ['cat'], SORT_ASC, 
					$arrFAQ['autor'], SORT_ASC, 
					$arrFAQ['uid'], SORT_ASC
				);
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($is_admin){
				case 'Developer':
				case 'Administrator':
					$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
					break;
				
				case 'User':
				case 'Editor':
				case 'Presenter':
					$strAdd = " OR access = 'Protected' ) ";
					break;
				
				default:
					$strAdd = ' ) ';
					break;
			}
			
			if(!isset($category)){
				$sqlSTR = "SELECT * "
				."FROM ".$tcms_db_prefix."knowledgebase "
				."WHERE publish_state = 2 "
				."AND parent IS NULL "
				."OR parent = '' "
				."AND ( access = 'Public' "
				.$strAdd
				."ORDER BY sort ASC, date ASC, title ASC";
			}
			else{
				/*
					access authentication
				*/
				switch($is_admin){
					case 'Developer':
					case 'Administrator':
						$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
						break;
					
					case 'User':
					case 'Editor':
					case 'Presenter':
						$strAdd = " OR access = 'Protected' ) ";
						break;
					
					default:
						$strAdd = ' ) ';
						break;
				}
				
				$sqlSTR = "SELECT * "
				."FROM ".$tcms_db_prefix."knowledgebase "
				."WHERE uid = '".$category."' "
				."AND publish_state = 2 "
				."AND type = 'c' "
				."AND ( access = 'Public' "
				.$strAdd
				."ORDER BY sort ASC, date ASC, title ASC";
				
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
				
				if($sqlNR > 0){
					$sqlSTR = "SELECT * "
					."FROM ".$tcms_db_prefix."knowledgebase "
					."WHERE category = '".$category."' "
					."AND publish_state = 2 "
					."AND ( access = 'Public' "
					.$strAdd
					."ORDER BY sort ASC, date ASC, title ASC";
				}
				else{
					$displayDownload = false;
				}
			}
			
			if($displayDownload){
				$count = 0;
				
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				
				while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
					$arrFAQ['uid'][$count]     = $sqlARR['uid'];
					$arrFAQ['title'][$count]   = $sqlARR['title'];
					$arrFAQ['subt'][$count]    = $sqlARR['subtitle'];
					$arrFAQ['content'][$count] = $sqlARR['content'];
					$arrFAQ['date'][$count]    = $sqlARR['date'];
					$arrFAQ['type'][$count]    = $sqlARR['type'];
					$arrFAQ['sort'][$count]    = $sqlARR['sort'];
					$arrFAQ['cat'][$count]     = $sqlARR['category'];
					$arrFAQ['img'][$count]     = $sqlARR['image'];
					$arrFAQ['pub'][$count]     = $sqlARR['publish_state'];
					$arrFAQ['access'][$count]  = $sqlARR['access'];
					$arrFAQ['autor'][$count]   = $sqlARR['autor'];
					
					
					if($arrFAQ['uid'][$count]     == NULL){ $arrFAQ['uid'][$count]     = ''; }
					if($arrFAQ['title'][$count]   == NULL){ $arrFAQ['title'][$count]   = ''; }
					if($arrFAQ['subt'][$count]    == NULL){ $arrFAQ['subt'][$count]    = ''; }
					if($arrFAQ['content'][$count] == NULL){ $arrFAQ['content'][$count] = ''; }
					if($arrFAQ['date'][$count]    == NULL){ $arrFAQ['date'][$count]    = ''; }
					if($arrFAQ['type'][$count]    == NULL){ $arrFAQ['type'][$count]    = ''; }
					if($arrFAQ['sort'][$count]    == NULL){ $arrFAQ['sort'][$count]    = ''; }
					if($arrFAQ['cat'][$count]     == NULL){ $arrFAQ['cat'][$count]     = ''; }
					if($arrFAQ['img'][$count]     == NULL){ $arrFAQ['img'][$count]     = ''; }
					if($arrFAQ['pub'][$count]     == NULL){ $arrFAQ['pub'][$count]     = ''; }
					if($arrFAQ['access'][$count]  == NULL){ $arrFAQ['access'][$count]  = ''; }
					if($arrFAQ['autor'][$count]   == NULL){ $arrFAQ['autor'][$count]   = ''; }
					
					
					// CHARSETS
					$arrFAQ['title'][$count]   = $tcms_main->decodeText($arrFAQ['title'][$count], '2', $c_charset);
					$arrFAQ['subt'][$count]    = $tcms_main->decodeText($arrFAQ['subt'][$count], '2', $c_charset);
					$arrFAQ['content'][$count] = $tcms_main->decodeText($arrFAQ['content'][$count], '2', $c_charset);
					
					$checkFAQAmount = $count;
					$count++;
				}
			}
		}
		
		
		if($displayDownload){
			/***********************
			* ACCESS AUTHENTICATION
			*/
			if($check_session){
				if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter')
					$auth_down = 'Protected';
				if($is_admin == 'Administrator' || $is_admin == 'Developer')
					$auth_down = 'Private';
			}
			else $auth_down = 'Public';
			
			
			echo tcms_html::table_head_cl('0', '0', '0', '100%', 'noborder');
			echo '<tr>'
			.'<td valign="top" class="titleBG" style="padding-left: 2px;" align="left" colspan="2">'._TABLE_CATEGORY.'</td><tr>'
			.'<tr style="height: 7px !important;"><td colspan="2"></td></tr>';
			
			if(is_array($arrFAQ)){
				foreach($arrFAQ['sort'] as $key => $value){
					if($arrFAQ['pub'][$key] == 2){
						echo '<tr>';
						
						
						echo '<td valign="top" align="center" width="5%" style="padding-right: 5px;">';
						
						switch(trim($arrFAQ['type'][$key])){
							case 'c':
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;cmd=list&amp;category='.$arrFAQ['uid'][$key];
								$link = $tcms_main->urlAmpReplace($link);
								
								echo '<a href="'.$link.'">';
								
								if(trim($arrFAQ['img'][$key]) == ''){
									if($detect_browser == 1){
										echo '<script>if(browser == \'ie\'){
										document.write(\'<img src="'.$imagePath.'engine/images/explore/faq_folder.gif" class="image" border="0" />\');
										}else{
										document.write(\'<img src="'.$imagePath.'engine/images/explore/faq_folder.png" class="image" border="0" />\');
										}</script>';
										
										echo '<noscript>'
										.'<img src="'.$imagePath.'engine/images/explore/faq_folder.png" class="image" border="0" />'
										.'</noscript>';
									}
									else{
										echo '<img src="'.$imagePath.'engine/images/explore/faq_folder.png" class="image" border="0" />';
									}
									
									//.'<img src="'.$imagePath.'engine/images/explore/faq_folder.gif" class="image" border="0" />'
								}
								else{
									echo '<img src="'.$imagePath.$tcms_administer_site.'/images/knowledgebase/'.$arrFAQ['img'][$key].'" class="image" border="0" />';
								}
								
								echo '</a>';
								break;
							
							case 'a':
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;cmd=detail'.( $arrFAQ['cat'][$key] != '' ? '&amp;category='.$arrFAQ['cat'][$key] : '' ).'&amp;article='.$arrFAQ['uid'][$key];
								$link = $tcms_main->urlAmpReplace($link);
								
								echo '<a href="'.$link.'">';
								
								if(trim($arrFAQ['img'][$key]) == ''){
									if($detect_browser == 1){
										echo '<script>if(browser == \'ie\'){
										document.write(\'<img src="'.$imagePath.'engine/images/explore/faq_text.gif" class="image" border="0" />\');
										}else{
										document.write(\'<img src="'.$imagePath.'engine/images/explore/faq_text.png" class="image" border="0" />\');
										}</script>';
										
										echo '<noscript>'
										.'<img src="'.$imagePath.'engine/images/explore/faq_text.png" class="image" border="0" />'
										.'</noscript>';
									}
									else{
										echo '<img src="'.$imagePath.'engine/images/explore/faq_text.png" class="image" border="0" />';
									}
									
									//.'<img src="'.$imagePath.'engine/images/explore/faq_text.gif" class="image" border="0" />'
								}
								else{
									echo '<img src="'.$imagePath.$tcms_administer_site.'/images/knowledgebase/'.$arrFAQ['img'][$key].'" class="image" border="0" />';
								}
								
								echo '</a>';
								break;
						}
						
						echo '</td>';
						
						
						echo '<td valign="top" align="left">';
						
						switch(trim($arrFAQ['type'][$key])){
							case 'c':
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;cmd=list&amp;category='.$arrFAQ['uid'][$key];
								$link = $tcms_main->urlAmpReplace($link);
								break;
							
							case 'a':
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;cmd=detail'.( $arrFAQ['cat'][$key] != '' ? '&amp;category='.$arrFAQ['cat'][$key] : '' ).'&amp;article='.$arrFAQ['uid'][$key];
								$link = $tcms_main->urlAmpReplace($link);
								break;
						}
						
						echo '<a class="main text_big" href="'.$link.'">'
						.tcms_html::bold($arrFAQ['title'][$key])
						.'</a>'
						.tcms_html::text($arrFAQ['subt'][$key], 'left');
						
						echo '</td>';
						
						
						echo '<tr style="height: 5px;"><td colspan="2"></td></tr>';
						
						
						echo '</tr>';
					}
				}
			}
			
			echo '</table><br />';
		}
		else{
			echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
		}
	}
	
	
	
	
	
	
	/*
		detail view
	*/
	if($cmd == 'detail'){
		if($category != ''){
			if($choosenDB == 'xml'){
				$down_xml = new xmlparser($tcms_administer_site.'/tcms_knowledgebase/'.$category.'.xml','r');
				$faq_cat    = $down_xml->read_section('faq', 'title');
				$access_cat = $down_xml->read_section('faq', 'access');
				$faq_cat    = $tcms_main->decodeText($faq_cat, '2', $c_charset);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'knowledgebase', $category);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$faq_cat    = $sqlARR['title'];
				$access_cat = $sqlARR['access'];
				$faq_cat    = $tcms_main->decodeText($faq_cat, '2', $c_charset);
			}
		}
		else{
			$faq_cat    = $faq_title;
			$access_cat = 'Public';
		}
		
		
		
		/*
			ACCESS AUTHENTICATION
		*/
		$show_this_category = $tcms_main->checkAccess($access_cat, $is_admin);
		
		
		
		
		if($show_this_category){
			if($choosenDB == 'xml'){
				if(file_exists($tcms_administer_site.'/tcms_knowledgebase/'.$article.'.xml')){
					$menu_xml = new xmlparser($tcms_administer_site.'/tcms_knowledgebase/'.$article.'.xml','r');
					
					$arrFAQ['title']   = $menu_xml->read_section('faq', 'title');
					$arrFAQ['subt']    = $menu_xml->read_section('faq', 'subtitle');
					$arrFAQ['content'] = $menu_xml->read_section('faq', 'content');
					$arrFAQ['date']    = $menu_xml->read_section('faq', 'date');
					$arrFAQ['type']    = $menu_xml->read_section('faq', 'type');
					$arrFAQ['sort']    = $menu_xml->read_section('faq', 'sort');
					$arrFAQ['img']     = $menu_xml->read_section('faq', 'image');
					$arrFAQ['pub']     = $menu_xml->read_section('faq', 'publish_state');
					$arrFAQ['access']  = $menu_xml->read_section('faq', 'access');
					$arrFAQ['cat']     = $menu_xml->read_section('faq', 'category');
					$arrFAQ['autor']   = $menu_xml->read_section('faq', 'autor');
					$arrFAQ['lup']     = $menu_xml->read_section('faq', 'last_update');
					
					if($arrFAQ['title']   == false){ $arrFAQ['title']   = ''; }
					if($arrFAQ['subt']    == false){ $arrFAQ['subt']    = ''; }
					if($arrFAQ['content'] == false){ $arrFAQ['content'] = ''; }
					if($arrFAQ['date']    == false){ $arrFAQ['date']    = ''; }
					if($arrFAQ['type']    == false){ $arrFAQ['type']    = ''; }
					if($arrFAQ['sort']    == false){ $arrFAQ['sort']    = ''; }
					if($arrFAQ['img']     == false){ $arrFAQ['img']     = ''; }
					if($arrFAQ['pub']     == false){ $arrFAQ['pub']     = ''; }
					if($arrFAQ['access']  == false){ $arrFAQ['access']  = ''; }
					if($arrFAQ['autor']   == false){ $arrFAQ['autor']   = ''; }
					if($arrFAQ['cat']     == false){ $arrFAQ['cat']     = ''; }
					if($arrFAQ['lup']     == false){ $arrFAQ['lup']     = ''; }
					
					// CHARSETS
					$arrFAQ['title']   = $tcms_main->decodeText($arrFAQ['title'], '2', $c_charset);
					$arrFAQ['subt']    = $tcms_main->decodeText($arrFAQ['subt'], '2', $c_charset);
					$arrFAQ['content'] = $tcms_main->decodeText($arrFAQ['content'], '2', $c_charset);
				}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($is_admin){
					case 'Developer':
					case 'Administrator':
						$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
						break;
					
					case 'User':
					case 'Editor':
					case 'Presenter':
						$strAdd = " OR access = 'Protected' ) ";
						break;
					
					default:
						$strAdd = ' ) ';
						break;
				}
				
				$sqlSTR = "SELECT ".$tcms_db_prefix."knowledgebase.*, "
				.$tcms_db_prefix."user.name AS tname, "
				.$tcms_db_prefix."user.username AS tusername "
				."FROM ".$tcms_db_prefix."knowledgebase "
				."LEFT JOIN ".$tcms_db_prefix."user ON (".$tcms_db_prefix."user.uid = ".$tcms_db_prefix."knowledgebase.autor) "
				."WHERE ".$tcms_db_prefix."knowledgebase.uid = '".$article."' "
				."AND ".$tcms_db_prefix."knowledgebase.publish_state=2 "
				//."AND parent IS NULL "
				."AND ( ".$tcms_db_prefix."knowledgebase.access = 'Public' "
				.$strAdd
				."ORDER BY ".$tcms_db_prefix."knowledgebase.sort ASC, "
				.$tcms_db_prefix."knowledgebase.date ASC, "
				.$tcms_db_prefix."knowledgebase.title ASC";
				
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				
				//echo $sqlSTR.'<br />'.$sqlAL->sqlGetNumber($sqlQR);
				
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$arrFAQ['title']   = $sqlARR['title'];
				$arrFAQ['subt']    = $sqlARR['subtitle'];
				$arrFAQ['content'] = $sqlARR['content'];
				$arrFAQ['date']    = $sqlARR['date'];
				$arrFAQ['autor']   = $sqlARR['tusername'];
				$arrFAQ['autorid'] = $sqlARR['autor'];
				$arrFAQ['lup']     = $sqlARR['last_update'];
				$arrFAQ['cat']     = $sqlARR['category'];
				$arrFAQ['access']  = $sqlARR['access'];
				
				if($arrFAQ['title']   == NULL){ $arrFAQ['title']   = ''; }
				if($arrFAQ['subt']    == NULL){ $arrFAQ['subt']    = ''; }
				if($arrFAQ['content'] == NULL){ $arrFAQ['content'] = ''; }
				if($arrFAQ['date']    == NULL){ $arrFAQ['date']    = ''; }
				if($arrFAQ['autor']   == NULL){ $arrFAQ['autor']   = ''; }
				if($arrFAQ['lup']     == NULL){ $arrFAQ['lup']     = ''; }
				if($arrFAQ['cat']     == NULL){ $arrFAQ['cat']     = ''; }
				if($arrFAQ['access']  == NULL){ $arrFAQ['access']  = ''; }
				
				// CHARSETS
				$arrFAQ['title']   = $tcms_main->decodeText($arrFAQ['title'], '2', $c_charset);
				$arrFAQ['subt']    = $tcms_main->decodeText($arrFAQ['subt'], '2', $c_charset);
				$arrFAQ['content'] = $tcms_main->decodeText($arrFAQ['content'], '2', $c_charset);
			}
			
			$show_this_category = $tcms_main->checkAccess($arrFAQ['access'], $is_admin);
			
			if($show_this_category){
				if(trim($arrFAQ['cat']) == ''){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;cmd=list';
				}
				else{
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;cmd=list&amp;category='.$arrFAQ['cat'];
				}
				$link = $tcms_main->urlAmpReplace($link);
				
				
				echo tcms_html::contentheading($arrFAQ['title']);//.'<br />';
				//echo tcms_html::contentstamp(_TABLE_CATEGORY.': <a href="'.$link.'">'.$faq_cat.'</a><br />');
				
				if(!empty($arrFAQ)){
					echo '<span class="text_small">';
					
					echo _TABLE_CATEGORY.': <a href="'.$link.'">'.$faq_cat.'</a><br />';
					echo _DOWNLOADS_SUBMIT_ON.': '.lang_date(substr($arrFAQ['date'], 0, 2), substr($arrFAQ['date'], 3, 2), substr($arrFAQ['date'], 6, 4), substr($arrFAQ['date'], 11, 2), substr($arrFAQ['date'], 14, 2), '');
					
					echo '</span>'
					.'<br />'
					.'<br />';
					
					
					echo tcms_html::text($arrFAQ['content'], 'left');
					
					
					echo '<br />'
					.'<br />'
					.'<span class="text_small">';
					
					if($faq_autorlink == 1){
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=profile&amp;s='.$s.'&amp;u='.$arrFAQ['autorid'];
						$link = $tcms_main->urlAmpReplace($link);
					}
					
					if($choosenDB == 'xml'){
						$strAutor = $tcms_main->getUser($arrFAQ['autor']);
					}
					else{
						$strAutor = $arrFAQ['autor'];
					}
					
					// class="main"
					echo _NEWS_WRITTEN.': '
					.( $faq_autorlink == 1 ? '<a href="'.$link.'">' : '' )
					.$strAutor
					.( $faq_autorlink == 1 ? '</a>' : '' )
					.'<br />';
					
					echo _CONTENT_LAST_UPDATE.': '.lang_date(substr($arrFAQ['lup'], 0, 2), substr($arrFAQ['lup'], 3, 2), substr($arrFAQ['lup'], 6, 4), substr($arrFAQ['lup'], 11, 2), substr($arrFAQ['lup'], 14, 2), '');
					
					echo '</span>';
				}
			}
			else{
				echo _MSG_NOTENOUGH_USERRIGHTS;
			}
		}
		else{
			echo _MSG_NOTENOUGH_USERRIGHTS;
		}
	}
}
else{
	echo '<strong>'._MSG_DISABLED_MODUL.'</strong>';
}



?>
