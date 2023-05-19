<?php
  $user_details = $this->db->get_where('user', array('id' => $this->session->userdata('user_id')))->row_array();
  $my_order_details = $this->db->get_where('order_details', array('code' => $my_order['code']))->result_array();
?>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-body">
        <div class="invoice">

        	<div class="row">

        		<div class="col-sm-6 invoice-left">

        			<a href="#">
        				<img src="<?php echo base_url('assets/global/dark_logo.png'); ?>" height="30"/>
        			</a>

        		</div>

        		<div class="col-sm-6 invoice-right">

        				<h3><?php echo get_phrase('order_invoice'); ?></h3>
        				<span><b><?php echo get_phrase('printed_on'); ?></b> : <?php echo date('D, d/M/Y'); ?></span>
                <br>
                <b><?php echo get_phrase('order_status'); ?>:</b>
                <?php if ($my_order['delivery_status'] == 'delivered'): ?>
                  <span class="label label-success float-right"><?php echo get_phrase('delivered'); ?></span>
                <?php else: ?>
                  <span class="label label-danger float-right"><?php echo get_phrase('pending'); ?></span>
                <?php endif; ?>
        		</div>

        	</div>


        	<hr class="margin" />


        	<div class="row">

        		<div class="col-sm-3 invoice-left">

        			<h4><?php echo get_phrase('shipping_address'); ?></h4>
              <?php echo sanitizer($my_order['customer_name']); ?><br>
              <?php echo sanitizer($my_order['delivery_address']); ?><br>
              <?php echo sanitizer($my_order['delivery_contact']); ?><br>

        		</div>

        		<div class="col-md-offset-3 col-md-6 invoice-right">
              <strong><?php echo get_phrase('payment_status'); ?>:</strong>
              <?php if ($my_order['payment_status'] == 'paid'): ?>
                <span class="label label-success float-right"><?php echo get_phrase('paid'); ?></span>
              <?php else: ?>
                <span class="label label-danger float-right"><?php echo get_phrase('unpaid'); ?></span>
              <?php endif; ?>
              <br>
        			<strong><?php echo get_phrase('order_placed_at'); ?>:</strong> <?php echo date('D, d-M-Y', $my_order['order_placed_at']); ?>
        			<br />
        			<strong><?php echo get_phrase('order_delivered_at'); ?>:</strong> <?php echo !empty($my_order['order_delivered_at']) ? date('D, d-M-Y', $my_order['order_delivered_at']) : get_phrase('no_delivered_yet'); ?>
        		</div>

        	</div>

        	<div class="margin"></div>

        	<table class="table table-bordered">
        		<thead>
        			<tr>
                <th>#</th>
                <th><?php echo get_phrase('products'); ?></th>
                <th><?php echo get_phrase('unit_price'); ?></th>
                <th><?php echo get_phrase('quantity'); ?></th>
                <th class="text-right"><?php echo get_phrase('total'); ?></th>
        			</tr>
        		</thead>

        		<tbody>
              <?php foreach ($my_order_details as $key => $my_order_detail):
                $inventory_details = $this->db->get_where('inventory', array('id' => $my_order_detail['inventory_id']))->row_array(); ?>
                <tr>
                  <td><?php echo ++$key; ?></td>
                  <td>
                    <b><?php echo sanitizer($inventory_details['name']); ?></b> <br/>
                  </td>
                  <td><?php echo currency($inventory_details['price']); ?></td>
                  <td><?php echo sanitizer($my_order_detail['quantity']); ?></td>
                  <td class="text-right"><?php echo currency($my_order_detail['total_amount']); ?></td>
                </tr>
              <?php endforeach; ?>
        		</tbody>
        	</table>

        	<div class="margin"></div>

        	<div class="row">

        		<div class="col-sm-6">

        		</div>

        		<div class="col-sm-6">

        			<div class="invoice-right">

        				<ul class="list-unstyled">
        					<li>
        						<?php echo get_phrase('sub_total_amount'); ?>:
        						<strong><?php echo currency($my_order['total_amount']); ?></strong>
        					</li>
        					<li>
        						<?php echo get_phrase('grand_total'); ?>:
        						<strong><?php echo currency($my_order['total_amount']); ?></strong>
        					</li>
        				</ul>

        				<br />

        				<a href="javascript:window.print();" class="btn btn-primary btn-icon icon-left hidden-print">
        					<?php echo get_phrase('print_invoice'); ?>
        					<i class="entypo-doc-text"></i>
        				</a>
        				&nbsp;
        			</div>

        		</div>

        	</div>

        </div>
      </div>
    </div>
  </div><!-- end col-->
</div>
