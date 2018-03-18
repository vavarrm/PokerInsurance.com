
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">

<main class="page-content this-white" ng-controller="userCtrl" ng-init="init()"  style="min-height: 500px" >

	<!-- Breadcrumbs & Page title-->
	<{include file="Frontend/breadcrumbs.tpl"}>
	<section class="bg-white container this-margin-top this-margin-button " style="margin-bottom: 80px">

		<div class="row">
			<div class="col-sm-3 ">
				<img src="/images/icon/phone.png" class="img-responsive this-hide-small"/>

			</div>
			<div class="col-sm-6 this-padding " style="text-align: left" >

				<h5 style="font-size: 20px"><span class="icon icon-sm icon-primary fa fa-comment-o"
													 style="font-size:50px"></span>
					Verify you phone </h5>
				<p style="color: #302f35"> Type verification code you received in sms </p>
				<span style="color: #302f35; font-size: 12px"> Please check your phone number 12345678 </span>
				<form method="post" action="" >
					<input type="text" class="form-control" style="border: 1px  solid silver" placeholder="Enter verification code" name="txtcode">

					<a href="#send">
						<span style="margin-top: 10px; padding-top: 10px; color: orangered"> Resend verification code </span>
					</a>
					<br/>
					<br/>
					<input type="submit" class="this-btn this-btn-this" value="<< Back" style="margin-top: 5px;
					background: silver!important;"
						   name="verify">
					<input type="submit" class="this-btn this-btn-this this-right" value="Verify >> "style="margin-top:5px" name="verify">

				</form>
			</div>
		</div>



	</section>



</main>

</script>
