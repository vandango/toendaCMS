<!--#####CONTENT_TEMPLATE_BEGIN#####-->
<div style="width: 99%; display: block;">
	<div class="contentheading">
		#####CONTENT_TITLE#####
	</div>
	
	{php:} if('#####CONTENT_SUBTITLE#####' != '') {
		echo '<span class="contentstamp">
			#####CONTENT_SUBTITLE#####
		</span>
		<br />
		<br />';
	} {:php}
	
	<div class="contentmain">
		#####CONTENT_TEXT#####
		<br />
		<br />
		#####CONTENT_FOOTNOTE#####
	</div>
</div>
<!--#####CONTENT_TEMPLATE_END#####-->
