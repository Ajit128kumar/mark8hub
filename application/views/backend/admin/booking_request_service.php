<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          Service Booking Request
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered datatable">
          <thead>
            <tr>
              <th width="80"><div>#</div></th>
              <th><div><?php echo get_phrase('listing');?></div></th>
              <th><div><?php echo get_phrase('date');?></div></th>
              <th><div><?php echo get_phrase('additional_information');?></div></th>
              <th><div><?php echo get_phrase('status');?></div></th>
              <th><div><?php echo get_phrase('options');?></div></th>
            </tr>
          </thead>
          <tbody>
            <?php $this->db->order_by('id', 'DESC'); ?>
            <?php $bookings = $this->db->get_where('booking', array('user_id' => $this->session->userdata('user_id'), 'listing_type' => 'service'))->result_array();
            $count = 1;
            foreach($bookings as $booking): ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $this->db->get_where('listing', array('id' => $booking['listing_id']))->row('name'); ?></td>
              <td>
                <?php
                $listing_type = $this->db->get_where('listing', array('id' => $booking['listing_id']))->row('listing_type');
                if($listing_type == 'service'){
                  echo get_phrase('booking_date').' : <b>'.date('d M Y', $booking['booking_date']).'</b><br>';

                  $informations = json_decode($booking['additional_information']);
                  foreach($informations as $key => $value){
                    if($key == 'time'):
                      echo '<span>'.get_phrase($key). ' : ' . date('h i A', $value) . '</span><br>';
                    endif;
                  }
                }
                echo '<br>'.get_phrase('requesting_date').' : '.date('d M Y', $booking['created_at']);
                ?>
              </td>
              <td>
                <h5 class="mt-0 mb-1"><?php echo $this->db->get_where('user', array('id' => $booking['requester_id']))->row('name'); ?></h5>
                <?php
                $informations = json_decode($booking['additional_information']);
                foreach($informations as $key => $value){
                  if($key == 'service'){
                    ?>
                    <span><?php echo get_phrase($key); ?> : <?php echo $this->db->get_where('service', array('id' => $value))->row('name'); ?></span><br>
                    <?php
                  };

                  if($key == 'note' && $value !=''){
                    ?>
                    <span><?php echo get_phrase($key); ?> : <?php echo $value; ?></span><br>
                    <?php
                  }
                }
                ?>
              </td>
              <td>
                <?php

                $listing_type = $this->db->get_where('listing', array('id' => $booking['listing_id']))->row('listing_type');

                  $expired_date = $booking['booking_date'];

//                die($expired_date);
                if($expired_date >= strtotime(date('dMY'))){
                  if($booking['status'] == 0){ ?>
                    <span class="label label-warning"><?php echo get_phrase('pending'); ?></span>
                  <?php }else{ ?>
                    <span class="label label-success"><?php echo get_phrase('approved'); ?></span>
                  <?php }
                }else{ ?>
                  <span class="label label-danger"><?php echo get_phrase('expired'); ?></span>
                <?php } ?>
              </td>
              <td>
                <?php

                  $expired_date = $booking['booking_date'];
                 ?>
                
                
                <div class="bs-example">
                  <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <?php echo get_phrase('action'); ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-blue" role="menu">
                      <li>
                        <?php if($expired_date >= strtotime(date('dMY'))){ ?>
                          <?php if($booking['status'] == 0){ ?>
                            <a href="<?php echo site_url('admin/booking_request_service/approved/'.$booking['id']); ?>" class="">
                              <i class="entypo-check"></i>
                              <?php echo get_phrase('approve'); ?>
                            </a>
                          <?php }else{ ?>
                            <a href="<?php echo site_url('admin/booking_request_service/pending/'.$booking['id']); ?>" class="">
                              <i class="entypo-check"></i>
                              <?php echo get_phrase('pending'); ?>
                            </a>
                          <?php } ?>
                        <?php } ?>
                      </li>
                      
                      <li>
                        <a href="#" class="" onclick="confirm_modal('<?php echo site_url('admin/booking_request_service/delete/'.$booking['id']); ?>');">
                          <i class="entypo-trash"></i>
                          <?php echo get_phrase('delete'); ?>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </td>
            </tr>
            <?php $count++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
