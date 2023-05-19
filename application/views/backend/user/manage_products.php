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
                <form action="<?= base_url() ?>user/manage_products" method="post">
                    <table class="table table-striped">
                        <tr>
                            <th> <select name="listing_id" class="form-control select2" required>
                                    <option value="">Select Directory</option>
                                    <?php foreach ($listings as $list): ?>
                                        <option value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
                                    <?php endforeach; ?>
                                </select></th>
<!--                             <th> <input type="submit" class="btn btn-success" value="search" name="submit"></th> -->
                        </tr>
                    </table>
                </form>
                </div>
          <!-- <?php //if(!empty($listing_id)): ?>
          				<form action="<?php //echo base_url() ?>user/update_products" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered listing_edit_form"> -->
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
                            <!-- <?php //include 'product_form_for_editing.php'; ?>
                              <div class="text-center">
                                  <br>
                                   <input type="hidden" name="listing_id_update" value="<?= $listing_id ?>">
                                  <input type="submit" class="btn btn-primary" name="submit_update"  value="<?php //echo get_phrase('submit'); ?>" onclick="this.form.submit()" >
                              </div> -->




          				</div>
          				<!-- </form> -->
			    <?php //endif; ?>
            </div>
		</div>
	</div><!-- end col-->
</div>
<script type="text/javascript">


  $('select[name="listing_id"]').change(function(){
      var listing_id = $(this).val();
      $.ajax({
          type: "POST",
          url: "<?php echo base_url('User/getTheProductsData');?>",
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
          url: "<?php echo base_url('User/getTheProductsData');?>",
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

});  
</script>
