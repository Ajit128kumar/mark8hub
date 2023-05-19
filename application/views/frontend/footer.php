<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/css/new.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/sass/new.scss"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/navmenu/css/menumaker.css"/>
<script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/new.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/frontend/navmenu/js/menumaker.js"></script>

<?php
session_start();
if(!isset($_SESSION['session'])){
$_SESSION['session']=session_id();
}
// echo $_SESSION['session'];
// function total_online()
// {
        $current_time=time();
        $timeout = $current_time - (60);
        
        $sql_query1 = "SELECT session FROM total_visitors WHERE session='".$_SESSION['session']."'";
        $query = $this->db->query($sql_query1);
        $session_check =  $query->num_rows();
        
        if($session_check==0 && $_SESSION['session']!="") 
        {
        // $sql_query2 = "INSERT INTO total_visitors values ('', '".$_SESSION['session']."','".$current_time."')";
      
         $data = array(  
                        'session'     => $_SESSION['session'],  
                        'time'  => $current_time 
                        );  
        //insert data into database table.  
        $this->db->insert('total_visitors',$data);  
        }
        else 
        {
        // $sql_query2 = "UPDATE total_visitors SET time='".time()."' WHERE session='".$_SESSION['session']."'";
        
        
        
         $data = array(  
                        'session'     => $_SESSION['session'],  
                        'time'  => time() 
                        ); 
        $this->db->where('session', $_SESSION['session']);
        $this->db->update('total_visitors', $data);
        }
        
        $sql_query3 = "SELECT * FROM total_visitors WHERE time>= '$timeout'";
        $query2 = $this->db->query($sql_query3);
        $total_online_visitors =  $query2->num_rows();
        // $total_online_visitors = mysql_num_rows($select_total);
        // return $total_online_visitors;
//  }
 

//   $total_online=total_online();
//   echo $total_online;
  
  //to get total online visitors
// $total_online_visitors=$total_online_visitors;

//to get total visitors
$sql_query4 = "SELECT * FROM total_visitors";
$total_visitors1 = $this->db->query($sql_query4);
$total_visitors = $total_visitors1->num_rows();
// to insert page view and select total pageview
$user_ip=$_SERVER['REMOTE_ADDR'];
$page=$_SERVER['PHP_SELF'];

 $data2 = array(  
                        'page'     => $page,  
                        'user_ip'  => $user_ip 
                        ); 
                        // print_r($data2);
        //insert data into database table.  
        $this->db->insert('pageviews',$data2); 
        
$sql_query5 = "SELECT * FROM pageviews";
$pageviews = $this->db->query($sql_query5);
$total_pageviews = $pageviews->num_rows();
 
?>



<?php 
$social_link_for_footer = json_decode(get_frontend_settings('social_links'), true);
//   $users_online = $this->user_model->countOnline();
//         $visitors = $this->user_model->countVisitors();
//         if($users_online==1)
//         {
//             $online = $users_online.' user online';
//         }
//         else
//         {
//             $online = $users_online.' users online';
//         }
//         $add_visitors = $this->user_model->addVisitors();
?>
<footer class="plus_border ft-new">
	<div class="margin_60_35 ft-wd">
		<div class="row">
		       <div class="col-lg-2 col-md-6 col-sm-6 ft-txt">
                <a data-toggle="collapse" data-target="#collapse_ft_5" aria-expanded="false" aria-controls="collapse_ft_5" class="collapse_bt_mobile">
                    <h3>Traffic</h3>
                    <div class="circle-plus closed">
                        <div class="horizontal"></div>
                        <div class="vertical"></div>
                    </div>
                </a>
                <div class="collapse show" id="collapse_ft_5">
                    <ul class="links">
                        <li> <?= $total_online_visitors; ?> users online</li>
                        <li id="online_visitor_val"><?= $total_pageviews; ?> number of visitors since 2022</li>
                    </ul>
                </div>
            </div>
			<div class="col-lg-2 col-md-6 col-sm-6 ft-txt">
				<a data-toggle="collapse" data-target="#collapse_ft_1" aria-expanded="false" aria-controls="collapse_ft_1" class="collapse_bt_mobile">
					<h3><?= get_phrase('quick_links'); ?></h3>
					<div class="circle-plus closed">
						<div class="horizontal"></div>
						<div class="vertical"></div>
					</div>
				</a>
				<div class="collapse show" id="collapse_ft_1">
					<ul class="links">
						<li><a href="<?php echo site_url('home/about'); ?>"><?php echo get_phrase('about'); ?></a></li>
						<li><a href="<?php echo site_url('home/terms_and_conditions'); ?>"><?php echo get_phrase('terms_and_conditions'); ?></a></li>
						<li><a href="<?php echo site_url('home/privacy_policy'); ?>"><?php echo get_phrase('privacy_policy'); ?></a></li>
						<li><a href="<?php echo site_url('home/faq'); ?>"><?php echo get_phrase('FAQ'); ?></a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 ft-txt">
				<a data-toggle="collapse" data-target="#collapse_ft_2" aria-expanded="false" aria-controls="collapse_ft_2" class="collapse_bt_mobile">
					<h3><?php echo get_phrase('categories'); ?></h3>
					<div class="circle-plus closed">
						<div class="horizontal"></div>
						<div class="vertical"></div>
					</div>
				</a>
				<div class="collapse show" id="collapse_ft_2">
					<ul class="links" id="footer_category">
						<?php $limitation = 6; ?>
						<?php $this->db->limit($limitation); ?>
						<?php $categories = $this->db->get_where('category', array('parent' => 0))->result_array();
						foreach ($categories as $key => $category):?>
						<li><a href="<?php echo site_url('home/filter_listings?category='.slugify($category['name']).'&&amenity=&&video=0&&status=all'); ?>"><?php echo $category['name']; ?></a></li>
					<?php endforeach; ?>
					<div id="loader" style="display: none; opacity: .5;"><img src="<?php echo base_url('assets/frontend/images/loader.gif'); ?>" width="25"></div>
					<?php $category_array_count = count($this->db->get_where('category', array('parent' => 0))->result_array()); ?>
					<?php if($category_array_count > 6): ?>
						<a href="javascript: void(0)" onclick="more_category()"><?php echo get_phrase('view_all_categories'); ?></a>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 ft-txt">
			<a data-toggle="collapse" data-target="#collapse_ft_3" aria-expanded="false" aria-controls="collapse_ft_3" class="collapse_bt_mobile">
				<h3><?php echo get_phrase('contacts'); ?></h3>
				<div class="circle-plus closed">
					<div class="horizontal"></div>
					<div class="vertical"></div>
				</div>
			</a>
			<div class="collapse show" id="collapse_ft_3">
				<ul class="contacts">
					<li><i class="ti-home"></i><?php echo get_settings('address'); ?></li>
					<li><i class="ti-headphone-alt"></i><?php echo get_settings('phone'); ?></li>
					<li><i class="ti-email"></i><a href="#0"><?php echo get_settings('system_email'); ?></a></li>
				</ul>
			</div>
		</div>
		<div class="col-lg-2 col-md-6 col-sm-6 ft-txt">
			<div class="social-links">
				<h5><?php echo get_phrase('follow_us'); ?></h5>
				<ul>
					<li><a href="<?php echo $social_link_for_footer['facebook']; ?>"><i class="ti-facebook"></i></a></li>
					<li><a href="<?php echo $social_link_for_footer['twitter']; ?>"><i class="ti-twitter-alt"></i></a></li>
					<li><a href="<?php echo $social_link_for_footer['google']; ?>"><i class="ti-google"></i></a></li>
					<li><a href="<?php echo $social_link_for_footer['pinterest']; ?>"><i class="ti-pinterest"></i></a></li>
					<li><a href="<?php echo $social_link_for_footer['instagram']; ?>"><i class="ti-instagram"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /row-->
	<hr>
	<div class="row justify-content-end">
		<div class="col-lg-6">
			<ul id="additional_links">
				<li><a href="<?php echo site_url('home/about'); ?>"><?php echo get_phrase('about'); ?></a></li>
				<li><a href="<?php echo site_url('home/terms_and_conditions'); ?>"><?php echo get_phrase('terms_and_conditions'); ?></a></li>
				<li><a href="<?php echo site_url('home/privacy_policy'); ?>"><?php echo get_phrase('privacy_policy'); ?></a></li>
				<li><a href="<?php echo site_url('home/faq'); ?>"><?php echo get_phrase('FAQ'); ?></a></li>
				<li><a href="<?php echo get_settings('footer_link'); ?>"><?php echo get_settings('footer_text'); ?></a></li>
			</ul>
		</div>
	</div>
</div>
</footer>
<!--/footer-->

<script>
	function more_category(){
		$.ajax({
			url: "<?php echo site_url('home/footer_more_category/'); ?>",
			success: function(response){
				$('#loader').show();
				setInterval(function(){
					$('#loader').hide();
					$('#footer_category').html(response);
				},1000);

			}
		});
	}
</script>
