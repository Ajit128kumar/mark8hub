<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/select2/select2-bootstrap.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/select2/select2.css');?>">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/slick/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/css/new.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/sass/new.scss"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/navmenu/css/menumaker.css"/>
<!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/sass/mediaquery.scss"/> -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/slick/slick/slick-theme.css"/>
<script src="<?php echo base_url('assets/backend/js/select2/select2.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/frontend/slick/slick/slick.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/new.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/frontend/navmenu/js/menumaker.js"></script>
<div class="hero_in shop_detail hero_inner_page" style="background: url(<?php echo base_url('uploads/listing_cover_photo/'.$listing_details['listing_cover']); ?>) center center no-repeat; background-size: cover;">
    <div class="in_txt">
        <h2>Ratna Hotesdvsd</h2>
    </div> 
</div>
<!--/hero_in-->
<?php
$branches = $this->crud_model->get_branches($listing_details['id']);
$brands = json_decode($listing_details['brands']);
?>
<nav class="secondary_nav sticky_horizontal_2">
    <div class="container">


    </div>
</nav>

<ul class="nav nav-tabs" id="myTab" role="tablist">

    <!-- description -->

    <li class="nav-item">
        <a class="nav-link active" id="des-tab" data-toggle="tab" href="#des__" role="tab" aria-controls="home" aria-selected="true"
        <?php if(isset($_GET['inventory_category']) || isset($_GET['service'])){ ?>

        <?php } else { ?>

        <?php } ?>

        ><?php echo get_phrase('description'); ?></a></li>

        <!-- new -->
        <?php
        if ($listing_details['listing_type'] == 'hotel' ||
            $listing_details['listing_type'] == 'shop' ||
            $listing_details['listing_type'] == 'restaurant' ||
            $listing_details['listing_type'] == 'beauty'
        ):

        ?>

        <!-- product services -->

        <li class="nav-item">
            <a class="nav-link" id="serv-tab" data-toggle="tab" href="#serv__" role="tab" aria-controls="profile" aria-selected="false"
            <?php if(isset($_GET['service'])){ ?>

            <?php } else { ?>

            <?php } ?>
            >Products & Services</a></li>
        <?php endif; ?>

        <!-- Shop -->

        <li class="nav-item">
            <a class="nav-link" id="shop-tab" data-toggle="tab" href="shop__" role="tab" aria-controls="profile" aria-selected="false"
            <?php if(isset($_GET['inventory_category'])){ ?>

            <?php } else { ?>

            <?php } ?>

            >Shop</a></li>
            <?php if(!empty($branches)): ?>

                <!-- branches -->

                <li class="nav-item"><a class="nav-link" id="branch-tab" data-toggle="tab" href="#branches__" role="tab" aria-controls="profile" aria-selected="false" >Branches</a></li>
            <?php endif;
            if (!empty($brands)):
                ?>

                <!-- Brands -->

                <li><a class="nav-link" id="brands-tab" data-toggle="tab" href="#brnds__" role="tab" aria-controls="profile" aria-selected="false">Brands Associated</a></li>
            <?php endif; ?>
            <!-- new ends -->

            <!-- Reviews -->
            <li><a class="nav-link" id="review-tab" data-toggle="tab" href="#revw__" role="tab" aria-controls="profile" aria-selected="false"><?php echo get_phrase('reviews'); ?></a></li>
            <li><a href="#sidebar"><?php echo get_phrase('booking'); ?></a></li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="#des__" role="tabpanel" aria-labelledby="des-tab">
              asdasdasdc vadv as as ca caks ckasc
          </div>


          <div class="tab-pane fade" id="serv__" role="tabpanel" aria-labelledby="serv-tab">asdasdasd..avsduas aXCzxczxcv.</div>
          <div class="tab-pane fade" id="shop__" role="tabpanel" aria-labelledby="shop-tab">asdabsdas dizxczxccvng fg jg ffgjf fghfghfg gh </div>
          <div class="tab-pane fade" id="branches__" role="tabpanel" aria-labelledby="branch-tab">asdasdasd..avsduas ash dasg fg hfg hrth rthrth trhrt trh trh</div>
          <div class="tab-pane fade" id="brnds__" role="tabpanel" aria-labelledby="brands-tab">asdabsd rthtrt</div>
          <div class="tab-pane fade" id="revw__" role="tabpanel" aria-labelledby="review-tab">asdabsd rthtrt</div>

      </div>
      <div class="container margin_60_35 prdt_deta">
        <div class="row">
            <div class="col-lg-8">

              <section id="description" class="in_de_tails">
                <div class="detail_title_1">
                    <h1>
                        <?php if(!empty($listing_details['logo'])): ?>
                            <img src="<?php echo base_url('uploads/logo/'.$listing_details['logo']) ?>" height="100px" width="85px">
                        <?php endif;?>
                        <?php echo $listing_details['name']; ?>

                        <?php $claiming_status = $this->db->get_where('claimed_listing', array('listing_id' => $listing_id))->row('status'); ?>
                        <?php if($claiming_status == 1): ?>
                            <span class="claimed_icon" data-toggle="tooltip" title="<?php echo get_phrase('this_listing_is_verified'); ?>">
                                <img src="<?php echo base_url('assets/frontend/images/verified.png'); ?>" width="30" />
                            </span>
                        <?php endif; ?>
                    </h1>
                    <div class="add_bottom_15">
                        <?php
                        $categories = json_decode($listing_details['categories']);
                        for ($i = 0; $i < sizeof($categories); $i++):
                            $this->db->where('id',$categories[$i]);
                            $category_name = $this->db->get('category')->row()->name;
                            ?>
                            <span class="loc_open mr-2">
                                <a href="<?php echo site_url('home/filter_listings?category='.slugify($category_name).'&&status=all'); ?>"
                                   style="color: #32a067;">
                                   <?php echo $category_name;?>
                                   >
                               </a>
                           </span>
                           <?php
                       endfor;
                       ?>
                   </div>
               </div>


               <?php
                //new
               $parent_name = '';
               if(!empty($listing_details['parent_id'])):
                $parent_listing = $this->crud_model->get_listings($listing_details['parent_id'])->row_array();
                $parent_name = 'Branch of <a href="'.get_listing_url($parent_listing['id']).'">'.$parent_listing["name"].'</a>';

                ?>
                <h6><?= $parent_name ?></h6>

            <?php endif;
                //new ends below closing tag
            ?>

            <h5 class="abt-titl"><?php echo get_phrase('about'); ?></h5>
            <p class="para_list_ing">
                <?php echo nl2br($listing_details['description']); ?>
            </p>




            <!-- Photo Gallery -->
            <?php if (count(json_decode($listing_details['photos'])) > 0): ?>
                <h5 class="add_bottom_15 abt-titl"><?php echo get_phrase('photo_gallery'); ?></h5>
                <div class="grid-gallery">
                    <ul class="magnific-gallery">
                        <?php foreach (json_decode($listing_details['photos']) as $key => $photo): ?>
                            <?php if (file_exists('uploads/listing_images/'.$photo)): ?>
                                <li>
                                    <figure>
                                        <img style="height: 220px; width: 180px;" src="<?php echo base_url('uploads/listing_images/'.$photo); ?>" alt="">
                                        <figcaption>
                                            <div class="caption-content">
                                                <a href="<?php echo base_url('uploads/listing_images/'.$photo); ?>" title="" data-effect="mfp-zoom-in">
                                                    <i class="pe-7s-plus"></i>

                                                </a>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- <hr> -->
            <?php include 'contact_and_social.php'; ?>

            <h5 class="add_bottom_15 abt-titl"><?php echo get_phrase('amenities'); ?></h5>
            <div class="row add_bottom_30">
                <?php foreach (json_decode($listing_details['amenities']) as $key => $amenity): ?>
                    <div class="col-md-4">
                        <ul class=" amen_list">
                            <li>
                                <i class="<?php echo $this->frontend_model->get_amenity($amenity, 'icon')->row('icon'); ?> "></i>
                                <?php echo $this->frontend_model->get_amenity($amenity, 'name')->row()->name; ?>
                            </li>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- /row -->

            <!-- Opening and Closing Time -->
            <?php include 'opening_and_closing_time_schedule.php'; ?>

            <!-- Listing Type Wise Inner Page -->




            <!-- /row -->

            <!-- Video File Base On Package-->
            <?php include 'video_player.php'; ?>

            <hr>
            <!-- <h3><?= get_phrase('location'); ?></h3> --> 
            <!-- <div id="categorySideMap" class="map-full map-layout single-listing-map" style="z-index: 50;"></div> -->
            <!--  <div id="map" class="map-full map-layout single-listing-map" style="z-index: 50;"></div> -->
            <!-- End Map -->
        </section>
        <!-- SHOP ADDON VIEW WILL BE HERE -->
        <section id="shop_adn" class="in_sh_op" >
            <?php if (get_addon_details('shop')): ?>
                <?php include 'shop.php'; ?>
            <?php endif; ?>
        </section>
        <section id="product_services" class="in_pro_duct" >
            <?php if ($listing_details['listing_type'] == 'hotel'): ?>
                <hr>
                <?php include 'hotel_listing_inner_page.php'; ?>
                <?php elseif ($listing_details['listing_type'] == 'shop'):?>
                    <hr>
                    <?php include 'shop_listing_inner_page.php'; ?>
                    <?php elseif ($listing_details['listing_type'] == 'restaurant'):?>
                        <hr>
                        <?php include 'restaurant_listing_inner_page.php'; ?>
                        <?php elseif ($listing_details['listing_type'] == 'beauty'):?>
                            <hr>
                            <?php include 'beauty_listing_inner_page.php'; ?>
                        <?php endif; ?>
                    </section>

                    <section id="branches" class="in_bran_ches">
                        <h5 class="abt-titl add_bottom_15">Branches</h5>

                       <!--  <table class="table table-borderless table-hover">
                            <?php

                            foreach ($branches as $br):

                                echo '<tr><td><h5><a href="'.get_listing_url($br["id"]).'">'.$br["name"].'</a></h5></td>
                                <td> <i class="fa fa-directions">'.$br["address"].'</i></td>
                                </tr>';

                            endforeach;
                            ?>
                        </table> -->
                        <div class="container">
                            <div class="brnch_wrap_ row">

                                <div class="col-md-6 brn_pd_">
                                    <div class="brnch_name">

                                        <h4>Biratnagar Branch</h4>
                                        <div class="brn_div">
                                            <span><i class="ti-home"></i></span><h5>Biratnagar 13, Bhanu Tole, Morang</h5>
                                        </div>
                                        <div class="brn_div">
                                            <span><i class="ti-headphone-alt"></i></span><h5>9800000000, 021-5345689</h5>
                                        </div>
                                        <div class="brn_div">
                                            <span><i class="ti-email"></i></span><h5>biratnagar@xyz.com</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 brn_pd_">
                                    <div class="brnch_name">

                                        <h4>Biratnagar Branch</h4>
                                        <div class="brn_div">
                                            <span><i class="ti-home"></i></span><h5>Biratnagar 13, Bhanu Tole, Morang</h5>
                                        </div>
                                        <div class="brn_div">
                                            <span><i class="ti-headphone-alt"></i></span><h5>9800000000, 021-5345689</h5>
                                        </div>
                                        <div class="brn_div">
                                            <span><i class="ti-email"></i></span><h5>biratnagar@xyz.com</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 brn_pd_">
                                    <div class="brnch_name">

                                        <h4>Biratnagar Branch</h4>
                                        <div class="brn_div">
                                            <span><i class="ti-home"></i></span><h5>Biratnagar 13, Bhanu Tole, Morang</h5>
                                        </div>
                                        <div class="brn_div">
                                            <span><i class="ti-headphone-alt"></i></span><h5>9800000000, 021-5345689</h5>
                                        </div>
                                        <div class="brn_div">
                                            <span><i class="ti-email"></i></span><h5>biratnagar@xyz.com</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 brn_pd_">
                                    <div class="brnch_name">

                                        <h4>Biratnagar Branch</h4>
                                        <div class="brn_div">
                                            <span><i class="ti-home"></i></span><h5>Biratnagar 13, Bhanu Tole, Morang</h5>
                                        </div>
                                        <div class="brn_div">
                                            <span><i class="ti-headphone-alt"></i></span><h5>9800000000, 021-5345689</h5>
                                        </div>
                                        <div class="brn_div">
                                            <span><i class="ti-email"></i></span><h5>biratnagar@xyz.com</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                    <section id="brands" class="bran_ds">
                       <h5 class="abt-titl add_bottom_15">Brands Associated</h5>
                       <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="brnd_wrapp">
                                    <img class="brnd_img_ img img-responsive" src="http://localhost/directory/uploads/brand_images/402b8a9ae69b23481e1b0c0bde6aca28.jpg">
                                    <h4 class="brnd_name_">Apple Phone Pro</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="brnd_wrapp">
                                    <img class="brnd_img_ img img-responsive" src="http://localhost/directory/uploads/brand_images/402b8a9ae69b23481e1b0c0bde6aca28.jpg">
                                    <h4 class="brnd_name_">Apple Phone Pro</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="brnd_wrapp">
                                    <img class="brnd_img_ img img-responsive" src="http://localhost/directory/uploads/brand_images/402b8a9ae69b23481e1b0c0bde6aca28.jpg">
                                    <h4 class="brnd_name_">Apple Phone Pro</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="brnd_wrapp">
                                    <img class="brnd_img_ img img-responsive" src="http://localhost/directory/uploads/brand_images/402b8a9ae69b23481e1b0c0bde6aca28.jpg">
                                    <h4 class="brnd_name_">Apple Phone Pro</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                       <!--  <table class="table table-borderless table-hover">
                            <?php

                            foreach ($brands as $key=>$value):
                                ?>
                                <tr>
                                    <td> <img src="<?= base_url() ?>uploads/brand_images/<?= $value ?>" height="120" width="150"></td>
                                    <td><h5><em><?= $key ?></em></h5></td>
                                </tr>


                                <?php
                            endforeach;
                            ?>
                        </table> -->
                    </section>
                    <!-- /section -->
                    <!-- Section Of Review Starts -->
                    <?php include 'listing_reviews.php'; ?>
                    <!-- /section -->
                    
                    <?php $google_analytics_id = $this->db->get_where('listing', array('id' => $listing_id))->row('google_analytics_id'); ?>
                    <!-- Global site tag (gtag.js) - Google Analytics -->
                    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $google_analytics_id; ?>"></script>
                    <script>
                        window.dataLayer = window.dataLayer || [];
                        function gtag(){dataLayer.push(arguments);}
                        gtag('js', new Date());

                        gtag('config', '<?php echo $google_analytics_id; ?>');
                    </script>
                </div>
                <!-- /col -->

                <!-- Contact Form Base On Package-->
                <?php if(has_package_feature('ability_to_add_contact_form', $listing_details['user_id']) == 1): ?>
                    <aside class="col-lg-4" id="sidebar">
                        <div class="box_detail booking">
                            <form class="contact-us-form" action="<?php echo site_url('home/contact_us/'.$listing_details['listing_type']); ?>" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $listing_details['user_id']; ?>">
                                <input type="hidden" name="requester_id" value="<?php echo $this->session->userdata('user_id'); ?>">
                                <input type="hidden" name="listing_id" value="<?php echo $listing_details['id']; ?>">
                                <input type="hidden" name="listing_type" value="<?php echo $listing_details['listing_type']; ?>">
                                <input type="hidden" name="slug" value="<?php echo slugify($listing_details['name']); ?>">
                                <?php if ($listing_details['listing_type'] == 'hotel'): ?>
                                    <?php include 'hotel_room_booking_contact_form.php'; ?>
                                    <?php elseif ($listing_details['listing_type'] == 'restaurant'): ?>
                                        <?php include 'restaurant_booking_contact_form.php'; ?>
                                        <?php elseif ($listing_details['listing_type'] == 'beauty'): ?>
                                            <?php include 'beauty_service_contact_form.php'; ?>
                                            <?php else: ?>
                                                <?php include 'general_contact_form.php'; ?>
                                            <?php endif; ?>
                                            <a href="javascript::" class=" add_top_30 btn_1 full-width purchase" onclick="getTheGuestNumberForBooking('<?php echo $listing_details['listing_type']; ?>')"><?php echo get_phrase('submit'); ?></a>
                                        </form>
                                        <a href="javascript:" onclick="addToWishList('<?php echo $listing_details['id']; ?>')" class="btn_1 full-width outline wishlist" id = "btn-wishlist"><i class="icon_heart"></i> <?php echo is_wishlisted($listing_details['id']) ? get_phrase('remove_from_wishlist') : get_phrase('add_to_wishlist'); ?></a>
                                        <div class="text-center"><small><?php echo get_phrase('no_money_charged_in_this_step'); ?></small></div>
                                    </div>

                                    <ul class="share-buttons">
                                        <li><a href = "https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url();?>" class="fb-share" target="_blank"><i class="social_facebook"></i> Share</a></li>
                                        <li><a href = "https://twitter.com/share?url=<?php echo current_url();?>" target = "_blank" class="twitter-share"><i class="social_twitter"></i> Tweet</a></li>
                                        <li><a href = "http://pinterest.com/pin/create/link/?url=<?php echo current_url();?>" target="_blank" class="gplus-share"><i class="social_pinterest"></i> Pin</a></li>
                                    </ul>
                                   <!--  <div class="map_side_view_">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3572.1061189338325!2d87.26763821451064!3d26.452308086127264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef752b82ea5f03%3A0x15ca22a0364e7f4a!2sSolution%20Gate!5e0!3m2!1sen!2snp!4v1624804561040!5m2!1sen!2snp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    </div> -->
                                </aside>

                            <?php endif; ?>

                        </div>

                        <!-- /row -->

                    </div>
                    <!-- /container -->

                    <div class="col-md-12">
                        <div class="map_view_">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3572.1061189338325!2d87.26763821451064!3d26.452308086127264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef752b82ea5f03%3A0x15ca22a0364e7f4a!2sSolution%20Gate!5e0!3m2!1sen!2snp!4v1624804561040!5m2!1sen!2snp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>


                    <script type="text/javascript">
                        var isLoggedIn = '<?php echo $this->session->userdata('is_logged_in'); ?>';

    // This function performs all the functionalities to add to wishlist
    function addToWishList(listing_id) {
        if (isLoggedIn === '1') {
            $.ajax({
                type : 'POST',
                url : '<?php echo site_url('home/add_to_wishlist'); ?>',
                data : {listing_id : listing_id},
                success : function(response) {
                    if (response == 'added') {
                        $('#btn-wishlist').html('<i class="icon_heart"></i> <?php echo get_phrase('remove_from_wishlist'); ?>');
                    }else {
                        $('#btn-wishlist').html('<i class="icon_heart"></i> <?php echo get_phrase('add_to_wishlist'); ?>');
                    }
                }
            });
        }else {
            loginAlert();
        }
    }

    // This function shows the Report listing form
    function showClaimForm(){
        $('#claim_form').toggle();
        $('#report_form').hide();
    }
    // This function shows the Report listing form
    function showReportForm() {
        $('#report_form').toggle();
        $('#claim_form').hide();
    }

    // This function return the number of different types of guests
    function getTheGuestNumberForBooking(listing_type) {
        if (isLoggedIn === '1') {
            if (listing_type === "restaurant" || listing_type === "hotel") {
                $('#adult_guests_for_booking').val($('#adult_guests').val());
                $('#child_guests_for_booking').val($('#child_guests').val());
            }

            $('.contact-us-form').submit();
        }else {
            loginAlert();
        }

    }
//new jquery
<?php
if(isset($_GET['inventory_category']))
{
    ?>
    $('#reviews').hide();
    $('#claim').hide();
    $('#claim_user').hide();
    $('#description').hide();
    $('#shop_adn').show();
    $('#product_services').hide();
    
    <?php
} else {
    if(isset($_GET['service']))
    {
        ?>
        $('#reviews').hide();
        $('#claim').hide();
        $('#claim_user').hide();
        $('#shop_adn').hide();
        $('#description').hide();
        $('#product_services').show();

    <?php }
    else { ?>
        $('#reviews').hide();
        $('#claim').hide();
        $('#claim_user').hide();
        $('#shop_adn').hide();
        $('#description').show();
        $('#product_services').hide();
    <?php }
} ?>


$(document).on("click","#brands_click",function() {
    $('#brands').show();
    $('#claim').hide();
    $('#claim_user').hide();
    $('#description').hide();
    $('#product_services').hide();
    $('#branches').hide();
    $('#reviews').hide();
    $('#shop_adn').hide();
});
$(document).on("click","#branches_click",function() {
    $('#brands').hide();
    $('#claim').hide();
    $('#claim_user').hide();
    $('#description').hide();
    $('#product_services').hide();
    $('#branches').show();
    $('#reviews').hide();
    $('#shop_adn').hide();
});

$(document).on("click","#product_services_click",function() {
    $('#brands').hide();
    $('#claim').hide();
    $('#claim_user').hide();
    $('#description').hide();
    $('#product_services').show();
    $('#branches').hide();
    $('#reviews').hide();
    $('#shop_adn').hide();
});

$(document).on("click","#description_click",function() {
    $('#brands').hide();
    $('#claim').hide();
    $('#claim_user').hide();
    $('#description').show();
    $('#product_services').hide();
    $('#branches').hide();
    $('#reviews').hide();
    $('#shop_adn').hide();
});

$(document).on("click","#reviews_click",function() {
    $('#brands').hide();
    $('#claim').show();
    $('#claim_user').show();
    $('#description').hide();
    $('#product_services').hide();
    $('#branches').hide();
    $('#reviews').show();
    $('#shop_adn').hide();
});
$(document).on("click","#shop_click",function() {
       //  alert('here');
       $('#shop_adn').show();
       $('#brands').hide();
       $('#claim').hide();
       $('#claim_user').hide();
       $('#description').hide();
       $('#product_services').hide();
       $('#branches').hide();
       $('#reviews').hide();
       
   });
//ends
</script>

<!-- This map-category.php file has all the fucntions for showing the map, marker, map info and all the popup markups -->
<?php include 'assets/frontend/js/map/map-category.php'; ?>

<!-- This script is needed for providing the json file which has all the listing points and required information -->
<script>
    createListingsMap({
        mapId: 'map',
        jsonFile: '<?php echo base_url('assets/frontend/single-listing-geojson/listing-id-'.$listing_id.'.json'); ?>'
    });
</script>
