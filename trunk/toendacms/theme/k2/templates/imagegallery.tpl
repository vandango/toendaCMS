<!--#####IMAGEGALLERY_ALBUMLIST_HEADER_TEMPLATE_BEGIN#####-->
<tr>
	<th class="titleBG" align="left" width="20%">
		<strong>#####ALBUM_GALERY_TITLE#####</strong>
	</th>
	<th class="titleBG" align="left" width="70%" style="padding-left: 5px;">
		<strong>#####ALBUM_GALERY_DESCRIPTION#####</strong>
	</th>
</tr>
<tr>
	<td valign="top" colspan="2" style="height: 7px;">
	</td>
</tr>
<!--#####IMAGEGALLERY_ALBUMLIST_HEADER_TEMPLATE_END#####-->


<!--#####IMAGEGALLERY_ALBUMLIST_ENTRY_TEMPLATE_BEGIN#####-->
<tr>
	<td colspan="2" class="text_big">
		<div class="headLineGallery">
			<br />
			<span class="text_big">
				<a style="padding-left: 3px;" href="#####ALBUM_LINK#####">
				<strong>#####ALBUM_TITLE#####</strong>
				</a>
			</span>
		</div>
	</td>
</tr>
<tr>
	<td valign="top" colspan="2" style="height: 3px;">
	</td>
</tr>
<tr class="text_normal">
	<td width="20%" valign="top">
		<a href="#####ALBUM_LINK#####">
		<img style="border: 1px solid #333333;" src="#####ALBUM_THUMBNAIL_IMAGE#####" border="0" align="left" />
		</a>
	</td>
	<td width="70%" valign="top" style="padding-left: 5px;">
		#####ALBUM_DESCRIPTION#####
	</td>
</tr>
<tr>
	<td valign="top" colspan="2">
		<div class="headLinePadding">
			<img src="#####ALBUM_BLANK_IMAGE#####" border="0" height="1" />
		</div>
	</td>
</tr>
<!--#####IMAGEGALLERY_ALBUMLIST_ENTRY_TEMPLATE_END#####-->


<!--#####IMAGEGALLERY_ALBUM_LIST_VIEW_TEMPLATE_BEGIN#####-->
<tr>
	<td width="110" valign="top">
		<a href="#####ALBUM_IMAGE_LINK#####" target="_blank">
		<img style="border: 1px solid #333333;" src="#####ALBUM_IMAGE_THUMBNAIL#####" border="0" />
		</a>
	</td>
	<td valign="top">
		<div class="text_normal gallery_text">
			#####ALBUM_IMAGE_TITLE#####
		</div>
		
		{php:} if('#####ALBUM_IMAGE_TITLE#####' != '') {
			echo '<hr class="hr_line" />';
		} {:php}
		
		#####ALBUM_IMAGE_COMMENTS_LINK#####
		
		<span class="text_normal">
			#####ALBUM_IMAGE_UPLOAD_DATE#####
		</span>
		
		#####ALBUM_IMAGE_DETAILS#####
	</td>
</tr>
<tr style="height: 15px;">
	<td colspan="2">
	</td>
</tr>
<!--#####IMAGEGALLERY_ALBUM_LIST_VIEW_TEMPLATE_END#####-->


<!--#####IMAGEGALLERY_ALBUM_THUMB_VIEW_TEMPLATE_BEGIN#####-->
<td width="100">
	<a href="#####ALBUM_IMAGE_LINK#####" target="_blank">
	<img style="border: 1px solid #333333;" src="#####ALBUM_IMAGE_THUMBNAIL#####" border="0" />
	</a>
</td>
<!--#####IMAGEGALLERY_ALBUM_THUMB_VIEW_TEMPLATE_END#####-->