<div class="form-group">
  <label for="title" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?> <span style="color:red;">*</span></label>
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
    <select name="is_featured" id = "featured_type" class="selectboxit" required>
      <option value=""><?php echo get_phrase('select_featured_type'); ?></option>
      <option value="1"><?php echo get_phrase('featured'); ?></option>
      <option value="0"><?php echo get_phrase('none_featured'); ?></option>
		</select>
  </div>
</div>
<!--<div class="form-group">-->
<!--  <label for="google_analytics_id" class="col-sm-3 control-label"><?php echo get_phrase('google_analytics_id'); ?></label>-->
<!--  <div class="col-sm-7">-->
<!--    <input type="text" class="form-control" name="google_analytics_id" id="google_analytics_id" placeholder="GA_MEASUREMENT_ID" placeholder="GA_MEASUREMENT_ID">-->
<!--  </div>-->
<!--</div>-->
<!--<div class="form-group">-->
<!--    <label class="col-sm-3 control-label" for="category"> <?php echo get_phrase('category'); ?> <span style="color:red;">*</span></label>-->
<!--    <div class="col-sm-7">-->
<!--        <div id="category_area">-->
<!--            <div class="row">-->
<!--                <div class="col-sm-7">-->
<!--                    <select class="form-control select2" name="categories[]" id = "category_default" required>-->
<!--                        <option value=""><?php echo get_phrase('select_category'); ?></option>-->
<!--                        <?php foreach ($categories as $category): ?>-->
<!--                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>-->
<!--                        <?php endforeach; ?>-->
<!--                    </select>-->
<!--                </div>-->
<!--                <div class="col-sm-2">-->
<!--                    <button type="button" class="btn btn-primary btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="appendCategory()"> <i class="fa fa-plus"></i> </button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div id="blank_category_field">-->
<!--            <div class="row appendedCategoryFields" style="margin-top: 10px;">-->
<!--                <div class="col-sm-7 pr-0">-->
<!--                    <select class="form-control" name="categories[]">-->
<!--                        <option value=""><?php echo get_phrase('select_category'); ?></option>-->
<!--                        <?php foreach ($categories as $category): ?>-->
<!--                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>-->
<!--                        <?php endforeach; ?>-->
<!--                    </select>-->
<!--                </div>-->
<!--                <div class="col-sm-2">-->
<!--                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removeCategory(this)"> <i class="fa fa-minus"></i> </button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<!--<div class="form-group">-->
<!--    <label for="google_analytics_id" class="col-sm-3 control-label">Business type-->
<!--        <span style="color:red;">*</span>-->
<!--    </label>-->
<!--    <div class="col-sm-7">-->
<!--     <select name="type" id="lis_type" class="selectboxit" required>-->
<!--         <option>Select business type</option>-->
<!--         <option value="1">Product Oriented</option>-->
<!--         <option value="2">Service Oriented</option>-->
<!--         <option value="3">Product & Service Oriented</option>-->
<!--     </select>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="form-group">-->
<!--    <label for="google_analytics_id" class="col-sm-3 control-label">Business group</label>-->
<!--    <div class="col-sm-7">-->
<!--        <select name="bgroup" class="selectboxit">-->
<!--            <option>Select business group</option>-->
<!--            <option value="1">Sole trading Concern</option>-->
<!--            <option value="2">Partnership firm</option>-->
<!--            <option value="3">Joint stock company</option>-->
<!--            <option value="4">Corporation</option>-->
<!--            <option value="5">Multi National company</option>-->
<!--            <option value="6">Franchise</option>-->
<!--            <option value="7">NGO/INGO</option>-->
<!--            <option value="8">Others</option>-->
<!--        </select>-->
<!--    </div>-->
<!--</div>-->
<!--cloned below-->
<input type="hidden" class="form-control" name="google_analytics_id" id="google_analytics_id" placeholder="GA_MEASUREMENT_ID" placeholder="GA_MEASUREMENT_ID">

<div class="form-group">
    <label class="col-sm-3 control-label" for="category"> <?php echo get_phrase('category'); ?> <span style="color:red;">*</span></label>
    <div class="col-sm-7">
        <div id="category_area">
            <div class="row">
                <div class="col-sm-7">
                    <select class="form-control" name="categories[]" id = "category_default" required>
                        <option value=""><?php echo get_phrase('select_category'); ?></option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="appendCategory()"> <i class="fa fa-plus"></i> </button>
                </div>
            </div>
        </div>

        <div id="blank_category_field">
            <div class="row appendedCategoryFields" style="margin-top: 10px;">
                <div class="col-sm-7 pr-0">
                    <select class="form-control" name="categories[]">
                        <option value=""><?php echo get_phrase('select_category'); ?></option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removeCategory(this)"> <i class="fa fa-minus"></i> </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="google_analytics_id" class="col-sm-3 control-label">Business Type  <span style="color:red;">*</span></label>
    <div class="col-sm-7">
        <select name="type" id="lis_type" class="selectboxit" required>
            <option>Select business type</option>
            <option value="1">Product Oriented</option>
            <option value="2">Service Oriented</option>
            <option value="3">Product & Service Oriented</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="google_analytics_id" class="col-sm-3 control-label">Business group</label>
    <div class="col-sm-7">
        <select name="bgroup" class="selectboxit" required>
            <option>Select business group</option>
            <option value="1">Sole trading Concern</option>
            <option value="2">Partnership firm</option>
            <option value="3">Joint stock company</option>
            <option value="4">Corporation</option>
            <option value="5">Multi National company</option>
            <option value="6">Franchise</option>
            <option value="7">NGO/INGO</option>
            <option value="8">Others</option>
        </select>
    </div>
</div>
<div class="row col-12" style="text-align:end">
    <a class="btn btn-success btn-lg" onclick="$('#second_location').trigger('click')">Next</a>
</div>


