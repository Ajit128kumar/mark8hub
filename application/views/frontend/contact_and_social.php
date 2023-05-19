<?php $user_details = $this->user_model->get_all_users($listing_details['user_id'])->row_array(); ?>
<div class="row mb-3">
	<div class="col-12">
		

		<?php if($listing_details['website'] != ""){ ?>
			<a href="<?php echo $listing_details['website']; ?>" target="blank" class="btn_1 full-width outline wishlist social-button agt_btn" id = "btn-wishlist-social"><i class="icon-globe-6 mr-2"></i><?php echo get_phrase('website'); ?></a>
		<?php } ?>

		<?php if($listing_details['email'] != ""){ ?>
			<a href="mailto:<?php echo $listing_details['email']; ?>" target="" class="btn_1 full-width outline wishlist social-button agt_btn" id = "btn-wishlist-social"><i class="icon-email mr-2"></i><?php echo get_phrase('email_us'); ?></a>
		<?php } ?>

		<?php if($listing_details['phone'] != ""){ ?>
			<a href="tel:<?php echo $listing_details['phone']; ?>" target="" class="btn_1 full-width outline wishlist social-button agt_btn" id = "btn-wishlist-social"><i class="icon-phone mr-2"></i><?php echo get_phrase('call_now'); ?></a>
		<?php } ?>


		
	</div>
</div>
<!-- <hr> -->