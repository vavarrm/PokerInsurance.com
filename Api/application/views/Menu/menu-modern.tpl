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
			  <p><{$language.text_choose_your_category}></p>
			</li>
			<li class="block-top-level">
			  <!-- Isotope Filters-->
			  <button data-custom-toggle="#isotope-1" data-custom-toggle-disable-on-blur="true" class="isotope-filters-toggle btn btn-primary-lighter btn-shape-circle"><{$language.ext_filter}><span class="caret"></span></button>
			  <div id="isotope-1" class="isotope-filters isotope-filters-buttons">
				<ul class="inline-list"  >
					<{foreach from=$categorys item=category}>
						<li>
							<a data-isotope-filter="Category <{$category.ca_id}>" data-isotope-group="gallery" href="#" class="btn-shape-circle btn"><{$category.ca_name}></a>
						</li>
					<{/foreach}>
				</ul>
			  </div>
			</li>
		  </ul>
		</div>
	  </div>
	  <div class="cell-xs-12 offset-top-40" ng-controller="productPageCtrl" >
		<div id="setdialog" title="<{$food_language_ary.food_order_set}>" class="hidden" >
			<form class="rd-mailform form-contact-line text-left">
				<div ng-repeat="row in setList.select">
					<span ng-bind="row.ca_name" ></span>
					<select class="setSelect">
						<option value=""><{$language.select_0}></option>
						<option value="{{o.fs_child_f_id}}" ng-repeat=" o in row.data" ng-bind="o.f_name"></option>
					</select>
				</div>
				<a class="btn btn-primary btn-xs text-bottom"  ng-click="click(setList.set.f_id, '1', setList.set.f_large_price, setList.set.setName, 1);$event.stopPropagation();" ><{$language.add_cart}></a>
			</form>
		</div>
		<!-- Isotope Content-->
		<div data-isotope-layout="fitRows" data-isotope-group="gallery" data-photo-swipe-gallery="gallery" class="row isotope isotope-menu">
		  <{foreach from=$foods item=food}>
		  <div data-filter="Category <{$food.ca_id}>" class="col-xs-12 col-sm-6 col-md-4 isotope-item ">
			<div class="thumbnail-menu-modern">
			  <figure>
				<{*<img src="images/food/<{$food.ca_id}>-<{$food.f_id}>-310x260.png" alt="" width="310" height="260" class="img-responsive"/>*}>
				<img src="http://admin.sihalive.dev.com/upload/<{$food.photo}>" alt="" width="310" height="260" class="img-responsive"/>
			  </figure>
			  <div class="caption">
				<h5><a href="#menu-single.html" class="link link-default"><{$food.f_name}></a></h5>
				<p class="price"><{$food.f_large_price}></p>
			
				<a href="/Menu/food/<{$food.f_id}>" class="btn btn-shape-circle btn-primary offset-top-15 btn btn-primary btn-shadow btn-shape-circle btn-xs"><{$food_language_ary.food_menu_check_food}></a>
				<{if $food.ca_id == 5}>
					<a href="" ng-click="order_set(<{$food.f_id}>, '1','<{$food.f_large_price}>' ,'<{$food.f_name}>');$event.stopPropagation();" class="btn btn-shape-circle btn-primary offset-top-15 btn btn-primary btn-shadow btn-shape-circle btn-xs"><{$food_language_ary.food_order_set}></a>
				<{else}>
					<a href="" ng-click="click(<{$food.f_id}>, '1','<{$food.f_large_price}>' ,'<{$food.f_name}>');$event.stopPropagation();" class="btn btn-shape-circle btn-primary offset-top-15 btn btn-primary btn-shadow btn-shape-circle btn-xs"><{$food_language_ary.food_menu_addcar}></a>
				<{/if}>
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
				<h3 class="text-baseline"><{$language.website_name}></h3>
				<div class="group-sm offset-top-15 offset-lg-top-0">
					<hr class="hr divider-xs bg-primary text-top veil reveal-lg-inline-block">
					<p class="text-white big offset-lg-top-0 text-top"><{$language.website_slogan}></p>
				</div>
			</div>
		</div>
	</div>
  </div>
</section>
</main>

