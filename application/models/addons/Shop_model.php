<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  // GET ALL CATEGORIES ACCORDING TO LISITNG
  public function get_listing_wise_inventory_categories($listing_id){
    $this->db->where('listing_id', $listing_id);
    return $this->db->get('inventory_category')->result_array();
  }

  // GET INVENTORY CATEGORY BY ID
  public function get_inventory_category_by_id($id){
    $this->db->where('id', $id);
    return $this->db->get('inventory_category')->row_array();
  }

  // ADD CATEGORY
  public function add_inventory_category() {
    $data['name'] = sanitizer($this->input->post('name'));
    $data['listing_id'] = sanitizer($this->input->post('active_listing_id'));
    $this->db->insert('inventory_category', $data);
    return true;
  }

  // UPDATE INVENTORY CATEGORY
  public function update_inventory_category() {
    $id = sanitizer($this->input->post('id'));
    $data['name'] = sanitizer($this->input->post('name'));
    $this->db->where('id', $id);
    $this->db->update('inventory_category', $data);
    return true;
  }
  // DELETE INVENTORY CATEGORY
  public function delete_inventory_category($id) {
    $this->db->where('id', $id);
    $this->db->delete('inventory_category');
    return true;
  }


  // GET ALL INVENTORIES ACCORDING TO LISITNG
  public function get_listing_wise_inventories($listing_id){
    $this->db->where('listing_id', $listing_id);
    return $this->db->get('inventory')->result_array();
  }

  // GET INVENTORY BY ID
  public function get_inventory_by_id($id){
    $this->db->where('id', $id);
    return $this->db->get('inventory')->row_array();
  }
  // ADD NEW INVENTORY
  public function add_inventory() {
    $data['name'] = sanitizer($this->input->post('name'));
    $data['unit'] = sanitizer($this->input->post('unit'));
    $data['category_id'] = sanitizer($this->input->post('category_id'));
    $data['details'] = sanitizer($this->input->post('details'));
    $data['price'] = sanitizer($this->input->post('price')) > 0 ? sanitizer($this->input->post('price')) : 0;
    $data['listing_id'] = sanitizer($this->input->post('active_listing_id'));
    $data['availability'] = sanitizer($this->input->post('availability')) ? 1 : 0;
    $data['is_featured'] = sanitizer($this->input->post('is_featured')) ? 1 : 0;
    $data['thumbnail']  = $this->upload_product_image($_FILES['thumbnail']);
    $this->db->insert('inventory', $data);
    return true;
  }

  // UPDATE AN INVENTORY
  public function update_inventory() {
    $id = sanitizer($this->input->post('id'));
    $previous_data = $this->get_inventory_by_id($id);
    $data['name'] = sanitizer($this->input->post('name'));
     $data['unit'] = sanitizer($this->input->post('unit'));
    $data['category_id'] = sanitizer($this->input->post('category_id'));
    $data['details'] = sanitizer($this->input->post('details'));
    $data['price'] = sanitizer($this->input->post('price')) > 0 ? sanitizer($this->input->post('price')) : 0;
    $data['availability'] = sanitizer($this->input->post('availability')) ? 1 : 0;
     $data['is_featured'] = sanitizer($this->input->post('is_featured')) ? 1 : 0;
    if (!empty($_FILES['thumbnail']['name'])) {
      $data['thumbnail']  = $this->upload_product_image($_FILES['thumbnail'], $previous_data["thumbnail"]);
    }
    $this->db->where('id', $id);
    $this->db->update('inventory', $data);
    return true;
  }

  // DELETE AN INVENTORY
  public function delete_inventory($id) {

    $this->db->where('id', $id);
    $this->db->delete('inventory');
    return true;
  }



  // CHECK IF THE LISTING BELONGS TO THIS USER
  function is_listing_belongs_to_user($listing_id) {
    if (empty($listing_id)) {
      return false;
    }
    // GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
    $listing_details = $this->crud_model->get_listings($listing_id);
    if ($listing_details->num_rows() == 0) {
      return false;
    }

    return true;
  }
  // CHECK IF THE INVENTORY CATEGORY BELONGS TO THIS USER
  function is_inventory_category_belongs_to_user($inventory_category_id) {
    if (empty($inventory_category_id)) {
      return false;
    }

    $inventory_category_details = $this->db->get_where('inventory_category', array('id' => $inventory_category_id))->row_array();
    if (count($inventory_category_details) > 0) {
      // GET THE ACTIVE LISTING DETAILS, AND CHEKING IF THE LISTING IS BELONGS TO THE USER
      $listing_details = $this->crud_model->get_listings($inventory_category_details['listing_id']);
      if ($listing_details->num_rows() == 0) {
        return false;
      }else{
        return true;
      }
    }else{
      return false;
    }
  }

  // COMMON UPLOAD METHOD
  function upload_product_image($new_file, $previous_file = NULL)
  {
    $directory = 'uploads/shop';
    // MAKE DIRECTORY FIRST
    if (!file_exists($directory)) {
      mkdir($directory, 0777, true);
    }
    // REMOEV THE PREVIOUS FILE FIRST
    if (!empty($previous_file) && $previous_file != "placeholder.png") {
      if (file_exists("$directory/$previous_file")) {
        unlink("$directory/$previous_file");
      }
    }

    // UPLOAD NEW FILE
    if (!empty($new_file['tmp_name'])) {
      $file_name = $this->random(20) . '.jpg';
      $uploaded_image = $directory ."/". $file_name;
      return move_uploaded_file($new_file['tmp_name'], $uploaded_image) ? $file_name : "placeholder.png";
    }

    return "placeholder.png";
  }

  // GENERATE RANDOM NUMBER
  function random($length_of_string)
  {
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result), 0, $length_of_string);
  }


  // CART ITEMS
  function cart_items($listing_id) {
    $this->db->where(['user_id' => $this->session->userdata('user_id'), 'listing_id' => $listing_id]);
    return $this->db->get('shopping_cart')->result_array();
  }

  // CART HANDLER
  function cart_handler() {
    $data['user_id'] = $this->session->userdata('user_id');
    $data['inventory_id'] = sanitizer($this->input->post('inventoryId'));
    $data['quantity'] = sanitizer($this->input->post('quantity'));
    $isAddedToCart = sanitizer($this->input->post('addedToCart'));

    // GET INVENTORY DETAILS
    $inventory_details = $this->shop_model->get_inventory_by_id($data['inventory_id']);
    $data['listing_id'] = $inventory_details['listing_id'];
    $data['price'] = $inventory_details['price'] * $data['quantity'];
    // CHECK EXISTING CART DETAILS
    $previous_cart_data = $this->db->get_where('shopping_cart', ['user_id' => $data['user_id'], 'inventory_id' => $data['inventory_id'], 'listing_id' => $data['listing_id']]);

    if ($previous_cart_data->num_rows() == 0 && $isAddedToCart == 1) {
      $this->db->insert('shopping_cart', $data);
    }else {
      $previous_cart_data = $previous_cart_data->row_array();
      if ($previous_cart_data['quantity'] != $data['quantity'] && $isAddedToCart == 1) {
        $this->db->where('id', $previous_cart_data['id']);
        $this->db->update('shopping_cart', $data);
      }elseif ($previous_cart_data['quantity'] == $data['quantity'] && $isAddedToCart != 1) {
        $this->db->where('id', $previous_cart_data['id']);
        $this->db->delete('shopping_cart');
      }
    }

    // SELECT SUMMATION OF THE CART ITEMS
    $total_cart_amount = $this->db->select_sum('price')->where(array('user_id' => $data['user_id'], 'listing_id' => $data['listing_id']))->get('shopping_cart')->row()->price;

    return currency($total_cart_amount);
  }

  // CONFIRMING AN ORDER
  public function confirm_order() {
    $listing_id = sanitizer($this->input->post('listing_id'));
    $listing_details = $this->db->get_where('listing', ['id' => $listing_id])->row_array();
    $checker = array(
      'listing_id' => $listing_id,
      'user_id' => $this->session->userdata('user_id')
    );
    $cart_items = $this->db->get_where('shopping_cart', $checker)->result_array();

    // CHECK IF CART ITEMS ARE EMPTY
    if (count($cart_items) > 0) {
      $order_data['total_amount'] = $this->db->select_sum('price')->where($checker)->get('shopping_cart')->row()->price;

      // CHECK IF TOTAL AMOUNT IS ZERO
      if ($order_data['total_amount'] > 0) {

        // CHECK IF DELIVERY DETAILS IS EMPTY
        if(str_replace(' ', '', sanitizer($this->input->post('customer_name'))) != "" && str_replace(' ', '', sanitizer($this->input->post('delivery_address'))) != "" && str_replace(' ', '', sanitizer($this->input->post('delivery_contact'))) != ""){
          $order_data['code'] = $this->random(15);
          $order_data['user_id'] = $this->session->userdata('user_id');
          $order_data['listing_id'] = $listing_id;
          $order_data['listing_owner_id'] = $listing_details['user_id'];
          $order_data['customer_name'] = sanitizer($this->input->post('customer_name'));
          $order_data['delivery_address'] = sanitizer($this->input->post('delivery_address'));
          $order_data['delivery_contact'] = sanitizer($this->input->post('delivery_contact'));
          $order_data['note'] = sanitizer($this->input->post('note'));
          $order_data['delivery_status'] = "pending";
          $order_data['payment_status'] = "pending";
          $order_data['order_placed_at'] = strtotime(date('D, d-M-Y'));
          $this->db->insert('order', $order_data);

          // NOW INSERT TO ORDER DETAILS
          foreach ($cart_items as $cart_item) {
            $order_details_data['code'] = $order_data['code'];
            $order_details_data['inventory_id'] = $cart_item['inventory_id'];
            $order_details_data['quantity'] = $cart_item['quantity'];
            $order_details_data['total_amount'] = $cart_item['price'];
            $this->db->insert('order_details', $order_details_data);
          }

          // NOW REMOVE FROM CART ITEMS
          $this->db->where($checker);
          $this->db->delete('shopping_cart');

          $this->session->set_flashdata('flash_message', get_phrase('order_has_been_placed_successfully'));
          $this->session->set_flashdata('is_order_confirmed', true);
        }else{
          $this->session->set_flashdata('error_message', get_phrase('address_and_contact_are_mandatory'));
        }
      }else{
        $this->session->set_flashdata('error_message', get_phrase('total_amount_can_not_be_zero'));
      }
    }else{
      $this->session->set_flashdata('error_message', get_phrase('you_have_not_added_any_product_yet'));
    }
  }

  public function get_orders_by_listing_id($listing_id) {
    $this->db->where('listing_id', $listing_id);
    return $this->db->get('order')->result_array();
  }

  public function get_orders_by_conditions($conditions = [])
  {
    foreach ($conditions as $key => $value) {
      if ($value != null) {
        $this->db->where($key, $value);
      }
    }
    if ($this->session->userdata('user_login') == true) {
      $this->db->where('listing_owner_id', $this->session->userdata('user_id'));
    }
    $orders = $this->db->get('order');
    return $orders->result_array();
  }

  public function mark_order_as_paid($order_id) {
    $order_details = $this->db->get_where('order', array('id' => $order_id))->row_array();
    if ($this->is_listing_belongs_to_user($order_details['listing_id'])) {
      $updater = array('payment_status' => 'paid');
      $this->db->where('id', $order_id);
      $this->db->update('order', $updater);
      $this->session->set_flashdata('flash_message', get_phrase('order_has_been_marked_as_paid'));
    }else{
      $this->session->set_flashdata('error_message', get_phrase('you_have_not_have_access'));
    }
  }
  public function mark_order_as_delivered($order_id) {
    $order_details = $this->db->get_where('order', array('id' => $order_id))->row_array();
    if ($this->is_listing_belongs_to_user($order_details['listing_id'])) {
      if ($order_details['payment_status'] == "paid") {
        $updater['order_delivered_at'] = strtotime(date('D, d-M-Y'));
        $updater['delivery_status'] = 'delivered';
        $this->db->where('id', $order_id);
        $this->db->update('order', $updater);
        $this->session->set_flashdata('flash_message', get_phrase('order_has_been_marked_as_delivered'));
      }else{
          $this->session->set_flashdata('error_message', get_phrase('unpaid_orders_can_not_be_marked_as_delivered'));
      }
    }else{
      $this->session->set_flashdata('error_message', get_phrase('you_have_not_have_access'));
    }
  }
  public function mark_order_as_delete($order_id) {
    $order_details = $this->db->get_where('order', array('id' => $order_id))->row_array();
    if ($this->is_listing_belongs_to_user($order_details['listing_id'])) {
      if ($order_details['delivery_status'] == "pending") {
        $this->db->where('id', $order_id);
        $this->db->delete('order');
        $this->session->set_flashdata('flash_message', get_phrase('order_has_been_deleted'));
      }else{
          $this->session->set_flashdata('error_message', get_phrase('delivered_orders_can_not_be_deleted'));
      }
    }else{
      $this->session->set_flashdata('error_message', get_phrase('you_have_not_have_access'));
    }
  }

  public function get_my_orders() {
    $this->db->where('user_id', $this->session->userdata('user_id'));
    return $this->db->get('order')->result_array();
  }

  public function get_my_order_by_code($order_code) {
    $checker = array(
      'user_id' => $this->session->userdata('user_id'),
      'code' => $order_code
    );
    return $this->db->get_where('order', $checker)->row_array();
  }

  public function recaptcha_settings() {
    $data['description'] = sanitizer($this->input->post('recaptcha_sitekey'));
    $this->db->where('type', 'recaptcha_sitekey');
    $this->db->update('settings', $data);

    $data['description'] = sanitizer($this->input->post('recaptcha_secretkey'));
    $this->db->where('type', 'recaptcha_secretkey');
    $this->db->update('settings', $data);
    $this->session->set_flashdata('flash_message', get_phrase('recaptcha_settings_updated'));
  }
}
