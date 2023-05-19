<div class="row">
  <div class="col-lg-8">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <?php echo get_phrase('smtp_settings'); ?>
        </div>
      </div>
      <div class="panel-body">
        <form action="<?php echo site_url('addons/shop/recaptcha_settings/update'); ?>" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered">
          <div class="form-group">
            <label for="recaptcha_sitekey" class="col-sm-3 control-label"><?php echo get_phrase('recaptcha_sitekey'); ?></label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="recaptcha_sitekey" id="recaptcha_sitekey" placeholder="<?php echo get_phrase('recaptcha_sitekey'); ?>" value="<?php echo get_settings('recaptcha_sitekey'); ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label for="recaptcha_secretkey" class="col-sm-3 control-label"><?php echo get_phrase('recaptcha_secretkey'); ?></label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="recaptcha_secretkey" id="recaptcha_secretkey" placeholder="<?php echo get_phrase('recaptcha_secretkey'); ?>" value="<?php echo get_settings('recaptcha_secretkey'); ?>" required>
            </div>
          </div>
          <div class="col-sm-offset-3 col-sm-5" style="padding-top: 10px;">
            <button type="submit" class="btn btn-info"><?php echo get_phrase('save'); ?></button>
          </div>
        </form>
      </div>
    </div>
  </div><!-- end col-->
</div>
