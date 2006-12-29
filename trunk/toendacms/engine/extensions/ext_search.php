<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Search
|
| File:		ext_search.php
| Version:	0.1.8
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');





if($use_search == 1){
	if($choosenDB == 'xml'){
		$search_xml    = new xmlparser($tcms_administer_site.'/tcms_global/sidebar.xml','r');
		$show_st       = $search_xml->read_section('side', 'show_search_title');
		$sb_align      = $search_xml->read_section('side', 'search_alignment');
		$sb_withbr     = $search_xml->read_section('side', 'search_withbr');
		$sb_withbutton = $search_xml->read_section('side', 'search_withbutton');
		$sb_searchword = $search_xml->read_section('side', 'search_word');
		
		$sb_searchword = $tcms_main->decodeText($sb_searchword, '2', $c_charset);
		
		if($sb_searchword == ''){
			$sb_searchword = _SEARCH_BOX;
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$show_st       = $sqlARR['show_search_title'];
		$sb_align      = $sqlARR['search_alignment'];
		$sb_withbr     = $sqlARR['search_withbr'];
		$sb_withbutton = $sqlARR['search_withbutton'];
		$sb_searchword = $sqlARR['search_word'];
		
		$sb_searchword = $tcms_main->decodeText($sb_searchword, '2', $c_charset);
		
		if($sb_searchword == NULL || $sb_searchword == ''){
			$sb_searchword = _SEARCH_BOX;
		}
	}
	
	
	

	if($show_st == 1)
		echo tcms_html::subtitle(_SEARCH_TITLE).'<br />';
	
	echo '<div align="'.$sb_align.'">'
	.'<form action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?" method="post" style="margin: 0px !important; padding: 0px !important;">'
	.'<input class="inputtext searchform" type="text" name="searchword" value="'.$sb_searchword.'" onBlur="if(this.value==\'\') this.value=\''.$sb_searchword.'\';" onFocus="if(this.value==\''.$sb_searchword.'\') this.value=\'\';" />';
	
	// style="width: 100px;"
	
	if($sb_withbr == 1)
		echo '<br />';
	
	if($sb_withbutton == 1)
		echo '<input type="submit" value="'._SEARCH_SUBMIT.'" class="inputbutton" />';
	
	echo '<input type="hidden" name="id" value="search" />'
	.'<input type="hidden" name="s" value="'.$s.'" />'
	.'<input type="hidden" name="option" value="all" />'
	.( isset($session) ? '<input type="hidden" name="session" value="'.$session.'" />' : '' );
	
	echo '</form>'
	.'</div>';
	
	if($sb_withbr == 1)
		echo '<br /><br />';
}



?>
