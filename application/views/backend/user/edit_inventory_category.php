<?php
$this->db->where('id', $param2);
$inventory_category_details = $this->db->get('inventory_category')->row_array();
// GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
$active_listing_details = $this->crud_model->get_listings($inventory_category_details['listing_id'])->result_array();
?>
<?php if (count($active_listing_details) > 0): ?>
  <form action="<?php echo site_url('addons/shop/inventory_category_form/update'); ?>" method="post">
    <input type="hidden" class="form-control" name="id" value="<?php echo sanitizer($param2); ?>">
    <div class="form-group">
      <label for="name" class="control-label"><?php echo get_phrase('category_title'); ?></label>
      <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo get_phrase('provide_category_name'); ?>" value="<?php echo sanitizer($inventory_category_details['name']); ?>" required>
    </div>
    <button type="submit" name="button" class="btn btn-primary"><?php echo get_phrase('submit'); ?></button>
  </form>
<?php endif; ?>
