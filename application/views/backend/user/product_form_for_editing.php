<?php

$this->db->select('*')->from('inventory')->where(array('listing_id' => $listing_details['id']))->order_by('id','DESC');

  if(!empty($keyword)){
    $this->db->like('name', $keyword,'after');
  }
  $query = $this->db->get();

  $new_products = $query->result_array();

// $new_products = array();
// echo $listing_details['id'];die();
// echo '<pre>';
// print_r($new_products);
// echo '</pre>';die();

?>

<?php
// GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
$active_listing_details = $this->crud_model->get_listings($listing_details['id'])->result_array();
$inventory_categories = $this->db->get_where('inventory_category', ['listing_id' => $listing_details['id']])->result_array();
?>

<style type="text/css">
  
  .box{
    height: 120px;
    margin: 10px 5px;
  }

  .wrapper-image-preview{
    position: relative;
  }

  .cross{

    position: absolute;
    right:4px;
    top: -12px;
    z-index: 9;
  }
  .cross i{
    color: red;
  }

  .js--image-preview{

    height: 82px;
  }
  .upload-options .btn{

    padding: 0;
    white-space:inherit;
  }

  .p-0{
    padding: 0 !important;
  }

  .price_input{
    padding:0px !important;
  }
  .per_input{
    padding-left:10px !important;
    padding-right:0px !important;
  }



</style>

<div class="row">
  <div class="col-md-12">
    <?php if($listing_details['type'] == 1 || $listing_details['type'] == 3){?>
    <div class="row  pull-right">
      <button type="button" class="btn btn-primary" name="button" onclick="appendProduct()"> <i class="mdi mdi-plus"></i> Add new product</button>
    </div>
  <?php } else{?>
    <h2 style="color: red">You can not add more services in this directory because you're business type is  <?php echo getBusinessTypeName($listing_details['type'])?>.</h2>
  <?php }?>
  </div>
  
</div>

<div id="product_div">
              
</div>

<div id = "blank_product_div" style="visibility: hidden;position: absolute;">
  <div class="">
    <!-- <div class="row"> -->
      <div class="col-lg-6 product_div">
        <form action="<?= base_url() ?>user/update_products" onsubmit="return false;" method="post" class="service-form">
        <div class="panel panel-primary" data-collapsed="0">
          <div class="panel-body">
            <h5 class="card-title mb-0">Product
              <button type="button" class="btn btn-danger btn-sm btn-rounded alignToTitleOnPreview" name="button" onclick="removeProduct(this)">Remove this product</button>
              <a class="collapse-link pull-right" style="margin-right: 10px;" onclick="collapseDiv(
              this)" href="javascript:void(0);">
                  <i class="fa fa-chevron-up"></i>
              </a>
            </h5>
            <div class="collapse close-div" style="padding-top: 10px;">
              <div class="row no-margin">
                <input type="hidden" class="form-control" name="listing_id" value="<?php echo sanitizer($listing_details['id']); ?>">

                <div class="col-lg-1">
                  
                </div>
                <?php 
                for ($k=1; $k <= 5 ; $k++) {  ?>
                

                <div class="col-lg-2 p-0">
                  <div class="wrapper-image-preview">
                    <div class="box">
                      <div class="cross">
                        <a href="javascript:void(0);" class="cleartheimage product_cross_<?php echo $k;?>" data-dismiss="fileinput" onclick="clearNewImage(this.id);">
                          <i class="fas fa-window-close " ></i>
                        </a>
                        
                      </div>
                      <div class="js--image-preview product_bg_<?php echo $k;?>" ></div>
                      <div class="upload-options">
                        <label for="service-image-<?php echo $k;?>" class="btn product_label_<?php echo $k;?>"> <i class="entypo-camera"></i> <?php echo get_phrase('upload_service_image'); ?>   </label>
                        <input id="service-image-<?php echo $k;?>" style="visibility:hidden;" type="file" class="image-upload product_image_file_<?php echo $k;?>" name="new_product_image_<?php echo $k;?>" accept="image/*">
                        <input type="hidden" class="" name="old_product_images_<?php echo $k;?>" value="">
                      </div>
                    </div>
                  </div>
                </div>
                <?php }?>

              
              </div>
              <div class="row no-margin">
                <div class="col-lg-12">
                  <input type="hidden" name="new_product_id" value="0">
                  <div class="form-group">
                    <label for="name" class="control-label"><?php echo get_phrase('name'); ?></label>
                    <input type="text" class="form-control" name="new_product_name" id="name" placeholder="Provide Product Name" maxlength="22" required>
                  </div>
                    <div class="form-group">
                        <label for="category_id" class="control-label"><?php echo get_phrase('category'); ?></label>
                        <select class="form-control" name="new_category_id" id = "category_id" required>
                          <option value="">Choose Category</option>
                          <?php foreach ($inventory_categories as $inventory_category): ?>
                            <option value="<?php echo sanitizer($inventory_category['id']); ?>"><?php echo sanitizer($inventory_category['name']); ?></option>
                          <?php endforeach; ?>
                        </select>
                    </div>
                  <div class="form-row">
                      <div class="form-group col-md-6 price_input">
                        <label for="price" class="control-label"><?php echo get_phrase('price'); ?></label>
                        <input type="number" class="form-control" name="new_price" id="name" placeholder="Provide Product Price" min="0" required>
                      </div>
                      <div class="form-group col-md-6 per_input">
                        <label for="price" class="control-label">Per</label>
                        <input type="text" class="form-control" name="new_unit" id="unit" placeholder="kilogram/liter/dozen/piece">
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="price" class="control-label">Color</label>
                      <input type="text" class="form-control" name="new_color" id="color" placeholder="Provide Color"  required>
                  </div>

                  <div class="form-group ">
                    <label for="price" class="control-label">Brand</label>
                      <input type="text" class="form-control" name="new_brand" id="name" placeholder="Provide Brand"required>
                  </div>

                  <div class="form-group ">
                    <label for="price" class="control-label">Size Specification</label>
                      <input type="text" class="form-control" name="new_size_specification" id="name" placeholder="Size Specification" required>
                  </div>

                  <div class="form-group ">
                    <label for="price" class="control-label">Weight Specification</label>
                      <input type="number" class="form-control" name="new_weight_specification" id="name" placeholder="Weight Specification" required>
                  </div>

                  
                    <div class="form-group ">
                      <label for="details" class="control-label">Other Specification</label>
                      <textarea name="new_other_specification" id="details" class="form-control" rows="2" placeholder="Other Specification" maxlength="50" required></textarea>
                    </div>
                   
                
                  <!-- Assign name when the div appends -->
                   <div class="d-block">
                    <label>
                      <input type="radio" class="availability" name="" id="availability-1" value="1" checked="">&nbsp; <?php echo get_phrase('available'); ?>
                    </label>
                    <label>
                      <input type="radio" class="availability" name="" id="availability-2" value="0">&nbsp; <?php echo get_phrase('not_available'); ?>
                    </label>
                  </div>

                   <div class="d-block">
                      <label>
                          <input type="radio" class="featured" name="" id="is_featured-1" value="0" checked="">&nbsp; Not Featured
                      </label>
                      <label>
                          <input type="radio" class="featured" name="" id="is_featured-2" value="1">&nbsp; Featured
                      </label>
                  </div>


                </div>

                <div class="row">
                   <div class="col-md-12">
                      <input type="submit" class="btn btn-primary pull-right new-submit-button" onclick="abc(this.id)"  name="submit_update" value="Submit" >
                   </div>
                 </div>

                
              </div>
            </div>
          </div>
          


        </div>
      </form>
      </div> <!-- end card-->
    </div>
  </div>
</div>


<div id="service_parent_div" style="padding-top: 10px;">
  <!-- <div id = "service_div"> -->
    
      <div class="">
        <div class="row" id = "">
            <?php foreach ($new_products as $key => $new_product): ?>
              <div class="col-lg-6 product_div service_div">
                <form action="<?= base_url() ?>user/update_products" method="post" class="service-form">
                <div class="panel panel-primary" data-collapsed="0">
                  <div class="panel-body">
                    <h5 class="card-title mb-0">Product
                      <button type="button" class="btn btn-danger btn-sm btn-rounded alignToTitleOnPreview" name="button" id = "<?php echo $new_product['id']; ?>"  onclick="removefromDB(this,<?php echo $new_product['id']; ?>,'<?php echo base_url('User/deleteProductData')?>')">Remove this product</button>


                      <a class="collapse-link pull-right" style="margin-right: 10px;" onclick="collapseDiv(this)" href="javascript:void(0);">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    </h5>
                    <div class="collapse close-div" style="padding-top: 10px;">
                      <div class="row no-margin">
                        <input type="hidden" class="form-control" name="listing_id" value="<?php echo sanitizer($listing_details['id']); ?>">
                        <div class="col-lg-1">
                          
                        </div>
                        <?php 
                        for ($k=1; $k <= 5 ; $k++) {  ?>
                        
                        <?php 
                              if($k==1){ 

                                $image = $new_product['thumbnail'];

                              
                               } else{

                                  $image = $new_product['thumbnail_'.$k];
                               } 
                              ?>

                        <div class="col-lg-2 p-0">
                          <div class="wrapper-image-preview">
                            <div class="box">
                              <div class="cross">
                                <a href="javascript:void(0);" class="cleartheimage" onclick="clearImage('<?php echo $k;?>','<?php echo $new_product['id']; ?>');">
                                  <i class="fas fa-window-close " ></i>
                                </a>
                                
                              </div>
                              <div class="js--image-preview" id="product_bg_<?php echo $k;?>-<?php echo $new_product['id']; ?>" 
                                <?php if(!empty($image)){?>
                                style="background-image: url('<?php echo base_url('uploads/shop/').$image; ?>"
                              <?php }?>
                                ></div>
                              <div class="upload-options">
                                <label for="service-image-<?php echo $k;?>-<?php echo $new_product['id']; ?>" class="btn product_label_<?php echo $k;?>"> <i class="entypo-camera"></i> <?php echo get_phrase('upload_service_image'); ?>   </label>
                                <input id="service-image-<?php echo $k;?>-<?php echo $new_product['id']; ?>" style="visibility:hidden;" type="file" class="image-upload product_image_file_<?php echo $k;?>" name="new_product_image_<?php echo $k;?>" accept="image/*">
                                <input type="hidden" class="" name="old_product_images_<?php echo $k;?>" value="<?php echo $image; ?>">
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                      
                      </div>
                      <div class="row no-margin">
                        <div class="col-lg-12">
                          <input type="hidden" name="new_product_id" value="<?php echo $new_product['id']; ?>">
                          <div class="form-group">
                            <label for="name" class="control-label"><?php echo get_phrase('name'); ?></label>
                            <input type="text" class="form-control" name="new_product_name" id="name" placeholder="Provide Product Name" value="<?php echo $new_product['name']?>" maxlength="22" required>
                          </div>
                            <div class="form-group">
                                <label for="category_id" class="control-label"><?php echo get_phrase('category'); ?></label>
                                <select class="form-control" name="new_category_id" id = "category_id" required>
                                  <option value="">Choose Category</option>
                                  <?php foreach ($inventory_categories as $inventory_category): ?>
                                    <option value="<?php echo sanitizer($inventory_category['id']); ?>" <?php if($new_product['category_id'] == $inventory_category['id']){ echo "selected";}?> ><?php echo sanitizer($inventory_category['name']); ?></option>
                                  <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-row">
                              <div class="form-group col-md-6 price_input">
                                  <label for="price" class="control-label"><?php echo get_phrase('price'); ?></label>
                                  <input type="number" class="form-control" name="new_price" id="name" placeholder="Provide Product Price" value="<?php echo $new_product['price']?>" min="0" required>
                              </div>
                              <div class="form-group col-md-6 per_input">        
                              <!-- <div class="col-md-6"> -->
                                <label for="price" class="control-label">Per</label>
                                <input type="text" class="form-control" name="new_unit" value="<?php echo $new_product['unit']?>" id="unit" placeholder="kilogram/liter/dozen/piece">
                              </div>
                            </div>
                          
                          <div class="form-group ">
                            <label for="price" class="control-label">Color</label>
                              <input type="text" class="form-control" name="new_color" id="color" placeholder="Provide Color"  value="<?php echo $new_product['color']?>" required>
                          </div>

                          <div class="form-group ">
                            <label for="price" class="control-label">Brand</label>
                              <input type="text" class="form-control" name="new_brand" id="name" value="<?php echo $new_product['brand']?>" placeholder="Provide Brand"required>
                          </div>

                          <div class="form-group ">
                            <label for="price" class="control-label">Size Specification</label>
                              <input type="text" class="form-control" name="new_size_specification" value="<?php echo $new_product['size_specification']?>" id="name" placeholder="Size Specification" required>
                          </div>

                          <div class="form-group ">
                            <label for="price" class="control-label">Weight Specification</label>
                              <input type="number" class="form-control" name="new_weight_specification" value="<?php echo $new_product['weight_specification']?>" id="name" placeholder="Weight Specification" value="<?php echo $new_product['weight_specification']?>"  required>
                          </div>

                          
                            <div class="form-group ">
                              <label for="details" class="control-label">Other Specification</label>
                              <textarea name="new_other_specification" id="details" class="form-control" rows="2" placeholder="Other Specification" maxlength="50" required><?php echo $new_product['details']?></textarea>
                            </div>
                           
                        
                          <!-- Assign name when the div appends -->
                           <div class="d-block">
                            <label>
                              <input type="radio" class="availability" name="availability[<?php echo $new_product['id']?>]" id="availability-1" value="1" <?php if($new_product['availability']=="1"){echo 'checked';} ?>>&nbsp; <?php echo get_phrase('available'); ?>
                            </label>
                            <label>
                              <input type="radio" class="availability" name="availability[<?php echo $new_product['id']?>]" id="availability-2" value="0" <?php if($new_product['availability']=="0"){echo 'checked';} ?>>&nbsp; <?php echo get_phrase('not_available'); ?>
                            </label>
                          </div>

                           <div class="d-block">
                              <label>
                                  <input type="radio" class="featured" name="is_featured[<?php echo $new_product['id']?>]" id="is_featured-1" value="0" <?php if($new_product['is_featured']=="0"){echo 'checked';} ?>>&nbsp; Not Featured
                              </label>
                              <label>
                                  <input type="radio" class="featured" name="is_featured[<?php echo $new_product['id']?>]" id="is_featured-2" value="1" <?php if($new_product['is_featured']=="1"){echo 'checked';} ?>>&nbsp; Featured
                              </label>
                          </div>

                           
                        </div>

                        <div class="row">
                             <div class="col-md-12">
                                <input type="submit" class="btn btn-primary pull-right submit-button" name="submit_update" value="Submit" >
                             </div>
                           </div>

                        
                      </div>
                    </div>
                  </div>
                </div>
               
              </form>
              </div> <!-- end card-->
            <?php endforeach; ?>
          </div>
        </div>
      
    
  <!-- </div> -->

  
</div>






<script type="text/javascript">

  $('.image-upload').click(function(){
    initImagePreviewer();
  });

  function clearImage(k,product_id){

    var remove_bg = 'product_bg_'+k+'-'+product_id;
  
    $('#'+remove_bg).css('background-image','none');

    var image = 'service-image-'+k+'-'+product_id;
   
    $('#'+image).val('');
  }

  function clearNewImage(id){

    var file_id = 'product_bg_'+id;
  
    $('#'+file_id).css('background-image','none');

    var image = 'service-image-'+id;

    $('#'+image).val('');
  
  }

  $('.close-div').show();

  function abc(id){
   
    var frmdata = new FormData(document.getElementById('form-'+id));
      
        jQuery.ajax({
                type: "POST",
                url: '<?php echo base_url('user/update_products');?>', 
                data: frmdata,
                processData: false,
                cache:false,
                contentType: false,
                beforeSend: function () {

                    $("#"+id).attr("disabled", true);
                    jQuery('#'+id).val('Processing...');
                },
                complete: function () {

                    
                    jQuery('#'+id).val('Submitted');
                },
                success:function(data){
                

                  if(data != '' ){

                    swal("Success!", "Data has been added.", "success");
                  }

                  
              }
            });

  }

  $('.service-form').submit(function(e){

   
    e.preventDefault(); //to prevent the page redirection
       // var frmdata = jQuery(e.target);        
   
        var frmdata = new FormData(this);
      
        jQuery.ajax({
                type: "POST",
                url: $(this).attr("action"), 
                data: frmdata,
                processData: false,
                cache:false,
                contentType: false,
                beforeSend: function () {

                    $(".submit-button").attr("disabled", true);
                    jQuery('.submit-button').val('Processing...');
                },
                complete: function () {

                    $(".submit-button").attr("disabled", false);
                    
                    jQuery('.submit-button').val('Submit');
                },
                success:function(data){
                // alert(data);
                  if(data != ''){

                    swal("Success!", "Data has been updated.", "success");
                    // success_notify('Data has been updated.');
                  }

                 
              }
            });

    });





  function collapseDiv(val){

    
      var ibox = $(val).closest('div.panel-body');
       // console.log(ibox);
      var button = $(val).find('i');
       var content = ibox.children('.close-div');
     
        content.slideToggle(200);
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        ibox.toggleClass('').toggleClass('border-bottom');
         setTimeout(function () {
         ibox.resize();
         ibox.find('[id^=map-]').resize();
           }, 50);

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
  });

 
  function appendProduct() {
      console.log("Hello")
      jQuery('#product_div').append(blank_menu_div);
      let selector = jQuery('#product_div .product_div');

      let rand = Math.random().toString(36).slice(3);

      console.log("Hello1")
       for (var k=1; k <= 5 ; k++) { 

        $(selector[selector.length - 1]).find('label.product_label_'+k).attr('for', 'service-image-'+k+'-'+ rand);
        $(selector[selector.length - 1]).find('input.product_image_file_'+k).attr('id', 'service-image-'+k+'-' + rand);

        $(selector[selector.length - 1]).find('a.product_cross_'+k).attr('id', k+'-' + rand);

        $(selector[selector.length - 1]).find('.product_bg_'+k).attr('id', 'product_bg_'+k+'-' + rand);
       }

       $(selector[selector.length - 1]).find('input.availability').attr('name', 'availability['+ rand+']');

        $(selector[selector.length - 1]).find('input.featured').attr('name', 'is_featured['+ rand+']');

        $(selector[selector.length - 1]).find('form').attr('id', 'form-'+rand);
         $(selector[selector.length - 1]).find('input.new-submit-button').attr('id', rand);


      $(".bootstrap-tag-input").tagsinput('items');
      initImagePreviewer();
      console.log("Hello3")
  }

  function removeProduct(elem) {
    var toDelete = elem;
      // jQuery(elem).closest('.product_div').remove();
      // $(".bootstrap-tag-input").tagsinput('items');
      swal({
          title: "Are you sure?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete!",
          cancelButtonText: "No, cancel please!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(elem) {
          console.log(elem,'Hello');
          if (elem == true ) {
            jQuery(toDelete).closest('#product_div').remove();
            $(".bootstrap-tag-input").tagsinput('items');
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
            window.location.reload();
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
  }


  function appendCategory() {
    console.log("Hello");
    jQuery('#category_area').append(blank_category);
  }

  function removeCategory(categoryElem) {

    jQuery(categoryElem).closest('.appendedCategoryFields').remove();
  }


</script>
