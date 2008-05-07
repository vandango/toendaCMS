<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Poll Module (Contentplace)
|
| File:	ext_poll.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Poll Module (Contentplace)
 *
 * This module is used as a poll module.
 *
 * @version 0.4.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content-Modules
 */


if(isset($_GET['paction'])) { $paction = $_GET['paction']; }
if(isset($_GET['ps'])) { $ps = $_GET['ps']; }
if(isset($_GET['vote'])) { $vote = $_GET['vote']; }
if(isset($_GET['current_pollall'])) { $current_pollall = $_GET['current_pollall']; }

if(isset($_POST['a_poll'])) { $a_poll = $_POST['a_poll']; }
if(isset($_POST['a_ip'])) { $a_ip = $_POST['a_ip']; }
if(isset($_POST['a_make'])) { $a_make = $_POST['a_make']; }
if(isset($_POST['answer'])) { $answer = $_POST['answer']; }






if(!isset($a_ws_cip)) { $a_ws_cip = false; }
if(!isset($a_make)) { $a_make = ''; }



if($choosenDB == 'xml') {
	$poll_xml = new xmlparser(_TCMS_PATH.'/tcms_global/poll.xml','r');
	$title_ext_poll = $poll_xml->readSection('poll', 'poll_title');
	$title_ext_allpoll = $poll_xml->readSection('poll', 'allpoll_title');
	$mw_poll           = $poll_xml->readSection('poll', 'poll_main_width');
}
else {
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlQR = $sqlAL->getOne($tcms_db_prefix.'poll_config', 'poll');
	$sqlARR = $sqlAL->fetchArray($sqlQR);
	
	$title_ext_poll    = $sqlARR['poll_title'];
	$title_ext_allpoll = $sqlARR['allpoll_title'];
	$mw_poll           = $sqlARR['poll_main_width'];
}







$title_ext_allpoll = $tcms_main->decodeText($title_ext_allpoll, '2', $c_charset);
$title_ext_poll = $tcms_main->decodeText($title_ext_poll, '2', $c_charset);





/* LOAD POLL      */
if($choosenDB == 'xml') {
	$arr_apolls = $tcms_file->getPathContent(
		_TCMS_PATH.'/tcms_polls/', 
		false, 
		'.xml'
	);
}
else {
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	$sqlQR = $sqlAL->getAll($tcms_db_prefix.'polls');
	$count = 0;
	while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
		$arr_apolls[$count] = $sqlObj->uid;
		if($arr_apolls[$count] == NULL) { $arr_apolls[$count] = ''; }
		$count++;
	}
	$sqlAL->freeResult($sqlQR);
	unset($sqlAL);
}





if(is_array($arr_apolls)) {
	array_multisort($arr_apolls, SORT_ASC, SORT_NUMERIC);
	
	
	/* CURRENT POLL   */ if(!isset($current_pollall)) {$current_pollall = $arr_apolls[0]; }
	/* CURRENT POLLTAG*/ $current_pollall_tag = substr($current_pollall, 0, 32);
	/* YOU IP         */ $a_your_ip = getenv('REMOTE_ADDR');
	
	/* HAVE YOU VOTE? */
	if($choosenDB == 'xml') {
		$arr_voteall = $tcms_file->getPathContent(
			_TCMS_PATH.'/tcms_polls/'.$current_pollall_tag, 
			false, 
			'.xml'
		);
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlQR = $sqlAL->getAll($tcms_db_prefix."poll_items WHERE poll_uid='".$current_pollall_tag."'");
		$count = 0;
		while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
			$arr_voteall[$count] = $sqlObj->ip;
			if($arr_voteall[$count] == NULL) { $arr_voteall[$count] = ''; }
			$count++;
		}
		$sqlAL->freeResult($sqlQR);
		unset($sqlAL);
	}
	
	
	
	
	
	$paction = 'poll';
	$a_ws_cip = false;
	
	if($choosenDB == 'xml') { $your_ip2 = $a_your_ip.'.xml'; }
	else { $your_ip2 = $a_your_ip; }
	
	if(is_array($arr_voteall)) {
		if(in_array($your_ip2, $arr_voteall)) {
			$paction = 'result';
			$a_ws_cip = true;
		}
	}
	
	if(isset($ps) && $ps == 'result') {
		$paction = 'result';
		$a_ws_cip = true;
		$current_pollall_tag = $vote;
	}
}




echo $tcms_html->contentModuleHeader(
	$title_ext_poll
);


/*********************
*
* VOTING
*
*/

if($paction == 'poll') {
	if($choosenDB == 'xml') {
		if(strpos($current_pollall, '.xml')) {
			$tmp_current_pollall = $current_pollall;
		}
		else {
			$tmp_current_pollall = $current_pollall.'.xml';
		}
		
		$vote_xml = new xmlparser(_TCMS_PATH.'/tcms_polls/'.$tmp_current_pollall, 'r');
		$poll_subtitle  = $vote_xml->readSection('poll', 'title');
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlQR = $sqlAL->getOne($tcms_db_prefix.'polls', $current_pollall);
		$sqlARR = $sqlAL->fetchArray($sqlQR);
		$poll_subtitle  = $sqlARR['title'];
	}
	
	$poll_subtitle = $tcms_main->decodeText($poll_subtitle, '2', $c_charset);
	
	echo $tcms_html->text($poll_subtitle);
	
	echo '<form name="selectform" paction="?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=polls&amp;s='.$s.'" method="post">';
	echo '<div align="left" style="width: '.$mw_poll.'px;">';
	
	$qc = 1;
	if($choosenDB == 'xml') {
		do{
			$question = $vote_xml->readSection('poll', 'question'.$qc);
			if($question != '__END_POLL_QUESTION__') {
				$question = $tcms_main->decodeText($question, '2', $c_charset);
				echo tcms_html::poll_sheet($question, $qc, $mw_poll);
			}
			$qc++;
		}while($question != '__END_POLL_QUESTION__');
	}
	else {
		do{
			$question = $sqlARR['question'.$qc];
			if($question != NULL) {
				$question = $tcms_main->decodeText($question, '2', $c_charset);
				echo tcms_html::poll_sheet($question, $qc, $mw_poll);
			}
			$qc++;
		}while($question != NULL);
	}
	
	echo '<input type="hidden" name="a_poll" value="'.$current_pollall.'" />';
	echo '<input type="hidden" name="a_ip" value="'.$a_your_ip.'" />';
	echo '<input type="hidden" name="a_make" value="vote" />';
	
	echo '<input type="submit" value="'._TCMS_ADMIN_VOTE.'" border="0" class="inputbutton" />';
	
	$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
	.'id=polls&amp;s='.$s.'&amp;ps=result&amp;vote='.$current_pollall_tag
	.( isset($lang) ? '&amp;lang='.$lang : '' );
	$link = $tcms_main->urlConvertToSEO($link);
	
	echo '&nbsp;<a href="'.$link.'">'._POLL_RESULT.'</a>';
	echo '</div>';
	echo '</form>';
	
	echo '<br />';
}







/*********************
*
* SHOW RESULTS
*
*/

if($paction == 'result') {
	if($choosenDB == 'xml') {
		$vote_xml = new xmlparser(_TCMS_PATH.'/tcms_polls/'.$current_pollall_tag.'.xml', 'r');
		$poll_subtitle = $vote_xml->readSection('poll', 'title');
		
		$poll_subtitle = $tcms_main->decodeText($poll_subtitle, '2', $c_charset);
		echo $tcms_html->text($poll_subtitle);
		
		//$a_number = $tcms_main->l-o-a-d-_-x-m-l-_-f-i-l-e-s(
		//_TCMS_PATH.'/tcms_polls/'.$current_pollall_tag, 'number');
		$files = $tcms_file->getPathContent(
			_TCMS_PATH.'/tcms_polls/'.$current_pollall_tag, 
			false, 
			'.xml'
		);
		
		$a_number = $tcms_main->countArrayValues($files, false);
		
		$arrPollCalc       = $tcms_main->count_answers(_TCMS_PATH.'/tcms_polls/'.$current_pollall_tag);
		
		$arr_count_answers = $arrPollCalc['answers'];
		$arr_question      = $arrPollCalc['question'];
		$qc                = $arrPollCalc['amount'];
		$aa_number         = $arrPollCalc['amount'];
		$poll_answers      = $arrPollCalc['amounta'];
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlQRPoll = $sqlAL->getOne($tcms_db_prefix.'polls', $current_pollall_tag);
		$sqlARR = $sqlAL->fetchArray($sqlQRPoll);
		$poll_subtitle  = $sqlARR['title'];
		$sqlAL->freeResult($sqlQRPoll);
		
		$sqlQRPollItems = $sqlAL->query("SELECT * FROM ".$tcms_db_prefix."poll_items WHERE poll_uid = '".$current_pollall_tag."'");
		$a_number = $sqlAL->getNumber($sqlQRPollItems);
		
		$poll_subtitle = $tcms_main->decodeText($poll_subtitle, '2', $c_charset);
		echo $tcms_html->text($poll_subtitle);
		
		
		$poll_answers      = $tcms_main->count_answers_sql($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $current_pollall_tag, 'poll_answers');
		
		$arrPollCalc       = $tcms_main->count_answers_sql($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $current_pollall_tag, 'nothing');
		
		$arr_count_answers = $arrPollCalc['answers'];
		$arr_question      = $arrPollCalc['question'];
		$qc                = $arrPollCalc['amount'];
	}
	
	
	echo $tcms_html->text('<br /><span style="font-size: 9px;">'
		.'<strong>'.$poll_answers.' '._POLL_ANSWERS.'</strong>'.
		(
			 (' ('._POLL_RESULTTEXT.')')
		)
		.'</span><br />'
	);
	echo '<br />';
	
	echo $tcms_html->tableHead();
	echo $tcms_html->pollResultTableBreakLine('#eee');
	
	for($sp = 1; $sp < $qc-1; $sp++) {
		
		// WHICH BAR USE
		$bar_sp = $sp;
		
		// AND FROM NULL
		if($bar_sp > 6)
			$bar_sp = 1;
		
		// WIDTH OF BAR
		$tb_width = $mw_poll - 200;
		
		//$tb_width = 300;
		//$mw_poll;
		
		if($arr_count_answers[$sp] > 0
		&& $a_number > 0) {
			// BAR WIDTH
			$bar_width = ($arr_count_answers[$sp] / $a_number * $tb_width) - 4;
			
			// PLACEHOLDER
			$bar_place = $tcms_html->image($imagePath.'engine/images/b_px.gif', '1', '10');
			
			// BAR IMAGE
			$poll_bar = $tcms_html->image($imagePath.'engine/images/poll/bar'.$bar_sp.'.gif', $bar_width, '10');
			
			$ws_percent = (100 / $a_number) * $arr_count_answers[$sp];
			$ws_percent = substr($ws_percent, 0, 4);
		}
		else {
			$poll_bar = '&nbsp;';
			$bar_place = '&nbsp;';
			$ws_percent = 0;
		}
		
		if($arr_count_answers[$sp] != '' 
		|| isset($arr_count_answers[$sp]) 
		&& !empty($arr_count_answers[$sp])) {
			$counted_answers = $arr_count_answers[$sp];
		}
		else {
			$counted_answers = 0;
		}
		
		$arr_question[$sp] = $tcms_main->decodeText($arr_question[$sp], '2', $c_charset);
		
		echo $tcms_html->pollResultTable(
			'10', 
			$arr_question[$sp], 
			$tb_width, 
			$bar_place.$poll_bar.$bar_place, 
			'<strong>('.$counted_answers.')</strong>', 
			$ws_percent.'&nbsp;&#37;'
		);
		echo $tcms_html->pollResultTableBreakLine('#eee');
	}
	
	echo $tcms_html->tableEnd();
}








/*********************
*
* SHOW ALL POLLS
*
*/
$arr_allpolls = $arr_apolls;

if(is_array($arr_allpolls)) {
	array_multisort($arr_allpolls, SORT_DESC, SORT_NUMERIC);
	
	
	echo '<br /><br />'.$tcms_html->contentTitle($title_ext_allpoll, 'left').'<br />';
	
	if($tcms_main->isArray($arr_allpolls)) {
		foreach($arr_allpolls as $key => $value) {
			//$arr_vote = $tcms_main->l-o-a-d-_-x-m-l-_-f-i-l-e-s(
			//'data/polls/'.substr($current_poll, 0, 8), 'files');
			//echo $value;
			if($choosenDB == 'xml') {
				$ap_xml = new xmlparser(_TCMS_PATH.'/tcms_polls/'.$value, 'r');
				$poll_subtitle = $ap_xml->readSection('poll', 'title');
			}
			else {
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
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'polls', $value);
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				$poll_subtitle  = $sqlObj->title;
				
				$sqlAL->freeResult($sqlQR);
				unset($sqlAL);
			}
			
			$poll_subtitle = $tcms_main->decodeText($poll_subtitle, '2', $c_charset);
			
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=polls&amp;s='.$s.'&amp;current_pollall='.substr($value, 0, 32)
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo $tcms_html->text('<a href="'.$link.'">'.$poll_subtitle.'</a><br />', 'left');
		}
	}
}








/*********************
*
* SAVE VOTING
*
*/

if($a_make == 'vote') {
	if($tcms_main->isReal($answer)) {
		echo '<br />'
		.$tcms_html->text($poll_lang_votetext, 'left');
		
		$a_poll  = substr($a_poll, 0, 32);
		$a_ip    = getenv('REMOTE_ADDR');
		
		if($a_ip == '') {
			$remote = 'localhost';
			$a_ip = '127.0.0.1';
		}
		else {
			$remote = getHostByAddr($a_ip);
		}
		
		if($choosenDB == 'xml') {
			$xmluser = new xmlparser(
				_TCMS_PATH.'/tcms_polls/'.$a_poll.'/'.$a_ip.'.xml', 
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
			
			$newSQLData = "'".$a_poll."', '".$a_ip."', '".$remote."', '".$answer."'";
			
			$sqlQR = $sqlAL->createOne(
				$tcms_db_prefix.'poll_items', 
				$newSQLColumns, 
				$newSQLData, 
				$maintag
			);
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

?> 

