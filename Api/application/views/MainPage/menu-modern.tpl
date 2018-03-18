<!-- Page Content-->
<main class="page-content">
<!-- Breadcrumbs & Page title-->
<{include file="Frontend/breadcrumbs.tpl"}>
<section class="section-50 section-sm-100">
  <div class="shell isotope-wrap">
	<div class="range range-sm-center">
	  <div class="cell-xs-12" ng-controller="categoryCtrl">
		<div class="cell-box">
		  <ul class="isotope-filters-responsive">
			<li>
			  <p>Choose your category:</p>
			</li>
			<li class="block-top-level">
			  <!-- Isotope Filters-->
			  <button data-custom-toggle="#isotope-1" data-custom-toggle-disable-on-blur="true" class="isotope-filters-toggle btn btn-primary-lighter btn-shape-circle">Filter<span class="caret"></span></button>
			  <div id="isotope-1" class="isotope-filters isotope-filters-buttons">
				<ul class="inline-list"  >
					<{foreach from=$categorys item=category}>
					<li><a data-isotope-filter="Category <{$category.ca_id}>" data-isotope-group="gallery" href="#" class="btn-shape-circle btn"><{$category.ca_name}></a></li>
					<{/foreach}>
				</ul>
			  </div>
			</li>
		  </ul>
		</div>
	  </div>
	  <div class="cell-xs-12 offset-top-40">
		<!-- Isotope Content-->
		<div data-isotope-layout="fitRows" data-isotope-group="gallery" data-photo-swipe-gallery="gallery" class="row isotope isotope-menu">
		  <{foreach from=$foods item=food}>
		  <div data-filter="Category <{$food.ca_id}>" class="col-xs-12 col-sm-6 col-md-4 isotope-item">
			<div class="thumbnail-menu-modern">
			  <figure>
				<{*<img src="images/food/<{$food.ca_id}>-<{$food.f_id}>-310x260.png" alt="" width="310" height="260" class="img-responsive"/>*}>
				<img src="https://fakeimg.pl/310x260/" alt="" width="310" height="260" class="img-responsive"/>
			  </figure>
			  <div class="caption">
				<h5><a href="menu-single.html" class="link link-default"><{$food.f_name}></a></h5>
				<p class="text-italic"><{$food.f_description}></p>
				<p class="price"><{$food.f_large_price}></p><a href="/Food/index/<{$food.f_id}>" class="btn btn-shape-circle btn-primary offset-top-15">Order Online</a>
			  </div>
			</div>
		  </div>
		  <{/foreach}>
		</div>
	  </div>
	</div>
  </div>
</section>
<section class="bg-image-11 context-dark">
  <div class="shell section-80 section-sm-130">
	<div class="range range-xs-center range-lg-bottom">
	  <div class="cell-md-9">
		<div class="group-sm">
		  <h3 class="text-baseline">Fast Delivery</h3>
		  <div class="group-sm offset-top-15 offset-lg-top-0">
			<hr class="hr divider-xs bg-primary text-top veil reveal-lg-inline-block">
			<p class="text-white big offset-lg-top-0 text-top">Enjoy our free, fast, and reliable delivery service.</p>
		  </div>
		</div>
	  </div>
	  <div class="cell-lg-3"><a href="shop-single.html" class="btn btn-shape-circle btn-white-outline btn-min-width-md">order online</a></div>
	</div>
  </div>
</section>
</main>
