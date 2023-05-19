<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
      FB.init({
        xfbml            : true,
        version          : 'v5.0'
      });
    };
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Your customer chat code -->
<?php $this->load->model('addons/facebook_model'); ?>
<?php $facebook_page_data = get_facebook_page_data($listing_details['id']); ?>

<?php 
if(!empty($listing_details['id'])){
?>
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="<?php echo $facebook_page_data['page_id']; ?>"
  theme_color="<?php echo $facebook_page_data['color']; ?>"
  logged_in_greeting="<?php echo $facebook_page_data['logged_in_greeting']; ?>"
  logged_out_greeting="<?php echo $facebook_page_data['logged_in_greeting']; ?>">
</div>
<?php } else { ?>
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="105523301617028"
  theme_color="#004dda"
  logged_in_greeting="Welcome to mark8hub , how may we help you ?"
  logged_out_greeting="Welcome to mark8hub , how may we help you ?">
</div>
<?php } ?>