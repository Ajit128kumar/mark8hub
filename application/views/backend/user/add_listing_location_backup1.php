<?php

  $listing_id = $this->uri->segment(4); 
  $listing_details= array();
  $listing_details['name']= '';

  if(!empty($listing_id)){
      $listing_details = $this->crud_model->get_listings($listing_id)->row_array();
  }
?>

<div class="row">
<?php if(!empty($listing_id)): ?>
    <form action="<?= base_url() ?>user/branchCreation" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered listing_edit_form">
      <div class="col-md-12">
        <?php include 'edit_listing_branch.php'; ?>
          <div class="text-center">
              <br>
              <input type="hidden" name="listing_id_update" value="<?= $listing_id ?>">
              <!-- <button type="submit" class="btn btn-primary">Submit</div> -->
          </div>
      </div>
    </form>
<?php endif; ?>
</div>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>


<script type="text/javascript">
    var blank_branch_div = $('#blank_branch_div').html();
    
    function appendBranch() {
      jQuery('#servicess_div').append(blank_branch_div);
      // let selector = jQuery('#services_div .services_div');
    }

    function removeBranch(elem) {
      jQuery(this).closest(".servicess_div").remove();
    }

    jQuery(document).ready(function(){
      $(document).on('click', '.removeBtn', function(){ 
        console.log(this);
        jQuery(this).closest(".servicess_div").remove();
      });
    })


//new fn ends
</script>