<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Download Manager
|
| File:		ext_download.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



if(isset($_GET['page'])){ $page = $_GET['page']; }
if(isset($_GET['c'])){ $c = $_GET['c']; }
if(isset($_GET['file'])){ $file = $_GET['file']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['category'])){ $category = $_GET['category']; }


/**
 * Download Manager
 *
 * This module provides a download manager..
 *
 * @version 0.7.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if(!isset($action))
	$action = 'showall';
if(!isset($page))
	$page = 1;



/*
	SHOW CATEGORIES
*/
if($action == 'showall'){
	echo $tcms_html->contentModuleHeader($download_title, $download_stamp, $download_text);
	
	
	$displayDownload = true;
	
	
	if($choosenDB == 'xml'){
		$arr_downfiles = $tcms_main->readdir_ext($tcms_administer_site.'/files/');
		
		$count = 0;
		
		/*
			access
		*/
		if($tcms_main->isReal($category)){
			$xml      = new xmlparser($tcms_administer_site.'/files/'.$category.'/info.xml','r');
			$checkAcc = $xml->read_section('info', 'access');
			$wsCatTit = $xml->read_section('info', 'name');
			
			$wsCatTit = $tcms_main->decodeText($wsCatTit, '2', $c_charset);
			
			
			/*
				access
			*/
			$displayDownload = $tcms_main->checkAccess($checkAcc, $is_admin);
			
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
		}
		
		
		if($displayDownload){
			if(isset($arr_downfiles) && !empty($arr_downfiles) && $arr_downfiles != ''){
				foreach($arr_downfiles as $key => $value){
					if($value != 'index.html'){
						$xml      = new xmlparser($tcms_administer_site.'/files/'.$value.'/info.xml', 'r');
						$checkPub = $xml->read_section('info', 'pub');
						
						
						// show pub
						if($checkPub == 1){
							$checkCat = $xml->read_section('info', 'cat');
							
							
							/*
								rules
							*/
							if(!isset($category) || trim($category) == ''){
								if($checkCat == '')
									$countThis = true;
								else
									$countThis = false;
							}
							else{
								if($checkCat == $category)
									$countThis = true;
								else
									$countThis = false;
							}
							
							
							// show cat
							if($countThis){
								$arr_dw['uid'][$count]  = substr($value, 0, 10);
								$arr_dw['name'][$count] = $xml->read_section('info', 'name');
								$arr_dw['date'][$count] = $xml->read_section('info', 'date');
								$arr_dw['desc'][$count] = $xml->read_section('info', 'desc');
								$arr_dw['type'][$count] = $xml->read_section('info', 'type');
								$arr_dw['sort'][$count] = $xml->read_section('info', 'sort');
								$arr_dw['file'][$count] = $xml->read_section('info', 'file');
								//$arr_dw['pub'][$count]  = $checkPub;
								$arr_dw['ac'][$count]   = $xml->read_section('info', 'access');
								$arr_dw['st'][$count]   = $xml->read_section('info', 'sql_type');
								$arr_dw['img'][$count]  = $xml->read_section('info', 'image');
								$arr_dw['mir'][$count]  = $xml->read_section('info', 'mirror');
								
								
								// CHARSETS
								$arr_dw['name'][$count] = $tcms_main->decodeText($arr_dw['name'][$count], '2', $c_charset);
								$arr_dw['desc'][$count] = $tcms_main->decodeText($arr_dw['desc'][$count], '2', $c_charset);
								
								$count++;
							}
						}
						
						
						$xml->flush();
						$xml->_xmlparser();
						unset($xml);
					}
					
					$checkDownAmount = $count;
					$sqlNR = $count;
				}
			}
		}
		
		if(is_array($arr_dw) && !empty($arr_dw)){
			array_multisort(
				$arr_dw['sort'], SORT_ASC, 
				$arr_dw['date'], SORT_ASC, 
				$arr_dw['name'], SORT_ASC, 
				$arr_dw['type'], SORT_ASC, 
				$arr_dw['desc'], SORT_ASC, 
				$arr_dw['file'], SORT_ASC, 
				$arr_dw['uid'], SORT_ASC, 
				//$arr_dw['pub'], SORT_ASC, 
				$arr_dw['ac'], SORT_ASC, 
				$arr_dw['st'], SORT_ASC, 
				$arr_dw['img'], SORT_ASC, 
				$arr_dw['mir'], SORT_ASC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if(!isset($category) || trim($category) == ''){
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."downloads "
			."WHERE ( parent IS NULL "
			."OR parent = '' ) "
			."AND pub = 1 "
			//."AND ( access = 'Public' "
			//.$strAdd
			."ORDER BY sort ASC, date ASC, name ASC";
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
			
			// title
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."downloads "
			."WHERE uid = '".$category."' "
			."AND pub = 1 "
			."ORDER BY sort ASC, date ASC, name ASC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			if($sqlNR > 0){
				$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
				$wsCatTit = $sqlObj->name;
				
				$wsCatTit = $tcms_main->decodeText($wsCatTit, '2', $c_charset);
			}
			
			// positions
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."downloads "
			."WHERE cat = '".$category."' "
			."AND pub = 1 "
			//."AND ( access = 'Public' "
			//.$strAdd
			."ORDER BY sort ASC, date ASC, name ASC";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			if($sqlNR > 0){
				$sqlSTR = "SELECT * "
				."FROM ".$tcms_db_prefix."downloads "
				."WHERE cat = '".$category."' "
				//."AND parent IS NULL "
				//."OR parent = '' "
				."AND pub = 1 "
				//."AND ( access = 'Public' "
				//.$strAdd
				."ORDER BY sort ASC, date ASC, name ASC";
			}
			else{
				//$displayDownload = false;
			}
		}
		
		
		if($displayDownload){
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			$count = 0;
			
			while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
				$arr_dw['uid'][$count]   = $sqlObj->uid;
				$arr_dw['name'][$count]  = $sqlObj->name;
				$arr_dw['date'][$count]  = $sqlObj->date;
				$arr_dw['desc'][$count]  = $sqlObj->desc;
				$arr_dw['type'][$count]  = $sqlObj->type;
				$arr_dw['sort'][$count]  = $sqlObj->sort;
				$arr_dw['file'][$count]  = $sqlObj->file;
				//$arr_dw['dir'][$count]   = $sqlObj->folder;
				//$arr_dw['pub'][$count]   = $sqlObj->pub;
				$arr_dw['ac'][$count]    = $sqlObj->access;
				$arr_dw['st'][$count]    = $sqlObj->sql_type;
				$arr_dw['img'][$count]   = $sqlObj->image;
				$arr_dw['mir'][$count]   = $sqlObj->mirror;
				
				if($arr_dw['uid'][$count]  == NULL){ $arr_dw['uid'][$count]  = ''; }
				if($arr_dw['name'][$count] == NULL){ $arr_dw['name'][$count] = ''; }
				if($arr_dw['date'][$count] == NULL){ $arr_dw['date'][$count] = ''; }
				if($arr_dw['desc'][$count] == NULL){ $arr_dw['desc'][$count] = ''; }
				if($arr_dw['type'][$count] == NULL){ $arr_dw['type'][$count] = ''; }
				if($arr_dw['sort'][$count] == NULL){ $arr_dw['sort'][$count] = ''; }
				if($arr_dw['file'][$count] == NULL){ $arr_dw['file'][$count] = ''; }
				//if($arr_dw['dir'][$count]  == NULL){ $arr_dw['dir'][$count]  = ''; }
				//if($arr_dw['pub'][$count]  == NULL){ $arr_dw['pub'][$count]  = ''; }
				if($arr_dw['ac'][$count]   == NULL){ $arr_dw['ac'][$count]   = ''; }
				if($arr_dw['st'][$count]   == NULL){ $arr_dw['st'][$count]   = ''; }
				if($arr_dw['img'][$count]  == NULL){ $arr_dw['img'][$count]  = ''; }
				if($arr_dw['mir'][$count]  == NULL){ $arr_dw['mir'][$count]  = ''; }
				
				// CHARSETS
				$arr_dw['name'][$count] = $tcms_main->decodeText($arr_dw['name'][$count], '2', $c_charset);
				$arr_dw['desc'][$count] = $tcms_main->decodeText($arr_dw['desc'][$count], '2', $c_charset);
				
				$count++;
				$checkCatAmount = $count;
			}
		}
	}
	
	
	// only info
	if($displayDownload){
		$wsCatAdd = '';
		
		if($tcms_main->isReal($category)){
			if($choosenDB == 'xml'){
				$sqlNR2 = 0;
				
				if($category != ''){
					$xml = new xmlparser($tcms_administer_site.'/files/'.$category.'/info.xml', 'r');
					
					$wsType = $xml->read_section('info', 'type');
					
					$xml->flush();
					$xml->_xmlparser();
					unset($xml);
					
					$sqlNR2 = 1;
				}
			}
			else{
				switch($is_admin){
					case 'Developer':
					case 'Administrator':
						$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
						break;
					
					case 'User':
					case 'Editor':
					case 'Writer':
					case 'Presenter':
						$strAdd = " OR access = 'Protected' ) ";
						break;
					
					default:
						$strAdd = ' ) ';
						break;
				}
				
				$sqlSTR = "SELECT * "
				."FROM ".$tcms_db_prefix."downloads "
				."WHERE uid = '".$category."' "
				."AND ( access = 'Public' "
				.$strAdd;
				
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				$sqlNR2 = $sqlAL->sqlGetNumber($sqlQR);
				
				if($sqlNR2 > 0){
					$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
					
					$wsType = $sqlObj->type;
					
					unset($sqlQR);
				}
			}
			
			if($sqlNR2 > 0){
				foreach($arr_fs['tag'] as $key => $value){
					//echo $wsType.'<->'.$value.'<br>';
					if($wsType == $value){
						$wsCatAdd = $arr_fs['des'][$key];
					}
				}
			}
		}
		
		echo $tcms_html->tableHeadClass('0', '0', '0', '100%', 'noborder');
		echo '<tr>'
		.'<td valign="top" class="titleBG" style="padding-left: 2px;" align="left" colspan="2">'._TABLE_CATEGORY.( $wsCatAdd != '' ? ': '.$wsCatTit.' ('.$wsCatAdd.')' : '' ).'</td><tr>'
		.'<tr style="height: 2px;"><td colspan="2"></td></tr>'
		.'<tr><td colspan="2"><br /></td></tr>';
		
		if(isset($arr_dw['sort']) && !empty($arr_dw['sort']) && $arr_dw['sort'] != ''){
			foreach($arr_dw['sort'] as $key => $value){
				if($key >= ( ($page * 10) - 10 ) && $key < ( $page * 10 )){
					echo '<tr>'
					.'<td valign="top" align="center" width="70" style="padding-right: 5px;">';
					
					
					/*
						access
					*/
					$checkAcc = $arr_dw['ac'][$key];
					$showThis = $tcms_main->checkAccess($checkAcc, $is_admin);
					
					
					if($arr_dw['st'][$key] == 'd'){
						if($showThis){
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id=download&amp;s='.$s.'&amp;action=showall&amp;category='.$arr_dw['uid'][$key]
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $tcms_main->urlAmpReplace($link);
							
							echo '<a href="'.$link.'">';
							
							if($detect_browser == 1){
								echo '<script>if(browser == \'ie\'){'
								.'document.write(\'<img src="'.$imagePath.'engine/images/filesystemGIF/'.$arr_dw['type'][$key].'.gif" border="0" />\');'
								.'}else{'
								.'document.write(\'<img src="'.$imagePath.'engine/images/filesystem/'.$arr_dw['type'][$key].'.png" border="0" />\');'
								.'}</script>';
								
								echo '<noscript>'
								.'<img src="'.$imagePath.'engine/images/filesystem/'.$arr_dw['type'][$key].'.png" border="0" />'
								.'</noscript>';
							}
							else{
								echo '<img src="'.$imagePath.'engine/images/filesystem/'.$arr_dw['type'][$key].'.png" border="0" />';
							}
							
							echo '</a>';
						}
						else{
							if($detect_browser == 1){
								echo '<script>if(browser == \'ie\'){'
								.'document.write(\'<img src="'.$imagePath.'engine/images/filesystemGIF/folder_locked.gif" border="0" />\');'
								.'}else{'
								.'document.write(\'<img src="'.$imagePath.'engine/images/filesystem/folder_locked.png" border="0" />\');'
								.'}</script>';
								
								echo '<noscript>'
								.'<img src="'.$imagePath.'engine/images/filesystem/folder_locked.png" border="0" />'
								.'</noscript>';
							}
							else{
								echo '<img src="'.$imagePath.'engine/images/filesystem/folder_locked.png" border="0" />';
							}
						}
					}
					else{
						if($showThis){
							if($arr_dw['mir'][$key] == 0 && $tcms_main->checkWebLink($arr_dw['file'][$key]) == false){
								$downFile = $arr_dw['file'][$key];
								
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
								.'id=download&amp;s='.$s.'&amp;action=start&amp;category='.$arr_dw['uid'][$key].'&amp;file='.$downFile
								.( isset($lang) ? '&amp;lang='.$lang : '' );
								$link = $tcms_main->urlAmpReplace($link);
							}
							else{
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
								.( isset($lang) ? 'lang='.$lang.'&amp;' : '' )
								.'id=download&amp;s='.$s.'&amp;action=start&amp;category='.$arr_dw['uid'][$key].'&amp;c=_mirror_&amp;file=';
								$link = $tcms_main->urlAmpReplace($link);
								$link = $link.$arr_dw['file'][$key];
							}
							
							echo '<a href="'.$link.'" target="_blank">';
							
							if($arr_dw['img'][$key] == '_mimetypes_'){
								if(file_exists('engine/images/mimetypes/'.$arr_dw['type'][$key].'.png')){
									if($detect_browser == 1){
										echo '<script>if(browser == \'ie\'){'
										.'document.write(\'<img src="'.$imagePath.'engine/images/mimetypesGIF/'.$arr_dw['type'][$key].'.gif" border="0" />\');'
										.'}else{'
										.'document.write(\'<img src="'.$imagePath.'engine/images/mimetypes/'.$arr_dw['type'][$key].'.png" border="0" />\');'
										.'}</script>';
										
										echo '<noscript>'
										.'<img src="'.$imagePath.'engine/images/mimetypes/'.$arr_dw['type'][$key].'.png" border="0" />'
										.'</noscript>';
									}
									else{
										echo '<img src="'.$imagePath.'engine/images/mimetypes/'.$arr_dw['type'][$key].'.png" border="0" />';
									}
								}
								else{
									if($detect_browser == 1){
										echo '<script>if(browser == \'ie\'){'
										.'document.write(\'<img src="'.$imagePath.'engine/images/mimetypesGIF/empty.gif" border="0" />\');'
										.'}else{'
										.'document.write(\'<img src="'.$imagePath.'engine/images/mimetypes/empty.png" border="0" />\');'
										.'}</script>';
										
										echo '<noscript>'
										.'<img src="'.$imagePath.'engine/images/mimetypes/empty.png" border="0" />'
										.'</noscript>';
									}
									else{
										echo '<img src="'.$imagePath.'engine/images/mimetypes/empty.png" border="0" />';
									}
								}
							}
							else{
								echo '<img src="'.$imagePath.$tcms_administer_site.'/files/'.$arr_dw['uid'][$key].'/'.$arr_dw['img'][$key].'" border="0" />';
							}
							
							echo '</a>';
						}
						else{
							/*echo ( $arr_dw['img'][$key] == '_mimetypes_'
							?
								( file_exists('engine/images/mimetypes/'.$arr_dw['type'][$key].'.png')
								? '<img src="'.$imagePath.'engine/images/mimetypes/'.$arr_dw['type'][$key].'.png" border="0" />'
								: '<img src="'.$imagePath.'engine/images/mimetypes/empty.png" border="0" />' )
							:
							'<img src="'.$imagePath.$tcms_administer_site.'/files/'.$arr_dw['uid'][$key].'/'.$arr_dw['img'][$key].'" border="0" />'
							);*/
						}
					}
					
					echo '</td>'
					.'<td valign="top" align="left">';
					
					
					if($arr_dw['st'][$key] == 'd'){
						if($showThis){
							echo '<a class="main text_big" href="'.$link.'">'
							.tcms_html::bold($arr_dw['name'][$key])
							.'</a>'
							.tcms_html::text($arr_dw['desc'][$key], 'left');
						}
						else{
							echo tcms_html::bold($arr_dw['name'][$key])
							.tcms_html::text($arr_dw['desc'][$key], 'left');
						}
					}
					else{
						if(file_exists($tcms_administer_site.'/files/'.$category.'/'.$arr_dw['file'][$key])){
							$size = filesize($tcms_administer_site.'/files/'.$category.'/'.$arr_dw['file'][$key]) / 1024;
							$kpos = strpos($size, '.');
							$file_size = substr($size, 0, $kpos+3);
						}
						
						if($showThis){
							echo '<a class="main text_big" href="'.$link.'" target="_blank">'
							.tcms_html::bold($arr_dw['name'][$key])
							.'</a>'
							.tcms_html::text($arr_dw['desc'][$key], 'left')
							.'<br />';
							
							echo '<strong>'._DOWNLOADS_SUBMIT_ON.':</strong>'
							.tcms_html::text('&nbsp;'.$arr_dw['date'][$key], 'left')
							.'<br />';
							
							
							if(isset($file_size) && !empty($file_size) && $file_size != ''){
								echo '<strong>'._GALLERY_IMGSIZE.':</strong>'
								.tcms_html::text('&nbsp;'.$file_size.' KB', 'left');
							}
						}
						else{
							/*echo tcms_html::bold($arr_dw['name'][$key])
							.tcms_html::text($arr_dw['desc'][$key], 'left')
							.'<br />';*/
						}
					}
					
					
					echo '</td>'
					.'</tr>';
					
					echo '<tr><td colspan="2">'
					.'<hr class="hr_line" />'
					.'</td></tr>';
				}
			}
		}
		
		echo $tcms_html->tableEnd().'<br />';
		
		
		
		// pagelist
		if($sqlNR > 10){
			$pageAmount = ( substr(($sqlNR / 10), 0, strpos(($sqlNR / 10), '.', 1)) + 1 );
			
			echo '<div style="font-weight: bold; display: block; float: left;" align="left">';
			
			echo _BOOK_PAGE.'&nbsp;'
			.$page.'/'.$pageAmount
			.':&nbsp;&nbsp;';
			
			$showME1 = true;
			$showME2 = true;
			$showLink = false;
			
			if($page > 1){
				if($showME1){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=download&amp;s='.$s.'&action=showall'.( trim($category) != '' ? '&category='.$category : '' ).'&amp;page=1'
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<a href="'.$link.'" style="font-size: 14px;"><u>&laquo;</u></a>'
					.'&nbsp;&nbsp;';
					
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=download&amp;s='.$s.'&action=showall'.( trim($category) != '' ? '&category='.$category : '' ).'&amp;page='.( $page - 1 )
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<a href="'.$link.'" style="font-size: 14px;"><u>&#8249;</u></a>'
					.'&nbsp;&nbsp;';
				}
				
				$showME1 = false;
			}
			
			
			for($i = 0; $i < $pageAmount; $i++){
				$thisPage = $i + 1;
				
				
				if($page > 0 && $page < 3){
					if($thisPage < 7){
						$showLink = true;
					}
				}
				else{
					if(( $page - 3 ) == $thisPage 
					|| ( $page - 2 ) == $thisPage 
					|| ( $page - 1 ) == $thisPage 
					|| $page == $thisPage 
					|| ( $page + 1 ) == $thisPage 
					|| ( $page + 2 ) == $thisPage 
					|| ( $page + 3 ) == $thisPage){
						$showLink = true;
					}
				}
				
				
				if($showLink){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=download&amp;s='.$s.'&action=showall'.( trim($category) != '' ? '&category='.$category : '' ).'&amp;page='.$thisPage
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlAmpReplace($link);
					
					
					if($thisPage != $page) {
						echo '<a href="'.$link.'"><u>'.$thisPage.'</u></a>';
					}
					else{
						echo '<span style="font-weight: bold !important;">'.$thisPage.'</span>';
					}
					
					echo '&nbsp;&nbsp;';
				}
				
				$showLink = false;
			}
			
			if($page < $pageAmount){
				if($showME2){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=download&amp;s='.$s.'&action=showall'.( trim($category) != '' ? '&category='.$category : '' ).'&amp;page='.( $page + 1 )
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<a href="'.$link.'" style="font-size: 14px;"><u>&#8250;</u></a>';
					
					
					echo '&nbsp;&nbsp;';
					
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=download&amp;s='.$s.'&action=showall'.( trim($category) != '' ? '&category='.$category : '' ).'&amp;page='.$pageAmount
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<a href="'.$link.'" style="font-size: 14px;"><u>&raquo;</u></a>';
				}
				
				$showME2 = false;
			}
			
			echo '</div>';
		}
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}





/*
	START TO DOWNLOAD
*/
if($action == 'start'){
	if($choosenDB == 'xml'){
		$xml        = new xmlparser($tcms_administer_site.'/files/'.$category.'/info.xml', 'r');
		$access_cat = $xml->read_section('info', 'access');
		$down_main  = $xml->read_section('info', 'cat');
		$xml->flush();
		$xml->_xmlparser();
		
		if($down_main != ''){
			$xml        = new xmlparser($tcms_administer_site.'/files/'.$down_main.'/info.xml', 'r');
			$down_cat   = $xml->read_section('info', 'name');
			$down_main  = $xml->read_section('info', 'cat');
			$xml->flush();
			$xml->_xmlparser();
		}
		else{
			$down_cat = _TCMS_MENU_DOWN;
			$down_main = '';
		}
		
		$down_cat = $tcms_main->decodeText($down_cat, '2', $c_charset);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'downloads', $category);
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$access_cat = $sqlARR['access'];
		
		if($sqlARR['cat'] != NULL){
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'downloads', $sqlARR['cat']);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$down_cat  = $sqlARR['name'];
			$down_main = $sqlARR['cat'];
			
			$down_cat = $tcms_main->decodeText($down_cat, '2', $c_charset);
		}
		else{
			$down_cat = _TCMS_MENU_DOWN;
			$down_main = '';
		}
	}
	
	
	
	/*
		ACCESS AUTHENTICATION
	*/
	$show_this_download = $tcms_main->checkAccess($access_cat, $is_admin);
	
	
	
	/*
		LOAD DOWNLOAD
	*/
	if($show_this_download){
		$strDown1 = _MSG_IF_DOWNLOAD_DOES_NOT_START;
		
		
		if(isset($c) && $c == '_mirror_'){
			$strDown2 = ': <a target="_blank" class="main" href="'.$file.'">'.$file.'</a>';
		}
		else{
			$file = str_replace(';', '/', $file);
			$strDown2 = ': <a target="_blank" class="main" href="'.$imagePath.'data/files/'.$category.'/'.$file.'">'.$file.'</a>';
		}
		
		
		echo tcms_html::contentheading($download_title);
		echo tcms_html::contentstamp(_TABLE_CATEGORY.': '.$down_cat).'<br /><br />';
		echo tcms_html::contentmain($strDown1.$strDown2).'<br /><br />';
		
		
		if(isset($c) && $c == '_mirror_') {
			echo '<script>'
			.'setTimeout("document.location=\''.$file.'\'", 100);</script>';
		}
		else {
			echo '<script>'
			.'setTimeout("document.location=\''.$imagePath.'data/files/'.$category.'/'.$file.'\'", 100);'
			.'</script>';
		}
		
			
		$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
		.'id=download&amp;s='.$s.'&amp;action=showall'.( $down_main != '' ? '&amp;category='.$down_main : '' )
		.( isset($lang) ? '&amp;lang='.$lang : '' );
		$link = $tcms_main->urlAmpReplace($link);
		
		echo '<a class="main" href="'.$link.'">'._TCMS_ADMIN_BACK.'</a>';
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}



?>