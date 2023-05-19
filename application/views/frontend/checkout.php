<?php
$amount_to_checkout = $this->db->select_sum('price')->where(array('user_id' => $this->session->userdata('user_id'), 'listing_id' => $listing_id))->get('shopping_cart')->row()->price;
$amount_to_checkout = $amount_to_checkout > 0 ? $amount_to_checkout : 0;
?>
<div class="row">
  <div class="col-md-5">
    <h5><?php echo get_phrase('order_summary'); ?></h5>
    <div class="order-summary">
      <ul class="list-group">
        <?php
        $final_cart_items = $this->db->get_where('shopping_cart', array('user_id' => $this->session->userdata('user_id'), 'listing_id' => $listing_id))->result_array();
        foreach ($final_cart_items as $final_cart_item):
          $inventory_details = $this->db->get_where('inventory', ['id' => $final_cart_item['inventory_id']])->row_array();
        ?>
          <li class="list-group-item">
            <?php echo sanitizer($inventory_details['name']); ?>
            <div class="text-right"><small><?php echo get_phrase('price').': '. currency($inventory_details['price']).'X'.$final_cart_item['quantity'].'='.currency($final_cart_item['price']); ?></small></div>
          </li>
        <?php endforeach; ?>
        <li class="list-group-item">
          <div class="text-right">
            <strong><?php echo get_phrase('total').' = '.currency($amount_to_checkout); ?></strong>
          </div>
          <div class="text-center">
            <small>(<?php echo get_phrase('payment_method'); ?> : <?php echo get_phrase('cash_on_delivery'); ?>)</small>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="col-md-7">
    <h5><?php echo get_phrase('delivery_details'); ?></h5>
    <div class="order-details">
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <form action="<?php echo site_url('addons/shop/confirm_order'); ?>" method="post">
        <input type="hidden" name="listing_id" value="<?php echo sanitizer($listing_id); ?>">
        <div class="form-group">
          <input class="form-control" type="text" placeholder="<?php echo get_phrase('customer_name'); ?>" name="customer_name" id="customer_name" required="">
        </div>
        <div class="form-group">
          <input class="form-control" type="text" placeholder="<?php echo get_phrase('phone_number'); ?>" name="delivery_contact" id="delivery_contact" required="">
        </div>
        <div class="form-group">
          <input class="form-control" type="text" placeholder="<?php echo get_phrase('delivery_address'); ?>" name="delivery_address" id="delivery_address" required="">
        </div>
        <div class="form-group">
          <textarea class="form-control" name="note" id="note" placeholder="<?php echo get_phrase('any_note'); ?>" maxlength="150"></textarea>
        </div>
        <div class="g-recaptcha mb-1" data-sitekey="<?php echo get_settings('recaptcha_sitekey') ?>" required></div>
        <div class="form-group text-center">
          <button type="button" class="btn_1" name="button" onclick="location.reload();"><?php echo get_phrase('show_products'); ?></button>
          <button type="submit" class="btn_1" name="button"><?php echo get_phrase('confirm_this_order'); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
