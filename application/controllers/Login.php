<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    private $exp_time = 2147483647; //set a cookie that expires in ten years:


    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        $this->load->library('facebook');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        // Set the timezone
		date_default_timezone_set(get_settings('timezone'));


    }

    public function index() {
         
        if ($this->session->userdata('admin_login') == true) {
            redirect(site_url('admin/dashboard'), 'refresh');
        }elseif ($this->session->userdata('user_login') == true) {
            redirect(site_url('user/dashboard'), 'refresh');
        }else {
            redirect(site_url('home/login'), 'refresh');
        }
    }

    public function validate_login($from = "") {

        // if(get_cookie('remember')) {
            
        //     $email = get_cookie('email');
        //     $password = get_cookie('password');
            
        //     $credential = array('email' => $email, 'password' => sha1($password), 'is_verified' => 1);

        //     // Checking login credential for admin
        //     $query = $this->db->get_where('user', $credential);
        //     if ($query->num_rows() > 0) {
        //         $row = $query->row();
        //         $user_id = $row->id;
        //         $this->user_model->edit_user_online($user_id,1);
        //         $this->session->set_userdata('is_logged_in', 1);
        //         $this->session->set_userdata('user_id', $user_id);
        //         $this->session->set_userdata('role_id', $row->role_id);
        //         $this->session->set_userdata('role', get_user_role('user_role', $user_id));
        //         $this->session->set_userdata('name', $row->name);
        //         if ($row->role_id == 1) {
        //             $this->session->set_userdata('admin_login', '1');
        //             redirect(site_url('admin/dashboard'), 'refresh');
        //         }else if($row->role_id == 2){
        //             $this->session->set_userdata('user_login', '1');
        //             redirect(site_url('user/dashboard'), 'refresh');
        //         }
        //     }else {
        //         $this->session->set_flashdata('error_message', get_phrase('provided_credentials_are_invalid'));
        //         redirect(site_url('home/login'), 'refresh');

        //     }
        // } 
        // else {

            $email = sanitizer($this->input->post('email'));
            $password = sanitizer($this->input->post('password'));

            $remember = $this->input->post('remember');
                
            if($remember) {
                set_cookie("email", $email, $this->exp_time);
                set_cookie("password", $password, $this->exp_time);
                set_cookie("remember", $remember, $this->exp_time);
            } else {
                delete_cookie("email");
                delete_cookie("password");
                delete_cookie("remember");
            }

            $credential = array('email' => $email, 'password' => sha1($password), 'is_verified' => 1);

            // Checking login credential for admin
            $query = $this->db->get_where('user', $credential);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $user_id = $row->id;
                $this->user_model->edit_user_online($user_id,1);
                $this->session->set_userdata('is_logged_in', 1);
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_userdata('role_id', $row->role_id);
                $this->session->set_userdata('role', get_user_role('user_role', $user_id));
                $this->session->set_userdata('name', $row->name);
                $this->session->set_userdata('email', $row->email);
                if ($row->role_id == 1) {
                    $this->session->set_userdata('admin_login', '1');
                    redirect(site_url('admin/dashboard'), 'refresh');
                }else if($row->role_id == 2){
                    $this->session->set_userdata('user_login', '1');
                    redirect(site_url('user/dashboard'), 'refresh');
                }
            }else {
                $this->session->set_flashdata('error_message', get_phrase('provided_credentials_are_invalid'));
                redirect(site_url('home/login'), 'refresh');

            }

        // }


        

    }

    public function register_user() {
        $email = sanitizer($this->input->post('email'));
        $name = sanitizer($this->input->post('name'));
        $password = sha1(sanitizer($this->input->post('password')));
        $address = sanitizer($this->input->post('address'));
        $phone = sanitizer($this->input->post('phone'));

        if(empty($email) || empty($name) || empty($password) || empty($address) || empty($phone)){
            $this->session->set_flashdata('error_message', get_phrase('fill_in_all_the_fields'));
            redirect(site_url('home/login'), 'refresh');    
        }

		$this->user_model->add_user();
		redirect(site_url('home/login'), 'refresh');
	}
	
	//register facebook user
	//register facebook user

    public function register_facebook_user()
    {
        $data['user'] = array();
        if ($this->facebook->is_authenticated()) {
            // User logged in, get user details
            $user = $this->facebook->request('get', '/me?fields=id,name,email,picture');
            if (!isset($user['error'])) {
                $email = $user['email'];
                $name = $user['name'];
              //Get the file
                $content = file_get_contents($user['picture']['data']['url']);
                //echo $content;exit;
                 //$rand = time().$name.'.jpg';
        //Store in the filesystem.
                $fp = fopen($_SERVER['DOCUMENT_ROOT']."/uploads/temp/image.jpg", "w");
                fwrite($fp, $content);
                fclose($fp);
                $picture = $_SERVER['DOCUMENT_ROOT']."/uploads/temp/image.jpg";
                //echo $picture;exit;

                $credential = array('email' => $email , 'is_verified' => 1);

                // Checking login credential for admin
                $query = $this->db->get_where('user', $credential);

                if ($query->num_rows() > 0) {
                    //  echo 'here';exit;
                    $row = $query->row();
                    $user_id = $row->id;
                    $this->user_model->edit_user_online($user_id,1);
                    $this->session->set_userdata('is_logged_in', 1);
                    $this->session->set_userdata('user_id', $user_id);
                    $this->session->set_userdata('role_id', $row->role_id);
                    $this->session->set_userdata('role', get_user_role('user_role', $user_id));
                    $this->session->set_userdata('name', $row->name);
                    if ($row->role_id == 1) {
                        $this->session->set_userdata('admin_login', '1');
                        redirect(site_url('admin/dashboard'), 'refresh');
                    }else if($row->role_id == 2){
                        $this->session->set_userdata('user_login', '1');
                        redirect(site_url('user/dashboard'), 'refresh');
                    }
                }else {
                    $email = sanitizer($email);
                    $name = sanitizer($name);

                    if(empty($email) || empty($name)){
                        $this->session->set_flashdata('error_message', 'Your facebook do not have email address, please add email to your facebook and then continue here');
                        redirect(site_url('home/login'), 'refresh');
                    }
                    $picture = sanitizer($picture);

                    $this->user_model->add_google_user($name,$email,$picture);

                    $credential = array('email' => $email , 'is_verified' => 1);

                    // Checking login credential for admin
                    $query = $this->db->get_where('user', $credential);

                    if ($query->num_rows() > 0) {
                        //  echo 'here';exit;
                        $row = $query->row();
                        $user_id = $row->id;
                       $this->user_model->edit_user_online($user_id,1);
                        $this->session->set_userdata('is_logged_in', 1);
                        $this->session->set_userdata('user_id', $user_id);
                        $this->session->set_userdata('role_id', $row->role_id);
                        $this->session->set_userdata('role', get_user_role('user_role', $user_id));
                        $this->session->set_userdata('name', $row->name);
                        if ($row->role_id == 1) {
                            $this->session->set_userdata('admin_login', '1');
                            redirect(site_url('admin/dashboard'), 'refresh');
                        }else if($row->role_id == 2){
                            $this->session->set_userdata('user_login', '1');
                            redirect(site_url('user/dashboard'), 'refresh');
                        }
                    }


                }


            }

        } 
    }
//register facebook user ends
	//register facebook user ends
	
	
	
	//register google user
    public function register_google_user() {
            require_once 'googleapi/vendor/autoload.php';
        // init configuration
        $clientID = '49389833011-r70fjrm1p2fumrdihk3rvifaflfve8jk.apps.googleusercontent.com';
        $clientSecret = '5XRvdCdNPmitHj7k6otzYt5M';
        $redirectUri = base_url().'Login/register_google_user/';
        // create Client Request to access Google API
        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        //  Set the scopes required for the API you are going to call
        $client->addScope("email");
        $client->addScope("profile");

// authenticate code from Google OAuth Flow
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);

            // get profile info
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            //create a new user
      //new user creation ends
//            echo '<pre>';
//            print_r($google_account_info);
//            echo '</pre>';
//            exit;
            $email = $google_account_info->email;
            $name = $google_account_info->name;
            $picture = $google_account_info->picture;
            $credential = array('email' => $email , 'is_verified' => 1);

            // Checking login credential for admin
            $query = $this->db->get_where('user', $credential);

            if ($query->num_rows() > 0) {
              //  echo 'here';exit;
                $row = $query->row();
                $user_id = $row->id;
                $this->user_model->edit_user_online($user_id,1);
                $this->session->set_userdata('is_logged_in', 1);
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_userdata('role_id', $row->role_id);
                $this->session->set_userdata('role', get_user_role('user_role', $user_id));
                $this->session->set_userdata('name', $row->name);
                if ($row->role_id == 1) {
                    $this->session->set_userdata('admin_login', '1');
                    redirect(site_url('admin/dashboard'), 'refresh');
                }else if($row->role_id == 2){
                    $this->session->set_userdata('user_login', '1');
                    redirect(site_url('user/dashboard'), 'refresh');
                }
            }else {
                $email = sanitizer($email);
                $name = sanitizer($name);

                if(empty($email) || empty($name)){
                    $this->session->set_flashdata('error_message', get_phrase('fill_in_all_the_fields'));
                    redirect(site_url('home/login'), 'refresh');
                }
                $picture = sanitizer($picture);

                $this->user_model->add_google_user($name,$email,$picture);

                $credential = array('email' => $email , 'is_verified' => 1);


                // Checking login credential for admin
                $query = $this->db->get_where('user', $credential);

                if ($query->num_rows() > 0) {
                    //  echo 'here';exit;
                    $row = $query->row();
                    $user_id = $row->id;
                    $this->user_model->edit_user_online($user_id,1);
                    $this->session->set_userdata('is_logged_in', 1);
                    $this->session->set_userdata('user_id', $user_id);
                    $this->session->set_userdata('role_id', $row->role_id);
                    $this->session->set_userdata('role', get_user_role('user_role', $user_id));
                    $this->session->set_userdata('name', $row->name);
                    if ($row->role_id == 1) {
                        $this->session->set_userdata('admin_login', '1');
                        redirect(site_url('admin/dashboard'), 'refresh');
                    }else if($row->role_id == 2){
                        $this->session->set_userdata('user_login', '1');
                        redirect(site_url('user/dashboard'), 'refresh');
                    }
                }


            }
         }


    }
//register_google_user ends

    function logout() {
        $user_id = $this->session->userdata('user_id');
        if(!empty($user_id))
        {
            $this->user_model->edit_user_online($user_id,0);
        }
        $this->session->sess_destroy();
        redirect(site_url('home/login'), 'refresh');
    }

    function forgot_password($from = "") {
        $email = sanitizer($this->input->post('email'));
        //resetting user password here
        $new_password = substr( md5( rand(100000000,20000000000) ) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('user' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $this->db->where('email' , $email);
            $this->db->update('user' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password, $email);
            $this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            redirect(site_url('home/login'), 'refresh');
        }else {
            $this->session->set_flashdata('error_message', get_phrase('password_reset_failed'));
            redirect(site_url('home/login'), 'refresh');
        }
    }

    // function for user verification
    public function verify_email_address($verification_code = "") {
        $user_details = $this->db->get_where('user', array('verification_code' => $verification_code));
        if($user_details->num_rows() == 0) {
            $this->session->set_flashdata('error_message', get_phrase('verification_failed'));
        }else {
            $user_details = $user_details->row_array();
            $updater = array(
                'is_verified' => 1
            );
            $this->db->where('id', $user_details['id']);
            $this->db->update('user', $updater);
            $this->session->set_flashdata('flash_message', get_phrase('congratulations').'!'.get_phrase('your_email_address_has_been_successfully_verified').'.');
        }
        redirect(site_url('home'), 'refresh');
    }
}
