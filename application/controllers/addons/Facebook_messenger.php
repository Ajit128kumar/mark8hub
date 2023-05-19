<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook_messenger extends CI_Controller {
	//protected $unique_identifier = "fb_messenger";

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('addons/facebook_model');

		// Set the timezone
		date_default_timezone_set(get_settings('timezone'));
	}

	public function index() {
		if ($this->session->userdata('admin_login') == true) {
			$this->dashboard();
		}else {
			redirect(site_url('login'), 'refresh');
		}
	}

	public function api_manager($listing_id = ""){
		if ($this->session->userdata('admin_login') == true || $this->session->userdata('user_login') == true){
			$page_data['facebook_page_data'] = $this->facebook_model->get_facebook_page_data($listing_id);
			$page_data['listing'] = $this->crud_model->get_listings($listing_id)->row_array();
			$page_data['page_name'] = 'facebook_page_manager';
			$page_data['page_title'] = get_phrase('facebook_messenger_plugin_data');
			$this->load->view('backend/index.php', $page_data);
		}else{
			redirect(site_url('login'), 'refresh');
		}
	}

	public function update_facebook_page_data($listing_id = ""){
		if($listing_id != "" && $this->session->userdata('admin_login') == true){
			$this->facebook_model->update_facebook_page_data($listing_id);
			$this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
			redirect(site_url('admin/listings'), 'refresh');
		}elseif($listing_id != "" && $this->session->userdata('user_login') == true){
			if($this->facebook_model->get_listing_user_wiz($listing_id) == true):
				$this->facebook_model->update_facebook_page_data($listing_id);
				$this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
			endif;
			redirect(site_url('user/listings'), 'refresh');
		}else{
			redirect(site_url('login'), 'refresh');
		}
	}


}