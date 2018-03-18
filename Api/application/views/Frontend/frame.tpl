<!DOCTYPE html>
<html lang="zh-cn" class="wide wow-animation"  ng-app="sihaliveApp">
	<head>
		<!-- Site Title-->
		<{include file="Frontend/meta.tpl"}>
		<link rel="icon" href="/images/favicon.ico" type="image/x-icon">
		<!-- Stylesheets-->
		<{include file="Frontend/css.tpl"}>
		<!--[if lt IE 10]>
			<div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
			<script src="js/html5shiv.min.js"></script>
		<![endif]-->
	</head>
	<body ng-controller="bodyCtrl" ng-init="init()">
	<!-- Page-->
    <div class="page text-center" >
      <header class="page-head">
        <!-- RD Navbar-->
		<{include file="Frontend/navbar.tpl"}>
      </header>
      <!-- Page Content-->
	  <{include file="$content"}>
      <!-- Page Footer-->
      <{include file="Frontend/footer.tpl"}>
    </div>
    <!-- Global Mailform Output-->
    <div id="form-output-global"  class="snackbars" >
		<p>
			<span id="form-output-global-icon" class="icon text-middle fa icon-xxs"></span>
			<span class="message"></span>
		</p>
	</div>
    <!-- PhotoSwipe Gallery-->
	<{include file="Frontend/gallery.tpl"}>
	<script>
		var ca_id ="<{$smarty.get.ca_id}>";
		if(ca_id =="")
		{
			ca_id  = 1;
		}
	</script>
	<{include file="Frontend/js.tpl"}>
    <!-- Java script-->
	<script>
		window.onload=function()
		{	
			if($(document).width()<=1024)
			{
				$('.cartnums').removeClass('text-white').addClass('text-black');
			}
			
			$( window ).resize(function() {
				if($(document).width()<=1024)
				{
					$('.cartnums').removeClass('text-white').addClass('text-black');
				}else
				{
					$('.cartnums').removeClass('text-black').addClass('text-white');
				}
			});	
		}
	</script>
</body>
</html>