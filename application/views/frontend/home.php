


<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/select2/select2-bootstrap.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/select2/select2.css');?>">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/slick/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/slick/slick/slick-theme.css"/>
<script src="<?php echo base_url('assets/backend/js/select2/select2.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/frontend/slick/slick/slick.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/backend/css/xzoom.css" rel="stylesheet" />
<!-- <link href="https://unpkg.com/xzoom/dist/xzoom.css" rel="stylesheet" /> -->
<link type="text/css" rel="stylesheet" media="all" href="https://unpkg.com/xzoom/dist/xzoom.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
<!-- <script type="text/javascript" src="/slick/slick.min.js"></script> -->

<style>
    .select2-container .select2-choice, .select2-result-label {
        height: 50px;
        box-shadow: none;
        overflow: auto;

    }


    .select2-arrow, .select2-chosen {
        padding-top: 6px;
    }

    .cata-slider {
        display: none;
    }

    .cata-slider.slick-initialized {
        display: block !important;
    }

    .loadingspinner {
        pointer-events: none;
        width: 2.5em;
        height: 2.5em;
        border: 0.4em solid transparent;
        border-color: #eee;
        border-top-color: #3E67EC;
        border-radius: 50%;
        animation: loadingspin 1s linear infinite;
        margin: auto;
    }


    @keyframes loadingspin {
        100% {
            transform: rotate(360deg);
        }
    }
</style>
<?php
$brand_sql = "SELECT brands FROM listing WHERE brands<>'' and brands<>'[]'";
$brand_result = $this->crud_model->get_by_query($brand_sql);

$f_product_sql = "SELECT i.* FROM inventory i INNER JOIN listing l ON l.id=i.listing_id WHERE (l.is_featured=1 OR
i.is_featured=1)
AND i.availability=1";
$f_product_result = $this->crud_model->get_by_query($f_product_sql);

$f_sevice_sql = "SELECT b.* FROM service b LEFT JOIN listing l ON l.id=b.listing_id WHERE (l.is_featured=1 
    OR b.is_featured=1)  
AND b.name<>''";
$f_service_result = $this->crud_model->get_by_query($f_sevice_sql);
//echo '<pre>';
//print_r($f_product_result);
//echo '</pre>';exit;

?>


<div class="all_cata_gory all-category-fields">
    <div class="loadingspinner"></div>
    <div class="cata-slider">
        <div class="cata-wrap">
            <a href="<?= base_url().'home/category' ?>">

                <div class="cat-icon">
                   <img class="img img-responsive" src="assets/frontend/images/cat-icon.png">
                   <h5>All Categories</h5>
               </div>
           </a>
       </div>
       <?php
       $this->db->limit(12);
       $categories = $this->db->get_where('category', array('parent' => 0))->result_array();
       foreach ($categories as $key => $category):
          //  $count = $this->crud_model->get_listing_count_from_category($category['id']);
        ?>
        <div class="cata-wrap">
            <a href="<?php echo site_url('home/filter_listings?category='.slugify($category['name']).'&&amenity=&&video=0&&status=all'); ?>">
                <div class="cata_inside_wrap">
                    <div class="cata-img">
                        <img class="img img-responsive" src="<?php echo base_url('uploads/category_thumbnails/').$category['thumbnail'];?>">

                    </div>
                    <div class="cata-des cat-description"><?php echo $category['name']; ?></div>
                </div>

            </a>
        </div>
    <?php endforeach; ?>
</div>
</div>
<section class="fst-home hero_single version_2" style="background: #222 url(<?php echo base_url('uploads/system/home_banner.jpg'); ?>) center center no-repeat; background-size: cover;">
    <div class="wrapper">
      <div class="container">
         <h3><?php echo get_frontend_settings('banner_title'); ?>!</h3>
         <p><?php echo get_frontend_settings('slogan'); ?></p>
        <form action="<?php echo site_url('home/search'); ?>" method="get">
            <div class="row no-gutters custom-search-input-2">
               <div class="col-lg-4">
                  <div class="form-group">
                     <input class="form-control" type="text" name="search_string" placeholder="<?php echo get_phrase('what_are_you_looking_for'); ?>...">
                     <i class="icon_search"></i>
                 </div>
               </div>
                <div class="col-lg-3">
                <select class="wide select2"  name="selected_category_id">
                        <option value=""><?php echo get_phrase('all_categories'); ?></option>
                        <?php
                        $categories = $this->crud_model->get_categories()->result_array();
                        foreach ($categories as $category):?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <input type="text" id="searchPlaces" placeholder="type a place..">
                   
                </div>
                <div class="col-lg-2">
                    <input type="submit" value="<?= get_phrase('search'); ?>">
                </div>
            </div>
    <!-- /row -->
        </form>
        </br>
    <?php

    if ($this->session->userdata('is_logged_in') != 1){
        $link= site_url('home/login');
    }
    else
    {
        $link= base_url(strtolower($this->session->userdata('role')).'/dashboard');
    }

    ?>
    <a href="<?= $link ?>" class="btn_1  rounded">Register My Business</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <!--<a href="<?= $link ?>" class="btn_1 rounded">Help A Local Business Get Registered</a>-->


        </div>
    </div>
</section>
<!-- /hero_single -->

<div class="bg_color_1 hm-full-sec">
    <!-- /container -->
    <div class="container-fluid margin_80_55 parral-scroll">
        <div class="main_title_2">
            <span><em></em></span>
            <h2>Featured Listings</h2>
        </div>

        <div class="owl-carousel owl-theme mb-5">
        <?php // $listing_number = 0; ?>
        <?php $listings = $this->frontend_model->get_top_ten_listings();
        foreach ($listings as $key => $listing): ?>
            <div class="item mx-4 text-center">
                <a href="<?php echo get_listing_url($listing['id']); ?>"><img src="<?php echo base_url('uploads/listing_thumbnails/'.$listing['listing_thumbnail']); ?>" class="" alt="" width="400" height="266"><div class="read_more"><span>Read more</span></div></a>
                <small class="category"><?php echo $listing['listing_type'] == "" ? ucfirst(get_phrase('general')) : ucfirst(get_phrase($listing['listing_type'])) ; ?></small>
                <div class="strip grid strip-alignment">
                    <div class="wrapper my-wrapper-1">
                        <h3>
                            <a href="<?php echo get_listing_url($listing['id']); ?>" class="float-left"><?php echo $listing['name']; ?></a>
                            <?php $claiming_status = $this->db->get_where('claimed_listing', array('listing_id' => $listing['id']))->row('status'); ?>
                            <?php if($claiming_status == 1): ?>
                                <img class="float-left ml-1" data-toggle="tooltip" title="<?php echo get_phrase('this_listing_is_verified'); ?>" src="<?php echo base_url('assets/frontend/images/verified.png'); ?>" style="width: 25px;">
                            <?php endif; ?>
                        </h3>
                        <br>
                        <p class="mt-1 paragrapg-alignment"><?php echo substr($listing['description'], 0, 100) . '...'; ?>.</p>
                            <div class="city-name">
                                <span><?php echo $listing['city_name'] ?>, <?php echo $listing['country_name'] ?></span>
                            </div>
                    </div>

                    <ul>
                        <!-- <li><span class="loc_open"><?php echo now_open($listing['id']); ?></span></li> -->
                        <li><span class="<?php echo strtolower(now_open($listing['id'])) == 'closed' ? 'loc_closed' : 'loc_open'; ?>"><?php echo now_open($listing['id']); ?></span></li>
                        <li><div class="score"><span>
                            <?php
                            if ($this->frontend_model->get_listing_wise_rating($listing['id']) > 0) {
                            $quality = $this->frontend_model->get_rating_wise_quality($listing['id']);
                            echo $quality['quality'];
                        }else {
                            echo get_phrase('unreviewed');
                        }
                        ?>
                        <em><?php echo count($this->frontend_model->get_listing_wise_review($listing['id'])).' '.get_phrase('reviews'); ?></em></span><strong><?php echo $this->frontend_model->get_listing_wise_rating($listing['id']); ?></strong></div></li>
                    </ul>
                </div>

            </div>
        <?php endforeach; ?>    
        
        </div>
        <!-- /carousel -->
        <div class="container">
            <div class="btn_home_align" style="text-align: center;"><a href="<?php echo site_url('home/listings'); ?>" class="btn_1 rounded"><?php echo get_phrase('view_all'); ?></a></div>
        </div>
        <!-- /container -->
    </div>

    <!-- FEATURED PRODUCTS START -->
    <section class="pdt-feat-1 featured-product">
        <div class="main_title_2 dl-titl">
            <h2>Featured Products</h2>
            <div class="ex-btn">
                <a target="_blank" href="<?= base_url() ?>home/featured_product">View All</a>
            </div>
        </div>
        <div class="">
            <div class="owl-carousel owl-carousel-3">
            <?php            
                if(!empty($f_product_result)):
                    foreach ($f_product_result as $f_product): ?>
                <div class="item">
                    <div class="pdt-bx-wrap">
                        <div class="pop_up_">
                            <div class="popup popupsInfoabc" onclick="showproducts(<?= $f_product['id'] ?>)"><i class="fas fa-info"></i>
                                <span class="popuptext" id="999<?= $f_product['id'] ?>"><?= $f_product['details'] ?></span>
                            </div>
                        </div>
                    </div>        
                    <a href="<?php echo get_listing_url($f_product['listing_id']); ?>?inventory_category=<?= $f_product['category_id'] ?>" target="_blank">
                        <div class="pdt-bx-img">
                            <div class="pdt-pd blur_image">
                                <img class="img img-responsive"  src="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>">
                                <h5 style="font-size: 15px;"><?=$f_product['name'];  ?></h5>
                                    <div class="w-100 text-right">
                                        <span>RS <?=$f_product['price'];  ?></span>
                                    </div>    
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach;
                endif;
                ?>            
            </div>
        </div>

    </section>
    <!-- FEATURED PRODUTCS END -->

    <!-- BRANDS START -->
    <div class="slick_div slikk-deal" style="display:None">
        <div class="main_title_2 dl-titl">
            <!-- <span><em></em></span> -->
            <h2>Brands We Recommend</h2>
        </div>
        <div class="slick_items brandy-slider">
            <?php if(!empty($brand_result)) :
                foreach ($brand_result as $br_result):
                    // print_r($br_result);exit;
                    $brand_array = json_decode($br_result['brands']);
                    foreach ($brand_array as $br_key=>$br_value):
                    //     echo $br_value;exit;
                        ?>
                        <div>
                            <div class="slikimg-img">
                                <img style="" class="" data-lazy="<?php echo base_url('uploads/brand_images/'.$br_value); ?>">
                            </div>
                           <p class="font-weight-bold mt-3 text-alignment text-center"><?php echo $br_key ?></p>
                        </div>
                        <?php
                    endforeach;
                endforeach;
            endif; ?>
        </div>
    </div>
    <!-- BRANDS END -->

    <!-- FEATURED SECTION START -->
    <section class="pdt-feat-1 featured-section" id="feat_serv__" style="padding-bottom: 30px;">
        <div class="main_title_2 dl-titl">
            <h2>Featured Services</h2>
            <div class="ex-btn">
                <a target="_blank" href="<?= base_url() ?>home/featured_service">View All</a>
            </div>
        </div>
            <div class="owl-carousel owl-theme">
                <?php
                if(!empty($f_service_result)):
                    foreach ($f_service_result as $f_service): ?>
                    <div class="item">
                        <div class="pdt-bx-wrap small_scrn_pdt pdt-bx-wraps">
                            <div class="pop_up_">
                                <div class="popup popupsInfo " onclick="showServices(<?= $f_service['id'] ?>)"><i class="fas fa-info"></i>
                                    <span class="popuptext" id="888<?= $f_service['id'] ?>">
                                        <?php echo $f_service['description'].'</br>';
                                        if(!empty($f_service['price'])){?>
                                        RS.<?= $f_service['price'] ?>
                                        <?php } else { ?>

                                        <?php } ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo get_listing_url($f_service['listing_id']); ?>?service=<?=$f_service['id']?>" target="_blank" id="blur_image">
                            <div class="pdt-bx-img">
                                <div class="pdt-pd">
                                    <img class="img img-responsive" src="<?= base_url() ?>uploads/service_images/<?=$f_service['photo']  ?>">
                                    <h5 style="font-size: 15px;"><?= $f_service['name'] ?></h5>
                                </div>
                            </div>
                        </a>    
                    </div>
                    <?php endforeach;
                endif;
                ?>
            </div>
        </section>

    </section> 
    <!-- FEATURED SECTION END -->

<style type="text/css">
    .product_img{
        padding-top: 5px;
        /*margin-left: 5px;*/
    }
    .product_img img{

        border:1px solid grey;
        border-radius: 5px;
        width: 200px; 
    }
    .xzoom{
        width: 100% !important;
    }
    .xzoom-1{
        width: 100% !important;
    }
</style>
<!-- The Modal -->
<?php
if(!empty($f_product_result)):
    foreach ($f_product_result as $f_product): ?>
<div id="myModal-<?= $f_product['id'] ?>" class="modal">
  <span class="close">&times;</span>


  <div class="modal-content">
        <div class="row">
            <div class="col-lg-7">
                <img id="xzoom" class="xzoom" src="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>" xoriginal="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>" />
                <p><br></p>

                <div class="row">
                    <!-- <?php if(!empty($f_product['thumbnail'])){?>
                        <input type="hidden" id="image-thumb" value="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>" />
                        <div class="col-lg-3 col-md-3 col-3">
                            <img class="img img-responsive thumb" id="image-thumbs" src="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>" xpreview="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>" style="width:100%">
                        </div>
                        <?php } ?> 
                        <?php if(!empty($f_product['thumbnail_2'])){?>
                        <div class="col-lg-3 col-md-3 col-3">
                            <img class="img img-responsive thumb" id="second_image"  src="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail_2'];  ?>" style="width:100%">
                        </div>
                        <?php } ?> 

                        <?php if(!empty($f_product['thumbnail_3'])){?>
                        <div class="col-lg-3 col-md-3 col-3">
                            <img class="img img-responsive thumb" id="second_image1" src="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail_3'];  ?>" style="width:100%">
                        </div>
                        <?php } ?> 

                        <?php if(!empty($f_product['thumbnail_4'])){?>
                        <div class="col-lg-3 col-md-3 col-3">
                            <img class="img img-responsive thumb" id="second_image2"  src="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail_4'];  ?>" style="width:100%">
                        </div>
                        <?php } ?> 

                        <?php if(!empty($f_product['thumbnail_5'])){?>
                        <div class="col-lg-3 col-md-3 col-3">
                            <img class="img img-responsive thumb" id="second_image3" src="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail_5'];  ?>" style="width:100%"+>
                        </div>
                        <?php } ?> -->
                </div>
                  
            </div>
            <div class="col-lg-5 d-flex align-items-center justify-content-center">
                <div class="d-flex flex-column">
                    <?php if(!empty($f_product['name'])){?>
                        <div class="d-flex">
                            <div class="font-weight-bold">Name:</div>
                            <div class="ml-4"><?php echo $f_product['name']?></div>
                        </div>
                    <?php } ?>
                    
                    <?php if(!empty($f_product['details'])){?>    
                        <div class="d-flex">
                            <div class="font-weight-bold">Details:</div>
                            <div class="ml-4"><?php echo $f_product['details']?></div>
                        </div>
                    <?php } ?>    
                    
                    <?php if(!empty($f_product['color'])){?>    
                        <div class="d-flex">
                            <div class="font-weight-bold">Color:</div>
                            <div class="ml-4"><?php echo $f_product['color']?></div>
                        </div>
                    <?php } ?>
                    
                    <?php if(!empty($f_product['brand'])){?>    
                        <div class="d-flex">
                            <div class="font-weight-bold">Brand:</div>
                            <div class="ml-4"><?php echo $f_product['brand']?></div>
                        </div>
                    <?php } ?>
                        
                    <?php if(!empty($f_product['size_specification'])){?>    
                        <div class="d-flex">
                            <div class="font-weight-bold">Size Specification:</div>
                            <div class="ml-4"><?php echo $f_product['size_specification']?></div>
                        </div>
                    <?php } ?>
                    
                    <?php if(!empty($f_product['weight_specification'])){?>    
                        <div class="d-flex">
                            <div class="font-weight-bold">Weight Specification:</div>
                            <div class="ml-4"><?php echo $f_product['weight_specification']?></div>
                        </div>
                    <?php } ?>
                    
                    <?php if(!empty($f_product['availability'])){?>    
                        <div class="d-flex">
                            <div class="font-weight-bold">Availability:</div>
                            <div class="ml-4"><?php echo $f_product['availability']?></div>
                        </div>
                    <?php } ?>
                    <?php if(!empty($f_product['price'])){?>    
                        <div class="d-flex">
                            <div class="font-weight-bold">Price:</div>
                            <div class="ml-4">RS: <?php echo $f_product['price']?></div>
                        </div>
                    <?php } ?>   
                </div>
            </div>  
        </div>
  </div>
</div>

<?php endforeach;
    endif;
?>  

<?php     

if(!empty($f_service_result)):
    foreach ($f_service_result as $f_product): ?>
<div id="serviceModal-<?= $f_product['id'] ?>" class="modal" >
  <span class="close">&times;</span>
  <div class="modal-content">
        <div class="row">
            <div class="col-lg-7">
                <?php if(!empty($f_product['photo'])){?>
                    <img class="xzoom-1" src="<?= base_url() ?>uploads/service_images/<?=$f_product['photo'];  ?>" xoriginal="" />
                <?php } ?> 
                <p><br></p>
                <div class="row">
                    <!-- <?php if(!empty($f_product['photo'])){?>
                        <div class="col-lg-3 col-md-3 col-3">
                            <img class="img img-responsive thumb3"  src="<?= base_url() ?>uploads/service_images/<?=$f_product['photo'];  ?>" style="width:100%">
                        </div>
                    <?php } ?> 
                    
                    <?php if(!empty($f_product['photo_2'])){?>
                        <div class="col-lg-3 col-md-3 col-3">
                            <img class="img img-responsive thumb3"  src="<?= base_url() ?>uploads/service_images/<?=$f_product['photo_2'];  ?>" style="width:100%">
                        </div>
                    <?php } ?> 

                    <?php if(!empty($f_product['photo_3'])){?>
                        <div class="col-lg-3 col-md-3 col-3">
                            <img class="img img-responsive thumb3"  src="<?= base_url() ?>uploads/service_images/<?=$f_product['photo_3'];  ?>" style="width:100%">
                        </div>
                    <?php } ?> 

                    <?php if(!empty($f_product['photo_4'])){?>
                        <div class="col-lg-3 col-md-3 col-3">
                            <img class="img img-responsive thumb3"  src="<?= base_url() ?>uploads/service_images/<?=$f_product['photo_4'];  ?>" style="width:100%">
                        </div>
                    <?php } ?> 

                    <?php if(!empty($f_product['photo_5'])){?>
                        <div class="col-lg-3 col-md-3 col-3">
                            <img class="img img-responsive thumb3"  src="<?= base_url() ?>uploads/service_images/<?=$f_product['photo_5'];  ?>" style="width:100%"+>
                        </div>
                    <?php } ?>   -->
                </div>
            </div>
            <div class="col-lg-5 d-flex align-items-center justify-content-center">
                <div class="d-flex flex-column">
                    <?php if(!empty($f_product['name'])){?>
                            <div class="d-flex">
                                <div class="font-weight-bold">Name:</div>
                                <div class="ml-4"><?php echo $f_product['name']?></div>
                            </div>
                        <?php } ?> 
                        <?php if(!empty($f_product['description'])){?>
                        <div class="d-flex">
                            <div class="font-weight-bold">Description:</div>
                            <div class="ml-4"><?php echo $f_product['description']?></div>
                        </div>
                    <?php } ?>
                    <?php if(!empty($f_product['service_times'])){?>
                        <div class="d-flex">
                            <div class="font-weight-bold">Service Time:</div>
                            <div class="ml-4"><?php echo $f_product['service_times']?></div>
                        </div>
                    <?php } ?>
                    <?php if(!empty($f_product['price'])){?>
                        <div class="d-flex">
                            <div class="font-weight-bold">Price:</div>
                            <div class="ml-4">RS: <?php echo $f_product['price']?></div>
                        </div>
                    <?php } ?>          
                </div>  
            </div>
      </div>
  </div>
</div>

<?php endforeach;
    endif;
?>  

<!-- End Here -->

<!-- /container -->

<script>
    function activatePlacesSearch(){
        var input = document.getElementById('searchPlaces');
        var autoComplete = new google.maps.places.Autocomplete(input);
        
        
    }
</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-izr7XK6g2OdUqO0nWPDivtlv-xSxu1E&libraries=places&callback=activatePlacesSearch">
</script>
<script type="text/javascript" src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script>

<script>


// x-zoom
$(".xzoom").xzoom();

// var src = document.getElementById("image-thumb").value;
// $(".xzoom").prop("src",src);
// $(".xzoom, .xzoom-gallery").xzoom({
//     magnify: 0
// });

// $('.thumb').click(function(){
//     var vm = this;
//     $(".xzoom").fadeOut(1000,function(){
//         $(this).attr("src",$(vm).attr("src")).fadeIn(1000);
//     });
//     return false;          
// });

$(document).keydown(function(event) { 
  if (event.keyCode == 27) { 
    $('.modal').css('display','none');
  }
});
// x-zoom

// x-zoom 1 

// $(".xzoom-1, .xzoom-gallery-1").xzoom({
    // magnify: 0
// });

// $('.xzoom-gallery-1').click(function(){
	// var vm1 = this;
    // $(".xzoom-1").fadeOut(600,function(){
	//     $(this).attr("src",$(vm1).attr("src")).fadeIn(1000);
    // });

	// return false;

// });

// x-zoom-1

    function showproducts(p_id){
        // $(".xzoom").removeClass("xactive");
        // var src = document.getElementById("image-thumb").value;

        // $(".xzoom").prop("src",src);
        // localStorage.setItem("p_id",p_id);
        // $(".xzoom").prop("src",null);
        // $("#thumb-image1234").prop("src",null);
        // $(".xzoom").xzoom();
        // $( ".thumb" ).click(function(){
        //     var vm = this;
        //     // console.log(vm,'THIS ONE');
        //     $(".xzoom").fadeOut(1000,function(){
        //         $(this).attr("src",$(vm).attr("src")).fadeIn(1000);
        //     });
        //     return false;  
        // });
        // $(".xzoom").xzoom();

        // $(".xzoom").attr("src",$(src).attr("src"));
        // $(".thumb").trigger('click');
        // var image = $("#second_image3").attr("src");
        // console.log(image);
        // document.getElementById('thumb').click();
        $('#myModal-'+p_id).css('display','block');
        
        // $('.xzoom-gallery').removeClass("xactive");

        // var images = $("#thumb-image1234").trigger('click');
        // var img =$("#thumb-image1234").attr("src",images.attr("src"))
        // var img = $("#thumb-image1234").prop("src",images.attr("src"));
        // console.log(images);
        // console.log(img);
        // });
        // console.log(images);
        // var modal = $(this);
        // console.log(modal);
        // $('#myModal-'+p_id).modal({
        //     refresh: true
        // });
        // window.location.reload();
    }
    $('.close').click(function(){
        
        $(this).parent().css('display','none');
        // var src = document.getElementById("image-thumb").value;
        // console.log(src);
        // $(".xzoom").prop("src","<?= base_url() ?>uploads/about_2.jpg?>");
        // $(".xzoom").prop("src",src);
        // $("#thumb-image1234").prop("src",null);
    });

    function showServices(p_id){
        $('#serviceModal-'+p_id).css('display','block');
    }

    $('.owl-carousel').owlCarousel(
        {
            autoPlay: true,
            items : 4,
            itemsDesktop : [1199,4],
            itemsDesktopSmall : [979,3],
            itemsMobile : [767,1],
            center: true,
            navigation:true,
            navigationText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            // navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                items: 1
                },
                600: {
                items: 1
                },
                1000: {
                items: 1
                }
            }
        });

    

// OWL CARUSEL


</script>