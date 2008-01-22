<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Poll Admin
|
| File:	mod_poll.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Poll Admin
 *
 * This module is used for the polls.
 *
 * @version 0.3.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['poll'])){ $poll = $_GET['poll']; }
if(isset($_GET['check'])){ $check = $_GET['check']; }

if(isset($_POST['tmp_poll_title'])){ $tmp_poll_title = $_POST['tmp_poll_title']; }
if(isset($_POST['tmp_allpoll_title'])){ $tmp_allpoll_title = $_POST['tmp_allpoll_title']; }
if(isset($_POST['tmp_show_pt'])){ $tmp_show_pt = $_POST['tmp_show_pt']; }
if(isset($_POST['tmp_poll_s_width'])){ $tmp_poll_s_width = $_POST['tmp_poll_s_width']; }
if(isset($_POST['tmp_poll_m_width'])){ $tmp_poll_m_width = $_POST['tmp_poll_m_width']; }
if(isset($_POST['tmp_sm_title'])){ $tmp_sm_title = $_POST['tmp_sm_title']; }
if(isset($_POST['tmp_use_poll_sm'])){ $tmp_use_poll_sm = $_POST['tmp_use_poll_sm']; }
if(isset($_POST['tmp_poll_sm_id'])){ $tmp_poll_sm_id = $_POST['tmp_poll_sm_id']; }
if(isset($_POST['tmp_tm_title'])){ $tmp_tm_title = $_POST['tmp_tm_title']; }
if(isset($_POST['tmp_use_poll_tm'])){ $tmp_use_poll_tm = $_POST['tmp_use_poll_tm']; }
if(isset($_POST['tmp_poll_tm_id'])){ $tmp_poll_tm_id = $_POST['tmp_poll_tm_id']; }
if(isset($_POST['your_new_poll_titel'])){ $your_new_poll_titel = $_POST['your_new_poll_titel']; }
if(isset($_POST['ynp'])){ $ynp = $_POST['ynp']; }
if(isset($_POST['cnp'])){ $cnp = $_POST['cnp']; }
if(isset($_POST['on'])){ $on = $_POST['on']; }
if(isset($_POST['extra'])){ $extra = $_POST['extra']; }




//=====================================================
// INIT
//=====================================================

if(!isset($todo)){ $todo = 'show'; }

$arr_farbe[0] = $arr_color[0];
$arr_farbe[1] = $arr_color[1];
$bgkey = 0;




if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){
	if($todo == 'show'){
		/*********************
		*
		* SHOW ALL POLLS
		*
		*/
		
		//*********************************
		// TABLE FOR OUTPUT AND INPUT
		//
		
		
		echo tcms_html::table_head_nb('3', '0', '0', '100%');
		
		echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="15">&nbsp;</th>'
			.'<th valign="middle" class="tcms_db_title" align="left" width="75%">'._POLL_ALL_TITLE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
		
		if($choosenDB == 'xml'){
			$arr_allpolls = $tcms_file->getPathContent(
				_TCMS_PATH.'/tcms_polls/', 
				false, 
				'.xml'
			);
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'polls');
			
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$arr_allpolls[$count] = $sqlARR['uid'];
				
				if($arr_allpolls[$count] == NULL){ $arr_allpolls[$count] = ''; }
				
				$count++;
				$checkCatAmount = $count;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
		}
		
		if(isset($arr_allpolls) && $arr_allpolls != '' && !empty($arr_allpolls)){
			array_multisort($arr_allpolls, SORT_ASC, SORT_NUMERIC);
			
			foreach($arr_allpolls as $key => $value){
				if($choosenDB == 'xml'){
					$ap_xml = new xmlparser(_TCMS_PATH.'/tcms_polls/'.$value, 'r');
					$poll_subtitle = $ap_xml->read_section('poll', 'title');
					$value = substr($value, 0, 32);
				}
				else{
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'polls', $value);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$poll_subtitle = $sqlARR['title'];
					$value = $sqlARR['uid'];
				}
				
				$poll_subtitle = $tcms_main->decodeText($poll_subtitle, '2', $c_charset);
				
				$bgkey++;
				if(is_integer($bgkey/2)){ $ws_farbe = $arr_farbe[0]; }else{ $ws_farbe = $arr_farbe[1]; }
				
				echo '<tr height="25" id="row'.$key.'" '
				.'bgcolor="'.$ws_farbe.'" '
				.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
				.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$ws_farbe.'\')" '
				.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_poll&amp;todo=edit&amp;poll='.$value.'\';">';
				
				echo '<td align="left" class="tcms_db_2"><img src="../images/poll.png" border="0" /></td>';
				echo '<td align="left" class="tcms_db_2">'.$poll_subtitle.'</td>';
				
				echo '<td class="tcms_db_2" align="right" valign="middle">'
				.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_poll&amp;todo=edit&amp;poll='.$value.'">'
				.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
				.'</a>&nbsp;'
				.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_poll&amp;todo=delete&amp;poll='.$value.'">'
				.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
				.'</a>&nbsp;'
				.'</td>';
				
				echo '</tr>';
			}
		}
		
		echo tcms_html::table_end();
		
		// Table end
		echo '<br /><br />';
		
		
		
		
		//=====================================================
		// INIT GLOBAL
		//=====================================================
		
		if($choosenDB == 'xml'){
			$poll_xml              = new xmlparser(_TCMS_PATH.'/tcms_global/poll.xml','r');
			$old_tmp_poll_title    = $poll_xml->read_section('poll', 'poll_title');
			$old_tmp_allpoll_title = $poll_xml->read_section('poll', 'allpoll_title');
			
			$old_tmp_show_pt       = $poll_xml->read_section('poll', 'show_poll_title');
			$old_tmp_poll_s_width  = $poll_xml->read_section('poll', 'poll_side_width');
			$old_tmp_poll_m_width  = $poll_xml->read_section('poll', 'poll_main_width');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'poll_config', 'poll');
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$old_tmp_poll_title    = $sqlARR['poll_title'];
			$old_tmp_allpoll_title = $sqlARR['allpoll_title'];
			
			$old_tmp_show_pt       = $sqlARR['show_poll_title'];
			$old_tmp_poll_s_width  = $sqlARR['poll_side_width'];
			$old_tmp_poll_m_width  = $sqlARR['poll_main_width'];
			
			if($old_tmp_poll_title    == NULL){ $old_tmp_poll_title    = ''; }
			if($old_tmp_allpoll_title == NULL){ $old_tmp_allpoll_title = ''; }
			
			if($old_tmp_show_pt       == NULL){ $old_tmp_show_pt       = ''; }
			if($old_tmp_poll_s_width  == NULL){ $old_tmp_poll_s_width  = ''; }
			if($old_tmp_poll_m_width  == NULL){ $old_tmp_poll_m_width  = ''; }
		}
		
		// CHARSETS
		$old_tmp_poll_title    = $tcms_main->decodeText($old_tmp_poll_title, '2', $c_charset);
		$old_tmp_allpoll_title = $tcms_main->decodeText($old_tmp_allpoll_title, '2', $c_charset);
		
		
		
		
		
		
		
		/*
			BEGIN FORM
		*/
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_poll" method="post">'
		.'<input name="todo" type="hidden" value="save" />';
		
		
		// table head
		echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// row
		echo '<tr><td colspan="2" class="tcms_db_title tcms_bg_blue_01 tcms_padding_mini">'
		.'<strong>'._POLL_MAINTITLE.'</strong></td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._POLL_TITLE.'</td>'
		.'<td><input name="tmp_poll_title" class="tcms_input_normal" value="'.$old_tmp_poll_title.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._POLL_ALLPOLL_TITLES.'</td>'
		.'<td><input name="tmp_allpoll_title" class="tcms_input_normal" value="'.$old_tmp_allpoll_title.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._POLL_SHOW_TITLE.'</td>'
		.'<td><input type="checkbox" name="tmp_show_pt" '.( $old_tmp_show_pt == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._POLL_SIDE_WIDTH.'</td>'
		.'<td><input type="text" class="tcms_id_box" name="tmp_poll_s_width" value="'.$old_tmp_poll_s_width.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._POLL_MAIN_WIDTH.'</td>'
		.'<td><input type="text" class="tcms_id_box" name="tmp_poll_m_width" value="'.$old_tmp_poll_m_width.'" />'
		.'</td></tr>';
		
		
		// Table end
		echo '</table><br />';
		
		echo '</form>';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	//==================================================
	// EDIT POLL
	//==================================================
	
	if($todo == 'edit'){
		$width = 150;
		$ws_poll = 0;
		
		if(!isset($poll) || $poll == '' || empty($poll)){
			$poll = $tcms_main->getNewUID(32, 'polls');
			
			$wr_poll = 'w';
			$ws_poll = 1;
			$new_or_edit = 'new';
		}
		else{
			$poll = $poll;
			$wr_poll = 'r';
			$ws_poll = 0;
			$new_or_edit = 'edit';
		}
		
		
		
		
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_poll" method="post">';
		
		
		//***************************************
		// LOOK FOR TITLE
		
		if($ws_poll == 0){
			if($choosenDB == 'xml'){
				$vote_xml = new xmlparser(_TCMS_PATH.'/tcms_polls/'.$poll.'.xml', $wr_poll);
				$your_poll_title  = $vote_xml->read_section('poll', 'title');
				
				$your_poll_title = $tcms_main->decodeText($your_poll_title, '2', $c_charset);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'polls', $poll);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$your_poll_title = $sqlARR['title'];
				
				$your_poll_title = $tcms_main->decodeText($your_poll_title, '2', $c_charset);
				
				if($your_poll_title == NULL){ $your_poll_title = ''; }
			}
		}
		else{ $your_poll_title = ''; }
		
		
		
		//***************************************
		// LOOK FOR OPTIONS
		
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">';
		echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
		echo '</tr></table>';
		
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
		
		//================================================
		
		echo '
		<tr><td valign="top" width="'.$width.'">
			<strong class="tcms_bold">'._TABLE_TITLE.'</strong>
		</td><td>
			<input class="tcms_input_normal" name="your_new_poll_titel" type="text" value="'.$your_poll_title.'" />
		</td></tr>';
		
		//================================================
		
		echo '<tr><td class="tcms_padding_mini" colspan="2">&nbsp;</td></td></tr>';
		
		//================================================
		
		if($ws_poll == 0){
			$qc = 1;
			if($choosenDB == 'xml'){
				do{
					$question = $vote_xml->read_section('poll', 'question'.$qc);
					
					if($question != '__END_POLL_QUESTION__'){
						$question = $tcms_main->decodeText($question, '2', $c_charset);
						
						echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_OPTION.' '.$qc.'</strong></td><td>';
						echo '<input class="tcms_input_normal" name="option'.$qc.'" type="text" value="'.$question.'" />';
						echo '</td></tr>';
					}
					$option_number = $qc;
					$qc++;
				}while($question != '__END_POLL_QUESTION__');
			}
			else{
				do{
					$question = $sqlARR['question'.$qc];
					
					if($question != NULL){
						$question = $tcms_main->decodeText($question, '2', $c_charset);
						
						echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_OPTION.' '.$qc.'</strong></td><td>';
						echo '<input class="tcms_input_normal" name="option'.$qc.'" type="text" value="'.$question.'" />';
						echo '</td></tr>';
					}
					$option_number = $qc;
					$qc++;
				}while($question != NULL);
			}
		}
		elseif($ws_poll == 1){
			for($ppp = 1; $ppp <= 12; $ppp++){
				echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_OPTION.' '.$ppp.'</strong></td><td>';
				echo '<input class="tcms_input_normal" name="option'.$ppp.'" type="text" value="" />';
				echo '</td></tr>';
				$option_number = 13;
			}
		}
		else{
			continue;
		}
		
		//================================================
		
		echo '</table>
		<input name="todo" type="hidden" value="save_poll" />
		<input name="extra" type="hidden" value="'.$new_or_edit.'" />
		<input name="ynp" type="hidden" value="'.$poll.'" />
		<input name="cnp" type="hidden" value="'.$ws_poll.'" />
		<input name="on" type="hidden" value="'.$option_number.'" />
		</form>';
		
		//***************************************
	}
	
	
	
	
	
	
	
	
	
	
	
	
	//==================================================
	// SAVE
	//==================================================
	
	if($todo == 'save_poll'){
		//***************************************
		//
		// WRITE XML
		//
		
		
		if($your_new_poll_titel == ''){
			echo '<script>alert(\''._MSG_NOCONTENT.'\');history.go(-1);</script>';
		}
		else{
			// CHARSETS
			$your_new_poll_titel = $tcms_main->encodeText($your_new_poll_titel, '2', $c_charset);
			
			
			if($choosenDB == 'xml'){
				if($cnp == 1){
					mkdir(_TCMS_PATH.'/tcms_polls/'.$ynp);
					chmod(_TCMS_PATH.'/tcms_polls/'.$ynp, 0777);
				}
				
				
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_polls/'.$ynp.'.xml', 'w');
				$xmluser->xml_c_declaration($c_charset);
				$xmluser->xml_section('poll');
				
				// --> write values
				$xmluser->write_value('title', $your_new_poll_titel);
				
				$cq = 1;
				for($pppo = 1; $pppo < $on; $pppo++){
					if(isset($_POST['option'.$pppo]) && $_POST['option'.$pppo] != '' && !empty($_POST['option'.$pppo])){
						$tmp = $_POST['option'.$pppo];
						$tmp = $tcms_main->encodeText($tmp, '2', $c_charset);
						$xmluser->write_value('question'.$cq, $tmp);
						$cq++;
					}
				}
				
				$xmluser->write_value('question'.$cq, '__END_POLL_QUESTION__');
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('poll');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				if($extra == 'new'){
					switch($choosenDB){
						case 'mysql':
							$newSQLColumns = '`title`';
							break;
						
						case 'pgsql':
							$newSQLColumns = 'title';
							break;
						
						case 'mssql':
							$newSQLColumns = '[title]';
							break;
					}
					
					$newSQLData = "'".$your_new_poll_titel."'";
					
					$cq = 1;
					for($pppo = 1; $pppo < $on; $pppo++){
						if(isset($_POST['option'.$pppo]) && $_POST['option'.$pppo] != '' && !empty($_POST['option'.$pppo])){
							$tmp = $_POST['option'.$pppo];
							$tmp = $tcms_main->encodeText($tmp, '2', $c_charset);
							
							switch($choosenDB){
								case 'mysql':
									$newSQLColumns .= ', `question'.$cq.'`';
									break;
								
								case 'pgsql':
									$newSQLColumns .= ', question'.$cq;
									break;
								
								case 'mssql':
									$newSQLColumns .= ', [question'.$cq.']';
									break;
							}
							
							$newSQLData .= ", '".$tmp."'";
							
							$cq++;
						}
					}
					
					$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'polls', $newSQLColumns, $newSQLData, $ynp);
				}
				else{
					$newSQLData = $tcms_db_prefix.'polls.title="'.$your_new_poll_titel.'"';
					
					$cq = 1;
					for($pppo = 1; $pppo < $on; $pppo++){
						if(isset($_POST['option'.$pppo]) && $_POST['option'.$pppo] != '' && !empty($_POST['option'.$pppo])){
							$tmp = $_POST['option'.$pppo];
							$tmp = $tcms_main->encodeText($tmp, '2', $c_charset);
							$newSQLData .= ', '.$tcms_db_prefix.'polls.question'.$cq.'="'.$tmp.'"';
							$cq++;
						}
					}
					
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'polls', $newSQLData, $ynp);
				}
			}
			
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_poll\'</script>';
			//***************************************
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	//==================================================
	// SAVE
	//==================================================
	
	if($todo == 'save'){
		//***************************************
		//
		// WRITE XML
		//
		
		
		if($tmp_poll_title == '')   { $tmp_poll_title    = ''; }
		if($tmp_allpoll_title == ''){ $tmp_allpoll_title = ''; }
		if(empty($tmp_use_poll_sm)) { $tmp_use_poll_sm   = 0; }
		if(empty($tmp_use_poll_tm)) { $tmp_use_poll_tm   = 0; }
		if(empty($tmp_show_pt))     { $tmp_show_pt       = 0; }
		if($tmp_poll_s_width == '') { $tmp_poll_s_width  = '80'; }
		if($tmp_poll_m_width == '') { $tmp_poll_m_width  = '80'; }
		;
		
		// CHARSETS
		$tmp_poll_title    = $tcms_main->encodeText($tmp_poll_title, '2', $c_charset);
		$tmp_allpoll_title = $tcms_main->encodeText($tmp_allpoll_title, '2', $c_charset);
		
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_global/poll.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('poll');
			
			// --> write values
			$xmluser->write_value('poll_title', $tmp_poll_title);
			$xmluser->write_value('allpoll_title', $tmp_allpoll_title);
			$xmluser->write_value('show_poll_title', $tmp_show_pt);
			$xmluser->write_value('poll_side_width', $tmp_poll_s_width);
			$xmluser->write_value('poll_main_width', $tmp_poll_m_width);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('poll');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'poll_config.poll_title="'.$tmp_poll_title.'", '
			.$tcms_db_prefix.'poll_config.allpoll_title="'.$tmp_allpoll_title.'", '
			.$tcms_db_prefix.'poll_config.show_poll_title='.$tmp_show_pt.', '
			.$tcms_db_prefix.'poll_config.poll_side_width='.$tmp_poll_s_width.', '
			.$tcms_db_prefix.'poll_config.poll_main_width='.$tmp_poll_m_width;
			
			$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'poll_config', $newSQLData, 'poll');
		}
		
		//***************************************
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_poll\'</script>';
		
		//***************************************
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	//===================================================================================
	// DELETE
	//===================================================================================
	if($todo == 'delete'){
		if($check == 'yes'){
			if($choosenDB == 'xml'){
				unlink(_TCMS_PATH.'/tcms_polls/'.$poll.'.xml');
				$tcms_file->deleteDir(_TCMS_PATH.'/tcms_polls/'.$poll.'/');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$sqlAL->sqlDeleteOne($tcms_db_prefix.'polls', $poll);
				$sqlAL->sqlQuery("DELETE FROM ".$tcms_db_password."poll_items WHERE poll_uid='".$poll."'");
			}
			
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_poll\'</script>';
		}
		else{
			echo '<script type="text/javascript">
			delCheck = confirm("'._MSG_DELETE_SUBMIT.'");
			if(delCheck == false){
				document.location=\'admin.php?id_user='.$id_user.'&site=mod_poll\';
			}
			else{
				document.location=\'admin.php?id_user='.$id_user.'&site=mod_poll&todo=delete&check=yes&poll='.$poll.'\';
			}
			</script>';
		}
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}


?>


