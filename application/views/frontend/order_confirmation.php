<div class="row justify-content-center" id="order-confirmed">
  <div class="col">
    <a class="box_topic">
      <i class="pe-7s-check"></i>
      <h3><?php echo get_phrase('congratulations'); ?>!!!</h3>
      <p>
        <span class="d-block"><?php echo get_phrase('your_order_has_been_placed_successfully'); ?>.</span>
        <span class="d-block"><?php echo get_phrase('you_will_be_notified_about_the_delivery_soon'); ?>.</span>
      </p>
      <button type="button" class="btn_1" name="button" onclick="window.location.replace('<?php echo site_url('addons/shop/my_orders'); ?>');"><?php echo get_phrase('check_order_status'); ?></button>
      <button type="button" class="btn_1" name="button" onclick="location.reload();"><?php echo get_phrase('continue_shopping'); ?></button>
    </a>
  </div>
</div>

<script type="text/javascript">
  $('.box_topic').mouseenter(function() {
    $('.box_topic').css('transform', 'translateY(0px)');
  });
</script>
