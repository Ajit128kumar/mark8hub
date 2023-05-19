<style>
    #hrline1 {
    line-height: 1em;
    position: relative;
    top: 50px;
    left: 32%;
    width: 38%
}
#text2 {
    font-size: 16px;
    font-weight: bold;
    font-family: 'Roboto Slab', serif;
    position: relative;
    top: 18px;
    left: 6px;
    color: gray
}
</style>
<div class="container margin_60">
	<div class="row justify-content-center">
		<div class="col-xl-6 col-lg-6 col-md-8">
			<div class="box_account">
				<h3 class="client"><?php echo get_phrase('already_registered'); ?></h3>
				<form class="" action="<?php echo site_url('login/validate_login'); ?>" method="post">
					<div class="form_container">
						<div class="divider"><span><?php echo get_phrase('login_credentials'); ?></span></div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" id="email" value="<?php if(!empty(get_cookie('remember')) && !empty(get_cookie('email'))){ echo get_cookie('email');}?>" placeholder="Email*">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" id="password" value="<?php if(!empty(get_cookie('remember')) && !empty(get_cookie('password'))){ echo get_cookie('password');}?>" placeholder="Password*">
						</div>
						<div class="clearfix add_bottom_15">
							<div class="float-left"><input style="margin-top: 5px;margin-right: 5px;" type="checkbox" name="remember" value="1">Remember me</div> 

							<div class="float-right"><a id="forgot-pass" href="<?php echo site_url('home/forgot_password'); ?>"> 
							<small style=" "><?php echo get_phrase('lost_password'); ?>?</small> </a></div>
						</div>
						

						<div class="row">
							<div class="col-md-12 mb-2">
								<input type="submit" value="Log In" class="btn_1 w-100">
							</div>
							<div class="col-md-12">
								<a id="sign_up" class="btn_1 full-width outline wishlist icon-login" href="<?php echo site_url('home/sign_up'); ?>"><?php echo get_phrase("sign_up"); ?></a>
							</div>
							<!--<hr id="hrline1">-->
							<!--<p id="text2">Or Login with</p>-->
							 <div class="col-md-12 d-flex flex-wrap justify-content-center mx-auto anchor_gf">
                            <?php
                                // if(isset($button))
                                // {
                                //     echo $button;
                                // }
                                //   if(isset($button_fb))
                                // {
                                //     echo $button_fb;
                                // }
                                 ?>
                            </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>