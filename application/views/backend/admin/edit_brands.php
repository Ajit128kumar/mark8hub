<div class="form-group">
    <label class="col-sm-3 control-label" for="listing_images">Brand<br/>  </label>
    <div class="col-sm-7">
        <div id="brands_area">
            <?php if (count(json_decode($listing_details['brands'])) > 0): ?>
                <?php
                $k=0;
                foreach (json_decode($listing_details['brands']) as $key => $photo): ?>
                    <?php if ($k == 0): ?>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="brand_name[]" class="form-control" value="<?= $key ?>" placeholder="Brand name"/>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
                                                <img src="<?php echo base_url('uploads/brand_images/'.$photo); ?>" alt="...">
                                                <input type="hidden" class="name_of_previous_image" name="new_brand_images[]" value="<?php echo $photo; ?>">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                            <div>
                        <span class="btn btn-white btn-file">
                          <span class="fileinput-new">Select Logo</span>
                          <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                          <input type="file" name="brand_logo[]" accept="image/*">
                        </span>
                                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-primary btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="appendBrandUploader()"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row appendedBrandUploader">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="brand_name[]" class="form-control" value="<?= $key ?>" placeholder="Brand name"/>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
                                                <img src="<?php echo base_url('uploads/brand_images/'.$photo); ?>" alt="...">
                                                <input type="hidden" class="name_of_previous_image" name="new_brand_images[]" value="<?php echo $photo; ?>">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                            <div>
                        <span class="btn btn-white btn-file">
                          <span class="fileinput-new">Select Logo</span>
                          <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                          <input type="file" name="brand_logo[]" accept="image/*">
                        </span>
                                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removeBrandUploader(this)"> <i class="fa fa-minus"></i> </button>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php
                $k++;
                endforeach; ?>
            <?php else: ?>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" name="brand_name[]" class="form-control"  placeholder="Brand name"/>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
                                        <img src="<?php echo base_url('uploads/placeholder.png'); ?>" alt="...">
                                        <input type="hidden" class="name_of_previous_image" name="new_brand_images[]" value="">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                    <span class="btn btn-white btn-file">
                      <span class="fileinput-new">Select Logo</span>
                      <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                      <input type="file" name="brand_logo[]" accept="image/*">
                    </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="appendBrandUploader()"> <i class="fa fa-plus"></i> </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div id="blank_brand_uploader">
            <div class="row appendedBrandUploader">
                <div class="col-sm-7">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" name="brand_name[]" class="form-control"  placeholder="Brand name"/>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
                                    <img src="<?php echo base_url('uploads/placeholder.png'); ?>" alt="...">
                                    <input type="hidden" class="name_of_previous_image" name="new_brand_images[]" value="">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                  <span class="btn btn-white btn-file">
                    <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>
                    <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                    <input type="file" name="brand_logo[]" accept="image/*">
                  </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removeBrandUploader(this)"> <i class="fa fa-minus"></i> </button>
                </div>
            </div>
        </div>
    </div>
</div>
