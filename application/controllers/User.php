<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->library('session');
		/*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');

		// Set the timezone
		date_default_timezone_set(get_settings('timezone'));
	}

	public function branch_creation(){
		$this->load->library('form_validation');  
           $this->form_validation->set_rules("bname", "First Name", 'required|alpha');  
           $this->form_validation->set_rules("contact", "Last Name", 'required|alpha');  
           if($this->form_validation->run())  
           {  
			    //true  
                // $this->load->model("main_model");  
				echo "1";
                $data = array(  
                     "bname"     		 =>$this->input->post("bname"),  
                     "contact"           =>$this->input->post("contact"),  
                     "address"           =>$this->input->post("address"),  
                     "lat"         		 =>$this->input->post("latitude"),  
                     "lon"        		 =>$this->input->post("longitude"), 
					 "listing_id"        =>1,
                );  
				echo "2";
				// return print_r($data); 
                // if($this->input->post("insert"))  
                // {  
					echo "3";
                     $this->crud_model->insert_branch($data);  
                     redirect(base_url() . "main/inserted");
					 echo "4";  
                // }  
           } 
	}
	public function index() {
		if ($this->session->userdata('user_login') == true) {
			$this->dashboard();
		}else {
			redirect(site_url('login'), 'refresh');
		}
	}

	public function dashboard() {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}
		$page_data['page_name'] = 'dashboard';
		$page_data['page_title'] = get_phrase('dashboard');
		$this->load->view('backend/index.php', $page_data);
	}

	public function listings($param1 = '', $param2 = '') {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}
		if ($param1 == 'add') {
			$this->crud_model->add_listing();

			redirect(site_url('user/listings'), 'refresh');
		}elseif ($param1 == 'edit') {
			$this->crud_model->update_listing($param2);
			redirect(site_url('user/listings'), 'refresh');
		}elseif ($param1 == 'delete') {
			$this->crud_model->delete_from_table('listing', $param2);
			$this->session->set_flashdata('flash_message', get_phrase('listing_deleted'));
			redirect(site_url('user/listings'), 'refresh');
		}

		// $page_data['timestamp_start'] = strtotime('-29 days', time());
		// $page_data['timestamp_end']   = strtotime(date("m/d/Y"));
		$page_data['page_name']  = 'listings';
		$page_data['page_title'] = get_phrase('directories');
		$page_data['listings'] = $this->db->get_where('listing', array('user_id' => $this->session->userdata('user_id')))->result_array();
		$this->load->view('backend/index', $page_data);
	}

//new infos
// Branch Add Code
public function branchCreation(){
	$listing_id_update= $_POST['listing_id_update'];
	$this->crud_model->update_branch($listing_id_update);
    redirect(site_url('user/listing_form'), 'refresh');
}





// End Here
public function update_listings_only()
{
	// echo "<pre>";
	// print_r($_FILES);die();
    $listing_id_update= $_POST['listing_id_update'];
    $this->crud_model->update_listing_info($listing_id_update);
    redirect(site_url('user/listings'), 'refresh');
}
    public function update_listings_ps() {
	   // echo 'here';exit;
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $listing_id = '';
         if(isset($_POST['submit']))
         {
             $listing_id = $_POST['listing_id'];
         }

        $page_data['page_name']  = 'listings_update_ps';
        $page_data['page_title'] = 'Product and services';
        $page_data['listing_id'] = $listing_id;
        $page_data['listings'] = $this->db->get_where('listing', array('user_id' => $this->session->userdata('user_id')))->result_array();

        $this->load->view('backend/index', $page_data);
    }

    //new
    public function update_listings_ss() {
        // echo 'here';exit;
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $listing_id = '';
        if(isset($_POST['submit']))
        {
            $listing_id = $_POST['listing_id'];
        }

        $page_data['page_name']  = 'listings_update_ss';
        $page_data['page_title'] = 'Services';
        $page_data['listing_id'] = $listing_id;
        $page_data['listings'] = $this->db->get_where('listing', array('user_id' => $this->session->userdata('user_id')))->result_array();

        $this->load->view('backend/index', $page_data);
    }

    public function add_service(){

        echo "<pre>";
        print_r($_POST);
        print_r($_FILES);
        die();
    }


    public function update_service(){

        // echo "waleed";die();
        $new_is_featured_array = [];
        foreach ($this->input->post('is_featured') as $value) {
            $new_is_featured_array[] = $value; 
        }
        $service_is_featured_array = $new_is_featured_array;

    

       if(!empty($_FILES['new_service_image_1']['tmp_name'])){

            $random_identifier_1 = md5(rand(10000000, 20000000)) . '.jpg';
            move_uploaded_file($_FILES['new_service_image_1']['tmp_name'], 'uploads/service_images/' . $random_identifier_1);
       }
       else{
        $random_identifier_1 = $this->input->post('old_service_images_1');
       }

       if(!empty($_FILES['new_service_image_2']['tmp_name'])){

            $random_identifier_2 = md5(rand(10000000, 20000000)) . '.jpg';
            move_uploaded_file($_FILES['new_service_image_2']['tmp_name'], 'uploads/service_images/' . $random_identifier_2);
       }
       else{
        $random_identifier_2 = $this->input->post('old_service_images_2');
       }

       if(!empty($_FILES['new_service_image_3']['tmp_name'])){

            $random_identifier_3 = md5(rand(10000000, 20000000)) . '.jpg';
            move_uploaded_file($_FILES['new_service_image_3']['tmp_name'], 'uploads/service_images/' . $random_identifier_3);
       }
       else{
        $random_identifier_3 = $this->input->post('old_service_images_3');
       }

       if(!empty($_FILES['new_service_image_4']['tmp_name'])){

            $random_identifier_4 = md5(rand(10000000, 20000000)) . '.jpg';
            move_uploaded_file($_FILES['new_service_image_4']['tmp_name'], 'uploads/service_images/' . $random_identifier_4);
       }
       else{
        $random_identifier_4 = $this->input->post('old_service_images_4');
       }

       if(!empty($_FILES['new_service_image_5']['tmp_name'])){

            $random_identifier_5 = md5(rand(10000000, 20000000)) . '.jpg';
            move_uploaded_file($_FILES['new_service_image_5']['tmp_name'], 'uploads/service_images/' . $random_identifier_5);
       }
       else{
        $random_identifier_5 = $this->input->post('old_service_images_5');
       }

      
       
       $new_service_id = $this->input->post('new_service_id');
       $new_service_name = $this->input->post('new_service_name');
       $new_description = $this->input->post('new_description');
       $new_starting_time = $this->input->post('new_starting_time');
       $new_ending_time = $this->input->post('new_ending_time');
       $new_duration = $this->input->post('new_duration');
       $new_service_price = $this->input->post('new_service_price');
       $new_negotiable = $this->input->post('new_negotiable');
       $listing_id = $this->input->post('listing_id');


        $save_data['name'] = sanitizer($new_service_name);
        $save_data['price'] = sanitizer($new_service_price);
        $save_data['description'] = sanitizer($new_description);
        $save_data['service_times'] = sanitizer($new_starting_time) . ',' . sanitizer($new_ending_time) . ',' . sanitizer($new_duration);
        $save_data ['photo'] = sanitizer($random_identifier_1);
        $save_data ['photo_2'] = sanitizer($random_identifier_2);
        $save_data ['photo_3'] = sanitizer($random_identifier_3);
        $save_data ['photo_4'] = sanitizer($random_identifier_4);
        $save_data ['photo_5'] = sanitizer($random_identifier_5);
        $save_data['listing_id'] = sanitizer($listing_id);
        $save_data['negotiable'] = sanitizer($new_negotiable);
        $save_data['is_featured'] = sanitizer($service_is_featured_array[0]);
        
        if(!empty($new_service_id)){

            $this->db->where('id',$new_service_id);
            $result = $this->db->update('service', $save_data);
        }
        else{
             $result = $this->db->insert('service', $save_data);
             // $result = 'insert';
        }
        
        echo $result;
        die();
    }

    public function getTheServicesData(){


        $listing_id = $this->input->post('listing_id');
        $data['keyword'] = $this->input->post('keyword');
        
        $data['listing_details'] = $this->crud_model->get_listings($listing_id)->row_array();
        
        $this->load->view('backend/user/edit_listing_service', $data);
    }

    public function deleteServiceData()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $delete = $this->db->delete('service');
        if($delete)
        {
            echo $delete;
        }
    
    }

    public function deleteBranchData()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $delete = $this->db->delete('business_branch');
        if($delete)
        {
            echo $delete;
        }
    
    }

    public function manage_products(){

    	 if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $listing_id = '';
        if(isset($_POST['submit']))
        {
            $listing_id = $_POST['listing_id'];
        }

        $page_data['page_name']  = 'manage_products';
        $page_data['page_title'] = 'Products';
        $page_data['listing_id'] = $listing_id;
        $page_data['listings'] = $this->db->get_where('listing', array('user_id' => $this->session->userdata('user_id')))->result_array();

        $this->load->view('backend/index', $page_data);
    }

     public function getTheProductsData(){


        $listing_id = $this->input->post('listing_id');
        $data['keyword'] = $this->input->post('keyword');
        
        $data['listing_details'] = $this->crud_model->get_listings($listing_id)->row_array();
        
        $this->load->view('backend/user/product_form_for_editing', $data);
    }

    public function update_products(){

    	// $listing_id_update= $_POST['listing_id_update'];
    	// $this->crud_model->update_listing_product_details($listing_id_update);
   		// redirect(site_url('user/listings'), 'refresh');


        // Updating listing wise image and data saving.

        $product_name = sanitizer($this->input->post('new_product_name'));
        // array_pop($product_name_array);

        $category_id = $this->input->post('new_category_id');
        // array_pop($category_id_array);

        $product_price = $this->input->post('new_price');
        // array_pop($product_price_array);

        $product_unit = $this->input->post('new_unit');
        // array_pop($product_unit_array);

        $product_color = $this->input->post('new_color');
        // array_pop($product_color_array);

        $product_brand = $this->input->post('new_brand');
        // array_pop($product_brand_array);

        $product_size_specification = $this->input->post('new_size_specification');
        // array_pop($product_size_specification_array);

        $product_weight_specification = $this->input->post('new_weight_specification');
        // array_pop($product_weight_specification_array);

        $product_other_specification = $this->input->post('new_other_specification');
        // array_pop($product_other_specification_array);

        $listing_id       = $this->input->post('listing_id');

        $new_availability_array = [];
        foreach ($this->input->post('availability') as $value) {
            $new_availability_array[] = $value; 
        }

        $product_availability = $new_availability_array;
        


        $new_is_featured_array = [];
        foreach ($this->input->post('is_featured') as $value) {
            $new_is_featured_array[] = $value; 
        }

        // $product_is_featured_array = $this->input->post('is_featured');
        $product_is_featured = $new_is_featured_array;
        
        // array_pop($product_is_featured_array);




        $product_id = sanitizer($this->input->post('new_product_id'));
   


        if(!empty($_FILES['new_product_image_1']['tmp_name'])){

            $random_identifier_1 = md5(rand(10000000, 20000000)) . '.jpg';
            move_uploaded_file($_FILES['new_product_image_1']['tmp_name'], 'uploads/shop/' . $random_identifier_1);
       }
       else{
        $random_identifier_1 = $this->input->post('old_product_images_1');
       }

       if(!empty($_FILES['new_product_image_2']['tmp_name'])){

            $random_identifier_2 = md5(rand(10000000, 20000000)) . '.jpg';
            move_uploaded_file($_FILES['new_product_image_2']['tmp_name'], 'uploads/shop/' . $random_identifier_2);
       }
       else{
        $random_identifier_2 = $this->input->post('old_product_images_2');
       }

       if(!empty($_FILES['new_product_image_3']['tmp_name'])){

            $random_identifier_3 = md5(rand(10000000, 20000000)) . '.jpg';
            move_uploaded_file($_FILES['new_product_image_3']['tmp_name'], 'uploads/shop/' . $random_identifier_3);
       }
       else{
        $random_identifier_3 = $this->input->post('old_product_images_3');
       }

       if(!empty($_FILES['new_product_image_4']['tmp_name'])){

            $random_identifier_4 = md5(rand(10000000, 20000000)) . '.jpg';
            move_uploaded_file($_FILES['new_product_image_4']['tmp_name'], 'uploads/shop/' . $random_identifier_4);
       }
       else{
        $random_identifier_4 = $this->input->post('old_product_images_4');
       }

       if(!empty($_FILES['new_product_image_5']['tmp_name'])){

            $random_identifier_5 = md5(rand(10000000, 20000000)) . '.jpg';
            move_uploaded_file($_FILES['new_product_image_5']['tmp_name'], 'uploads/shop/' . $random_identifier_5);
       }
       else{
        $random_identifier_5 = $this->input->post('old_product_images_5');
       }

       
        $product_data['name'] = sanitizer($product_name);
        $product_data['category_id'] = sanitizer($category_id);
        $product_data['price'] = sanitizer($product_price);
        $product_data['unit'] = sanitizer($product_unit);
        $product_data['color'] = sanitizer($product_color);
        $product_data['brand'] = sanitizer($product_brand);
        $product_data['size_specification'] = sanitizer($product_size_specification);
        $product_data['weight_specification'] = sanitizer($product_weight_specification);
        $product_data['details'] = sanitizer($product_other_specification);
        $product_data['availability'] = sanitizer($product_availability[0]);
        $product_data['is_featured'] = sanitizer($product_is_featured[0]);

        
        $product_data ['thumbnail'] = sanitizer($random_identifier_1);
        $product_data ['thumbnail_2'] = sanitizer($random_identifier_2);
        $product_data ['thumbnail_3'] = sanitizer($random_identifier_3);
        $product_data ['thumbnail_4'] = sanitizer($random_identifier_4);
        $product_data ['thumbnail_5'] = sanitizer($random_identifier_5);
        $product_data['listing_id'] = sanitizer($listing_id);
            
        

        if(!empty($product_id)){


            $this->db->where('id', $product_id);
            $result = $this->db->update('inventory', $product_data);
        }
        else{
             $result = $this->db->insert('inventory', $product_data);
             
        }
        
        echo $result;
        die();


    }

    public function deleteProductData()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $delete = $this->db->delete('inventory');
        if($delete)
        {
            echo $delete;
        }
    
    }
    //new ends

    public function update_listings_gallery() {
        // echo 'here';exit;
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $listing_id = '';
        if(isset($_POST['submit']))
        {
            $listing_id = $_POST['listing_id'];
        }

        $page_data['page_name']  = 'listings_update_gallery';
        $page_data['page_title'] = 'Gallery';
        $page_data['listing_id'] = $listing_id;
        $page_data['listings'] = $this->db->get_where('listing', array('user_id' => $this->session->userdata('user_id')))->result_array();

        $this->load->view('backend/index', $page_data);
    }

    public function update_listings_brand() {
        // echo 'here';exit;
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $listing_id = '';
        if(isset($_POST['submit']))
        {
            $listing_id = $_POST['listing_id'];
        }

        $page_data['page_name']  = 'listings_update_brand';
        $page_data['page_title'] = 'Brand';
        $page_data['listing_id'] = $listing_id;
        $page_data['listings'] = $this->db->get_where('listing', array('user_id' => $this->session->userdata('user_id')))->result_array();

        $this->load->view('backend/index', $page_data);
    }


    public function manage_branches(){

    	 if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $listing_id = '';
        if(isset($_POST['submit']))
        {
            $listing_id = $_POST['listing_id'];
        }

        $page_data['page_name']  = 'manage_branches';
        $page_data['page_title'] = 'Branches';
        $page_data['listing_id'] = $listing_id;
        $page_data['listings'] = $this->db->get_where('listing', array('user_id' => $this->session->userdata('user_id')))->result_array();

        $this->load->view('backend/index', $page_data);
    }

    public function getTheBranchesData(){


        $listing_id = $this->input->post('listing_id');
        $data['keyword'] = $this->input->post('keyword');
        
        $data['listing_details'] = $this->crud_model->get_listings($listing_id)->row_array();
        
        $this->load->view('backend/user/branch_form_for_editing', $data);
    }

    public function update_branch(){



        $branch_id      = $this->input->post('new_branch_id');
        // array_pop($branch_id);
        
        $branch_name     = $this->input->post('business_name');
        // array_pop($branch_name_array);

        $branch_contact   = $this->input->post('contact_no');
        // array_pop($branch_contact_array);

        $branch_email     = $this->input->post('email');
        // array_pop($branch_email_array);

        $branch_address   = $this->input->post('address');
        // array_pop($branch_address_array);

        $branch_lat     = $this->input->post('latitude');
        // array_pop($branch_lat_array);

        $branch_lon       = $this->input->post('longitude');
        $listing_id       = $this->input->post('listing_id');
        // array_pop($branch_lon_array);

      


        $branchData['listing_id']       = sanitizer($listing_id);
        $branchData['branchName']       = sanitizer($branch_name);
        $branchData['contactNumber']    = sanitizer($branch_contact);
        $branchData['email']            = sanitizer($branch_email);
        $branchData['address']          = sanitizer($branch_address);
        $branchData['lat']              = sanitizer($branch_lat);
        $branchData['lon']              = sanitizer($branch_lon);

        if(!empty($branch_id)){


            $this->db->where('id', $branch_id);
            $result = $this->db->update('business_branch', $branchData);
        }
        else{
             $result = $this->db->insert('business_branch', $branchData);
             // $result = 'insert';
        }
        
        echo $result;
        die();
     
    }

    // public function update_branches(){


    // 	$listing_id_update= $_POST['listing_id_update'];
    	// $this->crud_model->update_branch($listing_id_update);
   	// 	redirect(site_url('user/manage_branches'), 'refresh');

    // }

     public function manage_achievements(){

    	 if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $listing_id = '';
        if(isset($_POST['submit']))
        {
            $listing_id = $_POST['listing_id'];
        }

        $page_data['page_name']  = 'manage_achievements';
        $page_data['page_title'] = 'Achievements';
        $page_data['listing_id'] = $listing_id;
        $page_data['listings'] = $this->db->get_where('listing', array('user_id' => $this->session->userdata('user_id')))->result_array();

        $this->load->view('backend/index', $page_data);
    }

    public function getTheAchievementsData(){


        $listing_id = $this->input->post('listing_id');
        $data['keyword'] = $this->input->post('keyword');
        
        $data['listing_details'] = $this->crud_model->get_listings($listing_id)->row_array();
        
        $this->load->view('backend/user/edit_achievements', $data);
    }

    public function update_achievements(){


    	$listing_id_update= $_POST['listing_id_update'];
    	
    	$this->crud_model->update_achievements($listing_id_update);
   		redirect(site_url('user/manage_achievements'), 'refresh');

    }

    public function update_listings_branch() {
        // echo 'here';exit;
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $listing_id = '';
        if(isset($_POST['submit']))
        {
            $listing_id = $_POST['listing_id'];
           // redirect(site_url('user/listing_form/add/'.$listing_id), 'refresh');
        }

        $page_data['page_name']  = 'listings_update_branch';
        $page_data['page_title'] = 'Branch';
        $page_data['listing_id'] = $listing_id;
        $page_data['listings'] = $this->db->get_where('listing', array('user_id' => $this->session->userdata('user_id')))->result_array();

        $this->load->view('backend/index', $page_data);
    }

//new infos ends




	public function listing_form($param1 = '', $param2 = '') {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}
		if (has_package() > 0) {
			if ($param1 == 'add') {
				$page_data['page_name']  = 'listing_add_wiz';
				$page_data['page_title'] = get_phrase('add_new_listing');
			}elseif ($param1 == 'edit') {
				$page_data['page_name']  = 'listing_edit_wiz';
				$page_data['page_title'] = get_phrase('listing_edit');
				$page_data['listing_id'] = $param2;
			}
			$this->load->view('backend/index.php', $page_data);
		}else {
			redirect(site_url('user'), 'refresh');
		}
	}

	function booking_request_hotel($param1 ='', $param2 = ''){
		if ($this->session->userdata('user_login') != 1)
			redirect(site_url('login'), 'refresh');

		if($param1 == 'approved'){
			$data['status'] = 1;
			$this->db->where('id', $param2);
			$this->db->update('booking', $data);
			$this->email_model->request_approved_mail($param2);
			$this->session->set_flashdata('flash_message', get_phrase('request_approved_successfully'));
			redirect(site_url('user/booking_request_hotel'), 'refresh');
		}
		if($param1 == 'pending'){
			$data['status'] = 0;
			$this->db->where('id', $param2);
			$this->db->update('booking', $data);
			$this->session->set_flashdata('flash_message', get_phrase('request_pending_successfully'));
			redirect(site_url('user/booking_request_hotel'), 'refresh');
		}
		if($param1 == 'delete'){
			$this->db->where('id', $param2);
			$this->db->delete('booking');
			$this->session->set_flashdata('flash_message', get_phrase('booking_request_deleted_successfully'));
			redirect(site_url('user/booking_request_hotel'), 'refresh');
		}
		$page_data['page_name'] = 'booking_request_hotel';
		$page_data['page_title'] = get_phrase('booking_request');
		$this->load->view('backend/index.php', $page_data);
	}

	function booking_request_restaurant($param1 ='', $param2 = ''){
		if ($this->session->userdata('user_login') != 1)
			redirect(site_url('login'), 'refresh');

		if($param1 == 'approved'){
			$data['status'] = 1;
			$this->db->where('id', $param2);
			$this->db->update('booking', $data);
			$this->email_model->request_approved_mail($param2);
			$this->session->set_flashdata('flash_message', get_phrase('request_approved_successfully'));
			redirect(site_url('user/booking_request_restaurant'), 'refresh');
		}
		if($param1 == 'pending'){
			$data['status'] = 0;
			$this->db->where('id', $param2);
			$this->db->update('booking', $data);
			$this->session->set_flashdata('flash_message', get_phrase('request_pending_successfully'));
			redirect(site_url('user/booking_request_restaurant'), 'refresh');
		}
		if($param1 == 'delete'){
			$this->db->where('id', $param2);
			$this->db->delete('booking');
			$this->session->set_flashdata('flash_message', get_phrase('booking_request_deleted_successfully'));
			redirect(site_url('user/booking_request_restaurant'), 'refresh');
		}
		$page_data['page_name'] = 'booking_request_restaurant';
		$page_data['page_title'] = get_phrase('booking_request');
		$this->load->view('backend/index.php', $page_data);
	}

	function booking_request_beauty($param1 ='', $param2 = ''){
		if ($this->session->userdata('user_login') != 1)
			redirect(site_url('login'), 'refresh');

		if($param1 == 'approved'){
			$data['status'] = 1;
			$this->db->where('id', $param2);
			$this->db->update('booking', $data);
			$this->email_model->request_approved_mail($param2);
			$this->session->set_flashdata('flash_message', get_phrase('request_approved_successfully'));
			redirect(site_url('user/booking_request_beauty'), 'refresh');
		}
		if($param1 == 'pending'){
			$data['status'] = 0;
			$this->db->where('id', $param2);
			$this->db->update('booking', $data);
			$this->session->set_flashdata('flash_message', get_phrase('request_pending_successfully'));
			redirect(site_url('user/booking_request_beauty'), 'refresh');
		}
		if($param1 == 'delete'){
			$this->db->where('id', $param2);
			$this->db->delete('booking');
			$this->session->set_flashdata('flash_message', get_phrase('booking_request_deleted_successfully'));
			redirect(site_url('user/booking_request_beauty'), 'refresh');
		}
		$page_data['page_name'] = 'booking_request_beauty';
		$page_data['page_title'] = get_phrase('booking_request');
		$this->load->view('backend/index.php', $page_data);
	}
//new
    function booking_request_service($param1 ='', $param2 = ''){
        if ($this->session->userdata('user_login') != 1)
            redirect(site_url('login'), 'refresh');

        if($param1 == 'approved'){
            $data['status'] = 1;
            $this->db->where('id', $param2);
            $this->db->update('booking', $data);
            $this->email_model->request_approved_mail($param2);
            $this->session->set_flashdata('flash_message', get_phrase('request_approved_successfully'));
            redirect(site_url('user/booking_request_service'), 'refresh');
        }
        if($param1 == 'pending'){
            $data['status'] = 0;
            $this->db->where('id', $param2);
            $this->db->update('booking', $data);
            $this->session->set_flashdata('flash_message', get_phrase('request_pending_successfully'));
            redirect(site_url('user/booking_request_service'), 'refresh');
        }
        if($param1 == 'delete'){
            $this->db->where('id', $param2);
            $this->db->delete('booking');
            $this->session->set_flashdata('flash_message', get_phrase('booking_request_deleted_successfully'));
            redirect(site_url('user/booking_request_service'), 'refresh');
        }
        $page_data['page_name'] = 'booking_request_service';
        $page_data['page_title'] = get_phrase('booking_request');
        $this->load->view('backend/index.php', $page_data);
    }
//new ends
	function review_modify($param1 = '', $param2 = '', $param3 = '', $param4 = ''){
		if ($this->session->userdata('user_login') != 1)
			redirect(site_url('login'), 'refresh');

        if($param1 == 'edit'){
        	$data['review_rating'] = $this->input->post('review_rating');
        	$data['review_comment'] = $this->input->post('review_comment');
        	$this->db->where('review_id', $param2);
        	$this->db->update('review', $data);
        	$this->session->set_flashdata('flash_message', get_phrase('review_updated_successfully'));
        }
        if($param1 == 'delete'){
            $this->db->where('review_id', $param2);
            $this->db->delete('review');
            $this->session->set_flashdata('flash_message', get_phrase('review_deleted'));
        }
        $listing_type = $this->db->get_where('listing', array('id' => $param4))->row('listing_type');
        redirect(get_listing_url($param4),'refresh');

	}

	function wishlists() {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}
		$page_data['page_name'] = 'wishlists';
		$page_data['page_title'] = get_phrase('wishlists');
		$this->load->view('backend/index.php', $page_data);
	}

	function packages() {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}
		$page_data['page_name'] = 'packages';
		$page_data['page_title'] = get_phrase('packages');
		$page_data['packages'] = $this->crud_model->get_packages()->result_array();
		$this->load->view('backend/index.php', $page_data);
	}

	// Payment Stuffs
	public function paypal_checkout($package_id = "") {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}

		$page_data['package_details'] = $this->crud_model->get_packages($package_id)->row_array();
		$page_data['user_details']    = $this->user_model->get_all_users($this->session->userdata('user_id'))->row_array();
		$this->load->view('backend/user/paypal_checkout', $page_data);
	}

	public function stripe_checkout($package_id = "") {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}

		$page_data['package_details'] = $this->crud_model->get_packages($package_id)->row_array();
		$page_data['user_details']    = $this->user_model->get_all_users($this->session->userdata('user_id'))->row_array();
		$this->load->view('backend/user/stripe_checkout', $page_data);
	}

	// Function after payment gets done
	function payment_success($payment_method = "", $user_id = "", $package_id = "", $paid_amount = "") {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}
		$this->crud_model->create_package_purchase_history($payment_method, $user_id, $package_id, $paid_amount);
		$this->session->set_flashdata('flash_message', get_phrase('payment_success'));
		redirect(site_url('user/purchase_history'), 'refresh');
	}

	//free package
	function free_package($payment_method = "", $user_id = "", $package_id = "", $paid_amount = "") {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}

		$this->crud_model->create_package_purchase_history($payment_method, $user_id, $package_id, $paid_amount);
		$this->session->set_flashdata('flash_message', get_phrase('successfully_added_a_free_package'));
		redirect(site_url('user/purchase_history'), 'refresh');
	}

	// Ajax calls
	function get_city_list_by_country_id() {
		$page_data['country_id'] = sanitizer($this->input->post('country_id'));
		return $this->load->view('backend/user/city_list_dropdown', $page_data);
	}

	function filter_listing_table() {
		$data['status'] 	= sanitizer($this->input->post('status'));
		$date_range = sanitizer($this->input->post('date_range'));
		$date_range = explode(" - ", $date_range);
		$data['timestamp_start'] = strtotime($date_range[0]);
		$data['timestamp_end']   = strtotime($date_range[1]);
		$page_data['listings'] = $this->crud_model->filter_listing_table($data)->result_array();
		$this->load->view('backend/user/filter_listing_table', $page_data);
	}

	function purchase_history() {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}
		$page_data['page_name'] = 'purchase_history';
		$page_data['page_title'] = get_phrase('purchase_history');
		$page_data['purchase_histories'] = $this->crud_model->get_user_specific_purchase_history($this->session->userdata('user_id'))->result_array();
		$this->load->view('backend/index.php', $page_data);
	}

	function package_invoice($package_purchase_history_id = "") {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}
		$page_data['page_name'] = 'package_invoice';
		$page_data['page_title'] = get_phrase('invoice');
		$page_data['purchase_history'] = $this->db->get_where('package_purchased_history', array('id' => $package_purchase_history_id))->row_array();
		$this->load->view('backend/index.php', $page_data);
	}

	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'update_profile_info') {
            $this->user_model->edit_user($param2);
            redirect(site_url('user/manage_profile'), 'refresh');
        }
        if ($param1 == 'change_password') {
            $this->user_model->change_password($param2);
            redirect(site_url('user/manage_profile'), 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['user_info']  = $this->user_model->get_all_users($this->session->userdata('user_id'))->row_array();
        $this->load->view('backend/index', $page_data);
    }

    function payment_gateway($package_id = ""){
    	if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}
        $page_data['package_data'] = $this->crud_model->get_packages($package_id)->row_array();
        $this->session->set_userdata('total_price_of_checking_out', $page_data['package_data']['price']);
        $page_data['title'] = get_phrase('payment_gateway');
        $this->load->view('payment/index', $page_data);
    }
}
