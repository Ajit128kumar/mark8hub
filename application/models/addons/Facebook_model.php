<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook_model extends CI_Model {

	function __construct()
	{
	    parent::__construct();
			// $CI =& get_instance();
		 //    $CI->load->model('facebook_model');
 	}

 	function get_addon_status($unique_identifier = ""){
		if($unique_identifier != ""){
			$this->db->where('unique_identifier', $unique_identifier);
			return $this->db->get_where('addons')->row('status');
		}else{
			return 0;
		}
	}

 	function get_facebook_page_data($listing_id = ""){
		if($listing_id != ""){
			$facebook_page_data = $this->db->get_where('facebook_messenger', array('listing_id' => $listing_id));
			if($facebook_page_data->num_rows() > 0){
				return $facebook_page_data->row_array();
			}else{
				$data['listing_id'] = $listing_id;
				$data['color'] = '#004dda';
				$this->db->insert('facebook_messenger', $data);
				return $this->db->get_where('facebook_messenger', array('listing_id' => $listing_id))->row_array();
			}
		}
	}

	function update_facebook_page_data($listing_id = ""){
		$data['page_id'] = $this->input->post('page_id');
		$data['color'] = $this->input->post('color');
		$data['logged_in_greeting'] = $this->input->post('logged_in_greeting');
		$this->db->where('listing_id', $listing_id);
		$this->db->update('facebook_messenger', $data);
	}

	function get_listing_user_wiz($listing_id = ""){
		$user_id = $this->session->userdata('user_id');
		$listing = $this->db->get_where('listing', array('id' => $listing_id, 'user_id' => $user_id));
		if($listing->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
 }