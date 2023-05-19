<!-- <div class="form-group">-->
<!--  <label class="col-sm-3 control-label" for="tags"><?php echo get_phrase('tags'); ?></label>-->
<!--  <div class="col-sm-7">-->
<!--    <div class="form-group">-->
<!--      <input type="text" class="form-control bootstrap-tag-input" id = "tags" name="tags" data-role="tagsinput" style="width: 100%;"/>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->

<div class="form-group">
  <label class="col-sm-3 control-label" for="seo_meta_tags"><?php echo get_phrase('meta_keywords'); ?></label>
  <div class="col-sm-7">
    <div class="form-group">
      <input type="text" class="form-control" id = "seo_meta_tags" name="seo_meta_tags" data-role="tagsinput" style="width: 100%;"/>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label" for="meta_description">Meta Description</label>
  <div class="col-sm-7">
    <div class="form-group">
      <textarea class="form-control" id="meta_description" name="meta_description" rows="4"></textarea>
    </div>
  </div>
</div>
<input type="hidden" name="meta_description" value='' />
<!--nxt-btn-->
<div class="row col-12" style="text-align:end;">
     <a class="btn btn-success btn-lg" onclick="$('#sixth_schedule').trigger('click')">Next</a>
</div>