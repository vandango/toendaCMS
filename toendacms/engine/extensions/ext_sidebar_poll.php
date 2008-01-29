<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Poll Module
|
| File:	ext_sidebar_poll.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Poll Module
 *
 * This module provides the poll functionality.
 *
 * @version 0.4.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if($use_poll == 1) {
	if(isset($_GET['paction'])) { $paction = $_GET['paction']; }
	if(isset($_GET['ps'])) { $ps = $_GET['ps']; }
	if(isset($_GET['vote'])) { $vote = $_GET['vote']; }
	if(isset($_GET['current_pollall'])) { $current_pollall = $_GET['current_pollall']; }
	
	if(isset($_POST['poll'])) { $poll = $_POST['poll']; }
	if(isset($_POST['ip'])) { $ip = $_POST['ip']; }
	if(isset($_POST['make'])) { $make = $_POST['make']; }
	if(isset($_POST['answer'])) { $answer = $_POST['answer']; }
	
	
	if(!isset($ws_cip)) { $ws_cip = false; }
	if(!isset($make)) { $make = ''; }
	
	
	
	/*
		init
	*/
	if($choosenDB == 'xml') {
		$poll_xml = new xmlparser(_TCMS_PATH.'/tcms_global/poll.xml','r');
		$show_pt         = $poll_xml->readSection('poll', 'show_poll_title');
		$stitle_ext_poll = $poll_xml->readSection('poll', 'poll_title');
		$sw_poll         = $poll_xml->readSection('poll', 'poll_side_width');
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'poll_config', 'poll');
		$sqlObj = $sqlAL->fetchObject($sqlQR);
		
		$show_pt         = $sqlObj->show_poll_title;
		$stitle_ext_poll = $sqlObj->poll_title;
		$sw_poll         = $sqlObj->poll_side_width;
	}
	
	
	
	
	$stitle_ext_poll = $tcms_main->decodeText($stitle_ext_poll, '2', $c_charset);
	
	/* LOAD POLL       */
	if($choosenDB == 'xml') {
		$arr_polls = $tcms_file->getXMLFiles(_TCMS_PATH.'/tcms_polls/');
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlQR = $sqlAL->getAll($tcms_db_prefix.'polls');
		$count = 0;
		while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
			$arr_polls[$count] = $sqlObj->uid;
			
			if($arr_polls[$count] == NULL)
				$arr_polls[$count] = '';
			
			$count++;
		}
		$sqlAL->freeResult($sqlQR);
	}
	
	if(is_array($arr_polls)) {
		array_multisort($arr_polls, SORT_ASC, SORT_NUMERIC);
		
		
		// CURRENT POLL
		if(!isset($current_poll)) {
			$current_poll = $arr_polls[0];
		}
		
		// CURRENT POLLTAG
		$current_poll_tag = substr($current_poll, 0, 32);
		
		// YOU IP
		$your_ip = getenv('REMOTE_ADDR');
		
		// HAVE YOU VOTE?
		if($choosenDB == 'xml') {
			$arr_polls = $tcms_file->getPathContent(
				_TCMS_PATH.'/tcms_polls/'.$current_poll_tag, 
				false, 
				'.xml'
			);
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlQR = $sqlAL->getAll($tcms_db_prefix."poll_items WHERE poll_uid='".$current_poll_tag."'");
			$count = 0;
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
				$arr_vote[$count] = $sqlObj->ip;
				
				if($arr_vote[$count] == NULL)
					$arr_vote[$count] = '';
				
				$count++;
			}
			$sqlAL->freeResult($sqlQR);
		}
		
		
		
		$paction = 'poll';
		$ws_cip = false;
		
		
		if($choosenDB == 'xml') { $your_ip2 = $your_ip.'.xml'; }
		else { $your_ip2 = $your_ip; }
		
		
		if(is_array($arr_vote)) {
			if(in_array($your_ip2, $arr_vote)) {
				$paction = 'result';
				$ws_cip = true;
			}
		}
		
		if(isset($ps) && $ps == 'result') {
			$paction = 'result';
			$ws_cip = true;
			$current_poll_tag = $vote;
		}
		
		
		
		
		
		
		if($show_pt == 1)
			echo $tcms_html->subTitle($stitle_ext_poll).'<br />';
		echo '<div class="poll_sidebar">';
		
		
		
		
		
		/*********************
		*
		* VOTING
		*
		*/
		
		if($paction == 'poll') {
			//if($show_ext_poll == 1) {
			if($use_poll == 1) {
				if($choosenDB == 'xml') {
					$vote_xml = new xmlparser(_TCMS_PATH.'/tcms_polls/'.$current_poll, 'r');
					$poll_subtitle  = $vote_xml->readSection('poll', 'title');
				}
				else {
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'polls', $current_poll);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					$poll_subtitle  = $sqlARR['title'];
				}
				
				$poll_subtitle = $tcms_main->decodeText($poll_subtitle, '2', $c_charset);
				
				echo tcms_html::text($poll_subtitle, 'left');
				
				echo '<div align="left" style="width: '.$sw_poll.'px;">';
				echo '<form name="selectform" paction="?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'" method="post">';
				
				$qc = 1;
				if($choosenDB == 'xml') {
					do{
						$question = $vote_xml->readSection('poll', 'question'.$qc);
						if($question != '__END_POLL_QUESTION__') {
							$question = $tcms_main->decodeText($question, '2', $c_charset);
							
							echo $tcms_html->pollVoteBar($question, $qc, $sw_poll);
						}
						$qc++;
					}while($question != '__END_POLL_QUESTION__');
				}
				else {
					do{
						$question = $sqlARR['question'.$qc];
						if($question != NULL) {
							$question = $tcms_main->decodeText($question, '2', $c_charset);
							
							echo $tcms_html->pollVoteBar($question, $qc, $sw_poll);
						}
						$qc++;
					}while($question != NULL);
				}
				
				echo '<input type="hidden" name="poll" value="'.$current_poll.'" />'
				.'<input type="hidden" name="ip" value="'.$your_ip.'" />'
				.'<input type="hidden" name="make" value="vote" />'
				.( isset($lang) ? '<input type="hidden" name="lang" value="'.$lang.'" />' : '' );
				
				echo '<input type="submit" value="'._TCMS_ADMIN_VOTE.'" border="0" class="inputbutton" />';
				
				echo '</form>';
				
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=polls&amp;s='.$s
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<a href="'.$link.'">'._POLL_ALLPOLLS.'</a>';
				
				
				$link = '?'.( isset($session) ? 'session='.$session.'&' : '' )
				.'id=polls&s='.$s.'&ps=result&vote='.$current_poll_tag
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '&nbsp;&nbsp;<a href="'.$link.'">'._POLL_RESULT.'</a>';
				echo '</div>';
				
				echo '<br />';
			}
		}
		
		
		
		
		
		
		
		/*********************
		*
		* SHOW RESULTS
		*
		*/
		
		if($paction == 'result') {
			if($choosenDB == 'xml') {
				$vote_xml = new xmlparser(_TCMS_PATH.'/tcms_polls/'.$current_poll_tag.'.xml', 'r');
				$poll_subtitle = $vote_xml->readSection('poll', 'title');
				
				$poll_subtitle = $tcms_main->decodeText($poll_subtitle, '2', $c_charset);
				
				echo $tcms_html->text($poll_subtitle, 'left')
				.'<br />';
				
				//$number    = $tcms_main->l-o-a-d-_-x-m-l-_-f-i-l-e-s(
				//_TCMS_PATH.'/tcms_polls/'.$current_poll_tag, 'number');
				$files = $tcms_file->getPathContent(
					_TCMS_PATH.'/tcms_polls/'.$current_poll_tag, 
					false, 
					'.xml'
				);
				$number = $tcms_main->countArrayValues($files);
				
				$arrPollCalc       = $tcms_main->count_answers(_TCMS_PATH.'/tcms_polls/'.$current_poll_tag);
				
				$arr_count_answers = $arrPollCalc['answers'];
				$arr_question      = $arrPollCalc['question'];
				$qc                = $arrPollCalc['amount'];
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'polls', $current_poll_tag);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				$poll_subtitle  = $sqlARR['title'];
				$sqlAL->freeResult($sqlQR);
				
				$sqlQRPollItems = $sqlAL->sqlQuery("SELECT * FROM ".$tcms_db_prefix."poll_items WHERE poll_uid = '".$current_poll_tag."'");
				$number = $sqlAL->sqlGetNumber($sqlQRPollItems);
				
				$poll_subtitle = $tcms_main->decodeText($poll_subtitle, '2', $c_charset);
				echo tcms_html::text($poll_subtitle, 'left');
				echo '<br />';
				
				
				$arrPollCalc       = $tcms_main->count_answers_sql($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $current_poll_tag, 'nothing');
				
				$arr_count_answers = $arrPollCalc['answers'];
				$arr_question      = $arrPollCalc['question'];
				$qc                = $arrPollCalc['amount'];
			}
			
			echo $tcms_html->text(
				'(<span style="font-size: 9px; line-height: 0.9em;">'._POLL_RESULTTEXT.'</span>)', 
				'left'
			).'<br />';
			
			echo $tcms_html->tableHead('0', '0', '0', '95%')
			.$tcms_html->pollResultTableBreakLine('#eeeeee');
			
			for($sp = 1; $sp < $qc-1; $sp++) {
				
				/* WHICH BAR USE */ $bar_sp = $sp;
				/* AND FROM NULL */ if($bar_sp > 6) { $bar_sp = 1; }
				/* WIDTH OF BAR  */ $tbz_width = $sw_poll;
				
				if($arr_count_answers[$sp] != 0) {
					/* BAR WIDTH   */ $bar_width = ($arr_count_answers[$sp] / $number * $tbz_width) - 4;
					/* PLACEHOLDER */ $bar_place = tcms_html::image($imagePath.'engine/images/b_px.gif', '1', '10');
					/* BAR IMAGE   */ $poll_bar = tcms_html::image($imagePath.'engine/images/poll/bar'.$bar_sp.'.gif', $bar_width, '10');
					$ws_percent = (100 / $number) * $arr_count_answers[$sp];
					$ws_percent = substr($ws_percent, 0, 4);
				}
				else {
					/* NOTHING     */ $poll_bar = '&nbsp;';
					/* NOTHING     */ $bar_place = '&nbsp;';
					$ws_percent = 0;
				}
				
				if($arr_count_answers[$sp] != '' || isset($arr_count_answers[$sp]) && !empty($arr_count_answers[$sp])) {
					$counted_answers = $arr_count_answers[$sp];
				}
				else { $counted_answers = 0; }
				
				$arr_question[$sp] = $tcms_main->decodeText($arr_question[$sp], '2', $c_charset);
				
				echo $tcms_html->pollResultTable('10', $arr_question[$sp], $tbz_width, $bar_place.$poll_bar.$bar_place, '('.$counted_answers.')', $ws_percent.'&nbsp;&#37;');
				echo $tcms_html->pollResultTableBreakLine('#eeeeee');
			}
			echo tcms_html::table_end();
			
			$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id=polls&s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<br /><a href="'.$link.'">'._POLL_ALLPOLLS.'</a>';
		}
		
		
		
		
		
		
		
		/*********************
		*
		* SAVE VOTING
		*
		*/
		
		if($make == 'vote') {
			if($tcms_main->isReal($answer)) {
				echo '<br />'
				.$tcms_html->text($poll_lang_votetext, 'left');
				
				$poll  = substr($poll, 0, 32);
				$ip    = getenv('REMOTE_ADDR');
				
				if($ip == '') {
					$remote = 'localhost';
					$ip = '127.0.0.1';
				}
				else {
					$remote = getHostByAddr($ip);
				}
				
				if($choosenDB == 'xml') {
					$xmluser = new xmlparser(
						_TCMS_PATH.'/tcms_polls/'.$poll.'/'.$ip.'.xml', 
						'w'
					);
					
					$xmluser->xmlDeclarationWithCharset($c_charset);
					$xmluser->xmlSection('vote');
					
					$xmluser->writeValue('ip', $a_ip);
					$xmluser->writeValue('domain', $remote);
					$xmluser->writeValue('answer', $answer);
					
					$xmluser->xmlSectionBuffer();
					$xmluser->xmlSectionEnd('vote');
					
					$xmluser->flush();
					unset($xmluser);
				}
				else {
					$maintag = $tcms_main->getNewUID(8, 'poll_items');
					
					$sqlAL = new sqlAbstractionLayer(
						$choosenDB, 
						$tcms_time
					);
					
					$sqlCN = $sqlAL->connect(
						$sqlUser, 
						$sqlPass, 
						$sqlHost, 
						$sqlDB, 
						$sqlPort
					);
					
					switch($choosenDB) {
						case 'mysql':
							$newSQLColumns = '`poll_uid`, `ip`, `domain`, `answer`';
							break;
						
						case 'pgsql':
							$newSQLColumns = 'poll_uid, ip, "domain", answer';
							break;
						
						case 'mssql':
							$newSQLColumns = '[poll_uid], [ip], [domain], [answer]';
							break;
					}
					
					$newSQLData = "'".$poll."', '".$ip."', '".$remote."', '".$answer."'";
					
					$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'poll_items', $newSQLColumns, $newSQLData, $maintag);
				}
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id='.$id.'&amp;s='.$s
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<script>'
				.'document.location=\''.$link.'\';'
				.'alert(\''._MSG_POLL.'\');'
				.'</script>';
			}
			else {
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id='.$id.'&amp;s='.$s
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<script>'
				.'document.location=\''.$link.'\';'
				.'</script>';
			}
		}
		
		echo '</div><br /><br />';
	}
}

?> 
