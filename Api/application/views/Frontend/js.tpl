<!-- jQuery -->
<script>
	var mymap;
</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script type="text/javascript" src="/js/core.min.js"></script>
<{* jquery 1.2.1*}>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/script.min.js"></script>

<script src="/js/socket.io.js"></script>
<script type="text/javascript" src="/js/angular.min.js"></script>
<script type="text/javascript" src="/js/angular-cookies.min.js"></script>


<script type="text/javascript" src="/js/main.js"></script>


<{if $jsArray}>
	<{foreach from=$jsArray item=file}>
		<script src="/js/<{$file}>"></script>
	<{/foreach}>
<{/if}>
<{include file="Frontend/js_var.tpl"}>
<div id="dialog" title="<{$language.website_alert_title}>">
  <p></p>
</div>

