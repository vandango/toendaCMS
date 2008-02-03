<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Template Upload Manager
|
| File:	mod_upload_layout.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Template Upload Manager
 *
 * This module is used as a upload and edit page for the
 * templates.
 *
 * @version 0.5.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['load_template_file'])){ $load_template_file = $_GET['load_template_file']; }

if(isset($_POST['zlib_upload'])){ $zlib_upload = $_POST['zlib_upload']; }
if(isset($_POST['dir'])){ $dir = $_POST['dir']; }
if(isset($_POST['name'])){ $name = $_POST['name']; }
if(isset($_POST['autor'])){ $autor = $_POST['autor']; }
if(isset($_POST['url'])){ $url = $_POST['url']; }
if(isset($_POST['template_version'])){ $template_version = $_POST['template_version']; }
if(isset($_POST['desc'])){ $desc = $_POST['desc']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['s'])){ $s = $_POST['s']; }
if(isset($_POST['template_file'])){ $template_file = $_POST['template_file']; }
if(isset($_POST['base64Content'])){ $base64Content = $_POST['base64Content']; }




if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	/*
		init
	*/
	if(!isset($todo)) { $todo = 'show'; }
	
	
	
	/*
		upload and edit
	*/
	if($todo == 'show') {
		$layout_xml = new xmlparser(_TCMS_PATH.'/tcms_global/layout.xml', 'r');
		$s = $layout_xml->readSection('layout', 'select');
		
		if(!isset($load_template_file)){ $load_template_file = 'index.php'; }
		
		
		/*
			tabpane start
		*/
		
		echo '<div class="tab-pane" id="tab-pane-1">';
		
		
		/*
			settings tab
		*/
		
		echo '<div class="tab-page" id="tab-page-set">'
		.'<h2 class="tab">'._TABLE_SETTINGS.'</h2>'// form
		.'<form name="ttEdit" id="ttEdit"'
		.' action="admin.php?id_user='.$id_user.'&site=mod_upload_layout"'
		.' method="post"'
		.' enctype="multipart/form-data">'
		.'<table cellpadding="1" cellspacing="2" width="100%" border="0" class="noborder">';
		
		
		// table rows
		$arrFiles = $tcms_file->getPathContent('../../theme/'.$s.'/');
		
		$link = 'admin.php?id_user='.$id_user.'&site=mod_upload_layout'
		.'&amp;load_template_file=';
		
		$js = ' onchange="document.location=\''.$link.'\' + this.value;"';
		
		echo '<tr>'
		.'<td class="tcms_padding_mini">'
		._LU_TEMPLATE_FILE.': <select class="tcms_select" id="choosenTemplateFile" name="choosenTemplateFile"'.$js.'>';
		
		foreach($arrFiles as $key => $val){
			if(!is_dir($val)){
				if(strpos($val, '.js') 
				|| strpos($val, '.css') 
				|| strpos($val, '.php') 
				|| strpos($val, '.html') 
				|| strpos($val, '.htm') 
				|| strpos($val, '.php5') 
				|| strpos($val, '.phtml') 
				|| strpos($val, '.xml') 
				|| strpos($val, '.xslt')
				|| strpos($val, '.tpl')) {
					//echo '1-'.strpos($val, '.php.bak').'<br>';
					if(!(strpos($val, '.php.bak') > 0)) {
						echo '
						
						<option value="'.$val.'"'
						.( $load_template_file == $val ? ' selected="selected"' : '' )
						.'>'
						.$val
						.'</option>';
					}
				}
			}
			
			//if(is_dir($val)){
			if(!strpos($val, '.')){
				$arrFiles = $tcms_file->getPathContent('../../theme/'.$s.'/'.$val.'/');
				
				foreach($arrFiles as $key2 => $val2){
					if(!is_dir($val2)){
						if(strpos($val2, '.js') 
						|| strpos($val2, '.css') 
						|| strpos($val2, '.php') 
						|| strpos($val2, '.html') 
						|| strpos($val2, '.htm') 
						|| strpos($val2, '.php5') 
						|| strpos($val2, '.phtml')
						|| strpos($val2, '.tpl')) {
							//echo '2-'.strpos($val2, '.php.bak').'<br>';
							if(!(strpos($val2, '.php.bak') > 0)) {
								echo '
								
								<option value="'.$val.'/'.$val2.'"'
								.( $load_template_file == $val.'/'.$val2 ? ' selected="selected"' : '' )
								.'>'
								.$val.'/'.$val2
								.'</option>';
							}
						}
					}
				}
			}
			
			clearstatcache();
		}
		
		echo '</select>'
		.'<br />'
		.'</td>'
		.'</tr>';
		
		
		// load the index file
		if(file_exists('../../theme/'.$s.'/'.$load_template_file)) {
			$tcms_file = new tcms_file('../../theme/'.$s.'/'.$load_template_file, 'r');
			$loadPHP = $tcms_file->Read();
			$tcms_file->Close();
		}
		else {
			$loadPHP = '';
		}
		
		
		// editor
		echo '<tr>'
		.'<td class="tcms_padding_mini">';
		
		if(strpos($load_template_file, '.php') 
		|| strpos($load_template_file, '.tpl') 
		|| strpos($load_template_file, '.html') 
		|| strpos($load_template_file, '.php5') 
		|| strpos($load_template_file, '.html')){
			echo '<script>createTemplateToolbar(\'ttEdit\', \'toendaTemplate\');</script><br />';
			echo '<script>createToolbar(\'ttEdit\', \''.$tcms_lang.'\', \'HTML\');</script>';
		}
		elseif(strpos($load_template_file, '.css')){
			echo '<script>createCSSToolbar(\'ttEdit\', \'CSS\');</script><br />';
		}
		
		echo '<textarea name="content" id="content" class="tcms_textarea_source" style="overflow: auto !important;">'
		.htmlspecialchars_decode($loadPHP)
		.'</textarea>'
		.'<br /><br />';
		/*
		$loadPHP = str_replace("\r", "", $loadPHP);
		$loadPHP = str_replace("\n", "\\n", $loadPHP);
		$loadPHP = str_replace('"', '\"', $loadPHP);
		$loadPHP = str_replace("\t", "\\t", $loadPHP);
		
		echo '<iframe name="editor" src="http://localhost/toendacms/engine/js/helene/editor.html" style="width: 100%; height: 70%; border: solid 1px #333;"></iframe>';
		echo '<script type="text/javascript">
		function init(){
			editor.setContents("<? echo $loadPHP; ?>");
		}
		</script>';
		*/
		echo '</td>'
		.'</tr>';
		
		
		// Table end
		echo '<br />';
		
		
		echo $tcms_html->tableEnd();
		
		
		// end form
		echo '<input name="todo" type="hidden" value="template_save" />'
		.'<input name="s" type="hidden" value="'.$s.'" />'
		.'<input name="base64Content" id="base64Content" type="hidden" value="" />'
		.'<input name="template_file" type="hidden" value="'.$load_template_file.'" />'
		.'</form>'
		.'</div>';
		
		
		/*
			text tab
		*/
		
		echo '<div class="tab-page" id="tab-page-text">'
		.'<h2 class="tab">'._LU_ZTITLE.'</h2>'
		.'<form name="zlib" id="zlib"'
		.' action="admin.php?id_user='.$id_user.'&site=mod_upload_layout"'
		.' method="post"'
		.' enctype="multipart/form-data">'
		.'<input name="todo" type="hidden" value="zlib_save" />';
		
		
		// table
		echo $tcms_html->tableHeadNoBorder();
		
		
		echo '<tr><td colspan="2" class="tcms_padding_mini">&nbsp;</td></tr>';
		
		
		// table rows
		echo '<tr>'
		.'<td class="tcms_padding_mini" colspan="2">'
		.$tcms_html->text(
			_LU_TEXT
			.'<br /><br />', 
			'left'
		)
		.'</td>'
		.'</tr>';
		
		
		// table rows
		echo '<tr>'
		.'<td class="tcms_padding_mini" width="150">'
		._LU_ZFILE
		.'</td><td>'
		.'<input name="zlib_upload" type="file" class="tcms_upload" />'
		.'</td>'
		.'</tr>';
		
		
		echo '<tr><td colspan="2" class="tcms_padding_mini">&nbsp;</td></tr>';
		
		
		// Table end
		echo $tcms_html->tableEnd()
		.'<br />';
		
		
		echo '</form>'
		.'</div>';
		
		
		/*
			tabpane end
		*/
		
		echo '<script type="text/javascript">'
		.'var tabPane1 = new WebFXTabPane(document.getElementById("tab-pane-1"));'
		.'tabPane1.addTabPage(document.getElementById("tab-page-text"));'
		.'tabPane1.addTabPage(document.getElementById("tab-page-set"));'
		.'setupAllTabs();'
		.'</script>'
		.'<br />';
		
		
		/*
			END
		*/
	}
	
	
	
	/*
		save template
	*/
	
	if($todo == 'template_save') {
		$content = $tcms_main->decodeBase64($base64Content);
		
		echo $content.'<hr>';
		echo $base64Content.'<hr>';
		
		//$tcms_file = new tcms_file('../../theme/'.$s.'/'.$template_file, 'w+');
		//$tcms_file->Backup();
		//$tcms_file->Write($content);
		//$tcms_file->Close();
		
		echo '<script>'
		//.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_upload_layout&load_template_file='.$template_file.'\';'
		.'</script>';
	}
	
	
	
	/*
		create new xml template description file
	*/
	
	if($todo == 'edit') {
		/*
			Create XML with Description
		*/
		echo $tcms_html->text(_LU_DES_TEXT.'<br /><br />', 'left');
		
		
		// form
		echo '<form name="edit" id="edit" action="admin.php?id_user='.$id_user.'&site=mod_upload_layout" method="post">'
		.'<input name="todo" type="hidden" value="edit_save" />';
		
		
		// table
		echo '<table width="98%" cellpadding="1" cellspacing="5">';
		
		
		// description
		echo '<tr><td valign="middle">'
			.'<input class="tcms_input_normal" name="dir" type="text" />'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong>'._LU_DES_DIR.'</strong>'
			.'</td></tr>';
		
		echo '<tr><td valign="middle">'
			.'<input class="tcms_input_normal" name="name" type="text" />'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong>'._LU_DES_NAME.'</strong>'
			.'</td></tr>';
		
		echo '<tr><td valign="middle">'
			.'<input class="tcms_input_normal" name="autor" type="text" />'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong>'._LU_DES_AUTOR.'</strong>'
			.'</td></tr>';
		
		echo '<tr><td valign="middle">'
			.'<input class="tcms_input_normal" name="url" type="text" />'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong>'._LU_DES_URL.'</strong>'
			.'</td></tr>';
		
		echo '<tr><td valign="middle">'
			.'<input class="tcms_input_normal" name="template_version" type="text" />'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong>'._LU_DES_VERSION.'</strong>'
			.'</td></tr>';
		
		echo '<tr><td valign="middle">'
			.'<input class="tcms_input_normal" name="desc" type="text" />'
			.'&nbsp;<img src="../images/dot_2.gif" border="0" />&nbsp;'
			.'<strong>'._TABLE_DESCRIPTION.'</strong>'
			.'</td></tr>';
		
		
		
		// table end
		echo '</table><br />';
		
		
		// end form
		echo '</form>';
	}
	
	
	
	/*
		GZ OR ZIP UPLOAD AND INSTALL
	*/
	
	if($todo == 'zlib_save') {
		if($_FILES['zlib_upload']['size'] > 0 
		&& $_FILES['zlib_upload']['type'] == 'application/zip') {
			// theme file name
			$gzFileName = $_FILES['zlib_upload']['name'];
			
			// theme dir name
			if(strpos($gzFileName, '.zip') == false){ $gzEnd = strpos($gzFileName, '.gz'); }
			else{ $gzEnd = strpos($gzFileName, '.zip'); }
			$gzDirName = substr($gzFileName, 0, $gzEnd);
			
			// make theme dir and make theme var name
			mkdir('../../theme/'.$gzDirName, 0777);
			
			// theme paths
			$themeDir  = '../../theme/'.$gzDirName.'/';
			$themePath = '../../theme';
			
			// copy file to theme directory
			copy($_FILES['zlib_upload']['tmp_name'], $themeDir.$gzFileName);
			
			// ZLib coding
			$archive = new PclZip($themeDir.$gzFileName);
			if($archive->extract(PCLZIP_OPT_PATH, $themePath) == 0){
				die(_MSG_ERROR.' : '.$archive->errorInfo(true));
			}
			
			// remove zip file
			unlink($themeDir.$gzFileName);
			
			// make path writeable
			chmod($themeDir, 0777);
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_upload_layout\';'
		.'</script>';
	}
	
	
	
	
	
	/*
		write description.
	*/
	if($todo == 'edit_save') {
		$var_conf = 'layout';
		
		if(!is_dir('../../theme/'.$dir)) {
			mkdir('../../theme/'.$dir, 0777);
		}
		
		$xmluser = new xmlparser('../../theme/'.$dir.'/index.xml','w');
		$xmluser->xmlDeclaration();
		$xmluser->xmlSection('template');
		
		$xmluser->writeValue('name', $name);
		$xmluser->writeValue('autor', $autor);
		$xmluser->writeValue('url', $url);
		$xmluser->writeValue('version', $template_version);
		$xmluser->writeValue('desc', $desc);
		
		$xmluser->xmlSectionBuffer();
		$xmluser->xmlSectionEnd('template');
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_upload_layout\';'
		.'</script>';
	}
}
else {
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
