<?php $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday','saturday', 'sunday'); ?>

<div class="col-sm-offset-1 col-sm-10">
  <div class="form-group">
       <input type="checkbox" id="all"> Same as monday<br>
    <?php foreach($days as $day): ?>
      <div class="row" style="margin-bottom: 15px;">
        <div class="col-lg-6">
          <label><?php echo get_phrase($day.'_opening'); ?></label>
          <select class="form-control start" name="<?php echo $day.'_opening'; ?>" id="<?php echo $day.'_opening'; ?>">
            <option value="closed"><?php echo get_phrase('closed'); ?></option>
            <?php for($i = 0; $i < 24; $i++): ?>
              <option value="<?php echo $i; ?>"> <?php echo date('h a', strtotime("$i:00:00")) ?> </option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="col-lg-6">
          <label><?php echo get_phrase($day.'_closing'); ?></label>
          <select class="form-control end" name="<?php echo $day.'_closing'; ?>" id="<?php echo $day.'_closing'; ?>">
            <option value="closed"><?php echo get_phrase('closed'); ?></option>
            <?php for($i = 0; $i < 24; $i++): ?>
              <option value="<?php echo $i; ?>"><?php echo date('h a', strtotime("$i:00:00")) ?></option>
            <?php endfor; ?>
          </select>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <!--next button-->
<div class="row col-12" style="text-align:center;">
    <!--<button class="btn btn-success">Next</button>-->
     <a class="btn btn-success btn-lg" onclick="$('#seventh_contact').trigger('click')">Next</a>
</div>
</div>

<script type="text/javascript">
    $(document).on("click","#all",function() {
        var def_opening = $('#monday_opening').val();
        var def_closing = $('#monday_closing').val();
       // alert(def_opening);
        if(def_opening=='closed' || def_closing=='closed')
        {
            alert('schedule for monday is required');
            return false;
        }
        if ($(this).is(':checked')){
            $('.start').val(def_opening);
            $('.end').val(def_closing);
        }
        else
        {
            $('.start').val('closed');
            $('.end').val('closed');
            $('#monday_opening').val(def_opening);
            $('#monday_closing').val(def_closing);
        }
    });
</script>