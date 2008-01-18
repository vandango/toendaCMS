<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Import API
|
| File:	mod_import.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Import API
 *
 * This is used for the import api.
 *
 * @version 0.2.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['action'])){ $action = $_POST['action']; }




// ----------------------------------------
// INIT
// ----------------------------------------

if(!isset($todo)){ $todo = 'show'; }

$impKey = 1;




// ----------------------------------------
// SHOW OLD VALUES
// ----------------------------------------

if($todo == 'show') {
	echo $tcms_html->bold(_NEWS_CATEGORIES_TITLE);
	echo $tcms_html->text(
		'If you have posts or comments in another system WordPress'
		.' can import them into your current blog. To get started, choose'
		.' a system to import from below:<br /><br />',
		'left'
	);
	
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
	
	
	echo '<tr class="tcms_bg_blue_01">'
	.'<th valign="middle" class="tcms_db_title" width="15%" align="left">'._TABLE_IMPORT.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="100%" align="left">&nbsp;'._TABLE_DESCRIPTION.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="20%" align="left">'._TABLE_FUNCTIONS.'</th>'
	.'<tr>';
	
	
	// blogger ftp import
	if(phpversion() >= '5.0.0') {
		echo '<tr height="25" id="row'.$impKey.'" '
		.'bgcolor="'.$arr_color[$impKey].'" '
		.'onMouseOver="wxlBgCol(\'row'.$impKey.'\',\'#ececec\')" '
		.'onMouseOut="wxlBgCol(\'row'.$impKey.'\',\''.$arr_color[$impKey].'\')" '
		.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_import&amp;todo=bloggerftp\';">';
		
		echo '<td class="tcms_db_2">'._IMPORT_BLOGGER_FTP.'</td>';
		
		echo '<td class="tcms_db_2">'._IMPORT_BLOGGER_FTP_DESC.'</td>';
		
		echo '<td class="tcms_db_2" align="right" valign="middle">'
		.'<a title="'._IMPORT_BLOGGER_FTP.' '._TABLE_IMPORT.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_import&amp;todo=bloggerftp">'
		.'<img title="'._IMPORT_BLOGGER_FTP.' '._TABLE_IMPORT.'" alt="'._IMPORT_BLOGGER_FTP.' '._TABLE_IMPORT.'" style="padding-top: 3px;" border="0" src="../images/import_go.png" />'
		.'</a>&nbsp;'
		.'</td>';
		
		$impKey++;
		
		echo '</tr>';
	}
	
	
	// docbook xml (openoffice2 docbook) import
	/*if(phpversion() >= '5.2.0') {
		echo '<tr height="25" id="row'.$impKey.'" '
		.'bgcolor="'.$arr_color[$impKey].'" '
		.'onMouseOver="wxlBgCol(\'row'.$impKey.'\',\'#ececec\')" '
		.'onMouseOut="wxlBgCol(\'row'.$impKey.'\',\''.$arr_color[$impKey].'\')" '
		.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_import&amp;todo=opendocument\';">';
		
		echo '<td class="tcms_db_2">'._IMPORT_OOO2_DOCBOOK_XML.'</td>';
		
		echo '<td class="tcms_db_2">'._IMPORT_OOO2_DOCBOOK_XML_DESC.'</td>';
		
		echo '<td class="tcms_db_2" align="right" valign="middle">'
		.'<a title="'._IMPORT_OOO2_DOCBOOK_XML.' '._TABLE_IMPORT.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_import&amp;todo=opendocument">'
		.'<img title="'._IMPORT_OOO2_DOCBOOK_XML.' '._TABLE_IMPORT.'" alt="'._IMPORT_OOO2_DOCBOOK_XML.' '._TABLE_IMPORT.'" style="padding-top: 3px;" border="0" src="../images/import_go.png" />'
		.'</a>&nbsp;'
		.'</td>';
		
		$impKey++;
		
		echo '</tr>';
	}*/
	
	
	// table end
	echo '</table><br />';
}





// ----------------------------------------
// IMPORT FROM BLOGGER FTP
// ----------------------------------------

if($todo == 'bloggerftp') {
	if($action == 'startimport') {
		// information
		$letImport = false;
		$fileName = 'blogger.xml';
		$imgDir = '../../cache/';
		
		
		// check
		if($_FILES['event']['size'] > 0 && preg_match('/.xml/i', strtolower($_FILES['event']['name']))) {
			$letImport = true;
		}
		elseif(file_exists($imgDir.$fileName)) {
			$letImport = true;
		}
		else {
			$letImport = false;
		}
		
		
		// start
		if($letImport){
			// file upload
			if($_FILES['event']['size'] > 0 && preg_match('/.xml/i', strtolower($_FILES['event']['name'])))
				copy($_FILES['event']['tmp_name'], $imgDir.$fileName);
			
			
			if($choosenDB == 'xml'){
				$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml','r');
				$default_cat = $xml->read_section('global', 'default_category');
			}
			
			function post_date_manip($var){
				global $time, $date, $stamp, $publish_date, $order;
				
				$dd = (string)$var;
				$dd = strtotime($dd);
				
				$time = date('H:i', $dd);
				$date = date('d.m.Y', $dd);
				$stamp = date('YmdGm', $dd);
				$publish_date = date('d.m.Y-H:i', $dd);
				
				$day = date("d", $dd);
				$month = date("m", $dd);
				$year = date("Y", $dd);
				$hour = date("H", $dd);
				$minute = date("i", $dd);
				$seconds = date("s", $dd);
				
				$order = mktime(0, $minute, $hour, $month, $day, $year);
				$order = substr(md5($order), 0, 10);
			}
			
			function comment_date_manip($var){
				global $comment_time;
				
				$dd = (string)$var;
				$dd = strtotime($dd);
				
				$comment_time = date("YmdGis",$dd);
			}
			
			
			$xml_file = file_get_contents('../../cache/blogger.xml') or die("couldn't read from file\n");
			$xml = simplexml_load_string($xml_file);
			
			
			foreach($xml->blog as $blog) {
				$post_title = $blog->post->ItemTitle;
				$post_content = $blog->post->ItemBody;
				
				if($post_title != '' || $post_content != ''){
					$post_date_time = $blog->post->ItemDateTime;
					$post_author = $blog->post->ItemAuthor;
					
					$post_title = $tcms_main->decode_text_without_crypt($post_title, '2', $c_charset);
					$post_content = $tcms_main->decode_text_without_crypt($post_content, '2', $c_charset);
					
					post_date_manip($post_date_time);
					$enc_post_title = $tcms_main->decode_text($post_title, '2', $c_charset);
					$enc_post_content = $tcms_main->decode_text($post_content, '2', $c_charset);
					$enc_post_author = $tcms_main->decode_text($post_author, '2', $c_charset);
					
					$enc_post_title = $tcms_main->decode_text($post_title, '2', $c_charset);
					$enc_post_content = $tcms_main->decode_text($post_content, '2', $c_charset);
					$enc_post_author = $tcms_main->decode_text($post_author, '2', $c_charset);
					
					if($choosenDB == 'xml'){
						$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_news/'.$order.'.xml', 'w');
						$xml->xml_declaration();
						$xml->xml_section('news');
						
						$xml->write_value('title', $enc_post_title);
						$xml->write_value('autor', $enc_post_author);
						$xml->write_value('date', $date);
						$xml->write_value('time', $time);
						$xml->write_value('newstext', $enc_post_content);
						$xml->write_value('order', $order);
						$xml->write_value('stamp', $stamp);
						$xml->write_value('published', '1');
						$xml->write_value('publish_date', $publish_date);
						$xml->write_value('comments_enabled', '1');
						$xml->write_value('image', '');
						$xml->write_value('category', $default_cat);
						$xml->write_value('access', 'Public');
						
						$xml->xml_section_buffer();
						$xml->xml_section_end('news');
						
						$old_umask = umask(0);
						mkdir('../../'.$tcms_administer_site.'/tcms_news/comments_'.$order.'/', 0777);
						umask($old_umask);
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB);
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						switch($choosenDB){
							case 'mysql':
								$newSQLColumns = '`title`, `autor`, `date`, `time`, `newstext`, `stamp`, `published`, `publish_date`, `comments_enabled`, `image`, `access`';
								break;
							
							case 'pgsql':
								$newSQLColumns = 'title, autor, date, "time", newstext, stamp, published, publish_date, comments_enabled, image, "access"';
								break;
							
							case 'mssql':
								$newSQLColumns = '[title], [autor], [date], [time], [newstext], [stamp], [published], [publish_date], [comments_enabled], [image], [access]';
								break;
						}
						
						$newSQLData = "'".$enc_post_title."', '".$enc_post_author."', '".$date."', '".$time."', '"
						.$enc_post_content."', ".$stamp.", 1, '".$publish_date."', 1, '', 'Public'";
						
						$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'news', $newSQLColumns, $newSQLData, $order);
					}
					
					
					echo "post $order successfully written to file\n";
					
					
					foreach ($blog->comment as $comments) {
						$comment_content = $comments->CommentBody;
						if(!$comment_author = $comments->CommentAuthor->a) $comment_author = 'Anonymous';
						$comment_date_time = $comments->CommentDateTime;
						
						comment_date_manip($comment_date_time);
						$enc_comment_content = $tcms_main->decode_text($comment_content, '2', $c_charset);
						
						if($choosenDB == 'xml'){
							$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_news/comments_'.$order.'/'.$comment_time.'.xml', 'w');
							$xml->xml_declaration();
							$xml->xml_section('comment');
							
							$xml->write_value('name', $comment_author);
							$xml->write_value('email', '');
							$xml->write_value('web', '');
							$xml->write_value('msg', $enc_comment_content);
							$xml->write_value('time', $comment_time);
							$xml->write_value('ip', '127.0.0.1');
							$xml->write_value('domain', 'localhost');
							
							$xml->xml_section_buffer();
							$xml->xml_section_end('comment');
						}
						else{
						}
						
						echo "post comment successfully written to $order\n";
					}
				}
			}
			
			/*
			if($choosenDB == 'xml'){
				
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`name`, `desc`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'name, "desc"';
						break;
				}
				
				$newSQLData = "'".$new_cat_name."', '".$new_cat_desc."'";
				
				$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'news_categories', $newSQLColumns, $newSQLData, $maintag);
			}*/
			
			//unlink($imgDir.$fileNamev);
		}
		
		
		// delete temporary file
		//unlink($imgDir.$fileName);
		
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_import\';'
		.'</script>';
	}
	else {
		echo $tcms_html->bold(_IMPORT_BLOGGER_FTP).'<br />';
		echo $tcms_html->text(_IMPORT_BLOGGER_FTP_DESC.'<br /><br />', 'left');
		
		echo '<div style="padding: 0 0 0 10px;">';
		
		
		// upload file
		echo '<form name="upload" id="upload" action="admin.php?id_user='.$id_user.'&amp;site=mod_import" method="post" enctype="multipart/form-data">';
		
		
		// file
		echo '<input class="tcms_upload" name="event" type="file" value="file" />'
		.'<input name="todo" type="hidden" value="bloggerftp" />'
		.'<input name="action" type="hidden" value="startimport" />';
		
		echo '<input type="submit" name="reset" value="'._TABLE_START.' '._TABLE_IMPORT.'" '
		.'style="font-size: 16px; font-family: Verdana, arial, sans-serif; font-weight: bold;" />';
		
		
		// row
		echo '</form>';
		
		
		echo '</div>';
	}
}





// ----------------------------------------
// IMPORT FROM OPENDOCUMENT
// ----------------------------------------

if($todo == 'opendocument') {
	if($action == 'startimport') {
		// information
		$letImport = false;
		$fileName = 'docbook.xml';
		$imgDir = '../../cache/';
		
		
		// check
		if($_FILES['event']['size'] > 0 && preg_match('/.xml/i', strtolower($_FILES['event']['name']))) {
			$letImport = true;
		}
		elseif(file_exists($imgDir.$fileName)) {
			$letImport = true;
		}
		else {
			$letImport = false;
		}
		
		
		// start
		if($letImport) {
			// file upload
			if($_FILES['event']['size'] > 0 
			&& preg_match('/.xml/i', strtolower($_FILES['event']['name']))) {
				copy($_FILES['event']['tmp_name'], $imgDir.$fileName);
			}
		}
		
		
		// delete temporary file
		//unlink($imgDir.$fileName);
		
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_import\';'
		.'</script>';
	}
	else {
		echo $tcms_html->bold(_IMPORT_OOO2_DOCBOOK_XML).'<br />';
		echo $tcms_html->text(_IMPORT_OOO2_DOCBOOK_XML_DESC.'<br /><br />', 'left');
		
		echo '<div style="padding: 0 0 0 10px;">';
		
		// upload file
		echo '<form name="upload" id="upload" action="admin.php?id_user='.$id_user.'&amp;site=mod_import" method="post" enctype="multipart/form-data">';
		
		
		// file
		echo '<input class="tcms_upload" name="event" type="file" value="file" />'
		.'<input name="todo" type="hidden" value="docbookxml" />'
		.'<input name="action" type="hidden" value="startimport" />';
		
		echo '<input type="submit" name="reset" value="'._TABLE_START.' '._TABLE_IMPORT.'" '
		.'style="font-size: 16px; font-family: Verdana, arial, sans-serif; font-weight: bold;" />';
		
		
		// row
		echo '</form>';
		
		
		echo '</div>';
		
		echo '<h3>ODT2XHTML</h3><br />';
		
		using('toendacms.kernel.odtconverter', false, true);
		
		$class = new tcms_odtconverter();
		
		echo 'Try unzip file: ../../../test.odt<br />';
		
		try {
			$xml = $class->unzipFile('../../../test.odt', $tcms_file);
			
			echo 'Convert: '.$xml.'<br />';
			
			echo $class->convertUnzippedContent($xml);
		}
		catch(Exception $ex) {
			$tcms_html->displayException(
				$ex->getMessage(), 
				$ex->getTrace(), 
				$ex->getLine(), 
				$ex->getFile(), 
				$ex->getCode()
			);
		}
	}
}

?>
