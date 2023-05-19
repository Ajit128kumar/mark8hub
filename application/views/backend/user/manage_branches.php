<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>
<?php
$listing_details= array();
$listing_details['name']= '';

if(!empty($listing_id)){
    $listing_details = $this->crud_model->get_listings($listing_id)->row_array();
}


?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo get_phrase('update').': '.$listing_details['name']; ?>
				</div>
			</div>
			<div class="panel-body">
                <div class="col-md-12">
                <form action="<?= base_url() ?>user/manage_branches" method="post">
                    <table class="table table-striped">
                        <tr>
                            <th> <select name="listing_id" class="form-control select2" required>
                                    <option value="">Select Directory</option>
                                    <?php foreach ($listings as $list): ?>
                                        <option value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
                                    <?php endforeach; ?>
                                </select></th>
                            <!-- <th> <input type="submit" class="btn btn-success" value="search" name="submit"></th> -->
                        </tr>
                    </table>


                </form>
                </div>

          				<!-- <form action="<?php //echo base_url() ?>user/update_branches" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered listing_edit_form"> -->
          				<div class="col-md-12">

                    <div class="row">
                      <div class="col-md-12">
                        <div class="pull-right search" style="margin-bottom: 10px;">
                            <form>
                                
                                <div class="form-group">
                                   <!--  <label class="col-sm-2 control-label"> Search:</label> -->
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Search by Name" required name="search">
                                        <input type="hidden" id="listing_id">
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>

                    <div id="viewall-data">
                      
                    </div>
                            <?php //include 'branch_form_for_editing.php'; ?>
                              <!-- <div class="text-center">
                                  <br>
                                   <input type="hidden" name="listing_id_update" value="<?= $listing_id ?>">
                                  <input type="submit" class="btn btn-primary" name="submit_update"  value="<?php //echo get_phrase('submit'); ?>" onclick="this.form.submit()" >
                              </div> -->




          				</div>
          				</form>
            </div>
		</div>
	</div><!-- end col-->
</div>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script> -->

<script type="text/javascript">
  
  $('select[name="listing_id"]').change(function(){
      var listing_id = $(this).val();
     
      $.ajax({
          type: "POST",
          url: "<?php echo base_url('User/getTheBranchesData');?>",
          data:{listing_id:listing_id},
          beforeSend: function(){
            $('#viewall-data').addClass('loader');
          },
          success: function(data){

            // alert(data);
            $('#listing_id').val(listing_id);
            $('#viewall-data').removeClass('loader');
            $("#viewall-data").html(data);
          },
          // complete: function (data) {

            
          //       // viewAllStudentsData();
                
          //   }
      });
  });



$(document).ajaxComplete(function() {
  
    // Search

     $('input[name="search"]').keyup(function(){

        var keyword = $(this).val();
        var listing_id = $('#listing_id').val();
        
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('User/getTheBranchesData');?>",
          data: {keyword:keyword,listing_id:listing_id},
          beforeSend: function(){
            $('#viewall-data').addClass('loader');
          },
          success: function(data){
           
            $('#viewall-data').removeClass('loader');
            $("#viewall-data").html(data);
            // search();
          }
      });
    });

      

     // showListingTypeForm('<?php //echo $listing_details['listing_type']; ?>');





    



    // var marker = L.marker(mapCenter).addTo(map);
    // var updateMarker = function(lat, lng) {
    //     marker
    //         .setLatLng([lat, lng])
    //         .bindPopup("Your location :  " + marker.getLatLng().toString())
    //         .openPopup();
    //     return false;
    // };

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

    
    
       //new fn

$(document).on("change", "#city_id", function (){
    var  city_id = $("#city_id").val();
    //  alert(city_id);
    param = {};
    param.city_id = city_id;
    $.ajax({
        url: "<?= base_url()?>Admin/getCityName",
        method: "POST",
        data: param,
        success: function (data) {
            var obj = JSON.parse(data);
            var city = obj.city;
            $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q='+city, function(data){
                if(data[0].lat)
                {
                    if(data[0].lon) {
                        return updateMarker(data[0].lat, data[0].lon);
                    }
                }

            });

        },
        error: function (error) {
            console.log(JSON.stringify(error));
        }
    });
});

//new fn ends

});
</script>
