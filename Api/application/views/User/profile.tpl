
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">

<main class="page-content this-white" ng-controller="userCtrl" ng-init="init()"  >

	<!-- Breadcrumbs & Page title-->
	<{include file="Frontend/breadcrumbs.tpl"}>
	<section class="bg-white container this-margin-top this-margin-button " style="padding: 0px; color:
	white!important; font-size: 14px; ">

				<div class="">
				<ul class="nav nav-tabs" style="background:#f16121; border: none; padding: 0px">
					<li class="active"><a data-toggle="tab" href="#order_list"><span class="glyphicon glyphicon-book"></span>
							<{$mainpage_language_ary.Order}> </a></li>

					<li ><a data-toggle="tab" href="#home"><span class="glyphicon glyphicon-user"></span>
							<{$mainpage_language_ary.Profile}></a></li>
					<li><a data-toggle="tab" href="#address"><span class="glyphicon glyphicon-map-marker"></span>
							<{$mainpage_language_ary.Address}></a></li>

				</ul>

				<div class="tab-content this-border this-padding-top this-padding " style="border: none!important; margin-bottom: 50px">
					<div id="home" class="tab-pane this-animate-right " style="margin-top: 20px">
						<div class="c">
							<div class=" this-white" style="border: none">
								<div class="row">
									<div class="col-sm-1"></div>

									<div class="col-sm-8">
										<form method="post"  class="rd-mailform form-contact-line text-left" >
											<div class="form-inline-flex">
												<div class="form-group">
													<label for="o_consignee" class="form-label form-label-outside
													rd-input-label"><{$mainpage_language_ary.First_name}> :</label>
													<input id="o_consignee" ng-model="u_fname"  type="text" placeholder="<{$userLanguageAry.user_delivery_phone}>" name="o_consignee"   data-constraints="@Required" class="form-control form-control-has-validation form-control-last-child">
													<span class="form-validation"></span>
												</div>
												<div class="form-group">
													<label for="o_phone" class="form-label form-label-outside
													rd-input-label"><{$mainpage_language_ary.Last_name}> :</label>
													<input id="o_phone" ng-model="u_lname" type="text" placeholder="<{$mainpage_language_ary.Last_name}>" name="o_phone" data-constraints="@Required" class="form-control form-control-has-validation form-control-last-child"><span class="form-validation"></span>
												</div>
											</div>
											<div class="form-inline-flex this-margin-top">
												<div class="form-group">
													<label for="o_consignee" class="form-label form-label-outside
													rd-input-label"><{$mainpage_language_ary.Phone}> : </label>
													<input id="o_consignee" ng-model="u_phone"  type="text" placeholder="<{$mainpage_language_ary.Phone}>" name="o_consignee"   data-constraints="@Required" class="form-control form-control-has-validation form-control-last-child">
													<span class="form-validation"></span>
												</div>
												<div class="form-group">
													<label for="o_phone" class="form-label form-label-outside
													rd-input-label"><{$mainpage_language_ary.Email}> : </label>
													<input id="o_email" ng-model="u_email" type="text" placeholder="<{$mainpage_language_ary.Email}>" name="o_phone" data-constraints="@Required" class="form-control form-control-has-validation form-control-last-child"><span class="form-validation"></span>
												</div>
											</div>
											<div class="form-inline-flex this-margin-top">
												<div class="form-group">
													<label for="o_consignee" class="form-label form-label-outside
													rd-input-label"><{$mainpage_language_ary.Password}> :</label>
													<input id="o_consignee" ng-model="u_pwd"  type="text" placeholder="<{$mainpage_language_ary.Password}>" name="o_consignee"   data-constraints="@Required" class="form-control form-control-has-validation form-control-last-child">
													<span class="form-validation"></span>
												</div>
												<div class="form-group">
													<label for="o_phone" class="form-label form-label-outside
													rd-input-label"><{$mainpage_language_ary.Confirm_Password}></label>
													<input id="o_email" ng-model="u_confpwd" type="text" placeholder="<{$mainpage_language_ary.Confirm_Password}>" name="o_phone" data-constraints="@Required" class="form-control form-control-has-validation form-control-last-child"><span class="form-validation"></span>
												</div>
											</div>
											<div class="offset-top-30">
												<div class="form-inline-flex">
													<div class="form-group">
														<button ng-click="setProfile();$event.preventDefault();"  class="this-btn this-btn-this"><{$language.from_button_sumbit}></button>
													</div>
												</div>
											</div>
										</form>

									</div>

								</div>
							</div>
						</div>
					</div>
					<div id="order_list" class="tab-pane this-animate-right this-left-align in active " style="padding: 0px;" >
						<div class="well this-white " style="border: none; padding: 0px">

							<div class="this-container"  >
								<div class="row">

									<div class="col-sm-12" style="padding: 0px" >
										<div class="table-responsive" style="padding: 0px" ng-controller="orderCtrl" ng-init="orderList()"  >
											<table id="tb_order" class="table table-striped table-bordered"
												   cellspacing="0" width="100%"  >

												<thead>
												<tr class="this-border">
													<td class="this-hide-small"><{$mainpage_language_ary.Order_ID}></td>
													<td><{$mainpage_language_ary.Date_Time}></td>
													<td  class="this-hide-small"><{$mainpage_language_ary.Discount}></td>
													<td><{$mainpage_language_ary.Total}></td>
													<td><{$mainpage_language_ary.Status}></td>
												</tr>
												</thead

												<tbody >

												<tr  ng-repeat="row in data.orders" >
													<td  class="this-hide-small">{{row.o_id}}</td>
													<td>{{row.add_datetime}}</td>
													<td  class="this-hide-small">{{row.o_discount}}</td>
													<td>{{row.o_total}}</td>

													<td>
														<span class="badge this-green"> {{row.o_status}}</span>
														<a href="/user/inv/{{row.o_id}}"> <span class="badge
																this-orange
																this-text-white " >View</span>
														</a>
													</td>
												</tr>

												</tbody>



											</table>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>



						<div id="address" class="tab-pane this-animate-right this-left-align">
							<div class="well this-white " style="border: none">

								<div class="this-container" style="padding: 0px">
									<div class="row">
										<div class="col-sm-12" style="padding: 0px">
											<div class="col-sm-12" style="padding: 0px; margin-bottom: 20px">
												<span class="this-btn
											this-btn-this" style="margin-top: 5px" id="show_add" >
													<{$mainpage_language_ary.Add_Address}>
													</span>
											</div>
											<form  class="form" style="text-align: left" id="frm_add" action="/User_Position/doInsert" method="post" >
												<input type="text" id="o_consignee" ng-model="u_id" name="u_id"
													   style="display: none" required>
												<div class="form-group ">
													<div class="col-sm-4" style="padding: 0px">
														<label for="p_name"><{$mainpage_language_ary.Address_Name}>:</label>
														<select  id="o_position_id" data-constraints="@Required"  name="o_position_id" class="form-control form-control-has-validation form-control-last-child input-sm" style="padding: 2px; padding-left: 10px">
															<option value="0">請選擇</option>
															<{foreach from=$location item=row key=index}>
															<option value="<{$row.p_id}>"><{$row.p_title}> </option>
															<{/foreach}>
														</select>
														<span onclick="openLocation()"  class="this-btn
														this-btn-this" style="margin-top: 5px" ><{$mainpage_language_ary.google_map}> </span>
													</div>
													<div class="col-sm-7" style="padding: 0px">
														<label for="p_desc"><{$mainpage_language_ary.Plcese_Description}> :</label>
														<input class="form-control" name="desc"/>
													</div>
													<div class="col-sm-1" style="padding: 0px">
														<button type="submit"class="this-btn this-btn-this"
																style="height: 35px; padding: 2px; width: 100px;
																margin-top: 30px;"><{$mainpage_language_ary.Save}></button>
													</div>
												</div>
												<div id='response'></div>
											</form>
											<div class="col-sm-12" style="margin-top: 20px; padding: 0px;" ng-controller="userAddressCtrl" ng-init="address_()" >
												<table id="tb_order" class="table table-striped table-bordered"
													   cellspacing="0" width="100%"  >
													<thead>
													<tr class="this-border">

														<td><{$mainpage_language_ary.Title}></td>
														<td><{$mainpage_language_ary.Description}></td>

													</tr>
													</thead

													<tbody >


													<tr ng-repeat="row in data.book_address" >
														<td>{{row.u_p_b_titel}}</td>
														<td>{{row.description}}</td>
														<!--<td>
															<span class="badge this-green"> edit</span>
															<a href="/user/inv/"> <span class="badge
																this-orange
																this-text-white " >View</span>
															</a>
														</td>-->
													</tr>

													</tbody>



												</table>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>



				</div>
			</div>

	</section>

	<div class="this-animate-zoom ac-wrapper this-hide"  id="this_map" >
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

<script>
    function openLocation() {
        $('#this_map').removeClass('this-hide');
    }
    function PopUp(){
        $('#this_map').addClass('this-hide');
    }

</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script >
   // $.noConflict();
  //  jQuery( document ).ready(function( $ ) {
   //     $('#tb_order').DataTable();
   // });
   // $.noConflict();
    jQuery( document ).ready(function( $ ) {
        $('#frm_add').hide();
        $('#show_add').click(function () {
            $('#frm_add').slideToggle();
        });
    });
</script>
