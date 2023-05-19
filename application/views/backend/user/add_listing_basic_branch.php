<div class="form-group">
  <label for="title" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>
  <div class="col-sm-7">
    <input type="text" class="form-control" name="title" id="title" placeholder="<?php echo get_phrase('title'); ?>" required>
  </div>
</div>

<div class="form-group">
  <label for="description" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>
  <div class="col-sm-7">
    <textarea name="description" class="form-control" id="description" rows="8" cols="80"></textarea>
  </div>
</div>
<div class="form-group">
  <label for="featured_type" class="col-sm-3 control-label"><?php echo get_phrase('featured_type'); ?></label>
  <div class="col-sm-7">
    <?php $user_id = $this->session->userdata('user_id'); ?>
    <?php $package_id = has_package($user_id, 'package_id'); ?>
    <?php $featured_status = $this->db->get_where('package', array('id' => $package_id['package_id']))->row('featured'); ?>
    <select name="is_featured" id = "featured_type" class="selectboxit" <?php if($featured_status != 1) echo 'disabled'; ?> required>
      <option value=""><?php echo get_phrase('select_featured_type'); ?></option>
      <option value="1"><?php echo get_phrase('featured'); ?></option>
      <option value="0"<?php if($featured_status != 1) echo 'selected'; ?>><?php echo get_phrase('none_featured'); ?></option>
    </select>
  </div>
</div>
<div class="form-group">
  <label for="google_analytics_id" class="col-sm-3 control-label"><?php echo get_phrase('google_analytics_id'); ?></label>
  <div class="col-sm-7">
    <input type="text" class="form-control" name="google_analytics_id" id="google_analytics_id" placeholder="GA_MEASUREMENT_ID" placeholder="GA_MEASUREMENT_ID">
  </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label" for="category"> <?php echo get_phrase('category'); ?></label>
    <div class="col-sm-7">
        <div id="category_area">
            <div class="row">
                <div class="col-sm-7">
                    <?php
                    $categories = json_decode($parent_listing->categories);

                    foreach ($categories as $category):

                        $category_details = $this->crud_model->get_categories($category)->row_array();?>
                        <span class="badge badge-secondary"><?php echo $category_details['name']; ?></span><br>
                        <input type="hidden" name="categories[]" value="<?= $category_details['id'] ?>" />
                    <?php endforeach; ?>
                </div>
               
            </div>
        </div>


    </div>
</div>

<div class="form-group">
    <label for="google_analytics_id" class="col-sm-3 control-label">Business Type</label>
    <div class="col-sm-7">
        <?php
        switch ($parent_listing->type) {
            case 1:
                $type = 'Product oriented';
                break;
            case 2:
                $type = 'Service oriented';
                break;
            case 3:
                $type = 'Product and service oriented';
                break;
            default:
                $type='';
        }
        echo $type;
        ?>
        <input type="hidden" name="type" value="<?= $parent_listing->type ?>">
    </div>
</div>

<div class="form-group">
    <label for="google_analytics_id" class="col-sm-3 control-label">Business group</label>
    <div class="col-sm-7">
        <?php
        switch ($parent_listing->bgroup) {
            case 1:
                $bgroup = 'Sole trading Concern';
                break;
            case 2:
                $bgroup = 'Partnership firm';
                break;
            case 3:
                $bgroup = 'Joint stock company';
                break;
            case 4:
                $bgroup = 'Corporation';
                break;
            case 5:
                $bgroup = 'Multi National company';
                break;
            case 6:
                $bgroup = 'Franchise';
                break;
            case 7:
                $bgroup = 'NGO/INGO';
                break;
            case 8:
                $bgroup = 'Others';
                break;
            default:
                $bgroup='Not Entered';
        }
        echo $bgroup;
        ?>
        <input type="hidden" name="bgroup" value="<?= $parent_listing->bgroup ?>">
        <input type="hidden" name="listing_type" value="<?= $parent_listing->listing_type ?>">
    </div>
</div>



