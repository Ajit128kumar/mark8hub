<?php $new_services = $this->db->get_where('service', array('listing_id' => $listing_details['id']))->result_array();
//echo '<pre>';
//print_r($new_services);
//echo '</pre>';

?>
<div id="service_parent_div" style="padding-top: 10px;">
  <div id = "service_div">
    <?php foreach ($new_services as $key => $new_service): ?>
      <div class="service_div">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-primary" data-collapsed="0">
              <div class="panel-body">
                <h5 class="card-title mb-0">Services
                  <?php if ($key > 0 ): ?>
                    <button type="button" class="btn btn-danger btn-sm btn-rounded alignToTitleOnPreview" name="button" id = "<?php echo $new_service['id']; ?>" onclick="removeService(this)">Remove this service</button>
                  <?php endif; ?>
                </h5>
                <div class="collapse show" style="padding-top: 10px;">
                  <div class="row no-margin">
                    <div class="col-lg-8">
                      <input type="hidden" name="new_service_id[]" value="<?php echo $new_service['id']; ?>">
                      <div class="form-group">
                        <label for="service_name"><?php echo get_phrase('service_name'); ?></label>
                        <input type="text" name="new_service_name[]" class="form-control" value="<?php echo $new_service['name']; ?>" />
                      </div>
                        <div class="form-group">
                            <label for="service_name">Service Description</label>
                            <input type="text" name="new_description[]" class="form-control" value="<?php echo $new_service['description']; ?>" />
                        </div>

                      <?php $times = explode(',', $new_service['service_times']); ?>
                      <div class="row">
                        <div class="col-12"><label><?php echo get_phrase('service_time'); ?></label></div>
                        <div class="form-group  mb-2 col-md-5">
                          <div class="input-group">
                              <input type="time" id = "service_time_from_<?php echo $new_service['id']; ?>" onchange = "checkServiceTimeRange('<?php echo $new_service['id']; ?>')" value="<?php echo $times[0]; ?>" name="new_starting_time[]" class="form-control" required>
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="dripicons-clock"></i></span>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2  mb-2 text-center pt-1"><?php echo get_phrase('to'); ?></div>
                        <div class="form-group  mb-2 col-md-5">
                          <div class="input-group">
                              <input type="time" id = "service_time_to_<?php echo $new_service['id']; ?>" value="<?php echo $times[1]; ?>" name="new_ending_time[]" class="form-control" onchange = "checkServiceTimeRange('<?php echo $new_service['id']; ?>')" required>
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="dripicons-clock"></i></span>
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group  mb-2">
                        <label><?php echo get_phrase('service_duration'); ?></label>
                        <div class="input-group">
                            <input type="number" value="<?php echo $times[2]; ?>" name="new_duration[]" placeholder="Minute" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="service_price"><?php echo get_phrase('service_price').' ('.currency_code_and_symbol().')'; ?></label>
                        <input type="text" name="new_service_price[]" class="form-control" value="<?php echo $new_service['price']; ?>" />
                      </div>
                        <div class="form-group">
                            <label>Is price Negotiable ?</label>
                            <div class="input-group">
                                <select class="form-control" name="new_negotiable[]">
                                    <option value=""></option>
                                    <option <?php if($new_service['negotiable']=="Negotiable"){echo 'selected="selected"';} ?> value="Negotiable">Negotiable</option>
                                    <option <?php if($new_service['negotiable']=="Fixed"){echo 'selected="selected"';} ?> value="Fixed">Fixed</option>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="wrapper-image-preview">
                        <div class="box">
                          <div class="js--image-preview" style="background-image: url('<?php echo base_url('uploads/service_images/').$new_service['photo']; ?>')"></div>
                          <div class="upload-options">
                            <label for="service-image-<?php echo $new_service['id']; ?>" class="btn"> <i class="entypo-camera"></i> <?php echo get_phrase('upload_service_image'); ?> <small>(200 X 200) </small>  </label>
                            <input id="service-image-<?php echo $new_service['id']; ?>" style="visibility:hidden;" type="file" class="image-upload" name="new_service_image[]" accept="image/*">
                            <input type="hidden" class="" name="old_service_images[]" value="<?php echo $new_service['photo']; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- end card-->
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="row text-center">
    <button type="button" class="btn btn-primary" name="button" onclick="appendService()"> <i class="mdi mdi-plus"></i> Add new services</button>
  </div>
</div>

<div id = "blank_service_div" style="visibility: hidden;">
  <div class="service_div">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-primary" data-collapsed="0">
          <div class="panel-body">
            <h5 class="card-title mb-0">Service
              <button type="button" class="btn btn-danger btn-sm btn-rounded alignToTitleOnPreview" name="button" onclick="removeService(this)">Remove this service</button>
            </h5>
            <div class="collapse show" style="padding-top: 10px;">
              <div class="row no-margin">
                <div class="col-lg-8">
                  <input type="hidden" name="new_service_id[]" value="0">
                  <div class="form-group">
                    <label for="service_name"><?php echo get_phrase('service_name'); ?></label>
                    <input type="text" name="new_service_name[]" class="form-control" />
                  </div>
                    <div class="form-group">
                        <label for="service_name">Service Description</label>
                        <input id="new_description" type="text" name="new_description[]" class="form-control" />
                    </div>

                  <div class="row">
                    <div class="col-12"><label><?php echo get_phrase('service_time'); ?></label></div>
                    <div class="form-group  mb-2 col-md-5">
                      <div class="input-group">
                          <input type="time" name="new_starting_time[]" class="form-control timepicker" required>
                          <div class="input-group-append">
                              <span class="input-group-text"><i class="dripicons-clock"></i></span>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-2  mb-2 text-center pt-1"><?php echo get_phrase('to'); ?></div>
                    <div class="form-group  mb-2 col-md-5">
                      <div class="input-group">
                          <input type="time" name="new_ending_time[]" class="form-control timepicker" required>
                          <div class="input-group-append">
                              <span class="input-group-text"><i class="dripicons-clock"></i></span>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group  mb-2">
                    <label><?php echo get_phrase('service_duration'); ?></label>
                    <div class="input-group">
                        <input type="number" name="new_duration[]" placeholder="Minute" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="service_price"><?php echo get_phrase('service_price').' ('.currency_code_and_symbol().')'; ?></label>
                    <input type="text" name="new_service_price[]" class="form-control" />
                  </div>
                    <div class="form-group">
                        <label>Is price Negotiable ?</label>
                        <div class="input-group">
                            <select class="form-control" name="new_negotiable[]">
                                <option value=""></option>
                                <option value="Negotiable">Negotiable</option>
                                <option value="Fixed">Fixed</option>
                            </select>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                  <div class="wrapper-image-preview">
                    <div class="box">
                      <div class="js--image-preview"></div>
                      <div class="upload-options">
                        <label for="" class="btn"> <i class="entypo-camera"></i> <?php echo get_phrase('upload_service_image'); ?> <small>(200 X 200) </small>  </label>
                        <input id="" style="visibility:hidden;" type="file" class="image-upload" name="new_service_image[]" accept="image/*">
                        <input type="hidden" class="" name="old_service_images[]" value="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end card-->
    </div>
  </div>
</div>
