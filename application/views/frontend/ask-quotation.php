<div class="row" style="margin-top: 60px;">
    <h5 class="abt-titl col-md-12" style="padding-left: 0px;">Ask Quotation</h5>
    
    <div class="box_detail booking col-md-6" style="border-radius: 0px;">
        <form class="quotation-form" action="<?php echo site_url('home/ask_quotation'); ?>" method="post">
            <input type="hidden" name="user_id" value="<?php echo $listing_details['user_id']; ?>">
            <input type="hidden" name="requester_id" value="<?php echo $this->session->userdata('user_id'); ?>">
            <input type="hidden" name="listing_id" value="<?php echo $listing_details['id']; ?>">
            <div class="price">
                <h5 class="d-inline">Quotation Form</h5>
                
            </div>

         <?php
            $services = $this->db->get_where('service', array('listing_id' => $listing_id))->result_array();
          if(!empty($services)):?>
            <div class="form-group">
                <select class="form-control" name="service" id="service"  >
                    <option value=""><?php echo get_phrase('select_a_service'); ?></option>
                    <?php
                        
                        foreach($services as $service){
                           
                    ?>
                        <option value="<?php echo $service['name']; ?>">
                            <?php echo $service['name']; ?>
                        
                        </option>
                    <?php } ?>
                </select>
            </div>
        <?php endif;?>    
        <?php if(!empty($inventories)):?>
            <div class="form-group">
                <select class="form-control" name="product" id="product"  >
                    <option value="">Select Product</option>
                    <?php
                       
                        foreach($inventories as $inventory){
                           
                    ?>
                        <option value="<?php echo $inventory['name']; ?>">
                            <?php echo $inventory['name']; ?>
                        
                        </option>
                    <?php } ?>
                </select>
            </div>
        <?php endif;?>

            <div class="form-group">
                <input type="number" name="quantity" class="form-control" placeholder="Quantity">
            </div>

            <div class="form-group">
                <textarea name="note" class="form-control" placeholder="<?php echo get_phrase('note'); ?>" style="height: 80px;" required></textarea>
            </div>

            <a href="javascript::" class=" add_top_30 btn_1 full-width purchase" onclick="submit_quotation_form()"><?php echo get_phrase('submit'); ?></a>
        </form>
        
    </div>

    <div class="col-md-6" style="padding-right: 0px;">
        <img style="width: 100%; height: 400px; object-fit: cover;" class="img img-responsive" src="<?= base_url() ?>assets/frontend/images/cs.png">
    </div>
</div>


<script>
    $('document').ready(function(){
        $('#service').show();
        $('#product').show();

    });

    function submit_quotation_form() {
        if (isLoggedIn === '1') {

            $('.quotation-form').submit();
        }else {
            loginAlert();
        }

    }
</script>