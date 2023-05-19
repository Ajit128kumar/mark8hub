<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo $listing['name']; ?>
				</div>
			</div>
			<div class="panel-body">
				<form action="<?php echo site_url('addons/facebook_messenger/update_facebook_page_data/'.$listing['id']); ?>" method="post">
					<div class="form-group">
						<label for="page_id" class="control-label"><?php echo get_phrase('facebook_page_id'); ?></label>
						<input type="text" class="form-control" id="page_id" name="page_id" value="<?php echo $facebook_page_data['page_id']; ?>" placeholder="<?php echo get_phrase('your_facebook_page_id'); ?>" required>
					</div>
					<div class="form-group">
						<label for="logged_in_greeting" class="control-label"><?php echo get_phrase('popup_message'); ?></label>
						<textarea class="form-control" id="logged_in_greeting" name="logged_in_greeting" rows="3" required><?php echo $facebook_page_data['logged_in_greeting']; ?></textarea>
					</div>
					<div class="form-group">
						<label for="color" class="control-label"><?php echo get_phrase('brand_color'); ?></label>
						<div class="input-group form-control" style="margin: 0px; padding: 0px;">
							<input class="form-control" name="color" id="color" type="color" value="<?php echo $facebook_page_data['color']; ?>">
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-info"><?php echo get_phrase('update'); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert alert-info" role="alert">
				<h4 class="alert-heading"><?php echo get_phrase('instruction'); ?> <i class="fa fa-arrow-down"></i></h4>
			<p>1. Login to your Facebook account and enter your Facebook page .</p>
			<p>2. Go to your page settings , click on advanced messaging and copy paste the below url on
                  whitelisted domains and save it</p>
            <p style='color:red;'>  https://www.mark8hub.com/</p>
		
			<p>3. Click the about button, you will see one Page ID, put the Page ID facebook page id field.</p>
			<p>4. Write a welcome message.</p>
			<p>5. Select a brand color.</p>
			<p>6. Now click the update button.</p>
		</div>
	</div>
</div>