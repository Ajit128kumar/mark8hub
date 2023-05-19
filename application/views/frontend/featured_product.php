<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/slick/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/slick/slick/slick-theme.css"/>
<script type="text/javascript" src="<?= base_url() ?>assets/frontend/slick/slick/slick.min.js"></script>
<?php
$f_product_sql = "SELECT i.* FROM inventory i LEFT JOIN listing l ON l.id=i.listing_id WHERE (l.is_featured=1 OR
    i.is_featured=1)
    AND i.availability=1";
$f_product_result = $this->crud_model->get_by_query($f_product_sql);

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
        <h2>Featured Products</h2>
    </div>
</div>
<section class="pdt-feat-1" id="pd_inner_pg_">

	<div class="container">
		<div class="row">
            <?php foreach ($f_product_result as $fp): ?>
		<div class="pdt-bx-wrap col-lg-3 col-md-4 col-sm-4" style="margin-bottom: 45px;">
            <div class="pop_up_">
                <div class="popup" onclick="showFeatured(<?= $fp['id'] ?>)"><i class="fas fa-info-circle"></i>
                    <!-- <span class="popuptext" id="999<?= $fp['id'] ?>"><?= $fp['details'] ?></span> -->
                </div>
            </div>
			<a href="<?php echo get_listing_url($fp['listing_id']); ?>?inventory_category=<?= $fp['category_id'] ?>" target="_blank">
				<div class="pdt-bx-img">
					<div class="pdt-pd">
						<img class="img img-responsive" src="<?= base_url() ?>uploads/shop/<?=$fp['thumbnail'];  ?>">
						<h5 style="font-size: 15px;"><?= $fp['name'] ?></h5>
						<span>RS <?= $fp['price'] ?></span>
					</div>
				</div>
			</a>
		</div>
		<?php endforeach;  ?>
	</div>
	</div>
</section>

<?php

if(!empty($f_product_result)):
foreach ($f_product_result as $f_product): ?>
<div id="featuredModel-<?= $f_product['id'] ?>" class="modal" >
  <span class="close">&times;</span>

  <div class="modal-content">
        <div class="row">
            <div class="col-lg-7">
                <?php if(!empty($f_product['thumbnail'])){?>
                    <img class="img img-responsive" id="xzoom-magnific3" src="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>" style="width:100%">
                <?php } ?> 
                <p><br></p>
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


<script type="text/javascript">
    $(document).keydown(function(event) { 
        if (event.keyCode == 27) { 
            $('.modal').css('display','none');
        }
    });
    function showFeatured(p_id){

        // console.log(p_id);
        $('#featuredModel-'+p_id).css('display','block');
    }

    $('.close').click(function(){

        $(this).parent().css('display','none');

    });
</script>