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
                <form action="<?= base_url() ?>user/update_listings_branch" method="post">
                    <table class="table table-striped">
                        <tr>
                            <th> <select name="listing_id" class="form-control select2" required>
                                    <option value="">Select Directory</option>
                                    <?php foreach ($listings as $list): ?>
                                        <option value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
                                    <?php endforeach; ?>
                                </select></th>
                            <th> <input type="submit" class="btn btn-success" value="search" name="submit"></th>
                        </tr>
                    </table>
                </form>
                    <?php if(!empty($listing_id)): ?>
                        <a class="btn btn-info" href="<?php echo site_url('user/listing_form/add/'.$listing_id); ?>">Add new branch of <?= $listing_details['name'] ?> <i class="fa fa-plus"></i> </a>
                    <?php
                        $branches = $this->crud_model->get_branches($listing_id);
                         if(!empty($branches)):
                             ?>
                             <table class="table table-borderless table-hover">
                                 <tr>
                                     <th>Branch Name</th>
                                     <th>Location</th>
                                     <th>Status</th>
                                     <th>Option</th>
                                 </tr>
                                 <?php
                                 //   echo $listing_details['id'];exit;

                                 foreach ($branches as $br):
                                    ?>
<tr>
    <td><?= $br['name'] ?></td>
    <td>
        <?php
        $country_details = $this->crud_model->get_countries($br['country_id'])->row_array();
        $city_details = $this->crud_model->get_cities($br['city_id'])->row_array();
        echo $city_details['name'].', '.$country_details['name'];
        ?>
    </td>

    <td class="text-center">
                  <span class="mr-2">
                    <?php if ($br['status'] == 'pending'): ?>
                        <i class="entypo-record" style="color: #FFC107; font-size: 19px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase($br['status']); ?>"></i>
                    <?php elseif ($br['status'] == 'active'):?>
                        <i class="entypo-record" style="color: #4CAF50; font-size: 19px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase($br['status']); ?>"></i>
                    <?php endif; ?>
                  </span>

        <?php $claiming_status = $this->db->get_where('claimed_listing', array('listing_id' => $br['id']))->row('status'); ?>
        <?php if($claiming_status == 1): ?>
            <span class="claimed_icon" data-toggle="tooltip" title="<?php echo get_phrase('this_listing_is_verified'); ?>">
                        <img src="<?php echo base_url('assets/frontend/images/verified.png'); ?>" width="25" style="padding-bottom: 8px;" />
                      </span>
        <?php endif; ?>
    </td>

    <td>
        <div class="bs-example">
            <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <?php echo get_phrase('action'); ?> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-blue" role="menu">
                    <li><a href="<?php echo get_listing_url($br['id']); ?>"><?php echo get_phrase('view_in_website'); ?></a></li>
                    <?php if(get_addon_details('fb_messenger') != 0): ?>
                        <li><a href="<?php echo site_url('addons/facebook_messenger/api_manager/'.$br['id']); ?>"><?php echo get_phrase('facebook_chat_manager'); ?></a></li>
                    <?php endif; ?>


                </ul>
            </div>
        </div>
    </td>
</tr>





                                 <?php
                                 endforeach;
                                 ?>
                             </table>
                    <?php
                             endif;
                    endif; ?>
                </div>

			</div>
		</div>
	</div><!-- end col-->
</div>

