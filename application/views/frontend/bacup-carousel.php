<div id="reccomended" class="owl-carousel owl-theme">
    <?php // $listing_number = 0; ?>
    <?php $listings = $this->frontend_model->get_top_ten_listings();
    foreach ($listings as $key => $listing): ?>
        <div class="item">
            <div class="strip grid">
                <figure>
                    <!--redirect to routs file-->
                    <a href="<?php echo get_listing_url($listing['id']); ?>"><img src="<?php echo base_url('uploads/listing_thumbnails/'.$listing['listing_thumbnail']); ?>" class="img-fluid" alt="" width="400" height="266"><div class="read_more"><span>Read more</span></div></a>
                    <small><?php echo $listing['listing_type'] == "" ? ucfirst(get_phrase('general')) : ucfirst(get_phrase($listing['listing_type'])) ; ?></small>
                </figure>
                <div class="wrapper">
                    <h3>
                        <a href="<?php echo get_listing_url($listing['id']); ?>" class="float-left"><?php echo $listing['name']; ?></a>
                        <?php $claiming_status = $this->db->get_where('claimed_listing', array('listing_id' => $listing['id']))->row('status'); ?>
                        <?php if($claiming_status == 1): ?>
                            <img class="float-left ml-1" data-toggle="tooltip" title="<?php echo get_phrase('this_listing_is_verified'); ?>" src="<?php echo base_url('assets/frontend/images/verified.png'); ?>" style="width: 25px;">
                        <?php endif; ?>
                    </h3>
                    <br>
                    <p class="mt-1"><?php echo substr($listing['description'], 0, 100) . '...'; ?>.</p>

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



<!-- Second One -->

<section class="pdt-feat-1">
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
                    <div class="">
                        <div class="">
                            <div class="popup" onclick="myFunction(999<?= $f_product['id'] ?>)"><i class="fas fa-info-circle"></i>
                                <span class="popuptext" id="999<?= $f_product['id'] ?>"><?= $f_product['details'] ?></span>
                            </div>
                        </div>
                    </div>        
                    <a href="<?php echo get_listing_url($f_product['listing_id']); ?>?inventory_category=<?= $f_product['category_id'] ?>" target="_blank">
                        <div class="pdt-bx-img">
                            <div class="pdt-pd">
                                <img class="img img-responsive" src="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>">
                                <h5 style="font-size: 15px;"><?=$f_product['name'];  ?></h5>
                                <!-- <div class="w-100"> -->
                                    <span>RS <?=$f_product['price'];  ?></span>
                                <!-- </div>     -->
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
<!-- End Here -->


<!-- Third One -->

<div class="main_title_2 dl-titl">
        <h2>Featured Services</h2>
        <div class="ex-btn">
            <a target="_blank" href="<?= base_url() ?>home/featured_service">View All</a>
        </div>
    </div>
    <div class="pdt-serv-slide">
        <?php
        if(!empty($f_service_result)):
            foreach ($f_service_result as $f_service): ?>
                <div class="pdt-bx-wrap small_scrn_pdt">
                    <div class="pop_up_">
                        <div class="popup" onclick="myFunction(888<?= $f_service['id'] ?>)"><i class="fas fa-info"></i>
                            <span class="popuptext" id="888<?= $f_service['id'] ?>">

                                <?php echo $f_service['description'].'</br>';
                                if(!empty($f_service['price'])){?>
                                RS.<?= $f_service['price'] ?>
                                <?php } else { ?>

                                <?php } ?>
                            </span>
                      </div>
                  </div>
                    <a href="<?php echo get_listing_url($f_service['listing_id']); ?>?service=" target="_blank">
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
<!-- End Here -->