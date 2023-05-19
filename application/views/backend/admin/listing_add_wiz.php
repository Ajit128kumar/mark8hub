
<?php
$countries = $this->db->get('country')->result_array();
$categories = $this->db->get('category')->result_array();
error_reporting(E_ALL);
//new
$parent_id = $this->uri->segment(4);
$parent_name = '';
$excel_msg = '';
if (!empty($parent_id)) {
    $parent_listing = $this->crud_model->get_listings($parent_id)->row();
    if (!empty($parent_listing)) {
        $parent_name = '/ Branch of ' . $parent_listing->name;
        $excel_msg = 'Note: Upload the excel sheet for only branches of '.$parent_listing->name.'
        leaving category, business type and business group column empty from same format';
    }
}
//new ends

?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary" data-collapsed="0">
            
            <form class="form-horizotal" method="POST" action="
            <?php if(empty($parent_listing)){ ?>
            <?= base_url() ?>Admin/listingExcelUpload
           <?php }else{ ?>
          <?= base_url() ?>Admin/listingExcelUploadBranch
           <?php } ?>
        "enctype="multipart/form-data">
                <div class="table-responsive">
                    <table class="table table-borderless">
                    <tr>
                        <td class="text-center" >Bulk Data Upload</td>
                        <td>
                            <select name="country_id_excel" id="country_id_excel" class="select2"
                                    data-allow-clear="true"
                                    data-placeholder="<?php echo get_phrase('select_country'); ?>"
                                    onchange="getCityListExcel(this.value)">
                                <option value="0"><?php echo get_phrase('none'); ?></option>
                                <?php foreach ($countries as $country): ?>
                                    <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control select2" name="city_id_excel" id="city_id_excel">
                                <option value=""><?php echo get_phrase('select_city'); ?></option>
                            </select>
                        </td>
                        <td>
                            <input type="file" name="document" required>
                        </td>
                        <td>
                            <input type="hidden" name="parent_id" value="<?= $parent_id ?>"/>
                            <input type="submit" value="upload" name="upload_excel" class="btn btn-success">
                        </td>
                        <td>
                            <a href="<?= base_url() ?>uploads/uploadformat.xlsx" download="uploadSampleFormat"
                               class="btn btn-info"><i class="fa fa-download"> Download Sample</i></a>
                        </td>

                    </tr>
                    <tr>
                        <th colspan="10"><?= $excel_msg ?></th>
                    </tr>
                </table>
                </div>


            </form>
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('add_listing_form') . ' ' . $parent_name; ?>
                </div>

            </div>
            <div class="panel-body">

                <form action="<?php echo site_url('admin/listings/add'); ?>" method="post" enctype="multipart/form-data"
                      role="form" class="form-horizontal form-groups-bordered listing_add_form">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->

                            <li class="active">
                            <li>
                                <a href="#first" id="first_basic" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-home"></i></span>
                                    <span class="hidden-xs"><?php echo get_phrase('basic'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#second" id="second_location" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-location"></i></span>
                                    <span class="hidden-xs"><?php echo get_phrase('location'); ?></span>
                                </a>
                            </li>

                            <li>
                                <a href="#third" id="third_amenities" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-list"></i></span>
                                    <span class="hidden-xs"><?php echo get_phrase('amenities'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#fourth" id="fourth_media"  data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-video"></i></span>
                                    <span class="hidden-xs"><?php echo get_phrase('media'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#fifth" id="fifth_seo" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-cog"></i></span>
                                    <span class="hidden-xs"><?php echo 'SEO'; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#sixth"  id="sixth_schedule" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-cog"></i></span>
                                    <span class="hidden-xs"><?php echo get_phrase('schedule'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#seventh" id="seventh_contact" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-link"></i></span>
                                    <span class="hidden-xs"><?php echo get_phrase('contact'); ?></span>
                                </a>
                            </li>
                            <?php if (empty($parent_listing)) {
                            ?>
                            <!--<li>-->
                            <!--    <a href="#eighth" data-toggle="tab">-->
                            <!--        <span class="visible-xs"><i class="entypo-cog"></i></span>-->
                            <!--        <span class="hidden-xs"> <?php echo get_phrase('type'); ?></span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <?php } ?>
                            <!--<li class="services">-->
                            <!--    <a href="#services" data-toggle="tab">-->
                            <!--        <span class="visible-xs"><i class="entypo-cog"></i></span>-->
                            <!--        <span class="hidden-xs"> Services </span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--    <a href="#brand" data-toggle="tab">-->
                            <!--        <span class="visible-xs"><i class="entypo-cog"></i></span>-->
                            <!--        <span class="hidden-xs">Brands Associated</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <li>
                                <a href="#ninth" id="ninth_finish" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-check"></i></span>
                                    <span class="hidden-xs"><?php echo get_phrase('finish'); ?></span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

    
                            <div class="tab-pane active" id="first">
                                    <?php
    
                                    if (empty($parent_listing)) {
                                        include 'add_listing_basic.php';
                                    } else {
                                        include 'add_listing_basic_branch.php';
                                    }
                                    ?>

                            </div>
                            <div class="tab-pane " id="second">
                                    <?php include 'add_listing_location.php'; ?>

                            </div>                            
                            <div class="tab-pane" id="third">
                                    <?php include 'add_listing_amenity.php'; ?>
                                
                                
                                
                            </div>

                            <div class="tab-pane" id="fourth">
                                <?php include 'add_listing_media.php'; ?>
                            </div>

                            <div class="tab-pane" id="fifth">
                                <?php include 'add_listing_seo.php'; ?>
                            </div>
                            <div class="tab-pane" id="sixth">
                                <?php include 'add_listing_schedule.php'; ?>
                            </div>

                            <div class="tab-pane" id="seventh">
                                <?php include 'add_listing_contact.php'; ?>
                            </div>
                            <?php if (empty($parent_listing)) {
                                ?>
                                <div class="tab-pane" id="eighth">

                                    <?php include 'add_listing_type.php'; ?>
                                </div>
                            <?php } ?>
                            <div class="tab-pane" id="services">

                                <?php include 'add_listing_services.php'; ?>
                            </div>
                            <div class="tab-pane" id="brand">
                                <?php include 'add_brands.php'; ?>
                            </div>
                            <div class="tab-pane" id="ninth">
                                <?php include 'add_listing_finish.php'; ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="parent_id" value="<?= $parent_id ?>"/>
                </form>
            </div>
        </div>
    </div><!-- end col-->
</div>
<script type="text/javascript">
    function getCityListExcel(country_id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('home/get_city_list_by_country_id'); ?>',
            data: {country_id: country_id},
            success: function (response) {
                $('#city_id_excel').html(response);
            }
        });
    }

    function getCityList(country_id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('home/get_city_list_by_country_id'); ?>',
            data: {country_id: country_id},
            success: function (response) {
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
    var blank_beauty_menu_div = $('#blank_beauty_service_div').html();
    var blank_menu_div = $('#blank_service_div').html();

    var blank_hotel_room_specification_div = $('#blank_hotel_room_specification_div').html();
    var listing_type_value = $('.listing-type-radio').val();

    $(document).ready(function () {
        $('#blank_category_field').hide();
        $('#blank_photo_uploader').hide();
        //new
        $('#blank_brand_uploader').hide();
        //new ends
        $('#blank_special_offer_div').hide();
        $('#blank_food_menu_div').hide();
        $('#blank_beauty_service_div').hide();
        $('#blank_service_div').hide();
        $('#blank_hotel_room_specification_div').hide();
    });

    function appendHotelRoomSpecification() {

        jQuery('#hotel_room_specification_div').append(blank_hotel_room_specification_div);
        let selector = jQuery('#hotel_room_specification_div .hotel_room_specification_div');

        let rand = Math.random().toString(36).slice(3);

        $(selector[selector.length - 1]).find('label.btn').attr('for', 'room-image-' + rand);
        $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'room-image-' + rand);
        $(".bootstrap-tag-input").tagsinput('items');
        initImagePreviewer();
    }

    function removeHotelRoomSpecification(elem) {
        jQuery(elem).closest('.hotel_room_specification_div').remove();
        $(".bootstrap-tag-input").tagsinput('items');
    }

    function appendFoodMenu() {

        jQuery('#food_menu_div').append(blank_food_menu_div);
        let selector = jQuery('#food_menu_div .food_menu_div');

        let rand = Math.random().toString(36).slice(3);

        $(selector[selector.length - 1]).find('label.btn').attr('for', 'menu-image-' + rand);
        $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'menu-image-' + rand);
        $(".bootstrap-tag-input").tagsinput('items');
        initImagePreviewer();
    }

    function removeFoodMenu(elem) {
        jQuery(elem).closest('.food_menu_div').remove();
        $(".bootstrap-tag-input").tagsinput('items');
    }

    function appendBeautyService() {

        jQuery('#beauty_service_div').append(blank_beauty_menu_div);
        let selector = jQuery('#beauty_service_div .beauty_service_div');

        let rand = Math.random().toString(36).slice(3);

        $(selector[selector.length - 1]).find('label.btn').attr('for', 'service-image-' + rand);
        $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'service-image-' + rand);
        $(".bootstrap-tag-input").tagsinput('items');
        initImagePreviewer();
    }

    function removeBeautyService(elem) {
        jQuery(elem).closest('.beauty_service_div').remove();
        $(".bootstrap-tag-input").tagsinput('items');
    }

    function appendService() {

        jQuery('#service_div').append(blank_menu_div);
        let selector = jQuery('#service_div .service_div');

        let rand = Math.random().toString(36).slice(3);

        $(selector[selector.length - 1]).find('label.btn').attr('for', 'service-image-' + rand);
        $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'service-image-' + rand);
        $(".bootstrap-tag-input").tagsinput('items');
        initImagePreviewer();
    }

    function removeService(elem) {
        jQuery(elem).closest('.service_div').remove();
        $(".bootstrap-tag-input").tagsinput('items');
    }

    function appendSpecialOffer() {

        jQuery('#special_offer_div').append(blank_special_offer_div);
        let selector = jQuery('#special_offer_div .special_offer_div');

        let rand = Math.random().toString(36).slice(3);

        $(selector[selector.length - 1]).find('label.btn').attr('for', 'product-image-' + rand);
        $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'product-image-' + rand);
        $(".bootstrap-tag-input").tagsinput('items');
        initImagePreviewer();
    }

    function removeSpecialOffer(elem) {
        jQuery(elem).closest('.special_offer_div').remove();
        $(".bootstrap-tag-input").tagsinput('items');
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
    //new
    function appendBrandUploader() {
        jQuery('#brands_area').append(blank_brand_uploader);
    }
    function removeBrandUploader(photoElem) {
        jQuery(photoElem).closest('.appendedBrandUploader').remove();
    }
    //new ends


    function removePhotoUploader(photoElem) {
        jQuery(photoElem).closest('.appendedPhotoUploader').remove();
    }

    function showListingTypeForm(listing_type) {
        listing_type_value = listing_type;
        if (listing_type === "shop") {
            $('#special_offer_parent_div').show();
            $('#food_menu_parent_div').hide();
            $('#beauty_service_parent_div').hide();
            $('#hotel_room_specification_parent_div').hide();
            $('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_products'); ?>');
        } else if (listing_type === "hotel") {
            $('#special_offer_parent_div').hide();
            $('#food_menu_parent_div').hide();
            $('#beauty_service_parent_div').hide();
            $('#hotel_room_specification_parent_div').show();
            $('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_rooms'); ?>');
        } else if (listing_type === "restaurant") {
            $('#special_offer_parent_div').hide();
            $('#food_menu_parent_div').show();
            $('#beauty_service_parent_div').hide();
            $('#hotel_room_specification_parent_div').hide();
            $('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_food_menu'); ?>');
        } else if (listing_type === "beauty") {
            $('#special_offer_parent_div').hide();
            $('#food_menu_parent_div').hide();
            $('#beauty_service_parent_div').show();
            $('#hotel_room_specification_parent_div').hide();
            $('#demo-btn').html('<i class="mdi mdi-eye"></i> Preview Services');
        } else {
            $('#special_offer_parent_div').hide();
            $('#beauty_service_parent_div').hide();
            $('#food_menu_parent_div').hide();
            $('#hotel_room_specification_parent_div').hide();
            $('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('no_preview_available'); ?>');
        }
    }

    function showServiceTypeForm() {

        showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/beauty_service', '<?php echo get_phrase('preview'); ?>');

    }


    // This fucntion checks the minimul required fields of listing form
    function checkMinimumFieldRequired() {
        var title = $('#title').val();
        var defaultCategory = $('#category_default').val();
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var country_id = $('#country_id').val();
         var city_id = $('#city_id').val();
        
        if (title === "" || defaultCategory === "" || latitude === "" || longitude === "" || country_id === "" || city_id === "") {
            error_notify('<?php echo 'Country , City ,'.get_phrase('listing_title') . ', ' . get_phrase('listing_category') . ', ' . get_phrase('latitude') . ', ' . get_phrase('longitude') . ' ' . get_phrase('can_not_be_empty'); ?>');
        } else {
            $('.listing_add_form').submit();
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

<script>
    function service_time() {
        var starting_time = $('#starting_time').val();
        var ending_time = $('#starting_time').val();
        if (starting_time != '' && ending_time != '') {
            $("#ending_time").attr("min", starting_time);
            $("#ending_time").attr("max", "24:00");
        }
    }

    // function service_time_min(){
    // 	var ending_time   = $('#ending_time').val();
    // 	if(ending_time != ''){
    // 		$("#ending_time").attr("min", "1");
    // 		$("#ending_time").attr("max", ending_time);
    // 	}
    // }

    $(document).on('change', '#lis_type', function() {
        var type = $(this).val()||0;
        if(type==1)
        {
            $('.services').hide();
        }
        else
        {
            $('.services').show();
        }

    });
</script>
