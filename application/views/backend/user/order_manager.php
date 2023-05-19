<div class="row">
  <div class="panel panel-primary" data-collapsed="0" style="margin-top: 20px; margin-right: 15px; margin-left: 15px; margin-bottom: 0px;">
    <div class="panel-body">
      <form action="<?php echo site_url('addons/shop/order_manager') ?>" method="get">
        <div class="row justify-content-center">
          <div class="col-md-offset-2 col-md-6">
            <div class="form-group">
              <div class="col-sm-12">
                <select name="listing_id" id = "listing_filter" class="select2 form-control" data-allow-clear="true" data-placeholder="<?php echo get_phrase('choose_listing'); ?>">
                  <option value="<?php echo 'all'; ?>"><?php echo get_phrase('all'); ?></option>
                  <?php foreach ($listings as $listing): ?>
                    <option value="<?php echo sanitizer($listing['id']); ?>" <?php if($active_listing_id == $listing['id']): ?>selected<?php endif; ?>><?php echo sanitizer($listing['name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-info btn-block" style="height: 40px;"><i class="entypo-search"></i><?php echo get_phrase('filter'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <?php echo get_phrase('manage_orders'); ?>
        </div>
      </div>
      <div class="panel-body">
        <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
          <li class="active">
            <a href="#pending-orders" data-toggle="tab">
              <span class="visible-xs"><i class="entypo-home"></i></span>
              <span class="hidden-xs"><?php echo get_phrase('pending_orders'); ?></span>
            </a>
          </li>
          <li class="">
            <a href="#delivered-orders" data-toggle="tab">
              <span class="visible-xs"><i class="entypo-user"></i></span>
              <span class="hidden-xs"><?php echo get_phrase('delivered_orders'); ?></span>
            </a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active" id="pending-orders">
            <table class="table table-bordered datatable">
              <thead>
                <tr>
                  <th><div><?php echo get_phrase('customer_name');?></div></th>
                  <th width = "160"><div><?php echo get_phrase('product_details');?></div></th>
                  <th width = "100"><div><?php echo get_phrase('amount_to_pay');?></div></th>
                  <th width = "160"><div><?php echo get_phrase('delivery_details');?></div></th>
                  <th><div><?php echo get_phrase('order_placed_at');?></div></th>
                  <th><div><?php echo get_phrase('options');?></div></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pending_orders as $key => $pending_order):
                  $user_details = $this->user_model->get_all_users($pending_order['user_id'])->row_array();
                  $order_details = $this->db->get_where('order_details', array('code' => $pending_order['code']))->result_array();
                  ?>
                  <tr>
                    <td>
                      <?php
                      echo sanitizer($pending_order['customer_name']);
                      ?>
                    </td>
                    <td>
                      <?php
                      foreach ($order_details as $key => $order_detail) {
                        $inventory_details = $this->db->get_where('inventory', array('id' => $order_detail['inventory_id']))->row_array();
                        echo '○ '.$inventory_details['name'].' X '.$order_detail['quantity'].'<br/>';
                      }
                      ?>
                    </td>
                    <td>
                      <strong><?php echo get_phrase('amount'); ?> :</strong> <?php echo currency($pending_order['total_amount']); ?><br>
                      <?php if ($pending_order['payment_status'] == "paid"): ?>
                        <strong><?php echo get_phrase('status'); ?> :</strong>
                        <span class="label label-success"><?php echo get_phrase('paid'); ?></span>
                      <?php else: ?>
                        <strong><?php echo get_phrase('status'); ?> :</strong>
                        <span class="label label-danger"><?php echo get_phrase('pending'); ?></span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <strong><?php echo get_phrase('contact'); ?> :</strong> <?php echo sanitizer($pending_order['delivery_contact']); ?><br>
                      <strong><?php echo get_phrase('address'); ?> :</strong> <?php echo sanitizer($pending_order['delivery_address']); ?><br>
                      <strong><?php echo get_phrase('note'); ?> :</strong> <?php echo sanitizer($pending_order['note']); ?><br>
                    </td>
                    <td class="text-center">
                      <?php echo date('D, d/M/Y', $pending_order['order_placed_at']);?>
                    </td>
                    <td>
                      <div class="bs-example">
                        <div class="btn-group">
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <?php echo get_phrase('action'); ?> <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu dropdown-blue" role="menu">
                            <li>
                              <a href="#" class="" onclick="confirm_modal('<?php echo site_url('addons/shop/order_actions/paid/'.$pending_order['id']); ?>', 'generic_confirmation');">
                                <i class="entypo-check"></i>
                                <?php echo get_phrase('mark_as_paid'); ?>
                              </a>
                            </li>
                            <li>
                              <a href="#" class="" onclick="confirm_modal('<?php echo site_url('addons/shop/order_actions/delivered/'.$pending_order['id']); ?>', 'generic_confirmation');">
                                <i class="entypo-check"></i>
                                <?php echo get_phrase('mark_as_delivered'); ?>
                              </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                              <a href="#" class="" onclick="confirm_modal('<?php echo site_url('addons/shop/order_actions/delete/'.$pending_order['id']); ?>');">
                                <i class="entypo-trash"></i>
                                <?php echo get_phrase('delete'); ?>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="delivered-orders">
            <table class="table table-bordered datatable">
              <thead>
                <tr>
                  <th><div><?php echo get_phrase('customer_name');?></div></th>
                  <th width = "160"><div><?php echo get_phrase('product_details');?></div></th>
                  <th width = "100"><div><?php echo get_phrase('amount_paid');?></div></th>
                  <th width = "160"><div><?php echo get_phrase('delivery_details');?></div></th>
                  <th><div><?php echo get_phrase('order_delivered_at');?></div></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($delivered_orders as $key => $delivered_order):
                  $user_details = $this->user_model->get_all_users($delivered_order['user_id'])->row_array();
                  $order_details = $this->db->get_where('order_details', array('code' => $delivered_order['code']))->result_array();
                  ?>
                  <tr>
                    <td>
                      <?php
                      echo sanitizer($pending_order['customer_name']);
                      ?>
                    </td>
                    <td>
                      <?php
                      foreach ($order_details as $key => $order_detail) {
                        $inventory_details = $this->db->get_where('inventory', array('id' => $order_detail['inventory_id']))->row_array();
                        echo '○ '.$inventory_details['name'].' X '.$order_detail['quantity'].'<br/>';
                      }
                      ?>
                    </td>
                    <td>
                      <strong><?php echo get_phrase('amount'); ?> :</strong> <?php echo currency($delivered_order['total_amount']); ?><br>
                      <?php if ($delivered_order['payment_status'] == "paid"): ?>
                        <strong><?php echo get_phrase('status'); ?> :</strong>
                        <span class="label label-success"><?php echo get_phrase('paid'); ?></span>
                      <?php else: ?>
                        <strong><?php echo get_phrase('status'); ?> :</strong>
                        <span class="label label-danger"><?php echo get_phrase('pending'); ?></span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <strong><?php echo get_phrase('contact'); ?> :</strong> <?php echo sanitizer($delivered_order['delivery_contact']); ?><br>
                      <strong><?php echo get_phrase('address'); ?> :</strong> <?php echo sanitizer($delivered_order['delivery_address']); ?><br>
                      <strong><?php echo get_phrase('note'); ?> :</strong> <?php echo sanitizer($delivered_order['note']); ?><br>
                    </td>
                    <td class="text-center">
                      <?php echo date('D, d/M/Y', $delivered_order['order_delivered_at']);?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
