      <main class="page-content" ng-controller="productPageCtrl" ng-model="f_id" ng-init="f_id='<{$f_id}>'">
        <!-- Breadcrumbs & Page title-->
		<{include file="Frontend/breadcrumbs.tpl"}>

        <section class="section-50 section-sm-100">
          <div class="shell">
            <div class="range range-xs-center">
              <div class="cell-sm-6 text-lg-left">
                <div data-arrows="false" data-dots="false" data-loop="true" data-swipe="true" data-items="1" data-child="#child-carousel" data-for="#child-carousel" class="slick-slider carousel-parent">
                  <div class="item"><img src="/images/product-01-542x448.png" alt="" width="542" height="448"/>
                  </div>
                  <div class="item"><img src="/images/product-02-542x448.png" alt="" width="542" height="448"/>
                  </div>
                  <div class="item"><img src="/images/product-05-542x448.png" alt="" width="542" height="448"/>
                  </div>
                </div>
                <div id="child-carousel" data-for=".carousel-parent" data-arrows="false" data-loop="true" data-dots="false" data-swipe="true" data-items="3" data-xs-items="3" data-sm-items="3" data-md-items="3" data-lg-items="3" data-slide-to-scroll="1" data-center-mode="true" class="slick-slider carousel-child custom-pagination">
                  <div class="item">
                    <div><img src="/images/product-thumb-01-84x69.png" alt="" width="84" height="69"/>
                    </div>
                  </div>
                  <div class="item">
                    <div><img src="/images/product-thumb-02-84x69.png" alt="" width="84" height="69"/>
                    </div>
                  </div>
                  <div class="item">
                    <div><img src="/images/product-thumb-05-84x69.png" alt="" width="84" height="69"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cell-sm-6 cell-lg-5 text-sm-left offset-top-60 offset-sm-top-0">
                <div class="reveal-xs-flex range-xs-middle range-xs-center range-sm-left">
                  <h4 class="font-default" ng-model="food.f_name" ng-bind="food.f_name"></h4>
                  <div class="inset-xs-left-50 offset-top-0">
                    <div class="team-member-position team-member-position-primary"><span class="big text-italic text-middle">Hot</span></div>
                  </div>
                </div>
                <div class="offset-top-15">
                  <{*<p>Fruit / Sweet / Basket / Tropical / Gift / Tray</p>*}>
                  <p ng-model="food.f_description" ng-bind="food.f_description"></p>
                </div>
                <div class="offset-top-15">
                  <div class="group-sm">
					<a href="#" class="link-zoom">
						<img src="/images/shop-single-01-57x21.png" alt="" width="57" height="21"/>
					</a>
					<{*
					<a href="#" class="link-zoom">
						<img src="/images/shop-single-02-52x21.png" alt="" width="52" height="21"/>
					</a>
					<a href="#" class="link-zoom">
						<img src="/images/shop-single-03-54x21.png" alt="" width="54" height="21"/>
					</a>
					*}>
				  </div>
                </div>
                <hr class="offset-top-30 veil reveal-sm-block">
                <div class="offset-top-30">
                  <div class="responsive-tabs responsive-tabs-shop responsive-tabs-horizontal">
                    <ul class="resp-tabs-list">
                      <li ng-if="food.f_large_price > 0" ng-click="selectPrice(food.f_large_price, $event);$event.stopPropagation();"><span class="price">$</span><span class="price selectedprice" data-price="25.90" ng-model="food.f_large_price" ng-bind="food.f_large_price"></span><span class="icon icon-circle">Big</span></li>
                      <li ng-if="food.f_medium_price > 0" ng-click="selectPrice(food.f_medium_price, $event);$event.stopPropagation();"><span class="price">$</span><span class="price selectedprice" data-price="13.90" ng-model="food.f_medium_price" ng-bind="food.f_medium_price"></span><span class="icon icon-circle">Mini</span></li>
                    </ul>
                    <div class="resp-tabs-container">
                      <div>
                        <!-- Linear progress bar-->
                        <div data-to="43" class="progress-linear">
                          <div class="progress-header clearfix">
                            <div class="text-left">
                              <p class="text-uppercase">energy value</p>
                            </div>
                          </div>
                          <div class="progress-bar-linear-wrap offset-top-5">
                            <div class="progress-bar-linear bg-primary-lighter"></div><span class="progress-text">510kcal</span><span class="text-bold progress-value">43</span>
                          </div>
                        </div>
                        <!-- Linear progress bar-->
                        <div data-to="59" class="progress-linear">
                          <div class="progress-header clearfix">
                            <div class="text-left">
                              <p class="text-uppercase">proteins</p>
                            </div>
                          </div>
                          <div class="progress-bar-linear-wrap offset-top-5">
                            <div class="progress-bar-linear bg-primary"></div><span class="progress-text">44g</span><span class="text-bold progress-value">59</span>
                          </div>
                        </div>
                        <!-- Linear progress bar-->
                        <div data-to="20" class="progress-linear">
                          <div class="progress-header clearfix">
                            <div class="text-left">
                              <p class="text-uppercase">carbohydrates</p>
                            </div>
                          </div>
                          <div class="progress-bar-linear-wrap offset-top-5">
                            <div class="progress-bar-linear bg-secondary"></div><span class="progress-text">50g</span><span class="text-bold progress-value">20</span>
                          </div>
                        </div>
                      </div>
					  <{*
                      <div>
                        <!-- Linear progress bar-->
                        <div data-to="30" class="progress-linear">
                          <div class="progress-header clearfix">
                            <div class="text-left">
                              <p class="text-uppercase">energy value</p>
                            </div>
                          </div>
                          <div class="progress-bar-linear-wrap offset-top-5">
                            <div class="progress-bar-linear bg-primary-lighter"></div><span class="progress-text">360kcal</span><span class="text-bold progress-value">30</span>
                          </div>
                        </div>
                        <!-- Linear progress bar-->
                        <div data-to="39" class="progress-linear">
                          <div class="progress-header clearfix">
                            <div class="text-left">
                              <p class="text-uppercase">proteins</p>
                            </div>
                          </div>
                          <div class="progress-bar-linear-wrap offset-top-5">
                            <div class="progress-bar-linear bg-primary"></div><span class="progress-text">24g</span><span class="text-bold progress-value">39</span>
                          </div>
                        </div>
                        <!-- Linear progress bar-->
                        <div data-to="15" class="progress-linear">
                          <div class="progress-header clearfix">
                            <div class="text-left">
                              <p class="text-uppercase">carbohydrates</p>
                            </div>
                          </div>
                          <div class="progress-bar-linear-wrap offset-top-5">
                            <div class="progress-bar-linear bg-secondary"></div><span class="progress-text">40g</span><span class="text-bold progress-value">15</span>
                          </div>
                        </div>
                      </div>
					  *}>
                    </div>
                  </div>
                </div>
                <div class="offset-top-45" >
                  <div class="group-sm">
                    <div class="stepper-type-1">
                      <input type="number" id="order_num" data-zeros="true"   value="1" min="1" max="20" readonly class="form-control">
                    </div>
					<a ng-click="click(<{$f_id}>);$event.stopPropagation();" class="text-top btn btn-primary btn-shape-circle btn-min-width-sm">
						<span>Order Online</span>
					</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="text-left">
          <div class="responsive-tabs responsive-tabs-horizontal responsive-tabs-horizontal-background">
            <ul class="resp-tabs-list shell">
               <{*<li>Description</li> *}>
              <li>Delivery</li>
            </ul>
            <div class="resp-tabs-container">
			  <{*
              <div>
                <p class="text-base" ng-model="food.f_description" ng-bind="food.f_description"></p>
               
				<div class="unit unit-horizontal unit-spacing-xs offset-top-20">
                  <div class="unit-left">
                    <p class="h6">Ingredients:</p>
                  </div>
                  <div class="unit-body">
                    <p>Apples / Pears / Oranges / Grapefruits / Kiwis</p>
                  </div>
                </div>
              </div>
			  *}>
              <div>
                <p class="text-base">Here you can read some details about a nifty little lifecycle of your order's journey from the time you place your order to your new treasures arriving at your doorstep. At first, you choose the product you like. Then you put into your shopping cart and pass the checkout process in a few clicks. Our store offers several payment and delivery methods, so after placing your order, you'll have an opportunity to choose which one is the most convenient for you.</p>
              </div>
            </div>
          </div>
        </section>
      </main>