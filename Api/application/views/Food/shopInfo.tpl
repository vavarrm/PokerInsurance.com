<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="vavarrm">

    <title><{$language.website_name}></title>

    <{include file="frontend/css.tpl"}>
    <!-- Custom CSS -->
    <link href="/css/modern-business.css?<{$randseed}>" rel="stylesheet">

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
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><{$language.item_shopinfo}>
                    <small>店家名称</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/MainPage"><{$language.nav_index}></a>
                    </li>
                    <li class="active"><{$language.item_shopinfo}>－店家名称</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">
            <div class="col-md-8">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive" src="http://placehold.it/750x500" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="http://placehold.it/750x500" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="http://placehold.it/750x500" alt="">
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <h3>店家名称</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
                <h3><{$language.item_shopinfo_details}></h3>
				<p>
					3481 Melrose Place<br>Beverly Hills, CA 90210<br>
				</p>
				<p>
					<i class="fa fa-phone"></i> 
					<abbr title="Phone">P</abbr>: (123) 456-7890
				</p>
				<p>
					<i class="fa fa-envelope-o"></i> 
					<abbr title="Email">E</abbr>: <a href="mailto:name@example.com">name@example.com</a>
				</p>
				<p>
					<i class="fa fa-clock-o"></i> 
					<abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM
				</p>
					<ul class="list-unstyled list-inline list-social-icons">
						<li>
							<a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
						</li>
					</ul>
            </div>
        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><{$language.item_shopinfo_500x300}></h3>
            </div>
			<{foreach from=$shopImageList item=row}>
			<div class="col-sm-3 col-xs-6">
                <a href="http://placehold.it/500x300.jpg"  data-fancybox="gallery">
                    <img class="img-responsive img-hover img-related" src="http://placehold.it/500x300" alt="">
                </a>
            </div>
			<{/foreach}>
        </div>
        <!-- /.row -->

        <hr>
		<iframe width="100%"  height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
        <!-- Footer -->
		<{include file="frontend/footer.tpl"}>
    </div>
    <!-- /.container -->

	<{include file="frontend/js.tpl"}>
</body>

</html>
