<?php

defined('BASEPATH') or die('Error occured while loading the controller');
/*
 * Page Name    : Welcome
 * page Type    : Controllor
 * Folder Path  : controller/superadmin/Welcome.php
 * purpose      : Writing common Crud related queries 
 * Created By   : V.Venkateswara Achari
 * Created Date : 08-03-2016
 */

class Welcome extends CI_Controller {

    public $data,$ipaddress,$adminid;

    public function __construct() {
        parent::__construct();
        $this->data = array();
        /* loading the Models Code Start */
        $this->load->model('superadmin/Admin_profile_model');
        /* loading the Models Code End */
        $this->ipaddress = $this->input->ip_address();
        $this->adminid=$this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'id');
    }
    /*
   |--------------------------------------------------------------------------
    Welcome modules
      1) Login (done)
      2) Change Password (done)
      3) Logout (done)
     
   |--------------------------------------------------------------------------
   */
    public function index() {
        $this->data['utitle'] = ':: Dashboard';
        $this->data['dashboard_statistics']=$this->Admin_profile_model->getDashboard();
        $this->load->view(ADMIN_VIEW_PATH . 'dashboard', $this->data);
    }
   public function login() {
        $this->data['utitle'] = ' -Superadmin Login';
        $this->load->helper('captcha');
        $vals = array(
            'img_path' => './captcha/',
            'img_url' => base_url() . 'captcha/',
            'img_width' => '150',
            'img_height' => '33',
            'expiration' => 7200,
        );
        $captcha = create_captcha($vals);
        $this->data['captcha_image'] = $captcha['image'];
        $this->data['captcha_data'] = $captcha['word'];
        $this->session->set_userdata('admin_captcha', $captcha['word']);
        $this->load->view(ADMIN_VIEW_PATH . 'profile/login', $this->data);
    }

    public function logAuth() {
        /*
         * Purpose : Superadmin login
         * view    : login.php
         */
        $response = array();
        $posted_data = file_get_contents("php://input");
        $postdata = json_decode($posted_data);
        $log_user = $postdata->username;
        $log_password = $postdata->userpassword;
        if ($log_user != '' && $log_password != '') {
            $log_col_name = '';
            $password = hash("SHA256", $log_password . $this->config->item('salt'), false);
            $admin_log_array = array('username' => $log_user, 'password' => $password,);
            $log_req = $this->Admin_profile_model->adminAuthenticate($admin_log_array);
            $log_response = json_decode($log_req);
            if ($log_response->code == SUCCESS_CODE) {
                $admin_result = $log_response->admin_profile_details;
                $admin_status = $admin_result->status;
                switch ($admin_status) {
                    case 1:
                        $admin_sess_array = array(
                            PROJECT_SESS_ADMIN_CODE . 'id' => $admin_result->id,
                            PROJECT_SESS_ADMIN_CODE . 'profilecode' => $admin_result->profilecode,
                            PROJECT_SESS_ADMIN_CODE . 'name' => $admin_result->name,
                            PROJECT_SESS_ADMIN_CODE . 'displayname' => $admin_result->displayname,
                            PROJECT_SESS_ADMIN_CODE . 'email' => $admin_result->email,
                            PROJECT_SESS_ADMIN_CODE . 'mobile' => $admin_result->mobile,
                            PROJECT_SESS_ADMIN_CODE . 'role' => $admin_result->role,
                            PROJECT_SESS_ADMIN_CODE . 'permissions' => $admin_result->permissions,
                        );
                        $this->session->set_userdata($admin_sess_array);
                        $this->session->unset_userdata('admin_captcha');
                        /* user Log Code Start */
                        $log_array = array(
                            'user_id' => $admin_result->id,
                            'log_in_time' => DATE,
                            'log_date' => DATE,
                            'log_ip_address' => $this->ipaddress,
                        );
                        $this->Crud->commonInsert('admin_log_history_tbl', $log_array);
                        /* user Log Code End */
                        $response[CODE] = SUCCESS_CODE;
                        $response[MESSAGE] = 'Success';
                        $response[DESCRIPTION] = 'Please wait..';
                        $response['redirection'] = SITE_ADMIN_LINK;
                        break;
                    case 0:
                        $response[CODE] = FAIL_CODE;
                        $response[DESCRIPTION] = 'Account deactivated.';
                        break;
                    case 2:
                        $response[CODE] = FAIL_CODE;
                        $response[DESCRIPTION] = 'Please verify the email';
                        break;
                }
            } else {
                $response[CODE] = FAIL_CODE;
                $response[MESSAGE] = 'Invalid credentials';
                $response[DESCRIPTION] = 'Invalid Credentials';
            }
        } else {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Valiation';
            $response[DESCRIPTION] = '* Please fill manditory feilds';
        }
        echo json_encode($response);
    }

    public function adminLogout() {
        $this->session->sess_destroy();
        redirect(SITE_ADMIN_LINK);
    }

    //Status code Activate
    public function dataActivationStatus() {
        $response = array();
        $input_req = file_get_contents('php://input');
        $input_response = json_decode($input_req);
        $input_table = strtolower(trim($input_response->table));
        $input_status = trim($input_response->status);
        $input_data = $input_response->inputdata;
        $error = 0;
        $errror_message = '';
        if ($input_table == '') {
            $error = 1;
            $errror_message.='* Table name missing.';
        }
        if ($input_status > 5) {
            $error = 1;
            $errror_message.='* Status is missing.';
        }
        if ($input_data == '') {
            $error = 1;
            $errror_message.='* Input data is missing.';
        }
        if ($error == 0) {
            $table = $setcols = $condition = '';
            switch ($input_table) {
                case 'menu':/* menu table */
                    $table = 'menu_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                case 'submenu':/* submenu table */
                    $table = 'submenu_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                case 'listsubmenu':/* submenu table */
                    $table = 'listsubmenu_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                case 'slider':/* Slider table */
                    $table = 'slider_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                case 'size':/* Size table */
                    $table = 'size_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                case 'product':/* Product table */
                    $table = 'product_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                
                case 'faqs':/* Faq table */
                    $table = 'faq_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                case 'testimonials':/* testimonials table */
                    $table = 'testimonials_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                
                  case 'newsletter':/* Newsletter table */
                    $table = 'newsletter_tbl';
                    $setcols = 'activation_status ';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                    case 'brand':/* Brandtable */
                    $table = 'brand_tbl';
                    $setcols = 'activation_status ';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                    case 'shape':/* Shape */
                    $table = 'shape_tbl';
                    $setcols = 'activation_status ';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                    case 'producttype':/* product type */
                    $table = 'producttype_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                    case 'color':/* color */
                    $table = 'color_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
                    case 'model':/* Model */
                    $table = 'model_tbl';
                    $setcols = 'activation_status';
                    $condition = "id IN  (" . $input_data . ")";
                    break;
            }
            if ($table != '' && $setcols != '' && $condition != '') {
                $update = $this->Crud->commonStatusUpdate(trim($table), array($setcols => $input_status), $condition, $input_status);
                echo $update;
                exit;
            } else {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation error';
                $response[DESCRIPTION] = $errror_message;
            }
        } else {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validation error';
            $response[DESCRIPTION] = $errror_message;
        }
        echo json_encode($response);
    }

    //Submenu List based on menu id
    public function submenuWithMenu() {
        $submenu_data = '<option value="0">--Choose Sub Menu--</option>';
        $menu_id = $this->input->post('menu');
        if (num_check($menu_id)) {
            $submenu_qry = $this->Common->subMenu(array('menu_id' => $menu_id));
            $request = json_decode($submenu_qry);
            if ($request->code == SUCCESS_CODE) {
                foreach($request->submenu_result as $response){ 
                    $submenu_data.='<option value="'.$response->id.'">'.$response->title.'</option>';
                }
            } else {
                $submenu_data.='<option value="0">No results found</option>';
            }
        } else {
            $submenu_data.='<option value="0">No results found</option>';
        }
        echo $submenu_data;
    }
    //Change  password
    public function changePassword()
    {
         $this->data['URL_TITLE'] = 'Change Password';
                $this->data['link_url'] = SITE_ADMIN_LINK;
                $this->data['link_title'] = '';
                $breadcrumb_array = array(
                    array('title' => 'Profile', 'link' => SITE_ADMIN_LINK, 'class' => ''),
                    array('title' => 'Change password', 'link' =>'', 'class' => 'active'),
                );
           $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view(ADMIN_VIEW_PATH . 'profile/changepassword', $this->data);      
    }
    //Update password 
    public function updatePassword()
    {
          $response=array();
          $req_q=  file_get_contents('php://input');
          $req_response=  json_decode($req_q);
          $old_password=$req_response->opwd;
         $new_password=$req_response->new_password;
         $admin_id=  $this->adminid;
         if(!empty($old_password) && !empty($new_password)){
             if($old_password!=$new_password) {
                 $update_old_password = hash("SHA256", $old_password . $this->config->item('salt'), false);
                 $update_new_password = hash("SHA256", $new_password . $this->config->item('salt'), false);
                 $check_array=array(
                     'admin_secure_code'=>$update_old_password,
                     'id'=>$admin_id,
                 );
                 $update=  $this->Crud->commonUpdate('superadmin_userlist_tbl',array('admin_secure_code'=>$update_new_password,'last_password_updateddate'=>DATE),$check_array,'Password changed successfully');
                 echo $update;exit;
             }
             else{
                        $response[CODE]=VALIDATION_CODE;
                         $response[MESSAGE]='Password error';
                         $response[DESCRIPTION]='Old Password & new password are same';
                    }
         }
         else{
           $response[CODE]=VALIDATION_CODE;
           $response[MESSAGE]='Validation Error';
           $response[DESCRIPTION]='* Please fill manditory feilds';
         }
         echo json_encode($response);
    }
    //Logout
    public function logOut()
    {
        $this->session->sess_destroy();
        redirect(SITE_ADMIN_LINK);
    }
    //Bank account details code
   public function bankaccounts($page_type = NULL) 
   {
            $main_list='Bank Account List';
            $main_link=SITE_ADMIN_LINK.'Welcome/bankaccounts';
            $create_link=SITE_ADMIN_LINK.'Welcome/bankaccounts/Create';
        switch ($page_type) {
            /* Create Page Code */
            case 'Create':
                $this->data['URL_TITLE'] = 'Create Bank account';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => 'Create Bank account', 'link' =>$create_link, 'class' => 'active'),
                );
                $page_name = 'create';
                break;
            //Details
              case 'details':
                $id=  $this->uri->segment(5);
                $this->data['URL_TITLE'] = 'Update Bank Account details';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => 'Update Bank Account', 'link' =>$create_link, 'class' => 'active'),
                );
                $this->data['bank_details']=  $this->Admin_profile_model->bankAccountDetails($id);
                $page_name = 'update';
                break;
            /* List Page Code */
            default :
                $this->data['URL_TITLE'] = $main_list;
                $this->data['create_link_url'] = $create_link;
                $this->data['create_link_title'] = 'Create Bank Account';
                $page_name = 'bankaccount_list';
                $breadcrumb_array = array(
                    array('title' =>$main_list, 'link' =>$main_link, 'class' => 'active'),
                );
                /*Search Condition Code Start*/
                  $search_array=array();
                  $search_name=  $this->input->post('search_name');
                  $search_activation=  $this->input->post('search_activation');
                  $search_array['name']=(!empty($search_name))?$search_name:'';
                  $search_array['activation']=($search_activation!='')?$search_activation:'';
                /*Search Condition Code End*/
                $this->data['bank_details']=$this->Admin_profile_model->bankAccountList($search_array);
        }
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view(ADMIN_VIEW_PATH . 'bankdetails/'.$page_name, $this->data);      
    }
    //Insert bank details 
    public function insertBankDetails()
    {
          $response=array();
          $req_q=  file_get_contents('php://input');
          $req_response=  json_decode($req_q);
          $bankname=$req_response->bankname;
         $account_number=$req_response->account_number;
         $ifsccode=$req_response->ifsccode;
         $account_type=$req_response->account_type;
         $branch=$req_response->branch;
         $address=$req_response->address;
         $city=$req_response->city;
         if(!empty($bankname) && !empty($bankname) && !empty($bankname) && !empty($bankname) && !empty($bankname) && !empty($bankname) && !empty($bankname))
         {
             //checking the bank account number
             $table_name='admin_bankdetails_tbl';
             $check=  $this->Crud->commonCheck('id',$table_name,array('account_number'=>$account_number));
             if($check==0)
             {
                    $insert_array=array(
                            'admin_id'=>  $this->adminid,
                            'bank_name'=>$bankname,
                            'account_number'=>$account_number,
                            'ifsc_code'=>$ifsccode,
                            'account_type'=>$account_type,
                            'branch'=>$branch,
                            'address'=>$address,
                            'city'=>$city,
                            'created_date'=>DATE,
                            'created_by'=>  $this->adminid,
                            'created_ipaddress'=>  $this->ipaddress,
                        'activation_status'=>0,
                        );
                    $display_msg= $account_number. ' account added successfully';
                    $insert=  $this->Crud->commonInsert($table_name,$insert_array,$display_msg);
                    echo $insert;exit;
             }
             else
             {
                 $response[CODE]=EXISTS_CODE;
                 $response[MESSAGE]='Already exists';
                 $response[DESCRIPTION]=$account_number . ' account number already exists';
             }
         }
         else
         {
             $response[CODE]=VALIDATION_CODE;
             $response[MESSAGE]='Validation';
             $response[DESCRIPTION]=' * please fill manditory feilds';
         }
         echo json_encode($response);
    }
    //Update bank details 
    public function updateBankDetails()
    {
          $response=array();
          $req_q=  file_get_contents('php://input');
          $req_response=  json_decode($req_q);
          $account_id=$req_response->account_id;
          $bankname=$req_response->bankname;
         $account_number=$req_response->account_number;
         $ifsccode=$req_response->ifsccode;
         $account_type=$req_response->account_type;
         $branch=$req_response->branch;
         $address=$req_response->address;
         $city=$req_response->city;
         if(!empty($bankname) && !empty($bankname) && !empty($bankname) && !empty($bankname) && !empty($bankname) && !empty($bankname) && !empty($bankname))
         {
             //checking the bank account number
             $table_name='admin_bankdetails_tbl';
             $check=  $this->Crud->commonCheck('id',$table_name,array('account_number'=>$account_number,'id !='=>$account_id));
             if($check==0)
             {
                    $update_array=array(
                            'admin_id'=>  $this->adminid,
                            'bank_name'=>$bankname,
                            'account_number'=>$account_number,
                            'ifsc_code'=>$ifsccode,
                            'account_type'=>$account_type,
                            'branch'=>$branch,
                            'address'=>$address,
                            'city'=>$city,
                        );
                    $display_msg= $account_number. ' account updated successfully';
                    $update=  $this->Crud->commonUpdate($table_name,$update_array,array('id'=>$account_id),$display_msg);
                    echo $update;exit;
             }
             else
             {
                 $response[CODE]=EXISTS_CODE;
                 $response[MESSAGE]='Already exists';
                 $response[DESCRIPTION]=$account_number . ' account number already exists';
             }
         }
         else
         {
             $response[CODE]=VALIDATION_CODE;
             $response[MESSAGE]='Validation';
             $response[DESCRIPTION]=' * please fill manditory feilds';
         }
         echo json_encode($response);
    }
    //Active bank Account Details
    public function activeBankDetails()
    {
        $response=array();
        $id=  $this->input->post('id');
        if(num_check($id))
        {
            $this->Crud->commonUpdate('admin_bankdetails_tbl',array('activation_status'=>0,),array('activation_status'=>1),'');
            $update=  $this->Crud->commonUpdate('admin_bankdetails_tbl',array('activation_status'=>1),array('id'=>$id),' Bank account activated successfully..!');
             echo $update;exit;
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='* Invalid input details';
        }
        echo json_encode($response);
    }
}
