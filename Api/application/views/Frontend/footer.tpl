<footer class="page-foot  footer-light context-dark " style="background-color:#302f35!important; text-align: left" ng-controller="navCtrl">
	<section class="section-top-45 section-bottom-40 ">
	  <div class="shell">
		<div class="range range-xs-center">
			<div class="cell-sm-3 cell-md-3 offset-lg-top-0">
				<h5 class="text-italic font-secondary"><{$language.text_phone}></h5>
				<div class="unit unit-sm-horizontal unit-sm-top unit-spacing-xs offset-top-15">

					<div class="unit-body">


                        <p>	<a href="callto:#" > <span class="icon icon-sm fa fa-phone-square"  style="font-size:20px; "
                                ></span><{$website.phone}></a> </p>
                        <p>	<a href="callto:#" ><span class="icon icon-sm fa fa-envelope-o" style="font-size:18px;"></span>
                                tryion@sihalive.com</a> </p>
						<p class="contact-info"> <span class="icon icon-sm  fa fa-clock-o" style="font-size:20px; "></span>
                            <{$language.text_open_hour}></p>
                        <p><i class="fa fa-home" style="font-size:20px; "></i> Sihanoukville,
                            Cambodia
                        </p>
					</div>
				</div>
			</div>
		  <div class="cell-sm-3 cell-md-3  offset-lg-top-0">
				<h5 class="text-italic font-secondary">FEATURES SITE</h5>
				<div class="unit unit-sm-horizontal unit-sm-top unit-spacing-xs offset-top-15">
					<div class="unit-body">
                        <span> <a href="/"> Home </a> </span><br/>
                        <span> <a href="/contacts"> Contacts </a> </span><br/>
                        <span> <a href="/MainPage/privacy"> Privacy</a> </span><br/>

					</div>
				</div>
			</div>
			<div class="cell-sm-3 cell-md-3  offset-lg-top-0">
				<h5 class="text-italic font-secondary"><{$language.text_your_follow_us}></h5>
				<ul class="list-inline offset-top-15">
					<div class="fb-page"
						 data-href="https://www.facebook.com/Sihalive-187813995113064"
						 data-width="310"
						 data-hide-cover="false"
						 data-show-facepile="true">

					</div>
				</ul>
			</div>
			<div class="cell-sm-3 cell-md-3  offset-lg-top-0">
				<h5 class="text-italic font-secondary"><{$language.text_phone}></h5>
				<div class="unit unit-sm-horizontal unit-sm-top unit-spacing-xs offset-top-15">
					<i class="fa fa-facebook-official" style="font-size:30px;margin-left: 20px" ></i>
					<i class="fa fa-instagram" style="font-size:30px; margin-left: 20px"></i>
					<i class="fa fa-google-plus-square" style="font-size:30px; margin-left: 20px"></i>
					<i class="fa fa-twitter-square" style="font-size:30px; margin-left: 20px"></i>
					<i class="fa fa-youtube-play" style="font-size:30px; margin-left: 20px"></i>
				</div>
			</div>
		</div>
	  </div>
	</section>
	<section>
	  <div class="shell">
		<hr>
	  </div>
	  <div class="shell section-20" >
          <span class="this-left" > <a ng-click="setLanguage('en')">English (US)</a>  </span>
          <span class="this-left" style="margin-left: 20px"><a ng-click="setLanguage('zh-cn')">简体中文</a> </span>
		<div class="range range-xs-center" style="margin-top: -5px">

		  <div class="cell-md-5 text-center">
			<p class="copyright">
			  Food Delivery
			  &nbsp;&#169;&nbsp;<span id="copyright-year"></span>&nbsp;<br class="veil-sm"><a href="/MainPage/privacy">Privacy Policy</a>
			</p>
		  </div>
		</div>
	  </div>
	</section>
</footer>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=1080213098656327&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>