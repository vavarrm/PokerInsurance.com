<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<{include file="frontend/meta.tpl"}>

    <title><{$language.website_name}></title>

	<{include file="frontend/css.tpl"}>
	<!-- Custom CSS -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Navigation -->
	<{include file="frontend/navigation.tpl"}>

    <!-- Page Content -->
	<div class="container" id="tourpackages-carousel">
		<div class="row">
			<{foreach from=$shopList item=list}>
			<div class="col-xs-18 col-sm-6 col-md-3">
			  <div class="thumbnail">
				<img src="http://placehold.it/500x300" alt="">
				  <div class="caption">
					<h4>店家名稱</h4>
					<p>簡介簡介簡介簡介簡介簡介簡介簡介簡介簡介簡介簡介簡介簡介簡介簡介簡介簡介簡介</p>
					<p>
						<a href="/Food/menu" class="btn btn-info btn-xs" role="button"><{$language.shop_menu}></a> 
						<a href="/Food/shopInfo" class="btn btn-default btn-xs" role="button"><{$language.shop_link}></a>
					</p>
				</div>
			  </div>
			</div>
			<{/foreach}>
		</div><!-- End row -->
    </div><!-- End container -->
    <!-- /.container -->

    <div class="container">
        <!-- Footer -->
		<{include file="frontend/footer.tpl"}>
    </div>
    <!-- /.container -->

	<{include file="frontend/js.tpl"}>
</body>
</html>
