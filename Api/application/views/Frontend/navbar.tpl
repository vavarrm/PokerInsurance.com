<div class="rd-navbar-wrap rd-navbar-default "  ng-controller="navCtrl" >
	<nav data-layout="rd-navbar-fixed w3-card" data-sm-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-stick-up-clone="false" data-md-stick-up-offset="100px" data-lg-stick-up-offset="150px" class="rd-navbar">

	<div class="shell shell-fluid">
	  <div class="rd-navbar-inner">
		<div class="rd-navbar-nav-wrap-outer">
		  <div class="rd-navbar-aside">
			<div class="rd-navbar-aside-content">
			  <!-- RD Navbar Panel-->
			  <div class="rd-navbar-panel rd-navbar-aside-left">
				<!-- RD Navbar Toggle-->
				<button data-rd-navbar-toggle=".rd-navbar-nav-wrap" class="rd-navbar-toggle"><span></span></button>
				<div class="cart-right-top" >
					<a href="/ShopCart/" class="link link-shop link-default">
						<span class="icon icon-sm mdi mdi-cart-outline"  ></span>
						<span >(</span>
						<span class="label-inline big text-white cartnums"   ng-model="cartnums" ng-change="change()" ng-bind = "cartnums"></span>
						<span >)</span>
					</a>
				</div>
				<!-- RD Navbar Brand-->
					<a href="/" class="rd-navbar-brand brand" >
						<div class="brand-logo" >
							<img src="/images/brand-232x49.png"  style="margin-top:6px;" alt="" width="232" height="49"/>
						</div>
					</a>
			  </div>
			  <div class="rd-navbar-aside-right">
				<!-- RD Navbar Aside-->
				<ul class="list-links list-inline text-left">
				  <li>
					<div class="unit unit-horizontal unit-middle unit-spacing-xs">
						<!--
					  <div class="unit-left"><span class="icon icon-circle icon-gray-dark icon-xxs mdi mdi-phone text-middle"></span></div>
					  <div class="unit-body">

						<address class="contact-info">
							<a href="callto:#" class="link-default link-xs"><{$website.phone}></a>
							<span class="reveal-block text-base link-xs"><{$language.text_open_hour}></span>
						</address>

					  </div>
					  	-->
					</div>
				  </li>
				</ul>
			  </div>
			</div>
		  </div>
		</div>
		<!-- RD Navbar Nav-->
		<div class="rd-navbar-nav-wrap" >
		  <!-- RD Navbar Shop-->
		  <div class="rd-navbar-shop this-hide-large this-hide-medium">
			<a href="/ShopCart/" class="link link-shop link-default">
			  <span class="big text-gray-light">Cart</span>
			  <span class="icon icon-sm mdi mdi-cart-outline" ></span>
			  <span class="label-inline big text-white cartnums"  ng-model="cartnums" ng-change="change()" ng-bind = "cartnums"></span>
			</a>
		  </div>
		  <!-- RD Navbar Nav-->
		  <ul class="rd-navbar-nav">
			<li>
				<a href="/"><{$language.nav_home}></a>
			</li>
			<li>
				<a href="/contacts"><{$language.nav_contact}></a>
			</li>

			<li>
				<a href="#"><{$language.nav_language}></a>
				<!-- RD Navbar Dropdown-->
				<ul class="rd-navbar-dropdown">
					<li >
						<a ng-click="setLanguage('en')">english</a>
					</li>
					<li>
						<a ng-click="setLanguage('zh-cn')">简体中文</a>
					</li>
				</ul>
			</li>
			<li  ng-show="islogin" >
				<a href="#"><{$language.nav_user}></a>
				<!-- RD Navbar Dropdown-->
				<ul class="rd-navbar-dropdown">
					<!--
					<li>
						<a href="/Food/orderList"><{$language.nav_user_orderlist}></a>
					</li>\
					-->
					<li>
						<a href="/profile"><{$language.nav_user_profile}></a>
					</li>
					<li>
						<a ng-click="logout()"><{$language.nav_user_logout}></a>
					</li>
				</ul>
			</li>
			<li  ng-show="islogin == false">
				<a href="/login/"><{$language.nav_login}></a>
			</li>
		  </ul>
		  <div class="rd-navbar-aside-right">
			<ul class="list-links list-inline text-left">
			  <li>
				<div class="unit unit-horizontal unit-middle unit-spacing-xs">
				  <div class="unit-left"><span class="icon icon-circle icon-gray-dark icon-xxs mdi mdi-phone text-middle"></span></div>
				  <div class="unit-body">
					<address class="contact-info"><a href="callto:#" class="link-default link-xs"><{$website.phone}></a><span class="reveal-block text-base link-xs">Mon – Sat: 9:00–18:00</span></address>
				  </div>
				</div>
			  </li>
			  <li>
				<ul class="list-inline list-inline-sm">
				  <li><a href="" class="link-silver-light"><span class="icon icon-sm-mod-1 fa fa-facebook"></span></a></li>
				</ul>
			  </li>
			</ul>
		  </div>
		</div>
	  </div>
	</div>
  </nav>
</div>