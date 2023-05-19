<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date    : 22 July, 2020
*  Atlas Directory Listing
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Shop extends CI_Controller
{

  protected $unique_identifier = "shop";
  function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');

    /*cache control*/
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');

    /*ADDON SPECIFIC MODELS*/
    $this->load->model('addons/Shop_model','shop_model');

    // CHECK IF THE ADDON IS ACTIVE OR NOT
    $this->check_addon_status();
  }
  // INDEX FUNCTION
  public function index() {
    $this->inventory_manager();
  }
  //  INVENTORY MANAGER FOR A LISTING
  public function inventory_manager($active_listing_id = null) {
    if ($this->session->userdata('admin_login') != true && $this->session->userdata('user_login') != true) {
      redirect(site_url('404_override'), 'refresh');
    }

    $listings = $this->crud_model->get_listings()->result_array();

    if (count($listings) > 0 && !$active_listing_id) {
      $active_listing_id = $listings[0]['id'];
    }

    // GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
    if (count($listings) > 0 && !$this->shop_model->is_listing_belongs_to_user($active_listing_id)) {
      redirect(site_url('addons/shop'), 'refresh');
    }

    // ACTIVE LISTING DETAILS=
    $active_listing_details = $this->crud_model->get_listings($active_listing_id)->row_array();
    $page_datap['active_listing_details'] = $active_listing_details;
    $page_data['listings'] = $listings;
    $page_data['active_listing_id'] = $active_listing_id;
    $page_data['inventory_categories'] = $this->shop_model->get_listing_wise_inventory_categories($active_listing_id);
    $page_data['inventories'] = $this->shop_model->get_listing_wise_inventories($active_listing_id);
    $page_data['page_name'] = 'inventory_manager';
    $page_data['page_title'] = get_phrase('inventory_manager').': '.$active_listing_details['name'];
    $this->load->view('backend/index', $page_data);
  }


  // CATEGORY FORM
  public function inventory_category_form($action = "", $inventory_category_id = "") {
    if ($this->session->userdata('admin_login') != true && $this->session->userdata('user_login') != true) {
      redirect(site_url('404_override'), 'refresh');
    }

    $active_listing_id = null;
    if ($action == "add") {
      $active_listing_id = $this->input->post('active_listing_id');
      // GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
      if (!$this->shop_model->is_listing_belongs_to_user($active_listing_id)) {
        redirect(site_url('addons/shop'), 'refresh');
      }
      $response = $this->shop_model->add_inventory_category();
      $this->session->set_flashdata('flash_message', get_phrase('category_created'));
    }elseif ($action == "update") {
      $inventory_category_id = $this->input->post('id');
      $inventory_category_details = $this->shop_model->get_inventory_category_by_id($inventory_category_id);
      $active_listing_id = $inventory_category_details['listing_id'];
      // GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
      if (!$this->shop_model->is_listing_belongs_to_user($active_listing_id)) {
        redirect(site_url('addons/shop'), 'refresh');
      }
      $response = $this->shop_model->update_inventory_category();
      $this->session->set_flashdata('flash_message', get_phrase('category_updated'));
    }elseif ($action == "delete") {
      $inventory_category_details = $this->shop_model->get_inventory_category_by_id($inventory_category_id);
      $active_listing_id = $inventory_category_details['listing_id'];
      // GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
      if (!$this->shop_model->is_listing_belongs_to_user($active_listing_id)) {
        redirect(site_url('addons/shop'), 'refresh');
      }
      $response = $this->shop_model->delete_inventory_category($inventory_category_id);
      $this->session->set_flashdata('flash_message', get_phrase('category_deleted'));
    }
    redirect(site_url('addons/shop/inventory_manager/'.$active_listing_id), 'refresh');
  }

  // PUBLIC FUNCTION FOR ADDING INVENTORY
  public function inventory_form($action = "", $inventory_id = "") {
    if ($this->session->userdata('admin_login') != true && $this->session->userdata('user_login') != true) {
      redirect(site_url('404_override'), 'refresh');
    }

    $active_listing_id = null;
    // CRUD OPERATIONS OF INVENTORY
    if ($action == "add") {
      $active_listing_id = $this->input->post('active_listing_id');
      // GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
      if (!$this->shop_model->is_listing_belongs_to_user($active_listing_id)) {
        redirect(site_url('addons/shop'), 'refresh');
      }
      $response = $this->shop_model->add_inventory();
      $this->session->set_flashdata('flash_message', get_phrase('inventory_created'));
    }elseif ($action == "update") {
      $inventory_details = $this->shop_model->get_inventory_by_id($this->input->post('id'));
      $active_listing_id = $inventory_details['listing_id'];
      // GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
      if (!$this->shop_model->is_listing_belongs_to_user($active_listing_id)) {
        redirect(site_url('addons/shop'), 'refresh');
      }
      $response = $this->shop_model->update_inventory();
      $this->session->set_flashdata('flash_message', get_phrase('inventory_updated'));
    }elseif ($action == "delete") {
      $inventory_details = $this->shop_model->get_inventory_by_id($inventory_id);
      $active_listing_id = $inventory_details['listing_id'];
      // GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
      if (!$this->shop_model->is_listing_belongs_to_user($active_listing_id)) {
        redirect(site_url('addons/shop'), 'refresh');
      }
      $response = $this->shop_model->delete_inventory($inventory_id);
      $this->session->set_flashdata('flash_message', get_phrase('inventory_deleted'));
    }

    redirect(site_url('addons/shop/inventory_manager/'.$active_listing_id), 'refresh');
  }


  // CART HANDLER
  public function cart_handler() {
    if ($this->session->userdata('user_login') != true) {
      echo "false";
      return false;
    }
    $response = $this->shop_model->cart_handler();
    echo sanitizer($response);
  }

  // SHOW CHECKOUT VIEW AND HIDE PRODUCT VIEW
  public function show_checkout() {
    $page_data['listing_id'] = $this->input->post('listingId');
    $cart_items = $this->shop_model->cart_items($page_data['listing_id']);
    if (count($cart_items) > 0) {
      $this->load->view('frontend/checkout', $page_data);
    }else{
      echo "false";
      return false;
    }
  }

  // CONFIRMING ORDER
  public function confirm_order() {
    $validate_recaptcha = $this->validate_captcha();
    if ($validate_recaptcha) {
      $this->shop_model->confirm_order();
    }else{
      $this->session->set_flashdata('error_message', get_phrase('recaptcha_validation_failed'));
    }
    redirect($_SERVER['HTTP_REFERER'].'#order-confirmed', 'refresh');
  }

  function validate_captcha() {
    $recaptcha = trim($this->input->post('g-recaptcha-response'));
    $userIp= $this->input->ip_address();
    $secret= get_settings('recaptcha_secretkey');
    $data = array(
      'secret' => "$secret",
      'response' => "$recaptcha",
      'remoteip' =>"$userIp"
    );

    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
      curl_setopt($verify, CURLOPT_POST, true);
      curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($verify);
      $status= json_decode($response, true);

      if(empty($status['success'])){
        return FALSE;
      }else{
        return TRUE;
      }
    }

    // ORDER MANAGER
    public function order_manager() {
      if ($this->session->userdata('admin_login') != true && $this->session->userdata('user_login') != true) {
        redirect(site_url('404_override'), 'refresh');
      }
      $active_listing_id = (isset($_GET['listing_id']) && $_GET['listing_id'] != "all") ? $this->input->get('listing_id') : null;
      $listings = $this->crud_model->get_listings()->result_array();

      // GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
      if ($active_listing_id > 0 && !$this->shop_model->is_listing_belongs_to_user($active_listing_id)) {
        redirect(site_url('addons/shop/order_manager'), 'refresh');
      }

      $page_data['listings'] = $listings;
      $page_data['active_listing_id'] = $active_listing_id;
      $page_data['pending_orders'] = $this->shop_model->get_orders_by_conditions(['delivery_status' => "pending", 'listing_id' => $active_listing_id]);
      $page_data['delivered_orders'] = $this->shop_model->get_orders_by_conditions(['delivery_status' => "delivered", 'listing_id' => $active_listing_id]);
      $page_data['page_name'] = 'order_manager';
      $page_data['page_title'] = get_phrase('order_manager');
      $this->load->view('backend/index', $page_data);
    }

    // MY ORDERS
    public function my_orders() {
      if ($this->session->userdata('user_login') != true) {
        redirect(site_url('404_override'), 'refresh');
      }
      $page_data['my_orders'] = $this->shop_model->get_my_orders();
      $page_data['page_name'] = 'my_orders';
      $page_data['page_title'] = get_phrase('my_orders');
      $this->load->view('backend/index', $page_data);
    }

    // MY ORDERS
    public function invoice($order_code) {
      if ($this->session->userdata('user_login') != true) {
        redirect(site_url('404_override'), 'refresh');
      }

      $order_detail = $this->shop_model->get_my_order_by_code($order_code);
      if (count($order_detail) == 0) {
        redirect(site_url('404_override'), 'refresh');
      }

      $page_data['my_order'] = $order_detail;
      $page_data['page_name'] = 'order_invoice';
      $page_data['page_title'] = get_phrase('order_invoice');
      $this->load->view('backend/index', $page_data);
    }

    // ORDER ACTIONS
    public function order_actions($action, $order_id) {
      $dynamic_function_name = "mark_order_as_" . $action;
      $this->shop_model->$dynamic_function_name($order_id);
      redirect(site_url('addons/shop/order_manager'), 'refresh');
    }

    // RECAPTCHA SETTINGS
    public function recaptcha_settings($action = "") {
      if ($this->session->userdata('admin_login') != true) {
        redirect(site_url('404_override'), 'refresh');
      }
      if ($action == "update") {
        $this->shop_model->recaptcha_settings();
        redirect(site_url('addons/shop/recaptcha_settings'), 'refresh');
      }
      $page_data['page_name'] = 'recaptcha_settings';
      $page_data['page_title'] = get_phrase('recaptcha_settings');
      $this->load->view('backend/index', $page_data);
    }
    // CHECK IF THE ADDON IS ACTIVE OR NOT. IF NOT REDIRECT TO DASHBOARD
    public function check_addon_status() {
      $checker = array('unique_identifier' => $this->unique_identifier);
      $this->db->where($checker);
      $addon_details = $this->db->get('addons')->row_array();
      if ($addon_details['status']) {
        return true;
      }else{
        redirect(site_url(), 'refresh');
      }
    }
  }
