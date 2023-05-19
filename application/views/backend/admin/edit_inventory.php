<?php
$inventory_details = $this->db->get_where('inventory', ['id' => $param2])->row_array();
// GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
$active_listing_details = $this->crud_model->get_listings($inventory_details['listing_id'])->result_array();
$inventory_categories = $this->db->get_where('inventory_category', ['listing_id' => $inventory_details['listing_id']])->result_array();
?>
<?php if (count($inventory_details) > 0 && count($active_listing_details) > 0): ?>
  <form action="<?php echo site_url('addons/shop/inventory_form/update'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="id" value="<?php echo sanitizer($param2); ?>">
    <div class="form-group">
      <label for="name" class="control-label"><?php echo get_phrase('name'); ?></label>
      <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo get_phrase('provide_inventory_name'); ?>" value="<?php echo sanitizer($inventory_details['name']); ?>" maxlength="22" required>
      <small class="text-muted"><?php echo get_phrase('it_has_to_be_in').' 22 '.get_phrase('characters'); ?></small>
    </div>
    <div class="form-group">
      <label for="category_id" class="control-label"><?php echo get_phrase('category'); ?></label>
      <select class="form-control" name="category_id" id = "category_id" required>
        <option value=""><?php echo get_phrase('choose_inventory_category'); ?></option>
        <?php foreach ($inventory_categories as $inventory_category): ?>
          <option value="<?php echo sanitizer($inventory_category['id']); ?>" <?php if($inventory_category['id'] == $inventory_details['category_id']) echo "selected"; ?>><?php echo sanitizer($inventory_category['name']); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="details" class="control-label"><?php echo get_phrase('details'); ?></label>
      <textarea name="details" id="details" class="form-control" rows="2" placeholder="<?php echo get_phrase('provide_inventory_short_details'); ?>" maxlength="50" required><?php echo sanitizer($inventory_details['details']); ?></textarea>
    </div>
    <div class="form-group">
      <label for="price" class="control-label"><?php echo get_phrase('price'); ?></label>
      <input type="number" class="form-control" name="price" id="name" placeholder="<?php echo get_phrase('provide_inventory_price'); ?>" min="0" value="<?php echo sanitizer($inventory_details['price']); ?>" required>
    </div>
     <div class="form-group">
          <label for="price" class="control-label">Per</label>
          <input type="text" class="form-control" name="unit" id="unit" placeholder="kilogram/liter/dozen/piece" value="<?php echo sanitizer($inventory_details['unit']); ?>" >
      </div>
    <div class="form-group">
      <label class="control-label"><?php echo get_phrase('upload_product_image'); ?></label>
      <input type="file" name="thumbnail" class="form-control" accept="image/x-png,image/jpeg,image/jpg">
    </div>
    <div class="d-block">
      <label>
        <input type="radio" name="availability" id="availability-1" value="1" <?php if($inventory_details['availability'] == 1) echo "checked"; ?>>&nbsp; <?php echo get_phrase('available'); ?>
      </label>
      <label>
        <input type="radio" name="availability" id="availability-2" value="0" <?php if($inventory_details['availability'] == 0) echo "checked"; ?>>&nbsp; <?php echo get_phrase('not_available'); ?>
      </label>
    </div>
     <div class="d-block">
          <label>
              <input type="radio" name="is_featured" id="is_featured-1" value="0" <?php if($inventory_details['is_featured'] == 0) echo "checked"; ?>>&nbsp; Not Featured
          </label>
          <label>
              <input type="radio" name="is_featured" id="is_featured-2" value="1" <?php if($inventory_details['is_featured'] == 1) echo "checked"; ?>>&nbsp; Featured
          </label>
      </div>
    <button type="submit" name="button" class="btn btn-primary"><?php echo get_phrase('submit'); ?></button>
  </form>
<?php endif; ?>
