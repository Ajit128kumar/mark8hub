<?php 



  // $new_services = $this->db->get_where('service', array('listing_id' => $listing_details['id']))->like('name', $keyword,'after')->result_array();

  $this->db->select('*')->from('service')->where(array('listing_id' => $listing_details['id']))->order_by('id','DESC');

  if(!empty($keyword)){
    $this->db->like('name', $keyword,'after');
  }
  $query = $this->db->get();

  $new_services = $query->result_array();
// }
// else{
//   $new_services = $this->db->get_where('service', array('listing_id' => $listing_details['id']))->result_array();
// }


// $new_services = array();
// echo $listing_details['id'];die();
// echo '<pre>';
// print_r($new_services);
// echo '</pre>';die();

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
  .time-before{
    padding:0px !important;
  }
  .before_time_input{
    width:100% !important;
  }
  .time-after{
    padding:0px !important;
  }
  .after_time_input{
    width:100% !important;
  }

</style>




<div class="row">
  <div class="col-md-12">
    <?php if($listing_details['type'] == 2 || $listing_details['type'] == 3){?>
      <div class="row pull-right" style="margin-bottom: 5px;">
        <button type="button" class="btn btn-primary" name="button" onclick="appendService()"> <i class="mdi mdi-plus"></i> Add new services</button>
      </div>
    <?php } else{?>
      <h2 style="color: red">You can not add more services in this directory because you're business type is  <?php echo getBusinessTypeName($listing_details['type'])?>.</h2>
    <?php }?>
  </div>
  
</div>

<div id="service_div">
              
</div>
<div id = "blank_service_div" style="visibility: hidden;position: absolute;">
  <div class="">
    <!-- <div class="row"> -->
      <div class="col-lg-6 service_div">

        <form action="<?= base_url() ?>user/update_service" onsubmit="return false;" method="post" class="service-form">
        <div class="panel panel-primary" data-collapsed="0">

          <div class="panel-body">
          
            <h5 class="card-title mb-0">Service
              <button type="button" class="btn btn-danger btn-sm btn-rounded alignToTitleOnPreview" name="button" onclick="removeService(this)">Remove this service</button>


              
              <a class="collapse-link pull-right" style="margin-right: 10px;" onclick="collapseDiv(
              this)" href="javascript:void(0);">
                  <i class="fa fa-chevron-up"></i>
              </a>

            </h5>
            <div class="collapse close-div" style="padding-top: 10px;">
              <div class="row no-margin">
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
                      <div class="js--image-preview product_bg_<?php echo $k;?>"" ></div>
                      <div class="upload-options">
                        <label for="service-image-<?php echo $k;?>" class="btn label_<?php echo $k;?>"> <i class="entypo-camera"></i> <?php echo get_phrase('upload_service_image'); ?>   </label>
                        <input id="service-image-<?php echo $k;?>" style="visibility:hidden;" type="file" class="image-upload image_file_<?php echo $k;?>" name="new_service_image_<?php echo $k;?>" accept="image/*">
                        <input type="hidden" class="" name="old_service_images_<?php echo $k;?>" value="">
                      </div>
                    </div>
                  </div>
                </div>
                <?php }?>

              
              </div>
              <div class="row no-margin">
                <div class="col-lg-12">
                  <input type="hidden" name="new_service_id" value="0">
                  <input type="hidden" name="listing_id" value="<?php echo $listing_details['id'];?>">
                  <div class="form-group">
                    <label for="service_name"><?php echo get_phrase('service_name'); ?></label>
                    <input type="text" required name="new_service_name" class="form-control" />
                  </div>
                    <div class="form-group">
                        <label for="service_name">Service Description</label>
                        <input id="new_description" required type="text" name="new_description" class="form-control" />
                    </div>

                  <div class="row">
                    <div class="col-12"><label><?php echo get_phrase('service_time'); ?></label></div>
                    <div class="form-group  mb-2 col-md-5 time-before">
                      <div class="input-group before_time_input">
                          <input type="time" required name="new_starting_time" class="form-control timepicker">
                          <div class="input-group-append">
                              <span class="input-group-text"><i class="dripicons-clock"></i></span>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-2  mb-2 text-center pt-1"><?php echo get_phrase('to'); ?></div>
                    <div class="form-group  mb-2 col-md-5 time_after">
                      <div class="input-group after_time_input">
                          <input type="time" required name="new_ending_time" class="form-control timepicker">
                          <div class="input-group-append">
                              <span class="input-group-text"><i class="dripicons-clock"></i></span>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group  mb-2">
                    <label><?php echo get_phrase('service_duration'); ?></label>
                    <div class="input-group before_time_input">
                        <input type="number" required name="new_duration" placeholder="Minute" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="service_price"><?php echo get_phrase('service_price').' ('.currency_code_and_symbol().')'; ?></label>
                    <input type="text" required name="new_service_price" class="form-control" />
                  </div>
                    <div class="form-group">
                        <label>Is price Negotiable ?</label>
                        <div class="input-group">
                            <select class="form-control" required name="new_negotiable">
                                <option value=""></option>
                                <option value="Negotiable">Negotiable</option>
                                <option value="Fixed">Fixed</option>
                            </select>

                        </div>
                    </div>

                    <div class="d-block">
                      <label>
                          <input type="radio" class="featured" name="is_featured[abc]" id="is_featured-1" value="0" checked="">&nbsp; Not Featured
                      </label>
                      <label>
                          <input type="radio" class="featured" name="is_featured[abc]" id="is_featured-2" value="1">&nbsp; Featured
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
          </form>
          </div>
        </div>
      </div> <!-- end card-->
  </div>
</div>


<div id="service_parent_div" style="padding-top: 10px;">

  <div id = "">
      <div class="">
        <div class="row" > 

            
            <?php foreach ($new_services as $key => $new_service): ?>
              <div class="col-lg-6 service_div">

                <form action="<?= base_url() ?>user/update_service" method="post" class="service-form">
                <div class="panel panel-primary" data-collapsed="0">
                  <div class="panel-body">
                    <h5 class="card-title mb-0">Services
                      <?php if ($key > 0 ): ?>
                        <button type="button" class="btn btn-danger btn-sm btn-rounded alignToTitleOnPreview" name="button" id = "<?php echo $new_service['id']; ?>" onclick="removefromDB(this,<?php echo $new_service['id']; ?>,'<?php echo base_url('User/deleteServiceData')?>')">Remove this service</button>
                      <?php endif; ?>

                      <a class="collapse-link pull-right" onclick="collapseDiv(
              this)" href="javascript:void(0);" style="margin-right: 10px;">
                          <i class="fa fa-chevron-up"></i>
                      </a>
                      
                    </h5>
                    <input type="hidden" name="listing_id" value="<?php echo $listing_details['id'];?>">
                    <div class="collapse close-div" style="padding-top: 10px;">

                      <div class="row no-margin">
                        <div class="col-lg-1">
                          
                        </div>
                        <?php 
                        for ($i=1; $i <= 5 ; $i++) {  ?>

                          <?php 
                              if($i==1){ 

                                $image = $new_service['photo'];

                              
                               } else{

                                  $image = $new_service['photo_'.$i];
                               } 
                              ?>

                              <div class="col-lg-2 p-0">
                                    <div class="wrapper-image-preview">
                                      <div class="box">

                                        <div class="cross">
                                          <a href="javascript:void(0);" class="cleartheimage" onclick="clearImage('<?php echo $k;?>','<?php echo $new_service['id']; ?>');">
                                            <i class="fas fa-window-close " ></i>
                                          </a>
                                          
                                        </div>

                                        <div class="js--image-preview" id="product_bg_<?php echo $k;?>-<?php echo $new_service['id']; ?>"
                                        style="background-image: url('<?php echo base_url('uploads/service_images/').$image; ?>')"></div>

                                        <div class="upload-options">
                                          <label for="service-image-<?php echo $i;?>-<?php echo $new_service['id']; ?>" class="btn"> <i class="entypo-camera"></i> <?php echo get_phrase('upload_service_image'); ?>   </label>

                                          <input id="service-image-<?php echo $i;?>-<?php echo $new_service['id']; ?>" style="visibility:hidden;" type="file" class="image-upload" name="new_service_image_<?php echo $i?>" accept="image/*">

                                          <input type="hidden" class="" name="old_service_images_<?php echo $i?>" value="<?php echo $image; ?>">
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                          
                      
                       <?php  } ?>

                       
                      </div>
                      <div class="row no-margin">
                        <div class="col-lg-12">
                          <input type="hidden" name="new_service_id" value="<?php echo $new_service['id']; ?>">
                          <div class="form-group">
                            <label for="service_name"><?php echo get_phrase('service_name'); ?></label>
                            <input type="text" name="new_service_name" required class="form-control" value="<?php echo $new_service['name']; ?>" />
                          </div>
                            <div class="form-group">
                                <label for="service_name">Service Description</label>
                                <input type="text" required name="new_description" class="form-control" value="<?php echo $new_service['description']; ?>" />
                            </div>

                          <?php $times = explode(',', $new_service['service_times']); ?>
                          <div class="form-row">
                            <div class="form-group col-12"><label class="service_time"><?php echo get_phrase('service_time'); ?></label></div>
                            <div class="form-group  mb-2 col-md-5 time-before">
                              <div class="input-group before_time_input">
                                  <input type="time" id = "service_time_from_<?php echo $new_service['id']; ?>" onchange = "checkServiceTimeRange('<?php echo $new_service['id']; ?>')" value="<?php echo $times[0]; ?>" name="new_starting_time" class="form-control" required>
                                  <div class="input-group-append">
                                      <span class="input-group-text"><i class="dripicons-clock"></i></span>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-2  mb-2 text-center pt-1"><?php echo get_phrase('to'); ?></div>
                            <div class="form-group  mb-2 col-md-5 time-after">
                              <div class="input-group after_time_input">
                                  <input type="time" id = "service_time_to_<?php echo $new_service['id']; ?>" value="<?php echo $times[1]; ?>" name="new_ending_time" class="form-control" onchange = "checkServiceTimeRange('<?php echo $new_service['id']; ?>')" required>
                                  <div class="input-group-append">
                                      <span class="input-group-text"><i class="dripicons-clock"></i></span>
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-group  mb-2">
                            <label><?php echo get_phrase('service_duration'); ?></label>
                            <div class="input-group before_time_input">
                                <input type="number" value="<?php echo $times[2]; ?>" name="new_duration" placeholder="Minute" class="form-control" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="service_price"><?php echo get_phrase('service_price').' ('.currency_code_and_symbol().')'; ?></label>
                            <input type="text" name="new_service_price" class="form-control" value="<?php echo $new_service['price']; ?>" />
                          </div>
                            <div class="form-group">
                                <label>Is price Negotiable ?</label>
                                <div class="input-group">
                                    <select class="form-control" name="new_negotiable">
                                        <option value=""></option>
                                        <option <?php if($new_service['negotiable']=="Negotiable"){echo 'selected="selected"';} ?> value="Negotiable">Negotiable</option>
                                        <option <?php if($new_service['negotiable']=="Fixed"){echo 'selected="selected"';} ?> value="Fixed">Fixed</option>
                                    </select>

                                </div>
                            </div>

                            <div class="d-block">
                              <label>
                                  <input type="radio" class="featured" name="is_featured[<?php echo $new_service['id']?>]" id="is_featured-1" value="0" <?php if($new_service['is_featured']=="0"){echo 'checked';} ?>>&nbsp; Not Featured
                              </label>
                              <label>
                                  <input type="radio" class="featured" name="is_featured[<?php echo $new_service['id']?>]" id="is_featured-2" value="1" <?php if($new_service['is_featured']=="1"){echo 'checked';} ?>>&nbsp; Featured
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
  </div>

  
</div>



<script type="text/javascript">

   $('.image-upload').click(function(){
    initImagePreviewer();
  });

  function clearImage(k,product_id){

    alert(k);
    alert(product_id);
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
    // var frmdata = new FormData($('form-'+id));
      
        jQuery.ajax({
                type: "POST",
                url: '<?php echo base_url('user/update_service');?>', 
                data: frmdata,
                processData: false,
                cache:false,
                contentType: false,
                beforeSend: function () {

                    $("#"+id).attr("disabled", true);
                    jQuery('#'+id).val('Processing...');
                },
                complete: function () {

                    // $(".new-submit-button").attr("disabled", false);
                    
                    jQuery('#'+id).val('Submitted');
                },
                success:function(data){
                // alert(data);
                  // console.log(data);     

                  if(data !=''){

                    swal("Success!", "Data has been added.", "success");
                  }

                  // if(data = 'insert'){

                  //   appendService();
                  // }    
                    
              }
            });

  }

  $('.service-form').submit(function(e){

    // alert();
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
                
                  if(data !=''){

                    swal("Success!", "Data has been updated.", "success");
                  }

                  // if(data = 'insert'){

                  //   appendService();
                  // }    
                    
              }
            });

    });

//   $('#new-service-form').submit(function(evt){
// // alert();
//     evt.preventDefault(); //to prevent the page redirection
//        // var frmdata = jQuery(e.target);        
   
//         var frmdata = new FormData(this);
      
//         jQuery.ajax({
//                 type: "POST",
//                 url: $(this).attr("action"), 
//                 data: frmdata,
//                 processData: false,
//                 cache:false,
//                 contentType: false,
//                 beforeSend: function () {

//                     $(".new-submit-button").attr("disabled", true);
//                     jQuery('.new-submit-button').val('Processing...');
//                 },
//                 complete: function () {

//                     $(".new-submit-button").attr("disabled", false);
                    
//                     jQuery('.new-submit-button').val('Submit');
//                 },
//                 success:function(data){
                
//                 // appendService();
//                   console.log(data);         
                    
//               }
//             });

//     });

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

    $('#blank_category_field').hide();
    $('#blank_photo_uploader').hide();
      //new
      $('#blank_brand_uploader').hide();
      //new ends
    $('#blank_special_offer_div').hide();
    $('#blank_food_menu_div').hide();
    $('#blank_beauty_service_div').hide();
    $('#blank_hotel_room_specification_div').hide();
  
    var blank_category = $('#blank_category_field').html();
      var blank_photo_uploader = $('#blank_photo_uploader').html();
      //new
      var blank_brand_uploader = $('#blank_brand_uploader').html();
      //new ends
      var blank_special_offer_div = $('#blank_special_offer_div').html();
      var blank_food_menu_div = $('#blank_food_menu_div').html();
      var blank_menu_div = $('#blank_service_div').html();
      var blank_beauty_service_div = $('#blank_beauty_service_div').html();
      var blank_hotel_room_specification_div = $('#blank_hotel_room_specification_div').html();
      var listing_type_value = $('.listing-type-radio').val();

     function appendService() {
      
        jQuery('#service_div').append(blank_menu_div);
        let selector = jQuery('#service_div .service_div');

        let rand = Math.random().toString(36).slice(3);

        
         for (var k=1; k <= 5 ; k++) { 

          $(selector[selector.length - 1]).find('label.label_'+k).attr('for', 'service-image-'+k+'-'+ rand);
          $(selector[selector.length - 1]).find('input.image_file_'+k).attr('id', 'service-image-'+k+'-' + rand);

          $(selector[selector.length - 1]).find('a.product_cross_'+k).attr('id', k+'-' + rand);

          $(selector[selector.length - 1]).find('.product_bg_'+k).attr('id', 'product_bg_'+k+'-' + rand);

          $(selector[selector.length - 1]).find('input.featured').attr('name', 'is_featured['+ rand+']');
         }

         $(selector[selector.length - 1]).find('form').attr('id', 'form-'+rand);
         $(selector[selector.length - 1]).find('input.new-submit-button').attr('id', rand);

        $(".bootstrap-tag-input").tagsinput('items');
        initImagePreviewer();
    }

    function removeService(elem) {
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
            jQuery(elem).closest('.service_div').remove();
        $(".bootstrap-tag-input").tagsinput('items');
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
            window.location.reload();
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
    }


</script>
