

<style type="text/css">
/*.add_bottom_30{*/
/*    margin-bottom:9px;*/
/*}*/
/*added upper*/
    #top_section{
        margin-top: 74px;
        
    }
    #top_section .business_name{

        display: flex;
        justify-content: center;
        align-items: center;
        height: 75px;
    }

    .leaflet-pane{
        transform: translate3d(20px, 10px, 0px) !important;
    }

    #top_section .share-buttons{

        display: flex;
        justify-content: center;
        align-items: center;
        height: 75px;
        margin-bottom: 0;
    }

    #top_section .logo{

        height: 80px;
    }

    .nav-tabs{

        border-bottom: 0px;
    }

    .nav-link{
        padding: .5rem 1rem;
    }
    .share-icon{
        font-size:25px;
    }
    .btn-shareButton{
        border:none;
    }
    @media (max-width: 991px){
        #top_section{
            margin-top:41px;
        }
        .row-alignment{
            margin-top:10px;
        }
    }

/*    .prdt_deta .bran_ds .brnd_wrapp{
        height: 200px;
    }*/
</style>

<section id="top_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="row row-alignment">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        <img class="img-fluid logo" src="<?php echo base_url('uploads/logo/').$listing_details['logo'];?>" >
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                        <h4 class="business_name"><?php echo $listing_details['name'];?></h4>
                    </div>
                </div> 
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <ul class="share-buttons">
                    <!-- Umair -->
                <!-- <input id="inputText" type="text" value="" style="display:none"> -->
                    <!-- <button id="copyText" type="button">Copy -->
                        <!-- <i class="fa fa-share-alt" aria-hidden="true"></i> -->
                    <!-- </button> -->
                    <!-- The text field -->
                    <input type="text" value="<?php echo current_url();?>" id="myInput" style="display:none">

                    <!-- The button used to copy the text -->
                    <button class="btn btn-shareButton" onclick="myFunctionss()"><i class="fa fa-share-alt share-icon" aria-hidden="true">
                    </i></button>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="hero_in shop_detail hero_inner_page" style="background: url(<?php echo base_url('uploads/listing_cover_photo/'.$listing_details['listing_cover']); ?>) center center no-repeat; background-size: cover;">
    <!-- <div class="in_txt single_def_top">
        <h2><?= $listing_details['name'] ?></h2>
    </div>  -->
</div>


<?php
// print_r($branches);
$achievements = $this->crud_model->get_new_achievements($listing_details['id']);

// print_r($branches);die();
//echo $listing_details['brands'];exit;
$brands = json_decode($listing_details['brands']);
$achievements = json_decode($achievements['achievement']);
// print_r($brands);exit;
?>
<!-- <nav class="secondary_nav sticky_horizontal_2">
    <div class="container">

    </div>
</nav> -->
<div class="container">

    <ul class="nav nav-tabs inner_tab_sec" id="myTab" role="tablist clearfix">
        <li class="nav-item"><a href="#aaaa" id="description_click" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true"
            <?php if(isset($_GET['inventory_category']) || isset($_GET['service'])){ ?>
                class="nav-link "
            <?php } else { ?>
             class="nav-link active"
         <?php } ?>

         >About Us</a></li>

         <!-- new -->
         <?php
         if ($listing_details['listing_type'] == 'hotel' ||
            $listing_details['listing_type'] == 'shop' ||
            $listing_details['listing_type'] == 'restaurant' ||
            $listing_details['listing_type'] == 'general'
        ):

        ?>

        <li class="nav-item"><a  href="#cccc" id="shop_click" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false"
        <?php if(isset($_GET['inventory_category']) || isset($_GET['service'])){ ?>
            class="nav-link active"
        <?php } else { ?>
            class="nav-link"
        <?php } ?>

        > Products & Services</a></li>

     <?php endif; ?>
     
        

        <?php //if(!empty($branches)): ?>
            <li class="nav-item"><a class="nav-link" href="#dddd" id="branches_click" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">Branches</a></li>
        <?php //endif;
        // if (!empty($brands)):
            ?>

            <!--<li class="nav-item"><a class="nav-link" href="#eeee" id="brands_click" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">Brands</a></li>-->
        <!-- <?php //endif; ?> -->
        <!-- new ends -->

        <li class="nav-item"><a class="nav-link" href="#ffff" id="reviews_click" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">Our Achievements</a></li>
        <!-- <li><a href="#sidebar"><?php echo get_phrase('booking'); ?></a></li> -->

        <!--<li class="nav-item"><a   class="nav-link" href="#bbbb" id="product_services_click" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false"-->

        <!-- >Offers and Menus</a></li>-->
    </ul>
</div>
<div class="container margin_60_35 prdt_deta">
    <div class="row">
        <div class="col-lg-12" id="about_us_data">
            <?php include 'contact_and_social.php'; ?>
        </div>
        <div class="col-lg-8 change_the_col">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade
                <?php if(isset($_GET['inventory_category']) || isset($_GET['service'])){ ?>

                <?php } else { ?>
                    show active
                <?php } ?>


                " id="aaaa" role="tabpanel" aria-labelledby="home-tab">

                <div class="row">
                        <div class="col-md-4">
                        <?php if(!empty($listing_details['bgroup'])) {?>   
                            <p>Group of Business:</p>
                        <?php } ?>

                        <?php if(!empty($listing_details['categories'])) {?>   
                            <p>Category of Business:</p>
                        <?php } ?>

                        <?php if(!empty($listing_details['phone'])) {?>   
                            <p>Contact Number:</p>
                        <?php } ?>

                        <?php if(!empty($listing_details['email'])) {?>   
                            <p>Email:</p>
                        <?php } ?>

                        <?php if(!empty($listing_details['bgroup'])) {?>   
                            <p>Facebook:</p>
                        <?php } ?>
                        
                    </div>

                    <div class="col-md-4">
                        <?php if(!empty($listing_details['bgroup'])) {?>
                            <p><?php echo getBusinessGroup($listing_details['bgroup'])?></p>
                        <?php } ?>

                        <?php if(!empty($listing_details['categories'])) {?>
                        <div class="add_bottom_30">
                            <?php
                            $categories = json_decode($listing_details['categories']);
                            for ($i = 0; $i < sizeof($categories); $i++):
                                $this->db->where('id',$categories[$i]);
                                $category_name = $this->db->get('category')->row()->name;
                                ?>
                                <span class="loc_open mr-2 d-inline-block">
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

                        <?php } ?>
                       <?php if(!empty($listing_details['phone'])) {?>
                            <p><?php echo $listing_details['phone'] ?></p>
                        <?php }?>

                        <?php if(!empty($listing_details['email'])) {?>
                            <p><?php echo $listing_details['email'] ?></p>
                        <?php }?>

                        <?php if(!empty($listing_details['social'])) {?>
                        <?php $social = $listing_details['social']; ?>
                        <?php $social = json_decode($social, true); ?>

                        <?php if($social['facebook'] != ""){ ?>
                           <p> <a href="<?php echo $social['facebook']; ?>" target="blank" class="btn_1 full-width outline wishlist social-button" id = "btn-wishlist-social"><i class="icon-facebook-6 mr-2"></i><?php echo get_phrase('facebook'); ?></a></p>
                        <?php } ?>

                        <?php }?>
                    </div>
                   

                    <div class="col-md-12">
                         <h5 class="abt-titl"><?= get_phrase('location'); ?></h5>
                        <div class="map_side_view_">
                           
                            <!-- <div id="categorySideMap" class="map-full map-layout single-listing-map" style="z-index: 50;"></div> -->
                            <div id="map" class="map-full map-layout single-listing-map" style="width="100%"; height="350"; frameborder="0"; scrolling="no"; marginheight="0"; marginwidth="0";z-index: 50;">
                                
                            </div>
                            <!--<div  style="width: 100%"><iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=350&amp;hl=en&amp;q=Biratnagar,%20himalayan%20bank+(Mark8hub)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/sport-gps/">hiking gps</a></iframe></div>-->
                        </div>
                    </div>
                </div>
                <section id="description" class="in_de_tails">
                    <div class="detail_title_1">
                       
                        
                   </div>


                   <?php
                //new
                   $parent_name = '';
                   if(!empty($listing_details['parent_id'])):
                    $parent_listing = $this->crud_model->get_listings($listing_details['parent_id'])->row_array();
                 // print_r($parent_listing);exit;
                    $parent_name = 'Branch of <a href="'.get_listing_url($parent_listing['id']).'">'.$parent_listing["name"].'</a>';

                    ?>
                    <h6><?= $parent_name ?></h6>

                <?php endif;
                //new ends below closing tag
                ?>
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
                <?php include 'listing_reviews.php'; ?>


                <!-- /row -->

                <!-- Video File Base On Package-->
                <?php include 'video_player.php'; ?>

                <!-- <hr> -->
               <!-- <h3><?= get_phrase('location'); ?></h3>
                <div id="categorySideMap" class="map-full map-layout single-listing-map" style="z-index: 50;"></div>
                <div id="map" class="map-full map-layout single-listing-map" style="z-index: 50;"></div> -->
                <!-- End Map -->
            </section>

        </div>


        <div class="tab-pane fade" id="bbbb" role="tabpanel" aria-labelledby="profile-tab">
       <section id="product_services" class="in_pro_duct">
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
                        <?php if ($listing_details['listing_type'] != 'beauty'){ ?>
                    <div class="row" style="margin-top: 60px;">
                        <h5 class="abt-titl col-md-12" style="padding-left: 0px;">Book</h5>
                        <div class="col-md-6" style="padding-right: 0px;">
                            <img style="width: 100%; height: 400px; object-fit: cover;" class="img img-responsive" src="<?= base_url() ?>assets/frontend/images/cs.png">
                        </div>

                        <div class="box_detail booking col-md-6" style="border-radius: 0px;">
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
                                            <?php else: ?>
                                                <?php include 'general_contact_form.php'; ?>
                                            <?php endif; ?>
                                            <a href="javascript::" class=" add_top_30 btn_1 full-width purchase" onclick="getTheGuestNumberForBooking('<?php echo $listing_details['listing_type']; ?>')"><?php echo get_phrase('submit'); ?></a>
                                        </form>
                                        <a href="javascript:" onclick="addToWishList('<?php echo $listing_details['id']; ?>')" class="btn_1 full-width outline wishlist" id = "btn-wishlist"><i class="icon_heart"></i> <?php echo is_wishlisted($listing_details['id']) ? get_phrase('remove_from_wishlist') : get_phrase('add_to_wishlist'); ?></a>
                                        <div class="text-center"><small><?php echo get_phrase('no_money_charged_in_this_step'); ?></small></div>
                                    </div>
                                </div>
                            <?php } ?>

                            </section>
                        </div>

                <div class="tab-pane fade
                        <?php if(isset($_GET['inventory_category']) || isset($_GET['service'])){ ?>
                           show active
                       <?php } else { ?>

                       <?php } ?>
                       " id="cccc" role="tabpanel" aria-labelledby="contact-tab">
                       <section id="shop_adn" class="in_sh_op" >
                        <?php if (get_addon_details('shop')): ?>
                            <?php include 'shop.php'; ?>
                        <?php endif; ?>
                    </section>

                    <!-- services part -->

                    <section  class="in_pro_duct">


                        <?php include 'service_listing_inner_page.php'; ?>

                        <!--<?php include 'ask-quotation.php'; ?>-->



                        <div class="row" style="margin-top: 60px;">
                            <h5 class="abt-titl col-md-12" style="padding-left: 0px;">Book a Services</h5>
                            <div class="col-md-6" style="padding-right: 0px;">
                                <img style="width: 100%; height: 400px; object-fit: cover;" class="img img-responsive" src="<?= base_url() ?>assets/frontend/images/cs.png">
                            </div>
                            <div class="box_detail booking col-md-6" style="border-radius: 0px;">
                                <form class="contact-us-service-form" action="<?php echo site_url('home/contact_service/'.$listing_details['listing_type']); ?>" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $listing_details['user_id']; ?>">
                                    <input type="hidden" name="requester_id" value="<?php echo $this->session->userdata('user_id'); ?>">
                                    <input type="hidden" name="listing_id" value="<?php echo $listing_details['id']; ?>">
                                    <input type="hidden" name="listing_type" value="<?php echo $listing_details['listing_type']; ?>">
                                    <input type="hidden" name="slug" value="<?php echo slugify($listing_details['name']); ?>">

                                        <?php include 'service_contact_form.php'; ?>

                                    <a href="javascript::" class=" add_top_30 btn_1 full-width purchase" onclick="getTheGuestNumberForBookingService('<?php echo $listing_details['listing_type']; ?>')"><?php echo get_phrase('submit'); ?></a>
                                </form>
                                <a href="javascript:" onclick="addToWishList('<?php echo $listing_details['id']; ?>')" class="btn_1 full-width outline wishlist" id = "btn-wishlist"><i class="icon_heart"></i> <?php echo is_wishlisted($listing_details['id']) ? get_phrase('remove_from_wishlist') : get_phrase('add_to_wishlist'); ?></a>
                                <div class="text-center"><small><?php echo get_phrase('no_money_charged_in_this_step'); ?></small></div>
                            </div>
                        </div>

                    </section>

                </div>


                <div class="tab-pane fade" id="dddd" role="tabpanel" aria-labelledby="contact-tab">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="container">
                                <div class="brnch_wrap_ row">
                                <?php
                                foreach ($branches as $br):
                                    ?>
                                        <div  class="col-lg-6 col-md-6 listing-div alignment-card brn_pd_" data-marker-id="<?php echo $br['id']; ?>" id = "<?php echo $br['id']; ?>">
                                            <div class="brnch_name">

                                                <h4><?= $br["branchName"] ?></h4>
                                                <div class="brn_div">
                                                    <span><i class="ti-home"></i></span><h5 >
                                                        <?= $br["address"] ?> <br>
                                                    
                                                    </h5>
                                                </div>
                                                <div class="brn_div">
                                                    <span><i class="ti-headphone-alt"></i></span><h5>   <?= $br["contactNumber"] ?></h5>
                                                </div>
                                                <div class="brn_div">
                                                    <span><i class="ti-email"></i></span><h5><?= $br["email"] ?></h5>
                                                </div>
                                                <a class="address" href="javascript:" button-direction-id = "<?php echo $br['id']; ?>" target=""><?php echo get_phrase('show_on_map'); ?></a>
                                            </div>
                                        </div>
                                    
                                <?php  endforeach;
                                ?>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="stiky-map mb-5 mb-xl-0">
                                <div id="map1" class="map-full map-layout"></div>
                            </div>
                        </div> -->

                        <!--<div class="col-xl-4 order-xl-2 order-1">-->
                        <!--    <div class="stiky-map mb-5 mb-xl-0">-->
                        <!--        <div id="branches-map" class="map-full map-layout"></div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    

                </div>

                

                <div class="tab-pane fade
 <?php if(isset($_GET['service'])){ ?>
           show active
       <?php } else { ?>

       <?php } ?>
" id="serv" role="tabpanel" aria-labelledby="profile-tab">
                    
                </div>



                <div class="tab-pane fade" id="eeee" role="tabpanel" aria-labelledby="contact-tab">
           <section id="brands" class="bran_ds">
               <h5 class="abt-titl add_bottom_15">Brands Associated</h5>
               <div class="container">
                <div class="row">
                    <?php

                    foreach ($brands as $key=>$value):
                        ?>
                        <div class="col-md-4">
                            <div class="brnd_wrapp">
                                <img class="brnd_img_ img img-responsive" src="<?= base_url() ?>uploads/brand_images/<?= $value ?>">
                                <h4 class="brnd_name_"><?= $key ?></h4>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>


        </section>
    </div>

    <div class="tab-pane fade" id="ffff" role="tabpanel" aria-labelledby="contact-tab">
       <section id="brands" class="bran_ds">
               <h5 class="abt-titl add_bottom_15">Our Achievements</h5>
               <div class="container">
                <div class="row">
                    <?php

                    foreach ($achievements as $key=>$value):
                        ?>
                        <div class="col-md-4">
                            <div class="brnd_wrapp">
                                <img class="brnd_img_ img img-responsive" src="<?= base_url() ?>uploads/brand_images/<?= $value ?>">
                                <h4 class="brnd_name_"><?= $key ?></h4>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>


        </section>
   </div>

</div>

<!-- SHOP ADDON VIEW WILL BE HERE -->





<!-- /section -->
<!-- Section Of Review Starts -->

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


        <h5 class="mb-3 abt-titl "><?php echo get_phrase('agent_details'); ?></h5>

        <div class="row mb-1 ">
            <div class="col-md-12">
                <a href="<?php echo site_url('home/user_profile'); ?>">
                    <img src="<?php echo $this->user_model->get_user_thumbnail($user_details['id']); ?>" alt="" class="float-left mr-3" width="80">
                </a>
            
                <p class="m-0 pt-3 agnt_txt"><a href="<?php echo site_url('home/user_profile/'.$user_details['id']); ?>" class=""><?= $user_details['name']; ?></a></p>
                <p>
                    <small class="para_lst"><?php echo get_phrase('total').' '.$this->user_model->get_listing_by_user_id($user_details['id'])->num_rows().' '.get_phrase('listings'); ?></small>
                </p>
            </div>
        </div>
        
    </aside>

<?php endif; ?>

</div>

<!-- /row -->

</div>
<!-- /container -->

                 <!--    <div class="col-md-12">
                        <div class="map_view_">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3572.1061189338325!2d87.26763821451064!3d26.452308086127264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef752b82ea5f03%3A0x15ca22a0364e7f4a!2sSolution%20Gate!5e0!3m2!1sen!2snp!4v1624804561040!5m2!1sen!2snp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div> -->


                    <script type="text/javascript">
                        var isLoggedIn = '<?php echo $this->session->userdata('is_logged_in'); ?>';

                        // Testing
// function getProfileLink() {
    /* return input field to variable text */
    // Zahid
    function myFunctionss() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */

  alert("Copied the text: " + copyText.value);
}
    // }
                        // End Here 

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

                        function getTheGuestNumberForBookingService(listing_type) {
                            if (isLoggedIn === '1') {
                                if (listing_type === "restaurant" || listing_type === "hotel") {
                                    $('#adult_guests_for_booking').val($('#adult_guests').val());
                                    $('#child_guests_for_booking').val($('#child_guests').val());
                                }

                                $('.contact-us-service-form').submit();
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
    $('#about_us_data').hide();
    $('#sidebar').hide();
    $('.change_the_col').removeClass('col-lg-8');
        $('.change_the_col').addClass('col-lg-12');


    
    <?php
} else {
    if(isset($_GET['service']))
    {
        ?>
        $('#reviews').hide();
        $('#claim').hide();
        $('#claim_user').hide();
        $('#shop_adn').show();
        $('#description').hide();
        $('#product_services').show();
        $('#about_us_data').hide();
        $('#sidebar').hide();
        $('.change_the_col').removeClass('col-lg-8');
        $('.change_the_col').addClass('col-lg-12');



    <?php }
    else { ?>
        $('#reviews').show();
        $('#claim').show();
        $('#claim_user').show();
        $('#shop_adn').hide();
        $('#description').show();
        $('#product_services').hide();
        $('#about_us_data').show();
        $('#sidebar').show();
        $('.change_the_col').removeClass('col-lg-12');
        $('.change_the_col').addClass('col-lg-8');
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
    $('#about_us_data').hide();
    $('#sidebar').hide();
    $('.change_the_col').removeClass('col-lg-8');
        $('.change_the_col').addClass('col-lg-12');
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
    $('#about_us_data').hide();
    $('#sidebar').hide();
    $('.change_the_col').removeClass('col-lg-8');
        $('.change_the_col').addClass('col-lg-12');
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
    $('#about_us_data').hide();
    $('#sidebar').hide();
    $('.change_the_col').removeClass('col-lg-8');
        $('.change_the_col').addClass('col-lg-12');
});

$(document).on("click","#description_click",function() {
    $('#brands').hide();
    $('#claim').show();
    $('#claim_user').show();
    $('#description').show();
    $('#product_services').hide();
    $('#branches').hide();
    $('#reviews').show();
    $('#shop_adn').hide();
    $('#about_us_data').show();
    $('#sidebar').show();
    $('.change_the_col').removeClass('col-lg-12');
    $('.change_the_col').addClass('col-lg-8');



    // $('#reviews').show();
    //     $('#claim').show();
    //     $('#claim_user').show();
    //     $('#shop_adn').hide();
    //     $('#description').show();
    //     $('#product_services').hide();
    //     $('#about_us_data').show();
    //     $('#sidebar').show();
    //     $('.change_the_col').removeClass('col-lg-12');
    //     $('.change_the_col').addClass('col-lg-8');
});

$(document).on("click","#reviews_click",function() {
    $('#brands').hide();
    $('#claim').show();
    $('#claim_user').show();
    $('#description').hide();
    $('#product_services').hide();
    $('#branches').hide();
    $('#reviews').hide();
    $('#shop_adn').hide();
    $('#about_us_data').hide();
    $('#sidebar').hide();
    $('.change_the_col').removeClass('col-lg-8');
        $('.change_the_col').addClass('col-lg-12');
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
       $('#about_us_data').hide();
       $('#sidebar').hide();
       $('.change_the_col').removeClass('col-lg-8');
        $('.change_the_col').addClass('col-lg-12');
       
   });
//ends
</script>

<!-- This map-category.php file has all the fucntions for showing the map, marker, map info and all the popup markups -->
<?php include 'assets/frontend/js/map/map-category.php'; ?>

<!-- This script is needed for providing the json file which has all the listing points and required information -->
 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-izr7XK6g2OdUqO0nWPDivtlv-xSxu1E&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
<script>

function initAutocomplete() {
var lat = <?= $listing_details['latitude'] ?>;
var lng = <?= $listing_details['longitude'] ?>;


var myLatLng = { lat: lat, lng: lng };
 const map = new google.maps.Map(document.getElementById("map"), {
     center: myLatLng,
    zoom: 17,
  });
 var marker = new google.maps.Marker({
			  position: myLatLng,
			  map: map,
			  title: lat + ', ' + lng 
			});
}
    // createListingsMap({
    //     mapId: 'map',
    //     jsonFile: '<?php echo base_url('assets/frontend/single-listing-geojson/listing-id-'.$listing_id.'.json'); ?>'
    // });
</script>

<?php 
    $all_json_files = glob('assets/frontend/all-branches-geojson/*'); 
    foreach($all_json_files as $all_json_file){ // iterate files
        if(is_file($all_json_file))
            $json_file_for_this_page = $all_json_file;
    }

    // echo "<pre>";print_r($all_json_files);die();
?>
<script>
	

    $(document).on("click","#branches_click",function() {

        createListingsMap({
            mapId: 'branches-map',
            jsonFile: '<?php echo base_url($json_file_for_this_page); ?>'
        });
    });
</script>
