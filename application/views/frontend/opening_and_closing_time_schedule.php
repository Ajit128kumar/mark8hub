
<div class="opening" style="padding-left: 25px;">
  <div class="ribbon">
    <span class="<?php echo strtolower(now_open($listing_id)) == 'closed' ? 'closed' : 'open'; ?>"><?php echo now_open($listing_id); ?></span>
  </div>
  <i class="icon_clock_alt" style="margin-top: 8px; font-weight: 600; font-size: 30px;"></i>
  <h4 style="color: #08c; font-weight: 600;padding-left: 50px; font-size: 20px; margin-bottom: 30px;"><?php echo get_phrase('opening_hours'); ?></h4>
  <?php $time_config = $this->db->get_where('time_configuration', array('listing_id' => $listing_id))->row_array(); ?>
  <div class="row">
    <div class="col-md-6">
     <ul class="op_hr">
        <li class="op_bk_clr">
          <?php echo get_phrase('saturday'); ?>
          <span>
            <?php
             $time_interval = explode('-', $time_config['saturday']);
             if ($time_interval[0] == 'closed' || $time_interval[1] == 'closed') {
               echo get_phrase('closed');
             }else {
              echo date('h a', strtotime("$time_interval[0]:00:00")).' - '.date('h a', strtotime("$time_interval[1]:00:00"));
             }
            ?>
          </span>
        </li>
        <li>
          <?php echo get_phrase('sunday'); ?>
          <span>
            <?php
             $time_interval = explode('-', $time_config['sunday']);
             if ($time_interval[0] == 'closed' || $time_interval[1] == 'closed') {
               echo get_phrase('closed');
             }else {
              echo date('h a', strtotime("$time_interval[0]:00:00")).' - '.date('h a', strtotime("$time_interval[1]:00:00"));
             }
            ?>
          </span>
        </li>
        <li>
          <?php echo get_phrase('monday'); ?>
          <span>
            <?php
             $time_interval = explode('-', $time_config['monday']);
             if ($time_interval[0] == 'closed' || $time_interval[1] == 'closed') {
               echo get_phrase('closed');
             }else {
              echo date('h a', strtotime("$time_interval[0]:00:00")).' - '.date('h a', strtotime("$time_interval[1]:00:00"));
             }
            ?>
          </span>
        </li>
        <li>
          <?php echo get_phrase('tuesday'); ?>
          <span>
            <?php
             $time_interval = explode('-', $time_config['tuesday']);
             if ($time_interval[0] == 'closed' || $time_interval[1] == 'closed') {
               echo get_phrase('closed');
             }else {
              echo date('h a', strtotime("$time_interval[0]:00:00")).' - '.date('h a', strtotime("$time_interval[1]:00:00"));
             }
            ?>
          </span>
        </li>
      </ul>
    </div>
    <div class="col-md-6">
      <ul class="op_hr">
        <li class="op_list">
          <?php echo get_phrase('wednesday'); ?>
          <span>
            <?php
             $time_interval = explode('-', $time_config['wednesday']);
             if ($time_interval[0] == 'closed' || $time_interval[1] == 'closed') {
               echo get_phrase('closed');
             }else {
              echo date('h a', strtotime("$time_interval[0]:00:00")).' - '.date('h a', strtotime("$time_interval[1]:00:00"));
             }
            ?>
          </span>
        </li>
        <li>
          <?php echo get_phrase('thursday'); ?>
          <span>
            <?php
             $time_interval = explode('-', $time_config['thursday']);
             if ($time_interval[0] == 'closed' || $time_interval[1] == 'closed') {
               echo get_phrase('closed');
             }else {
              echo date('h a', strtotime("$time_interval[0]:00:00")).' - '.date('h a', strtotime("$time_interval[1]:00:00"));
             }
            ?>
          </span>
        </li>
        <li>
          <?php echo get_phrase('friday'); ?>
          <span>
            <?php
             $time_interval = explode('-', $time_config['friday']);
             if ($time_interval[0] == 'closed' || $time_interval[1] == 'closed') {
               echo get_phrase('closed');
             }else {
              echo date('h a', strtotime("$time_interval[0]:00:00")).' - '.date('h a', strtotime("$time_interval[1]:00:00"));
             }
            ?>
          </span>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- 
<div class="open_dt">
  <div class="container">
     <h5 class="add_bottom_15 abt-titl"><?php echo get_phrase('opening_hours'); ?></h5>
    <div class="row">
      <div class="col-md-6">
        <div class="dt-wrap">
          <div class="dt-rd-box">
            <span>Sun</span>
          </div>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
          <spam class="time_betn"></spam>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
        </div>
        <div class="dt-wrap">
          <div class="dt-rd-box">
            <span>Mon</span>
          </div>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
          <spam class="time_betn"></spam>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
        </div>
        <div class="dt-wrap">
          <div class="dt-rd-box">
            <span>Tue</span>
          </div>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
          <spam class="time_betn"></spam>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
        </div>
        <div class="dt-wrap">
          <div class="dt-rd-box">
            <span>Wed</span>
          </div>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
          <spam class="time_betn"></spam>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="dt-wrap">
          <div class="dt-rd-box">
            <span>Thu</span>
          </div>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
          <spam class="time_betn"></spam>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
        </div>
        <div class="dt-wrap">
          <div class="dt-rd-box">
            <span>Fri</span>
          </div>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
          <spam class="time_betn"></spam>
          <div class="dt_txt_">
            <span>8:00</span>
          </div>
        </div>
        <div class="dt-wrap">
          <div class="dt-rd-box">
            <span>Sat</span>
          </div>
          <div class="dt_txt_ close_d">
            <span>Closed</span>
          </div>
           <spam class="time_betn"></spam>
          <div class="dt_txt_">
            <span>8:00</span>
          </div> -->
        <!-- </div>
      </div>
    </div>
  </div>
</div> -->
 
