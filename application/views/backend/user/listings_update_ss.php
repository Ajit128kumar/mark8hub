<?php
$listing_details= array();
$listing_details['name']= '';

  if(!empty($listing_id)){
      $listing_details = $this->crud_model->get_listings($listing_id)->row_array();
  }
?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo get_phrase('update').': '.$listing_details['name']; ?>
				</div>
			</div>
			<div class="panel-body">
                <div class="col-md-12">
                  <form action="<?= base_url() ?>user/update_listings_ss" method="post">
                      <table class="table table-striped">
                          <tr>
                              <th> <select name="listing_id" class="form-control select2" required>
                                      <option value="">Select Directory</option>
                                      <?php foreach ($listings as $list): ?>
                                          <option value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
                                      <?php endforeach; ?>
                                  </select></th>
                              <th> 
                                <!-- <input type="submit" class="btn btn-success" value="search" name="submit"></th> -->
                          </tr>
                      </table>


                  </form>
                </div>
                <!-- <?php //if(!empty($listing_id)): ?> -->
              <!--   <form action="<?= base_url() ?>user/update_listings_only" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered listing_edit_form"> -->
                  <div class="col-md-12">

                    <div class="row">
                      <div class="col-md-12">
                        <div class="pull-right search" style="margin-bottom: 10px;">
                            <form>
                                
                                <div class="form-group">
                                   <!--  <label class="col-sm-2 control-label"> Search:</label> -->
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Search by Name" required name="search">
                                        <input type="hidden" id="listing_id">
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                    <div id="viewall-data">
                      
                    </div>

                    
                    <?php //include 'edit_listing_service.php'; ?>
                      <!-- <div class="text-center">
                          <br>
                          <input type="hidden" name="listing_id_update" value="<?= $listing_id ?>">
                          <input type="submit" class="btn btn-primary" name="submit_update"  value="<?php //echo get_phrase('submit'); ?>" onclick="this.form.submit()" >
                      </div> -->
                  </div>
				        <!-- </form> -->
			      <!-- <?php //endif; ?> -->
            </div>
		</div>
	</div><!-- end col-->
</div>
  <script type="text/javascript">

  $('select[name="listing_id"]').change(function(){
      var listing_id = $(this).val();
      $.ajax({
          type: "POST",
          url: "<?php echo base_url('User/getTheServicesData');?>",
          data:{listing_id:listing_id},
          beforeSend: function(){
            $('#viewall-data').addClass('loader');
          },
          success: function(data){

            // alert(data);
            $('#listing_id').val(listing_id);
            $('#viewall-data').removeClass('loader');
            $("#viewall-data").html(data);
          },
          // complete: function (data) {

            
          //       // viewAllStudentsData();
                
          //   }
      });
  });



$(document).ajaxComplete(function() {
  
    // Search

     $('input[name="search"]').keyup(function(){

        var keyword = $(this).val();
        var listing_id = $('#listing_id').val();
        
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('User/getTheServicesData');?>",
          data: {keyword:keyword,listing_id:listing_id},
          beforeSend: function(){
            $('#viewall-data').addClass('loader');
          },
          success: function(data){
           
            $('#viewall-data').removeClass('loader');
            $("#viewall-data").html(data);
            // search();
          }
      });
    });

      

     // showListingTypeForm('<?php //echo $listing_details['listing_type']; ?>');
});

  function getCityList(country_id) {
    $.ajax({
      type : 'POST',
      url : '<?php echo site_url('home/get_city_list_by_country_id'); ?>',
      data : {country_id : country_id},
      success : function(response) {
        $('#city_id').html(response);
      }
    });
  }
  

  // $(document).ready(function() {
  
    
  // });

  function appendHotelRoomSpecification() {

    jQuery('#hotel_room_specification_div').append(blank_hotel_room_specification_div);
    let selector = jQuery('#hotel_room_specification_div .hotel_room_specification_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'room-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'room-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }
  

  function removeHotelRoomSpecification(elem) {
    jQuery(elem).closest('.hotel_room_specification_div').remove();
    $(".bootstrap-tag-input").tagsinput('items');
    removeFromDatabase('hotel', elem.id);
  }

  function appendFoodMenu() {

    jQuery('#food_menu_div').append(blank_food_menu_div);
    let selector = jQuery('#food_menu_div .food_menu_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'menu-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'menu-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }

  function removeFoodMenu(elem) {
    jQuery(elem).closest('.food_menu_div').remove();
    $(".bootstrap-tag-input").tagsinput('items');
    removeFromDatabase('food_menu', elem.id);
  }

  function appendBeautyService() {

    jQuery('#beauty_service_div').append(blank_beauty_service_div);
    let selector = jQuery('#beauty_service_div .beauty_service_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'service-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'service-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }

  function removeBeautyService(elem) {
    jQuery(elem).closest('.beauty_service_div').remove();
    $(".bootstrap-tag-input").tagsinput('items');
    removeFromDatabase('beauty_service', elem.id);
  }

  function appendSpecialOffer() {

    jQuery('#special_offer_div').append(blank_special_offer_div);
    let selector = jQuery('#special_offer_div .special_offer_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'product-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'product-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }

  function removeSpecialOffer(elem) {
    jQuery(elem).closest('.special_offer_div').remove();
    $(".bootstrap-tag-input").tagsinput('items');
    removeFromDatabase('product', elem.id);
  }

  function appendCategory() {
    jQuery('#category_area').append(blank_category);
  }

  function removeCategory(categoryElem) {
    jQuery(categoryElem).closest('.appendedCategoryFields').remove();
  }

  function appendPhotoUploader() {
    jQuery('#photos_area').append(blank_photo_uploader);
  }

  function removePhotoUploader(photoElem) {
    jQuery(photoElem).closest('.appendedPhotoUploader').remove();
  }
  //new
  function appendBrandUploader() {
      jQuery('#brands_area').append(blank_brand_uploader);
  }
  function removeBrandUploader(photoElem) {
      jQuery(photoElem).closest('.appendedBrandUploader').remove();
  }
  //new ends

  function showListingTypeForm(listing_type) {
  	listing_type_value = listing_type;
  	if (listing_type === "shop") {
  		$('#special_offer_parent_div').show();
      $('#food_menu_parent_div').hide();
  		$('#beauty_service_parent_div').hide();
  		$('#hotel_room_specification_parent_div').hide();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_products'); ?>');
  	}
  	else if (listing_type === "hotel") {
  		$('#special_offer_parent_div').hide();
  		$('#food_menu_parent_div').hide();
      $('#beauty_service_parent_div').hide();
  		$('#hotel_room_specification_parent_div').show();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_rooms'); ?>');
  	}
  	else if (listing_type === "restaurant") {
  		$('#special_offer_parent_div').hide();
  		$('#food_menu_parent_div').show();
      $('#beauty_service_parent_div').hide();
  		$('#hotel_room_specification_parent_div').hide();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_food_menu'); ?>');
  	}else if (listing_type === "beauty") {
      $('#special_offer_parent_div').hide();
      $('#food_menu_parent_div').hide();
      $('#beauty_service_parent_div').show();
      $('#hotel_room_specification_parent_div').hide();
      $('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_food_menu'); ?>');
    }else {
  		$('#special_offer_parent_div').hide();
  		$('#food_menu_parent_div').hide();
  		$('#hotel_room_specification_parent_div').hide();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('no_preview_available'); ?>');
  	}
  }

  function removeFromDatabase(type, id) {
    $.ajax({
      type : 'POST',
      url : '<?php echo site_url('admin/remove_listing_inner_feature'); ?>',
      data : {type : type, id : id},
      success : function(response) {
        success_notify('<?php echo get_phrase('removed_successfully'); ?>');
      }
    });
  }

  // This fucntion checks the minimul required fields of listing form
  function checkMinimumFieldRequired() {
  	var title = $('#title').val();
  	var defaultCategory = $('#category_default').val();
  	var latitude = $('#latitude').val();
  	var longitude = $('#longitude').val();
  	if (title === "" || defaultCategory === "" || latitude === "" || longitude === "") {
  		error_notify('<?php echo get_phrase('listing_title').', '.get_phrase('listing_category').', '.get_phrase('latitude').', '.get_phrase('longitude').' '.get_phrase('can_not_be_empty'); ?>');
  	}else {
  		$('.listing_edit_form').submit();
  	}
  }

  // Show Listing Type Wise Demo
  function showListingTypeWiseDemo(param) {
  	if (listing_type_value === 'hotel') {
  		showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/hotel_room', '<?php echo get_phrase('preview'); ?>');
  	}
  	if (listing_type_value === 'restaurant') {
  		showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/food_menu', '<?php echo get_phrase('preview'); ?>');
  	}
  	if (listing_type_value === 'shop') {
  		showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/special_offers', '<?php echo get_phrase('preview'); ?>');
  	}
    if (listing_type_value === 'beauty') {
      showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/beauty_service', '<?php echo get_phrase('preview'); ?>');
    }
  }
</script>
