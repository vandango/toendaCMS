<!--#####DOWNLOAD_TABLE_HEADER_TEMPLATE_BEGIN#####-->
<tr>
	<td valign="top" class="titleBG" style="padding-left: 2px;" align="left" colspan="2">
		#####DOWNLOAD_CATEGORY_TITLE#####
	</td>
</tr>
<tr style="height: 2px;">
	<td colspan="2">
	</td>
</tr>
<tr>
	<td colspan="2">
		<br />
	</td>
</tr>
<!--#####DOWNLOAD_TABLE_HEADER_TEMPLATE_END#####-->

<!--#####DOWNLOAD_TABLE_ENTRY_CATEGORY_TEMPLATE_BEGIN#####-->
<tr>
	<td valign="top" align="center" width="70" style="padding-right: 5px;">
		#####DOWNLOAD_CATEGORY_IMAGE_LINK#####
	</td>
	<td valign="top" align="left">
		{php:} if('#####DOWNLOAD_CATEGORY_LINK#####' != '') {
			echo '<a class="main text_big" href="#####DOWNLOAD_CATEGORY_LINK#####">'
			.'<strong>#####DOWNLOAD_CATEGORY_TITLE#####</strong>'
			.'</a>'
			.'<br />';
		}else {
			echo '<strong>#####DOWNLOAD_CATEGORY_TITLE#####</strong>'
			.'<br />';
		} {:php}
		
		{php:} if('#####DOWNLOAD_CATEGORY_TEXT#####' != '') {
			echo '<span class="text_normal" style="text-align: left;">'
			.'#####DOWNLOAD_CATEGORY_TEXT#####'
			.'</span>';
		} {:php}
	</td>
</tr>
<tr>
	<td colspan="2">
		<hr class="hr_line" />
	</td>
</tr>
<!--#####DOWNLOAD_TABLE_ENTRY_CATEGORY_TEMPLATE_END#####-->

<!--#####DOWNLOAD_TABLE_ENTRY_DOWNLOAD_TEMPLATE_BEGIN#####-->
<tr>
	<td valign="top" align="center" width="70" style="padding-right: 5px;">
		#####DOWNLOAD_ITEM_IMAGE_LINK#####
	</td>
	<td valign="top" align="left">
		{php:} if('#####DOWNLOAD_ITEM_TITLE#####' != '') {
			echo '<a class="main text_big" href="#####DOWNLOAD_ITEM_LINK#####" target="_blank">'
			.'<strong>#####DOWNLOAD_ITEM_TITLE#####</strong>'
			.'</a>'
			.'<br />';
		}else {
			echo '<strong>#####DOWNLOAD_ITEM_TITLE#####</strong>'
			.'<br />';
		} {:php}
		
		<br />
		
		{php:} if('#####DOWNLOAD_ITEM_TEXT#####' != '') {
			echo '<span class="text_normal" style="text-align: left;">'
			.'#####DOWNLOAD_ITEM_TEXT#####'
			.'</span>'
			.'<br />'
			.'<br />';
		} {:php}
		
		<strong>#####DOWNLOAD_ITEM_UPLOADED_ON_TITLE#####:</strong>
		#####DOWNLOAD_ITEM_UPLOADED_ON_DATE#####
		<br />
		
		{php:} if('#####DOWNLOAD_ITEM_FILESIZE#####' != '') {
			echo '<strong>#####DOWNLOAD_ITEM_FILESIZE_TITLE#####:</strong>'
			.' #####DOWNLOAD_ITEM_FILESIZE#####'
			.'<br />';
		} {:php}
	</td>
</tr>
<tr>
	<td colspan="2">
		<hr class="hr_line" />
	</td>
</tr>
<!--#####DOWNLOAD_TABLE_ENTRY_DOWNLOAD_TEMPLATE_END#####-->
