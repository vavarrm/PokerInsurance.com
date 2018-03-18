<!-- Page Content-->

<style>
	.ac-wrapper {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background:transparent;
		z-index: 1001;
	}
	.popup {
		width: 100%;
		height: 100%;

		box-shadow: #64686e 0px 0px 3px 3px;
		-moz-box-shadow: #64686e 0px 0px 3px 3px;
		-webkit-box-shadow: #64686e 0px 0px 3px 3px;
		position: fixed;margin: 0px;
		padding: 0px;


	}
	main{
		min-height: 800px;
	}
	.tab-pane{
		margin-top: 20px!important;
	}
</style>

<main class="page-content this-white" ng-controller="shopCartCtrl" >
	<!-- Breadcrumbs & Page title-->
	<{include file="Frontend/breadcrumbs.tpl"}>
	<section class="section-0 section-sm-10">

		<div class="container" style="padding: 0px; margin-top: 0px; text-align: left">
			<div class="this-container  this-text-white " style="height: 40px; background: #f75d34;
			border-radius:
			4px">
             <div class="col-sm-12 this-center" style="padding: 0px">
				 <div class="col-xs-3 col-md-3 this-padding">
					 <span class="fa fa-home" style="font-size: 20px"></span>
					 <span class="fa fa-arrow-right this-hide-small" style="padding-left: 20px"> <{$mainpage_language_ary.Home}>  </span>
				 </div>
				 <div class="col-xs-3 col-md-3 this-padding">
					 <span class=" fa fa-shopping-cart" style="font-size: 20px"></span>
					<span class="fa fa-arrow-right this-hide-small " style="padding-left: 20px">  <{$mainpage_language_ary.ORDER}> </span>
				 </div>
				 <div class="col-xs-3 col-md-3 this-padding this-white" style="margin-top:2px; border-radius: 2px">
					 <span class="fa fa-credit-card" style="font-size: 20px"></span>
					 <span class="fa fa-arrow-right this-hide-small" style="padding-left:20px"> <{$mainpage_language_ary.CHECK_OUT}></span>
				 </div>
				 <div class="col-xs-3 col-md-3 this-padding">
					 <span class="fa fa-print" style="font-size: 20px"></span>
					  <span class="this-hide-small"><{$mainpage_language_ary.RECEIPT}></span>
				 </div>
			 </div>
			</div>
			<div class="col-sm-12" style="margin-bottom: 100px">
				<div class="col-sm-12  this-margin-top this-margin-bottom" STYLE="border-radius: 4PX">
					<div class="this-container this-padding" style="border-bottom: 1px solid silver">
						<div class="h5 text-bold"> <{$mainpage_language_ary.Order_Information}></div>
					</div>
					<div ng-repeat="item in items|filter as filterAry" ng-show="!item.del" class="row grid-system-row
				grid-element-outline-bottom ">
						<div class="col-xs-1">
							<div class="form-group stepper-type-2 offset-top-20">
								<input data-index="{{$index}}" data-price="{{item.price}}" type="number" data-zeros="true"  value="{{item.order_num}}" ng-model="$item.order_num" min="1" max="20" readonly class="form-control ">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="product-image">
								<img src="http://admin.sihalive.dev.com/upload/1518417582947.jpg" width="130" height="130" alt="">
							</div>
						</div>
						<div class="col-xs-4  text-left">
							<div class="  offset-top-20 ">
								<span  class=" grid-element-mod-2"　ng-bind="item.f_name"> {{item.f_name}}</span>
							</div>
							<div class="offset-top-0">
								<span class="" ng-bind="'$'+item.price"> {{item.price}}</span>
							</div>
						</div>
						<div class="col-xs-2  text-left">
							<div class="text-sbold offset-top-20 ">
								<span  class=" grid-element-mod-2"></span>
							</div>
							<div class="offset-top-0">
					<span class=" text-sbold">$<span>
					<span data-index="{{$index}}" data-subtotal="{{item.subtotal}}"
						  class=" text-sbold subtotal"
						  ng-model="item.subtotal" ng-bind="item.subtotal"
						  ng-init="item.subtotal=(item.price*item.order_num)">

					</span>
							</div>
						</div>
						<div class="col-xs-1">
							<div class="text-left offset-top-40">
							 <span class="glyphicon glyphicon-trash"
								   style="font-size:15px; cursor: pointer" ng-click="delete
                                                                  ($index);
                                                                  $event.stopPropagation();"></span>
							</div>
						</div>
					</div>
					<div  class="row grid-system-row offset-top-30 text-right">
						<div class="col-xs-12 this-padding 	" style="background: #F0F0F0">
							<div class=" font-default text-bold this-padding">
								<{$mainpage_language_ary.Sub_Total}> : <span class="total" ng-bind=" Total(filterAry)"></span>
							</div>

							<div class="font-default text-bold this-padding">
								<span  > <{$mainpage_language_ary.delivery_fee}> :1.00</span>
							</div>
							<div class=" font-default text-bold this-padding">
								<{$mainpage_language_ary.Total}> : <span class="total" ng-bind=" Total(filterAry)"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-2"></div>
				<div class="col-sm-8 this-center " style="margin-top: -50px">
					<div  class="row grid-system-row offset-top-50 ">

						<div class="shell">
							<h5><{$shopLanguageAry.shopcart_delivery_info}></h5>
							<div class="range range-xs-center offset-top-15">
								<div class="cell-sm-12 cell-md-12" style="padding: 0px">
									<div class="inset-lg-left-50 inset-lg-right-50">
										<!-- RD Mailform-->
										<div class="col-sm-12 this-padding-0" style="padding: 0px">
											<form method="post"  class=" form-contact-line text-left " >

												<div class="form-inline-flex">
													<div class="form-group" ng-controller="userAddressCtrl" ng-init="address_()">
														<div class="col-sm-12" style="padding: 0px">
															<label for="message" class="form-label form-label-outside rd-input-label"><{$shopLanguageAry.shopcart_delivery_position}></label>

															 <select   class="form-control
															 form-control-has-validation form-control-last-child " id="o_position_id">
																 <option value="">請選擇</option>
																<option ng-repeat="row in data.book_address"
																		value="{{row.p_bookId}}" >{{row.u_p_b_titel}}</option>
															</select>

														</div>
													</div>
													<center>
														<img src="/images/icon/g_map.png"height="40" style="cursor: pointer"  onclick="openLocation()" >
													</center>
													<div class="form-group ">
														<div class="col-sm-12" style="padding: 0px">
															<label for="message" class="form-label form-label-outside rd-input-label"><{$shopLanguageAry.shopcart_delivery_message}></label>
															<input type="text"  id="message" placeholder="<{$shopLanguageAry.shopcart_delivery_message_placeholder}>" name="o_messge"  class="form-control form-control-has-validation form-control-last-child ">
															<span class="form-validation"></span>
														</div>
													</div>

													<br/>
												</div>
												<div class=" form-inline-flex form-group">
													<div class="col-sm-12" style="padding: 0px">
														<input type="text"  id="o_address" placeholder="o_address"
															   name="o_messge"  class="form-control form-control-has-validation form-control-last-child ">
														<span class="form-validation"></span>
													</div>
												</div>

												<div class="offset-top-15">
													<div class="form-inline-flex">
														<div class="form-group">
															<button ng-click="checkout();$event.preventDefault();"  class="btn btn-primary btn-fullwidth"><{$shopLanguageAry.shopcart_proceed_to_checkout}></button>
														</div>
													</div>
												</div>
											</form>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>

	</section>
	<div class="this-animate-zoom ac-wrapper this-hide this-white"  id="this_map" >
		<div class="popup" id="this_Open">

			<div class="this-container this-top" style="width:320px; position:relative!important; background-color:rgba(255,255,255,0.7);text-align:left; top:0px; padding-bottom: 5px; padding: 5px"	>

				<div onClick="PopUp()" class="this-circle" style="text-align:right; position: absolute;right: 0px; margin-top: -5px">
					<div   name="submit"  onClick="PopUp()" style="border-radius: 15px; background:transparent;width:
					 30px" >
						<span class="glyphicon glyphicon-remove-circle" style="font-size: 25px;color: orangered; cursor:
						pointer"></span> </div>
				</div>


				<div class="form-group offset-top-0  " style="margin-top: -5px; width: 98%; padding: 10px">
					<div class="form-inline-flex">
						<div class="form-group" style="width: 90%">
							<select  id="o_position_id" data-constraints="@Required"  name="o_position_id" class="form-control form-control-has-validation form-control-last-child input-sm"
									 style="padding: 2px; padding-left: 10px">
								<option value="0">請選擇</option>
								<{foreach from=$location item=row key=index}>
								<option value="<{$row.p_title}>"><{$row.p_title}> </option>
								<{/foreach}>
							</select>
						</div>

					</div>
				</div>
			</div>
			<div id="maping" ng-init="mapinit()"  data-zoom="15" data-y="10.6105995" data-x="103.5236850" data-styles="" class="rd-google-map rd-google-map__model"
				 style="position:fixed; margin-bottom: 5px; height:100%; margin-top: -70px">
				<ul class="map_locations" style="width: 80%" >
					<li data-y="{{position.p_lat}}" data-x="{{position.p_lng}}" data-position_id="{{position.p_id}}" ng-repeat="position in positions">
						<p data-position_id ="1" style="width:100%; text-align:  center;height: 80%">
							<span style="width:28px; ">{{position.p_name}}</span>
						</p>
					</li>
				</ul>
			</div>

			<div class="this-container this-bottom this-white" style="height:17%; text-align: left; padding:0px"
				 id="frm_address">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
		<form method="post" action="" style="margin-top: 5px">
			<span class="this-hide-small"> Address Name :</span>
			<input type="text" class="form-control input-sm this-border" placeholder="Address name ....">
			<span class="this-hide-small" > Address Name :</span>
			<input type="text" class="form-control input-sm this-border" placeholder="Description....">
			<button id="open" class="this-btn this-btn-this  btn-sm " style="margin-top: 5px"
			>Save</button>
		</form>
						</div>
					</div>
				</div>

			</div>



		</div>
	</div>
</main>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
    function openLocation() {
        $('#this_map').removeClass('this-hide');
    }
    function PopUp(){
        $('#this_map').addClass('this-hide');
    }



</script>
