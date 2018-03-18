<!-- Page Content-->
<script>
    var url_back ='<{$smarty.get.back}>';
</script>
<main class="page-content" ng-controller="loginCtrl" ng-model="back" ng-init="back='<{$smarty.get.back}>'">
	<!-- Breadcrumbs & Page title-->
	<{include file="Frontend/breadcrumbs.tpl"}>

	<!-- Buttons-->
	<section class="bg-white text-center section-50 section-sm-50">
		<div class="shell">
			<div class="range range-xs-center">
				<div class="cell-sm-8 cell-lg-6">
					<div class="responsive-tabs responsive-tabs-modern responsive-tabs-modern-mod-1 responsive-tabs-horizontal">
						<ul class="resp-tabs-list">
							<li data-action="login"><{$language_ary.login_label}></li>
							<li data-action="reg"><{$language_ary.reg_label}></li>
						</ul>
						<div class="resp-tabs-container">
							<div class="action-div login-div">
								<div class="group-sm">
									<a id="FBloginBtn"  class="btn btn-facebook btn-icon btn-icon-left">
										<span class="icon icon-lg fa-facebook"></span>
										<span>Facebook</span>
									</a>
								</div>
								<div class="divider-custom offset-top-30">
									<p class="small text-uppercase">Or</p>
								</div>
								<!-- RD Mailform-->
								<form class="rd-mailform form-register text-center offset-top-20" id="Loginfrm">
									<div class="form-group">
										<label for="contact-login-account" class="form-label form-label-outside"><{$language_ary.user_account}></label>
										<input id="contact-login-account" ng-model="login.account" type="text" placeholder="<{$language_ary.please_enter}><{$language_ary.user_account}>"  data-constraints="@Required" class="form-control">
									</div>
									<div class="form-group">
										<label for="contact-login-passwd" class="form-label form-label-outside"><{$language_ary.user_passwd}></label>
										<input id="contact-login-passwd" type="text" ng-model="login.passwd"  onfocus="this.type='password'" data-constraints="@Required" placeholder="<{$language_ary.please_enter}><{$language_ary.user_passwd}>" class="form-control">
									</div>
									<div class="offset-top-50">
										<input type="hidden" ng-model="login.logintype" value="account">
										<button type="submit" ng-click="doLogin()" class="btn btn-primary btn-fullwidth btn-shadow"><{$language.from_button_sumbit}></button>
									</div>
								</form>
							</div>
							<div class="hide action-div reg-div">
								<div class="group-sm">
									<a  class="btn btn-facebook btn-icon btn-icon-left"  id="fbReg">
										<span class="icon icon-xs fa-facebook"></span>
										<span>Facebook</span>
									</a>
								</div>
								<div class="divider-custom offset-top-30">
									<p class="small text-uppercase">Or</p>
								</div>
								<!-- RD Mailform-->
								<form class="rd-mailform form-register text-center offset-top-20"  id="Register">
									<div class="form-group">
										<label for="register-form-account class="form-label form-label-outside"><{$language_ary.user_account}></label>
										<input id="register-form-account"  ng-blur="UserIsExist(input.u_account)" maxlength="20"   ng-model="input.u_account" type="text"  data-constraints="@Required" placeholder="<{$language_ary.please_enter}><{$language_ary.user_account}>" class="form-control">
										<span  ng-show="username_isexist" class="small text-uppercase" style="color:red;" ><{$language.register_form_username_isexist}></span>
									</div>
									<div class="form-group">
										<label for="register-form-password" class="form-label form-label-outside"><{$language_ary.user_passwd}></label>
										<input id="register-form-password"  onfocus="this.type='password'"   maxlength="12" ng-model="input.u_passwd" type="text"  data-constraints="@Required"   placeholder="<{$language_ary.please_enter}><{$language_ary.user_passwd}>" class="form-control">
									</div>
									<div class="form-group">
										<label for="register-form-password-confirm" class="form-label form-label-outside"><{$language_ary.user_confirm_passwd}></label>
										<input id="register-form-password-confirm" onfocus="this.type='password'"   maxlength="12" ng-model="input.u_passwd_confirm" type="text"  data-constraints="@Required"  placeholder="<{$language_ary.please_enter_aegin}><{$language_ary.user_passwd}>"  class="form-control">
									</div>
									<div class="offset-top-50">
										<button type="submit" ng-click="register($event);" class="btn btn-primary btn-fullwidth btn-shadow"><{$language.from_button_sumbit}></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>