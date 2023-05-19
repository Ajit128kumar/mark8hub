<?php 
$result = $this->db->get_where('business_achievements', array('listing_id' => $listing_details['id']))->row_array();
// echo "<pre>";
// print_r($result);die();
?>

<div class="form-group">
    <label class="col-sm-3 control-label" for="listing_images">Name<br/>  </label>
    <div class="col-sm-7">
        <div id="brands_area">
            
                <?php if (!empty($result['achievement'])): ?>
  <?php
                $k=0;
                foreach (json_decode($result['achievement']) as $key => $photo): ?>
                    <?php if ($k == 0): ?>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="brand_name[]" class="form-control" value="<?= $key ?>" placeholder="Name"/>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
                                                <img src="<?php echo base_url('uploads/brand_images/'.$photo); ?>" alt="...">
                                                <input type="hidden" class="name_of_previous_image" name="new_brand_images[]" value="<?php echo $photo; ?>">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                            <div>
                        <span class="btn btn-white btn-file">
                          <span class="fileinput-new">Select Logo</span>
                          <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                          <input type="file" name="brand_logo[]" accept="image/*">
                        </span>
                                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-primary btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="appendBrandUploader()"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                   
                    <?php else: ?>
                   
                        <div class="row appendedBrandUploader">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="brand_name[]" class="form-control" value="<?= $key ?>" placeholder="Brand name"/>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
                                                <img src="<?php echo base_url('uploads/brand_images/'.$photo); ?>" alt="...">
                                                <input type="hidden" class="name_of_previous_image" name="new_brand_images[]" value="<?php echo $photo; ?>">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                            <div>
                        <span class="btn btn-white btn-file">
                          <span class="fileinput-new">Select Logo</span>
                          <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                          <input type="file" name="brand_logo[]" accept="image/*">
                        </span>
                                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removeBrandUploader(this)"> <i class="fa fa-minus"></i> </button>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php
                $k++;
                endforeach; ?>

                <?php else: ?>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" name="brand_name[]" class="form-control"  placeholder=" Name"/>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
                                        <img src="<?php echo base_url('uploads/placeholder.png'); ?>" alt="...">
                                        <input type="hidden" class="name_of_previous_image" name="new_brand_images[]" value="">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                    <span class="btn btn-white btn-file">
                      <span class="fileinput-new">Select Logo</span>
                      <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                      <input type="file" name="brand_logo[]" accept="image/*">
                    </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="appendBrandUploader()"> <i class="fa fa-plus"></i> </button>
                    </div>
                </div>
              
                
             <?php endif; ?>
            
        </div>
        <div id="blank_brand_uploader">
            <div class="row appendedBrandUploader">
                <div class="col-sm-7">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" name="brand_name[]" class="form-control"  placeholder=" Name"/>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
                                    <img src="<?php echo base_url('uploads/placeholder.png'); ?>" alt="...">
                                    <input type="hidden" class="name_of_previous_image" name="new_brand_images[]" value="">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                  <span class="btn btn-white btn-file">
                    <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>
                    <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                    <input type="file" name="brand_logo[]" accept="image/*">
                  </span>

                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removeBrandUploader(this)"> <i class="fa fa-minus"></i> </button>
                </div>
            </div>
        </div>
        
    </div>
</div>
 

  <script type="text/javascript">


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
  var blank_category = $('#blank_category_field').html();
  var blank_photo_uploader = $('#blank_photo_uploader').html();
  //new
  var blank_brand_uploader = $('#blank_brand_uploader').html();
  //new ends
  var blank_special_offer_div = $('#blank_special_offer_div').html();
  var blank_food_menu_div = $('#blank_food_menu_div').html();
  var blank_menu_div = $('#blank_product_div').html();
  var blank_beauty_service_div = $('#blank_beauty_service_div').html();
  var blank_hotel_room_specification_div = $('#blank_hotel_room_specification_div').html();
  var listing_type_value = $('.listing-type-radio').val();

  $(document).ready(function() {
    $('#blank_category_field').hide();
    $('#blank_photo_uploader').hide();
      //new
      $('#blank_brand_uploader').hide();
      //new ends
    $('#blank_special_offer_div').hide();
    $('#blank_food_menu_div').hide();
    $('#blank_beauty_service_div').hide();
    $('#blank_hotel_room_specification_div').hide();
    //showListingTypeForm('<?php //echo $listing_details['listing_type']; ?>');
  });

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

  function appendHotelRoomSpecification() {

    jQuery('#hotel_room_specification_div').append(blank_hotel_room_specification_div);
    let selector = jQuery('#hotel_room_specification_div .hotel_room_specification_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'room-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'room-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }
  function appendProduct() {

      jQuery('#product_div').append(blank_menu_div);
      let selector = jQuery('#product_div .product_div');

      let rand = Math.random().toString(36).slice(3);

      
       for (var k=1; k <= 5 ; k++) { 

        $(selector[selector.length - 1]).find('label.product_label_'+k).attr('for', 'service-image-'+k+'-'+ rand);
        $(selector[selector.length - 1]).find('input.product_image_file_'+k).attr('id', 'service-image-'+k+'-' + rand);
       }

       $(selector[selector.length - 1]).find('input.availability').attr('name', 'availability['+ rand+']');

        $(selector[selector.length - 1]).find('input.featured').attr('name', 'is_featured['+ rand+']');


      $(".bootstrap-tag-input").tagsinput('items');
      initImagePreviewer();
  }

  function removeProduct(elem) {
      jQuery(elem).closest('.product_div').remove();
      $(".bootstrap-tag-input").tagsinput('items');
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
