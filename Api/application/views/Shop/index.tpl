<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<{include file="frontend/meta.tpl"}>

    <title><{$language.website_name}></title>

	<{include file="frontend/css.tpl"}>
	<!-- Custom CSS -->
	<link href="/css/shop/index.css?<{$randseed}>" rel="stylesheet">

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
	<br>
    <!-- Page Content -->
    <div class="container">
		<div class="row">
			<div class="col-md-3 column productbox">
				<img src="http://placehold.it/460x250/e67e22/ffffff&text=HTML5" class="img-responsive">
				<div class="producttitle">Product 2</div>
				<div class="productprice"><div class="pull-right"><a href="#" class="btn btn-danger btn-sm" role="button">BUY</a></div><div class="pricetext">£8.95</div></div>
			</div>
			<div class="col-md-3 column productbox">
				<img src="http://placehold.it/460x250/e67e22/ffffff&text=HTML5" class="img-responsive">
				<div class="producttitle">Product 2</div>
				<div class="productprice"><div class="pull-right"><a href="#" class="btn btn-danger btn-sm" role="button">BUY</a></div><div class="pricetext">£8.95</div></div>
			</div>
			<div class="col-md-3 column productbox">
				<img src="http://placehold.it/460x250/e67e22/ffffff&text=HTML5" class="img-responsive">
				<div class="producttitle">Product 3</div>
				<div class="productprice"><div class="pull-right"><a href="#" class="btn btn-danger btn-sm" role="button">BUY</a></div><div class="pricetext">£8.95</div></div>
			</div>
			<div class="col-md-3 column productbox">
				<img src="http://placehold.it/460x250/e67e22/ffffff&text=HTML5" class="img-responsive">
				<div class="producttitle">Product 4</div>
				<div class="productprice"><div class="pull-right"><a href="#" class="btn btn-danger btn-sm" role="button">BUY</a></div><div class="pricetext">£8.95</div></div>
			</div>
			<div class="col-md-3 column productbox">
				<img src="http://placehold.it/460x250/e67e22/ffffff&text=HTML5" class="img-responsive">
				<div class="producttitle">Product 4</div>
				<div class="productprice"><div class="pull-right"><a href="#" class="btn btn-danger btn-sm" role="button">BUY</a></div><div class="pricetext">£8.95</div></div>
			</div>
		</div>
    </div>
    <!-- /.container -->

    <div class="container">
        <!-- Footer -->
		<{include file="frontend/footer.tpl"}>
    </div>
    <!-- /.container -->

	<{include file="frontend/js.tpl"}>
</body>
</html>
