<!--#####LINK_TITLE_TEMPLATE_BEGIN#####-->
<div class="headLineLinksMainpage">
<br />
<span class="text_big" style="padding-left: 3px;">
<strong>#####LINK_TITLE#####</strong>
</span>
</div>
<br />
<!--#####LINK_TITLE_TEMPLATE_END#####-->


<!--#####LINK_ENTRY_TEMPLATE_BEGIN#####-->
<span class="text_normal">
	<span style="padding-left: 6px;">&raquo; <a target="#####LINK_TARGET#####" href="#####LINK_LINK#####">#####LINK_TEXT#####</a>
		{php:} if('#####LINK_DESC#####' != '') {
			echo '<br />'
			.'<span class="text_normal" style="padding-left: 3px;">#####LINK_DESC#####</span>';
		} {:php}
	</span>
	<br />
</span>
<!--#####LINK_ENTRY_TEMPLATE_END#####-->