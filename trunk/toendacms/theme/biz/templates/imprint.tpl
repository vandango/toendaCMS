<!--#####IMPRINT_TEMPLATE_BEGIN#####-->
<span class="contentmain">
	<strong class="imptitle">
		#####IMPRINT_OWNER#####
	</strong>
	<br />
	<br />
	
	{php:} if('#####IMPRINT_CONTACT_PERSON#####' != '') {
		echo '#####IMPRINT_CONTACT_PERSON#####<br />';
	} {:php}
	
	#####IMPRINT_CONTACT_PERSON_EMAIL#####
	
	{php:} if('#####IMPRINT_CONTACT_PERSON_PHONE#####' != '') {
		echo '#####IMPRINT_CONTACT_PERSON_PHONE#####<br />';
	} {:php}
	
	{php:} if('#####IMPRINT_USE_CONTACT_PERSON#####' == '1') {
		echo '<br />#####IMPRINT_PERSON#####<br /><br />';
	} {:php}
	
	#####IMPRINT_TAXNUMBER#####
	<br />
	#####IMPRINT_TRADEID#####
	<br />
	<br />
	#####IMPRINT_COPYRIGHT#####
	<br />
	<br />
	#####IMPRINT_TEXT#####
</span>
<!--#####IMPRINT_TEMPLATE_END#####-->