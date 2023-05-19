<header class="header menu_fixed cust__menu">
		<div id="logo">
			<a href="<?php echo site_url('home'); ?>" title="<?php echo get_settings('system_title'); ?>">
				<div class="d-flex logo-alignment">
					<div class="mr-3 d-flex align-items-center">
						<!-- <img src="<?php echo base_url();?>assets/global/light_logo.png" width="165" height="35" alt="" class="logo_normal"> -->
						<img src="<?php echo base_url();?>assets/global/logo.png" width="50px" alt="" class="logo_normal">
						<img src="<?php echo base_url();?>assets/global/dark_logo.png" width="35" height="35" style="border-radius: 20px; object-fit:contain;" alt="" class="logo_sticky">
						<!--<img src="<?php echo base_url();?>assets/global/dark_logo.png" width="165" height="35" alt="" class="logo_sticky">-->
						<div class="tagline text-right ml-2 tagline-color">
							<span class="font-weight-bold text-right" id="tagline-info">Aba-Sabb-Online </span>
							<!-- <span class="font-weight-bold text-white">TagLine</span> -->
						</div>
					</div>
				</div>		
			</a>
		</div>
		<ul id="top_menu">
			<?php if ($this->session->userdata('is_logged_in') != 1): ?>
				<li><a href="<?php echo site_url('home/login'); ?>" class="login login-alignment" title="Sign In"><?= get_phrase('sign_in'); ?></a></li>
			<?php endif; ?>
		</ul>
		<!-- /top_menu -->
		<a href="#menu" class="btn_mobile">
			<div class="hamburger hamburger--spin" id="hamburger">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
		</a>
		<?php include 'menu.php';?>
	</header>
