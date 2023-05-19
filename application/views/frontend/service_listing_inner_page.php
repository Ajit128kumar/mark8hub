<style type="text/css">
    ul.menu_list li{
        padding: 5px 0 25px 12px;
    }
</style>
<?php $new_services = $this->db->get_where('service', array('listing_id' => $listing_details['id']))->result_array(); ?>
<!--<h5>Available Services</h5>-->
<div class="row add_bottom_15">
    <?php foreach ($new_services as $new_service): ?>
        <div class="col-lg-4 col-md-12">

            <ul class="menu_list">

                <li>
                    <div class="row">

                        
                            <div class="pdt-bx-wrap">
                                  <div class="pop_up_">
                                      <div class="popup popupsInfoabc" onclick="showServices(<?= $new_service['id'] ?>)"><i class="fas fa-info"></i>
                                        
                                      </div>
                                  </div>
                            </div>  
                        
                        <div class="col-md-6">
                            <div class="thumb">
                                <img src="<?php echo base_url('uploads/service_images/'.$new_service['photo']); ?>" alt="" style="height: 88px; width: 88px;">
                            </div>
                        </div>
                        <div class="col-md-5">

                            <h6><?php echo $new_service['name']; ?> </h6>
                            <h6><?php echo currency($new_service['price']); ?> (<?php echo ($new_service['negotiable']); ?>) </h6>
                        </div>
                     </div>
                     <div class="row" style="margin-top: 52px;">   
                        <div class="col-md-12">
                            <?php
                                $times = explode(',', $new_service['service_times']);
                                // $time_from = explode(':', $times[0]);
                                // $time_to = explode(':', $times[1]);
                                // if($time_from[0] > 12){
                                //     $hour = $time_from[0] - 12;
                                //     $minute = $time_from[1];
                                //     $starting_time = $hour.':'.$minute.' '.' PM';
                                // }else{
                                //     $starting_time = $times[0].' AM';
                                // }

                                // if($time_to[1] > 12){
                                //     $end_hour = $time_to[0] - 12;
                                //     $end_minute = $time_to[1];
                                //     $ending_time = $end_hour.':'.$end_minute.' '.' PM';
                                // }else{
                                //     $ending_time = $times[1].' AM';
                                // }
                                // echo '<p style="margin-bottom: 5px;">'.$starting_time.' - '.$ending_time.'</p>';
                                $time_from = strtotime($times[0].":00");
                                $time_to   = strtotime($times[1].":00");

                                echo '<p style="margin-bottom: 5px;">'.get_phrase('availability').' : '.date('h:i A', $time_from).' - '.date('h:i A', $time_to).'</p>'; 
                                echo '<p>'.get_phrase('duration').' : '.$times[2].' '.get_phrase('minutes').'</p>'
                            ?>
                        </div>
                    </div>
                    
                    
                    
                </li>
            </ul>
        </div>
    <?php endforeach; ?>
</div>

<?php     

if(!empty($new_services)):
    foreach ($new_services as $f_product): ?>
<div id="serviceModal-<?= $f_product['id'] ?>" class="modal" >
  <span class="close">&times;</span>


  <div class="modal-content">
        <div class="row">
            <div class="col-lg-7">
                <img class="xzoom" id="xzoom" src="<?= base_url() ?>uploads/service_images/<?=$f_product['photo'];  ?>" style="width:100%">
                <p><br></p>
                    <div class="row">
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


<script src="../js/xzoom.js"></script>
<script type="text/javascript">
    // x-zoom
$(".xzoom").xzoom();

// var src = document.getElementById("image-thumb").value;
// $(".xzoom").prop("src",src);
// $(".xzoom, .xzoom-gallery").xzoom({
//     magnify: 0
// });

$('.thumb3').click(function(){
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
    function showServices(p_id){
        // console.log("Hello brother")

        $('#serviceModal-'+p_id).css('display','block');
    }

    $('.close').click(function(){

        $(this).parent().css('display','none');
        $(".xzoom").prop("src","<?= base_url() ?>uploads/about_2.jpg?>");

    });
</script>