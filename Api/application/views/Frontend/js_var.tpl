<script>
	<{foreach from=$language_js_ary item=value key=k}>
	var <{$k}> ="<{$value}>"
	<{/foreach}>
	var fbAppId = "<{$fb_app_id}>";
	var  __nav =new Array();
	__nav['Home'] = '<{$language.nav_home}>';
	__nav['Menu'] = '<{$language.nav_menu}>';
	__nav['Contacts'] = '<{$language.nav_contact}>';
	__nav['Login'] = '<{$language.nav_login}>';
</script>