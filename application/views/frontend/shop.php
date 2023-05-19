<?php

$inventory_categories = $this->db->get_where('inventory_category', ['listing_id' => $listing_details['id']])->result_array();

if (count($inventory_categories) > 0) {
  $default_inventory_category_id = (isset($inventory_category_id) && $inventory_category_id != null) ? $inventory_category_id : $inventory_categories[0]['id'];
  // $inventories = $this->db->get_where('inventory', ['listing_id' => $listing_details['id'], 'availability' => 1, 'category_id' => $default_inventory_category_id])->result_array();

  $inventories = $this->db->get_where('inventory', ['listing_id' => $listing_details['id'], 'availability' => 1])->result_array();
}else{
  $default_inventory_category_id = null;
  $inventories = array();
}

// GET CART ITEMS
$cart_items = $this->db->get_where('shopping_cart', array('user_id' => $this->session->userdata('user_id'), 'listing_id' => $listing_details['id']))->result_array();
$query = $this->db->select('inventory_id')->where(array('user_id' => $this->session->userdata('user_id'), 'listing_id' => $listing_details['id']))->get('shopping_cart')->result_array();
$inventory_id_in_cart = array();
foreach ($query as $row) {
  if(!in_array($row['inventory_id'], $inventory_id_in_cart)){
    array_push($inventory_id_in_cart, $row['inventory_id']);
  }
}

// SELECT SUMMATION OF THE CART ITEMS
$total_amount = $this->db->select_sum('price')->where(array('user_id' => $this->session->userdata('user_id'), 'listing_id' => $listing_details['id']))->get('shopping_cart')->row()->price;
$total_amount = $total_amount > 0 ? $total_amount : 0;
?>

<link type="text/css" rel="stylesheet" media="all" href="https://unpkg.com/xzoom/dist/xzoom.css" />

<style type="text/css">
  /*--------------------------------------------------------------
# Categories
--------------------------------------------------------------*/
.why-us .content {
  padding: 60px 100px 0 100px;
}

.why-us .content h3 {
  font-weight: 400;
  font-size: 34px;
  color: #37517e;
}

.why-us .content h4 {
  font-size: 20px;
  font-weight: 700;
  margin-top: 5px;
}

.why-us .content p {
  font-size: 15px;
  color: #848484;
}

.why-us .img {
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center center;
}

.why-us .accordion-list {
  /*padding: 0 100px 60px 100px;*/
}

.why-us .accordion-list ul {
  padding: 0;
  list-style: none;
}

.why-us .accordion-list li + li {
  margin-top: 15px;
}

.why-us .accordion-list li {
  padding: 20px;
  background: #fff;
  border-radius: 4px;
}

.why-us .accordion-list a {
  display: block;
  position: relative;
  font-family: "Poppins", sans-serif;
  font-size: 16px;
  line-height: 24px;
  font-weight: 500;
  padding-right: 30px;
  outline: none;
}

#accordion-list-6{
  margin-top:30px;
}
.why-us .accordion-list span {
  color: #000;
  font-weight: 600;
  /* font-size: 18px;
  padding-right: 10px; */
}

.why-us .accordion-list i {
  font-size: 24px;
  position: absolute;
  right: 0;
  top: 0;
}

.why-us .accordion-list p {
  margin-bottom: 0;
  padding: 10px 0 0 0;
}

.why-us .accordion-list .icon-show {
  display: none;
}

.why-us .accordion-list a.collapsed {
  color: #343a40;
}

.why-us .accordion-list a.collapsed:hover {
  color: #47b2e4;
}

.why-us .accordion-list a.collapsed .icon-show {
  display: inline-block;
}

.why-us .accordion-list a.collapsed .icon-close {
  display: none;
}

@media (max-width: 1024px) {
  .why-us .content, .why-us .accordion-list {
    padding-left: 0;
    padding-right: 0;
  }
}

@media (max-width: 992px) {
  .why-us .img {
    min-height: 400px;
  }
  .why-us .content {
    padding-top: 30px;
  }
  .why-us .accordion-list {
    padding-bottom: 30px;
  }
}

@media (max-width: 575px) {
  .why-us .img {
    min-height: 200px;
  }
}

</style>

<!-- SHOW ORDER CONFIRMATION MESSAGE -->
<?php if ($this->session->flashdata('is_order_confirmed')):?>
<?php include 'order_confirmation.php'; ?>
<?php else: ?>
  <!-- SHOP PRODUCTS -->
  <div class="display-products" style ="display:none;">
    <h5 class="add_bottom_15 abt-titl"><?php echo get_phrase('shop_products'); ?></h5>
    <form class="" action="<?php echo site_url($listing_details['listing_type'].'/'.slugify($listing_details['name']).'/'.$listing_details['id']); ?>" method="get">
      <div class="row shp_row_" style="display:none;margin-bottom: 30px; margin-top: 30px;">
        <div class="col-md-3" style="padding: 0px;">
          <label style="background: #34373f;
        font-size: 20px;
        color: #fff;
        font-weight: 600;
        background:red;
        /*border: 1px solid #08c;*/
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0px 15px;" for="inventory_category"><?php echo get_phrase('categories'); ?></label>
        </div>
        <div class="col-md-7" style="padding: 0px;">
          <div class="form-group clearfix">
            <div class="custom-select-form">
              <select class="wide" name="inventory_category">
                <option value=""><?php echo get_phrase('inventory_category'); ?></option>
                <?php foreach ($inventory_categories as $inventory_category): ?>
                  <option value="<?php echo sanitizer($inventory_category['id']); ?>" <?php if ($default_inventory_category_id == $inventory_category['id']): ?>selected<?php endif; ?>><?php echo sanitizer($inventory_category['name']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-2 shp_btn_btn" style="padding: 0px;">
          <button type="submit" class="btn_1" style="border-radius: 0px;height: 45px;"><?php echo get_phrase('filter'); ?></button>
        </div>
      </div>
    </form>
    <style type="text/css">
      
      
    .pdt-bx-wrap .pop_up_{

      position: relative;
      color: #08c;
      /*left: 10px;*/
      background-color: #08c;
      color: #fff;
      padding: 12px 13px;
      border-bottom-right-radius: 25px;
      /*top: -10px;*/
    }

    .pdt-bx-wrap .pop_up_ .popup {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }

    .pdt-bx-wrap .pop_up_ i{
      font-size: 12px;
    }
    </style>

       <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-12 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="accordion-list">

              <ul>

        <?php foreach ($inventory_categories as $category):
        
        ?>
                <li>
                  <a data-toggle="collapse" class="collapse" href="#accordion-list-<?php echo $category['id'];?>"><span><?php echo $category['name'];?></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-<?php echo $category['id'];?>" class="collapse <?php if(!empty($_GET['inventory_category']) && $_GET['inventory_category']==$category['id']){ echo "show";}?>" data-parent=".accordion-list">
                    <div class="row">
                        <?php
                         foreach ($inventories as $inventory):
                          $inventory_item_wise_cart_details = $this->db->get_where('shopping_cart', array('user_id' => $this->session->userdata('user_id'), 'listing_id' => $listing_details['id'], 'inventory_id' => $inventory['id']))->row_array();
                          $quantity = $inventory_item_wise_cart_details['quantity'];

                          if($category['id'] == $inventory['category_id']){ 
                          ?>
                          <div class="col-lg-4 col-md-12">
                            <ul class="menu_list">
                              <li>
                                <div class="row">
                                  
                                  <div class="pdt-bx-wrap">
                                      <div class="pop_up_">
                                          <div class="popup popupsInfoabc" onclick="showproducts(<?= $inventory['id'] ?>)"><i class="fas fa-info"></i>
                                            
                                          </div>
                                      </div>
                                  </div>  
                                  
                                  <div class="col-md-6">

                                    
                                    <!-- <div class="thumb"> -->
                                    <div class="">
                                      <img src="<?php echo base_url('uploads/shop/'.$inventory['thumbnail']); ?>" alt="" style="height: 88px; width: 88px;">
                                    </div>
                                  </div>

                                  <div class="col-md-5">
                                    <h6 style="font-size: 18px;padding-bottom: 8px; text-transform: uppercase;border-bottom: 0;text-align: right"><?php echo sanitizer($inventory['name']); ?> </h6>
                                    <h6 style="font-size: 18px;padding-bottom: 8px; text-transform: uppercase;border-bottom: 0;text-align: right"><span style="font-weight: 600;"><?php echo currency($inventory['price']); ?> </span></h6>
                                  </div>
                                </div>

                                <div class="col-md-12">
                                  <div class="mb-1" style="margin-top: 20px;margin-bottom: 20px !important; font-size: 16px;">
                                    <?php echo sanitizer($inventory['details']); ?>
                                  </div>
                                </div>
                             

                                <div class="row">
                                  <div class="col-md-10">
                                    <input class="form-control form-control-sm cart-input" type="number" placeholder="<?php echo get_phrase('quantity'); ?>" name="quantity" id="quantity-<?php echo sanitizer($inventory['id']); ?>" min="1" value="<?php echo sanitizer($quantity); ?>" onchange="cartHandler('<?php echo sanitizer($inventory['id']); ?>')">
                                  </div>
                                  <div class="col-md-2 invnt_btn_">
                                    <input class="form-control form-control-sm cart-input" type="checkbox" name="" id="cart-btn-<?php echo sanitizer($inventory['id']); ?>" onchange="cartHandler('<?php echo sanitizer($inventory['id']); ?>')" <?php if(in_array($inventory['id'], $inventory_id_in_cart)) echo "checked"; ?>>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        <?php } ?>
                        <?php   endforeach; ?>
                      </div>
                  </div>
                </li>

        <?php endforeach; ?>

        

              </ul>
            </div>

          </div>

        </div>

      </div>
      <style type="text/css">
    .product_img{
        padding-top: 5px;
        /*margin-left: 5px;*/
    }
    .product_img img{

        border:1px solid grey;
        border-radius: 5px;
        width: 200px;
        height: 200px;
        
    }
</style>
<!-- The Modal -->
<?php     

if(!empty($inventories)):
    foreach ($inventories as $f_product): ?>
<div id="myModal-<?= $f_product['id'] ?>" class="modal" >
  <span class="close">&times;</span>


  <div class="modal-content">
        <div class="row">
        <div class="col-lg-7">
                <img id="xzoom" class="xzoom" src="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>" xoriginal="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>" style="width:100%"/>
                <p><br></p>

                <div class="row">
                    <?php if(!empty($f_product['thumbnail'])){?>
                        <input type="hidden" id="image-thumb" value="<?= base_url() ?>uploads/shop/<?=$f_product['thumbnail'];  ?>" >
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
                        <?php } ?>
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
    </section><!-- End Why Us Section -->
    <div class="row justify-content-center">
      <div class="col-md-4">
        <?php if ($total_amount > 0): ?>
          <button type="submit" class="btn_1 full-width" id="order-btn" onclick="showCheckout()"><?php echo get_phrase('confirm_order').'('.currency($total_amount).')'; ?></button>
        <?php else: ?>
          <button type="submit" class="btn_1 full-width" id="order-btn" onclick="showCheckout()"><?php echo get_phrase('order'); ?></button>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- CHECKOUT PORTION -->
  <div class="checkout">

  </div>
<?php endif;?>
<script type="text/javascript" src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script>
<script type="text/javascript">

  // x-zoom
$(".xzoom").xzoom();

// var src = document.getElementById("image-thumb").value;
// $(".xzoom").prop("src",src);
// $(".xzoom, .xzoom-gallery").xzoom({
//     magnify: 0
// });

$('.thumb').click(function(){
    var vm = this;
    $(".xzoom").fadeOut(1000,function(){
        $(this).attr("src",$(vm).attr("src")).fadeIn(1000);
    });
    return false;          
});

$(document).keydown(function(event) { 
  if (event.keyCode == 27) { 
    $('.modal').css('display','none');
  }
});

  function showproducts(p_id){
    // console.log("Hello Bhai")
    $('#myModal-'+p_id).css('display','block');  
  }
    $('.close').click(function(){

        $(this).parent().css('display','none');
        $(".xzoom").prop("src","<?= base_url() ?>uploads/about_2.jpg?>");

    });
function cartHandler(inventoryId) {
  var addedToCart = 0;
  var quantity = $('#quantity-' + inventoryId).val();
  if ($('#cart-btn-' + inventoryId).is(":checked")) {
    addedToCart = 1;
    quantity = quantity > 0 ? $('#quantity-' + inventoryId).val() : 1;
    $('#quantity-' + inventoryId).val(quantity);
  }
  makeOrder(addedToCart, inventoryId, quantity);
}

function makeOrder(addedToCart, inventoryId, quantity) {
  $(".cart-input").prop('disabled', true);
  $.ajax({
    type: "post",
    url: "<?php echo site_url('addons/shop/cart_handler'); ?>",
    data: {addedToCart : addedToCart, inventoryId : inventoryId, quantity : quantity},
    success: function(response){
      if(response === "false"){
        toastr.error("<?php echo get_phrase('login_first'); ?>");
      }else if (response === "") {
        $('#order-btn').html('<?php echo get_phrase('order') ?>');
      }else{
        $('#order-btn').html('<?php echo get_phrase('confirm_order') ?> (' + response + ')');
      }
      $(".cart-input").prop('disabled', false);
    }
  });
}

function showCheckout() {
  toastr.warning("<?php echo get_phrase('order_processing'); ?>");
  $.ajax({
    type: "post",
    url: "<?php echo site_url('addons/shop/show_checkout'); ?>",
    data: {listingId : '<?php echo sanitizer($listing_details['id']); ?>'},
    success: function(response){
      if(response === "false"){
        toastr.error("<?php echo get_phrase('you_have_not_added_any_product_yet'); ?>");
      }else{
        $(".display-products").hide();
        $(".checkout").html(response);
      }
    }
  });
}
</script>
