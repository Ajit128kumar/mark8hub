<!--  -->

<?php 

// $new_branches = $this->db->get_where('business_branch', array('listing_id' => $listing_details['id']))->result_array();


$this->db->select('*')->from('business_branch')->where(array('listing_id' => $listing_details['id']))->order_by('id','DESC');

  if(!empty($keyword)){
    $this->db->like('branchName', $keyword,'after');
  }
  $query = $this->db->get();

  $new_branches = $query->result_array();

// $new_products = array();
// echo $listing_details['id'];die();
// echo '<pre>';
// print_r($new_products);
// exit();
// echo '</pre>';die();

?>

<style type="text/css">
  
  .box{
    height: 120px;
    margin: 10px 5px;
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
  .margin-adjust-button{
        margin-bottom: 10px !important;
  }
  .margin-adjust-label{
        margin-top: 10px !important;
  }

</style>
<!-- <div id="services_parent_div" style="padding-top: 10px;"> -->
  <!-- <div id = "service_div"> -->
    

    <div class="row">
      <div class="col-md-12">
           <div class="row text-center margin-adjust-button pull-right">
              <button type="button" class="btn btn-primary" name="button" onclick="appendBranch()"> <i class="mdi mdi-plus"></i> Add new branch</button>
          </div>
      </div>
      
    </div>

   
   

    <div id="service_div">
              
    </div>

    <div id = "blank_branch_div" style="visibility: hidden;position: absolute;"> 
        <div class="col-lg-6 service_div">
          <form action="<?= base_url() ?>user/update_branch" onsubmit="return false;" method="post" class="service-form">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">
                    <h5 class="card-title mb-0">Branch
                        <button type="button" class="btn btn-danger btn-sm btn-rounded alignToTitleOnPreview margin-adjust-button removeBtn" name="button" id = "">Remove this branch</button>

                        <a class="collapse-link pull-right" style="margin-right: 10px;" onclick="collapseDiv(this)" href="javascript:void(0);">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </h5>  
                    <input type="hidden" name="new_branch_id" value="0">
                    <input type="hidden" name="listing_id" value="<?php echo $listing_details['id'];?>">
                    <div class="collapse close-div">
                        <div class="form-group">
                            <label for="business_name" class="col-sm-3 control-label margin-adjust-label"><?php echo get_phrase('business name'); ?> <span style="color:red;">*</span></label>
                            <div class="col-sm-7">
                                <input class="form-control" required type="text" id="business_name" name="business_name">
                            </div>
                        </div> 
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="contact_no" class="col-sm-3 control-label margin-adjust-label"><?php echo get_phrase('contact number'); ?> <span style="color:red;">*</span></label>
                            <div class="col-sm-7">
                                <input class="form-control" required type="text" id="contact_no" name="contact_no">
                            </div>
                        </div> 
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label margin-adjust-label"><?php echo get_phrase('email'); ?> <span style="color:red;">*</span></label>
                            <div class="col-sm-7">
                                <input class="form-control" required type="email" id="email" name="email">
                            </div>
                        </div> 
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="address"><?php echo get_phrase('address'); ?></label>
                            <div class="col-sm-7">
                                <textarea name="address"  rows="5" class="form-control" id = "address"></textarea>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="latitude"><?php echo get_phrase('latitude'); ?> <span style="color:red;">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" required class="form-control" id="latitude" name="latitude" oninput="getlatitude(this.id)" placeholder="<?php echo get_phrase('you_can_provide_latitude_for_getting_the_exact_result'); ?>">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 control-label" for="longitude"><?php echo get_phrase('longitude'); ?> <span style="color:red;">*</span></label>
                            <div class="col-md-7">
                                <input type="text" required class="form-control" id="longitude" name="longitude" oninput="getlongitude(this.id)"  placeholder="<?php echo get_phrase('you_can_provide_longitude_for_getting_the_exact_result'); ?>">
                            </div>
                        </div>
                        <div id="map" style="height: 300px;" ></div>    
                        <br>
                        <div class="row">
                             <div class="col-md-12">
                                <input type="submit" class="btn btn-primary pull-right new-submit-button" onclick="abc(this.id)"  name="submit_update" value="Submit" >
                             </div>
                        </div>   
                    </div> 
                </div>
            </div>
          </form>
        </div> <!-- end card-->
    </div> 

     <div class="">
            <div class="row" id = "">   

            <?php foreach ($new_branches as $key => $new_branch): ?>    
                <div class="col-lg-6 service_div">
                 <form action="<?= base_url() ?>user/update_branch" method="post" class="service-form"> 
                    <input type="hidden" name="new_branch_id" value="<?php echo $new_branch['id']?>">
                    <input type="hidden" name="listing_id" value="<?php echo $listing_details['id'];?>">
                    <div class="panel panel-primary" data-collapsed="0">
                        <div class="panel-body">
                            <h5 class="card-title mb-0">Branch
                                <?php if ($key > 0 ): ?>

                                    <button type="button" class="btn btn-danger btn-sm btn-rounded alignToTitleOnPreview margin-adjust-button" name="button" id = "<?php echo $new_branch['id']; ?>" onclick="removefromDB(this,<?php echo $new_branch['id']; ?>,'<?php echo base_url('User/deleteBranchData')?>')">Remove this branch</button>

                                <?php endif; ?>

                                  <a class="collapse-link pull-right" style="margin-right: 10px;" onclick="collapseDiv(this)" href="javascript:void(0);">
                                      <i class="fa fa-chevron-up"></i>
                                  </a>
                            </h5>  

                            <div class="collapse close-div">
                                <div class="form-group">
                                  <label for="business_name" class="col-sm-4 control-label margin-adjust-label"><?php echo get_phrase('business name'); ?> <span style="color:red;">*</span></label>
                                  <div class="col-sm-7">
                                      <input class="form-control" required type="text" id="business_name" name="business_name" value="<?php echo $new_branch['branchName']?>">
                                  </div>
                              </div> 
                              <div class="clearfix"></div>
                              <div class="form-group">
                                  <label for="contact_no" class="col-sm-4 control-label margin-adjust-label"><?php echo get_phrase('contact number'); ?> <span style="color:red;">*</span></label>
                                  <div class="col-sm-7">
                                      <input class="form-control" type="text" id="contact_no" name="contact_no" required value="<?php echo $new_branch['contactNumber']?>">
                                  </div>
                              </div> 
                              <div class="clearfix"></div>
                              <div class="form-group">
                                  <label for="email" class="col-sm-4 control-label margin-adjust-label"><?php echo get_phrase('email'); ?> <span style="color:red;">*</span></label>
                                  <div class="col-sm-7">
                                      <input class="form-control" required type="email" id="email" name="email" value="<?php echo $new_branch['email']?>">
                                  </div>
                              </div> 
                              <div class="clearfix"></div>
                              <div class="form-group">
                                  <label class="col-sm-4 control-label" for="address"><?php echo get_phrase('address'); ?></label>
                                  <div class="col-sm-7">
                                      <textarea name="address" rows="5" class="form-control" id = "address"><?php echo $new_branch['address']?></textarea>
                                  </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                  <label class="col-sm-4 control-label" for="latitude"><?php echo get_phrase('latitude'); ?> <span style="color:red;">*</span></label>
                                  <div class="col-sm-7">
                                      <input type="text" required class="form-control" id="latitude" name="latitude" placeholder="<?php echo get_phrase('you_can_provide_latitude_for_getting_the_exact_result'); ?>" value="<?php echo $new_branch['lat']?>">
                                  </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group row mb-3">
                                  <label class="col-sm-4 control-label" for="longitude"><?php echo get_phrase('longitude'); ?> <span style="color:red;">*</span></label>
                                  <div class="col-md-7">
                                      <input type="text" required class="form-control" id="longitude" name="longitude" placeholder="<?php echo get_phrase('you_can_provide_longitude_for_getting_the_exact_result'); ?>" value="<?php echo $new_branch['lon']?>">
                                  </div>
                              </div>

                              <div  id="map-<?php echo $new_branch['id'];?>" style="height: 300px;" ></div>    
                              <br>
                              <div class="row">
                                 <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary pull-right submit-button" name="submit_update" value="Submit" >
                                 </div>
                               </div> 
                            </div>
                        </div>
                    </div>
                 </form>   
                </div> <!-- end card-->


                <script type="text/javascript">
    
    lon = '<?php echo $new_branch['lon']?>';              
    lat = '<?php echo $new_branch['lat']?>';     
    // alert(lon);         
    // alert(lat);         
    var mapCenter = [lat , lon];
    var mapid = '<?php echo $new_branch['id'];?>';
    // alert(mapid);
    var map = L.map('map-'+mapid, {center : mapCenter, zoom : 12});

    $('#map-'+mapid+' .leaflet-map-pane').css(
      {
       'transform': 'translate3d(263px, 150px, 0px)',
       // 'position':'absolute',
       // 'left' : 0,
       // 'top': 0
      });

    <?php if(get_settings("active_map") == 'openstreetmap'): ?>
    //free maps
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}.png', {
        attribution: 'Select Your Place',
        minZoom: '<?= get_settings("min_zoom_level"); ?>',
        maxZoom: '<?= get_settings("max_zoom_level"); ?>',
    }).addTo(map);
    <?php else: ?>
    //paid maps
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Select Your Place',
        minZoom: '<?= get_settings("min_zoom_level"); ?>',
        maxZoom: '<?= get_settings("max_zoom_level"); ?>',
        id: 'mapbox/streets-v11',
        style: 'mapbox://styles/mapbox/streets-v11',
        accessToken: '<?= get_settings("map_access_token"); ?>'

    }).addTo(map);
    <?php endif; ?>

    $(document).ready(function() {
        // setTimeout(() => {
        //     map.invalidateSize();
        // }, 0);

        setTimeout(function () {
         map.invalidateSize();
      }, 0);
    });



    var marker = L.marker(mapCenter).addTo(map);
    var updateMarker = function(lat, lng) {
        marker
            .setLatLng([lat, lng])
            .bindPopup("Your location :  " + marker.getLatLng().toString())
            .openPopup();
        return false;
    };

    // map.on('click', function(e) {
    //     $('#latitude').val(e.latlng.lat);
    //     $('#longitude').val(e.latlng.lng);
    //     updateMarker(e.latlng.lat, e.latlng.lng);
    // });




    // var updateMarkerByInputs = function() {
    //     return updateMarker( $('#latitude').val() , $('#longitude').val());
    // }
    // $('#latitude').on('input', updateMarkerByInputs);
    // $('#longitude').on('input', updateMarkerByInputs);
                </script>
                
            <?php endforeach;?>
            </div> 
    </div>  



<script type="text/javascript">
  
 
</script>



<script type="text/javascript">


    $('.close-div').show();


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

  function abc(id){
   
    var frmdata = new FormData(document.getElementById('form-'+id));
    // var frmdata = new FormData($('form-'+id));
      
        jQuery.ajax({
                type: "POST",
                url: '<?php echo base_url('user/update_branch');?>', 
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
                  // alert(data);  

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
    showListingTypeForm('<?php echo $listing_details['listing_type']; ?>');
  });

  var blank_branch_div = $('#blank_branch_div').html();
    
  function appendBranch() {
    jQuery('#service_div').append(blank_branch_div);

    let selector = jQuery('#service_div .service_div');

    let rand = Math.random().toString(36).slice(3);    

     $(selector[selector.length - 1]).find('form').attr('id', 'form-'+rand);
     $(selector[selector.length - 1]).find('[id^=latitude]').attr('id', 'latitude-'+rand);
     $(selector[selector.length - 1]).find('[id^=longitude]').attr('id', 'longitude-'+rand);
     $(selector[selector.length - 1]).find('input.new-submit-button').attr('id', rand);
     $(selector[selector.length - 1]).find('[id^=map]').attr('id', 'map-'+rand);



    //  var mapCenter = [26.447580603070755, 87.27111789634328];
    // var map = L.map('map-'+rand, {center : mapCenter, zoom : 12});

    // <?php if(get_settings("active_map") == 'openstreetmap'): ?>
    // //free maps
    // L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}.png', {
    //     attribution: 'Select Your Place',
    //     minZoom: '<?= get_settings("min_zoom_level"); ?>',
    //     maxZoom: '<?= get_settings("max_zoom_level"); ?>',
    // }).addTo(map);
    // <?php else: ?>
    // //paid maps
    // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    //     attribution: 'Select Your Place',
    //     minZoom: '<?= get_settings("min_zoom_level"); ?>',
    //     maxZoom: '<?= get_settings("max_zoom_level"); ?>',
    //     id: 'mapbox/streets-v11',
    //     style: 'mapbox://styles/mapbox/streets-v11',
    //     accessToken: '<?= get_settings("map_access_token"); ?>'

    // }).addTo(map);
    // <?php endif; ?>

    // $(document).ready(function() {
    //     setTimeout(() => {
    //         map.invalidateSize();
    //     }, 0);
    // });
    // var marker = L.marker(mapCenter).addTo(map);
  }

   // var marker = L.marker(mapCenter).addTo(map);
    var updateMarker = function(lat, lng,randomNumber) {
      // alert(lat);
      // alert(lng);
        // var map = L.map('map-'+randomNumber, {center : mapCenter, zoom : 12});
        // marker = L.marker(mapCenter).addTo('map-'+randomNumber);
        // marker
        //     .setLatLng([lat, lng])
        //     .bindPopup("Your location :  " + marker.getLatLng().toString())
        //     .openPopup();
        // return false;


       if(lat !='' && lng!=''){
          var mapCenter = [lat, lng];
          var map = L.map('map-'+randomNumber, {center : mapCenter, zoom : 12});

          <?php if(get_settings("active_map") == 'openstreetmap'): ?>
          //free maps
          L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}.png', {
              attribution: 'Select Your Place',
              minZoom: '<?= get_settings("min_zoom_level"); ?>',
              maxZoom: '<?= get_settings("max_zoom_level"); ?>',
          }).addTo(map);
          <?php else: ?>
          //paid maps
          L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
              attribution: 'Select Your Place',
              minZoom: '<?= get_settings("min_zoom_level"); ?>',
              maxZoom: '<?= get_settings("max_zoom_level"); ?>',
              id: 'mapbox/streets-v11',
              style: 'mapbox://styles/mapbox/streets-v11',
              accessToken: '<?= get_settings("map_access_token"); ?>'

          }).addTo(map);
          <?php endif; ?>

          $(document).ready(function() {
              setTimeout(() => {
                  map.invalidateSize();
              }, 0);
          });
          var marker = L.marker(mapCenter).addTo(map);
          marker
              .setLatLng([lat, lng])
              .bindPopup("Your location :  " + marker.getLatLng().toString())
              .openPopup();
          return false;
       }
    };





    // var updateMarkerByInputs = function() {
    //     return updateMarker( $('#latitude').val() , $('#longitude').val());
    // }
    // $('#latitude').on('input', updateMarkerByInputs);
    // $('#longitude').on('input', updateMarkerByInputs);
  function getlatlong(randomNumber){
    return updateMarker( $('#latitude-'+randomNumber).val() , $('#longitude-'+randomNumber).val(),randomNumber);
  }
  function getlatitude(e){

        var lat = e.split('-');
       var randomNumber = lat[1];

        getlatlong(randomNumber);
  };

  function getlongitude(e){

        var long = e.split('-');
       var randomNumber = long[1];

        getlatlong(randomNumber);
  };

  function removeBranch(elem) {
    jQuery(this).closest(".service_div").remove();
  }

  jQuery(document).ready(function(){
    $(document).on('click', '.removeBtn', function(){ 
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
          if (elem == true ) {
            jQuery(this).closest(".service_div").remove();
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
            window.location.reload();
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
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
