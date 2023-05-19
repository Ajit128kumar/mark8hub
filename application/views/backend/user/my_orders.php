<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <?php echo get_phrase('my_orders'); ?>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered datatable">
          <thead>
            <tr>
              <th width = "160"><div><?php echo get_phrase('product_details');?></div></th>
              <th width = "160"><div><?php echo get_phrase('amount_to_pay');?></div></th>
              <th><div><?php echo get_phrase('delivery_details');?></div></th>
              <th><div><?php echo get_phrase('date');?></div></th>
              <th><div><?php echo get_phrase('actions');?></div></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($my_orders as $key => $my_order):
              $user_details = $this->user_model->get_all_users($my_order['user_id'])->row_array();
              $order_details = $this->db->get_where('order_details', array('code' => $my_order['code']))->result_array();
              ?>
              <tr>
                <td>
                <?php
                  foreach ($order_details as $key => $order_detail) {
                    $inventory_details = $this->db->get_where('inventory', array('id' => $order_detail['inventory_id']))->row_array();
                    echo '○ '.$inventory_details['name'].' X '.$order_detail['quantity'].'<br/>';
                  }
                 ?>
               </td>
                <td>
                  <strong><?php echo get_phrase('amount_to_pay'); ?> :</strong> <?php echo currency($my_order['total_amount']); ?><br>
                  <?php if ($my_order['payment_status'] == "paid"): ?>
                    <strong><?php echo get_phrase('payment_status'); ?> :</strong>
                    <span class="label label-success"><?php echo get_phrase('paid'); ?></span>
                  <?php else: ?>
                    <strong><?php echo get_phrase('payment_status'); ?> :</strong>
                    <span class="label label-danger"><?php echo get_phrase('pending'); ?></span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if ($my_order['delivery_status'] == "delivered"): ?>
                    <strong><?php echo get_phrase('delivery_status'); ?> :</strong>
                    <span class="label label-success"><?php echo get_phrase('delivered'); ?></span>
                  <?php else: ?>
                    <strong><?php echo get_phrase('delivery_status'); ?> :</strong>
                    <span class="label label-danger"><?php echo get_phrase('pending'); ?></span>
                  <?php endif; ?>
                  <br>
                  <strong><?php echo get_phrase('contact'); ?> :</strong> <?php echo sanitizer($my_order['delivery_contact']); ?><br>
                  <strong><?php echo get_phrase('address'); ?> :</strong> <?php echo sanitizer($my_order['delivery_address']); ?><br>
                  <strong><?php echo get_phrase('note'); ?> :</strong> <?php echo sanitizer($my_order['note']); ?><br>
                </td>
                <td class="text-center">
                  <?php if ($my_order['delivery_status'] == "delivered"): ?>
                    <?php echo get_phrase('delivered_at').' : '.date('D, d/M/Y', $my_order['order_delivered_at']);?>
                  <?php else: ?>
                    <?php echo get_phrase('order_placed_at').' : '.date('D, d/M/Y', $my_order['order_placed_at']);?>
                  <?php endif; ?>

                </td>
                <td>
                  <a href="<?php echo site_url('addons/shop/invoice/'.$my_order['code']) ?>" class="btn btn-info"><i class="mdi mdi-printer"></i> <?php echo get_phrase('invoice') ?></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
