<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/slick/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/slick/slick/slick-theme.css"/>
<script type="text/javascript" src="<?= base_url() ?>assets/frontend/slick/slick/slick.min.js"></script>
<?php
$f_sevice_sql = "SELECT b.* FROM service b LEFT JOIN listing l ON l.id=b.listing_id WHERE (l.is_featured=1 
    OR b.is_featured=1) 
    AND b.name<>''";
$f_service_result = $this->crud_model->get_by_query($f_sevice_sql);
?>
<style>
    .pop_up_
    {
        right: 40px !important;
        top: 15px !important;
    }
</style>
<div class="hero_in shop_detail hero_inner_page" style="background: url(../assets/frontend/images/aa.jpeg);) center center no-repeat; background-size: cover;">
    <div class="in_txt" style="margin-top: 0px;">
        <h2>Featured Services</h2>
    </div>
</div>

<section class="pdt-feat-1" id="ft_serv_inner_">
    <div class="container">
    	<div class="row">
            <?php
            if(!empty($f_service_result)):
            foreach ($f_service_result as $f_service): ?>
        <div class="pdt-bx-wrap col-lg-3 col-md-4 col-sm-4">
            <div class="pop_up_">
                <div class="popup" onclick="showServices(<?= $f_service['id'] ?>)"><i class="fas fa-info-circle"></i>
                    <!-- <span class="popuptext" id="888<?= $f_service['id'] ?>">
                        <?php echo $f_service['description'].'</br>';
                        if(!empty($f_service['price'])){?>
                            RS.<?= $f_service['price'] ?>
                        <?php } else { ?>

                        <?php } ?>

                    </span> -->
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
    </div>
</section>








<?php     

if(!empty($f_service_result)):
    foreach ($f_service_result as $f_product): ?>
<div id="serviceModal-<?= $f_product['id'] ?>" class="modal" >
  <span class="close">&times;</span>


  <div class="modal-content">
        <div class="row">
            <div class="col-lg-7">
                <?php if(!empty($f_product['photo'])){?>
                    <img class="img img-responsive" id="xzoom-magnific3" src="<?= base_url() ?>uploads/service_images/<?=$f_product['photo'];  ?>" style="width:100%">
                <?php } ?> 
                <p><br></p>
                    <!-- <div class="row">
                        <?php if(!empty($f_product['photo'])){?>
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
                        <?php } ?>  
                    </div> -->
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


<script src="../js/xzoom.js"></script>
<script type="text/javascript">
    $(document).keydown(function(event) { 
        if (event.keyCode == 27) { 
            $('.modal').css('display','none');
        }
    });
    $('.thumb3').click(function(){
    var vm3 = this;
    $("#xzoom-magnific3").fadeOut(1000,function(){
        $(this).attr("src",$(vm3).attr("src")).fadeIn(1000);
      });
    return false;      
    });
    function showServices(p_id){

        $('#serviceModal-'+p_id).css('display','block');
    }

    $('.close').click(function(){

        $(this).parent().css('display','none');

    });
</script>