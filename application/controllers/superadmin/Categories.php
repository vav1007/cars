<?php

defined('BASEPATH') or die('Error occured while loading the Categories');
/*
 * Page Name    : Categories
 * page Type    : Controllor
 * Folder Path  : controller/superadmin/Categories.php
 * purpose      : Writing Category related methods (Menu,submenu,listsubmenu etc..)
 * Created By   : V.Venkateswara Achari
 * Created Date : 18-04-2018
 */

class Categories extends CI_Controller {

    public $data, $ipaddress, $adminid;

    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('superadmin/Categories_model');
        $this->ipaddress = $this->input->ip_address();
        $this->adminid = $this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'id');
        $this->data['menu_details'] = $this->Common->menu();
        $this->data['submenu_details'] = $this->Common->subMenu();
    }
 /*
  |--------------------------------------------------------------------------
	Other modules
	1) Menu                         (Create : done | view : done | update : complete | Delete : pending)
	2) SubMenu                    (Create : done | view : done | update : complete | Delete : pending)
                    3) List Sub Menu	(Create : done | view : done | update : complete | Delete : pending)
  * 	
 |--------------------------------------------------------------------------
 */
    public function menu($page_type = NULL) {

        switch ($page_type) {
            /* Create Page Code */
            case 'Create':
                $this->data['URL_TITLE'] = 'Create Menu';
                $this->data['link_url'] = SITE_ADMIN_LINK . 'Categories/menu';
                $this->data['link_title'] = 'Menu List';
                $breadcrumb_array = array(
                    array('title' => 'Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/menu', 'class' => ''),
                    array('title' => 'Create Menu', 'link' => SITE_ADMIN_LINK . 'Categories/menu/Create', 'class' => 'active'),
                );
                $page_name = 'create';
                break;
            /* Update */
            case 'Details':
                $updated_title = $this->uri->segment(5);
                $updated_title = urldecode($updated_title);
                $id = $this->uri->segment(6);
                $id=  base64_decode($id);
                $this->data['URL_TITLE'] = $updated_title . '  Update Menu';
                $this->data['link_url'] = SITE_ADMIN_LINK . 'Categories/menu';
                $this->data['link_title'] = 'Menu List';
                $breadcrumb_array = array(
                    array('title' => 'Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/menu', 'class' => ''),
                    array('title' => 'Details', 'link' => '', 'class' => ''),
                    array('title' => $updated_title, 'link' => '', 'class' => 'active'),
                );
                $this->data['menu_details']=  $this->Categories_model->menuDetails($id);
                $page_name = 'update';
                break;
            /* List Page Code */
            default :
                $this->data['URL_TITLE'] = 'Menu List';
                $this->data['create_link_url'] = SITE_ADMIN_LINK . 'Categories/menu/Create';
                $this->data['create_link_title'] = 'Add Menu';
                $page_name = 'menulist';
                $breadcrumb_array = array(
                    array('title' => 'Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/menu', 'class' => 'active'),
                );
                /* Search Condition Code Start */
                $search_array = array();
                $search_name = $this->input->post('search_name');
                $search_activation = $this->input->post('search_activation');
                $search_array['name'] = (!empty($search_name)) ? $search_name : '';
                $search_array['activation'] = ($search_activation != '') ? $search_activation : '';
                /* Search Condition Code End */
                $this->data['menu_details'] = $this->Categories_model->menuList($search_array);
                $this->data['update_link'] = SITE_ADMIN_LINK . 'Categories/menu/Details/';
        }
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view(ADMIN_VIEW_PATH . 'categories/menu/' . $page_name, $this->data);
    }

    //Submenu
    public function subMenu($page_type = NULL) {

        switch ($page_type) {
            /* Create Page Code */
            case 'Create':
                $this->data['URL_TITLE'] = 'Create SubMenu';
                $this->data['link_url'] = SITE_ADMIN_LINK . 'Categories/subMenu';
                $this->data['link_title'] = 'Sub Menu List';
                $breadcrumb_array = array(
                    array('title' => 'Sub Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/subMenu', 'class' => ''),
                    array('title' => 'Create Sub Menu', 'link' => SITE_ADMIN_LINK . 'Categories/subMenu/Create', 'class' => 'active'),
                );
                $page_name = 'create';
                break;
                /* Update */
            case 'Details':
                $updated_title = $this->uri->segment(5);
                $updated_title = urldecode($updated_title);
                $id = $this->uri->segment(6);
                $id=  base64_decode($id);
                $this->data['URL_TITLE'] = $updated_title . '  Update Sub Menu';
                $this->data['link_url'] = SITE_ADMIN_LINK . 'Categories/subMenu';
                $this->data['link_title'] = 'Menu List';
                $breadcrumb_array = array(
                    array('title' => 'Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/subMenu', 'class' => ''),
                    array('title' => 'Details', 'link' => '', 'class' => ''),
                    array('title' => $updated_title, 'link' => '', 'class' => 'active'),
                );
                $this->data['submenu_details']=  $this->Categories_model->submenuDetails($id);
                $page_name = 'update';
                break;
            /* List Page Code */
            default :
                $this->data['URL_TITLE'] = 'Sub Menu List';
                $this->data['create_link_url'] = SITE_ADMIN_LINK . 'Categories/subMenu/Create';
                $this->data['create_link_title'] = 'Add Sub Menu';
                $page_name = 'submenulist';
                $breadcrumb_array = array(
                    array('title' => 'Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/menu', 'class' => ''),
                    array('title' => 'Sub Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/subMenu', 'class' => 'active'),
                );
                /* Search Condition Code Start */
                $search_array = array();

                $search_menu_id = $this->input->post('search_menu');
                $search_name = $this->input->post('search_name');
                $search_activation = $this->input->post('search_activation');
                $search_array['menu'] = (!empty($search_menu_id)) ? $search_menu_id : '';
                $search_array['name'] = (!empty($search_name)) ? $search_name : '';
                $search_array['activation'] = ($search_activation != '') ? $search_activation : '';
                /* Search Condition Code End */
                $this->data['submenu_details'] = $this->Categories_model->subMenuList($search_array);
                $this->data['update_link'] = SITE_ADMIN_LINK . 'Categories/subMenu/Details/';
        }
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view(ADMIN_VIEW_PATH . 'categories/submenu/' . $page_name, $this->data);
    }
     //List Sub Menu
    public function listSubMenu($page_type = NULL) {

        switch ($page_type) {
            /* Create Page Code */
            case 'Create':
                $this->data['URL_TITLE'] = 'Create List Sub Menu';
                $this->data['link_url'] = SITE_ADMIN_LINK . 'Categories/listSubMenu';
                $this->data['link_title'] = 'List Sub Menu List';
                $breadcrumb_array = array(
                    array('title' => 'List Sub Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/listSubMenu', 'class' => ''),
                    array('title' => 'Create List Sub Menu', 'link' => SITE_ADMIN_LINK . 'Categories/listSubMenu/Create', 'class' => 'active'),
                );
                $this->data['menu_details'] = $this->Common->menu();
                $page_name = 'create';
                break;
            /* Update Page Code */
            case 'Details':
                $updatetitle=urldecode($this->uri->segment(5));
                $updateid=urldecode($this->uri->segment(6));
                $this->data['URL_TITLE'] = 'Update List Sub Menu';
                $this->data['link_url'] = SITE_ADMIN_LINK . 'Categories/listSubMenu';
                $this->data['link_title'] = 'List Sub Menu List';
                $breadcrumb_array = array(
                    array('title' => 'List Sub Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/listSubMenu', 'class' => ''),
                    array('title' => 'Update List Sub Menu', 'link' => SITE_ADMIN_LINK . 'Categories/listSubMenu/Details', 'class' => 'active'),
                );
                $this->data['lsm_details'] = $this->Categories_model->getLSMDetails($updateid);
                $page_name = 'update';
                break;
            /* View Page Code */
            default :
                $this->data['URL_TITLE'] = 'List Sub Menu List';
                $this->data['create_link_url'] = SITE_ADMIN_LINK . 'Categories/listSubMenu/Create';
                $this->data['create_link_title'] = 'Add List Sub Menu';
                $page_name = 'view';
                $breadcrumb_array = array(
                    array('title' => 'Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/menu', 'class' => ''),
                    array('title' => 'Sub Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/subMenu', 'class' => ''),
                    array('title' => 'List Sub Menu List', 'link' => SITE_ADMIN_LINK . 'Categories/listSubMenu', 'class' => 'active'),
                );
                /* Search Condition Code Start */
                $search_array = array();
                $search_submenu_id = $this->input->post('search_submenu');
                $search_name = $this->input->post('search_name');
                $search_activation = $this->input->post('search_activation');
                $search_array['submenu'] = (!empty($search_submenu_id)) ? $search_submenu_id : '';
                $search_array['name'] = (!empty($search_name)) ? $search_name : '';
                $search_array['activation'] = ($search_activation != '') ? $search_activation : '';
                /* Search Condition Code End */
                $this->data['listsubmenu_details'] = $this->Categories_model->listSubMenuList($search_array);
                $this->data['update_link'] =SITE_ADMIN_LINK . 'Categories/listSubMenu/Details/';
        }
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view(ADMIN_VIEW_PATH . 'categories/listsubmenu/' . $page_name, $this->data);
    }
    //Menu Insert
    public function insertMenu() {
//        print_r($_POST);
//        print_r($_FILES);exit;
        $response = array();
        $menu = $this->input->post('title');
        $priority = $this->input->post('menupriority');
        $icon = $_FILES['icon']['name'];
        $menuimage = $_FILES['menuimage']['name'];
        $app_icon = $_FILES['app_icon']['name'];
        if (!empty($menu)) {
            /* Check Menu Exists or Not */
            $check = $this->Crud->commonCheck('id', 'menu_tbl', array('title' => $menu,'activation_status!='=>5));
            if ($check == 0) {
                if (!is_dir(UPLOADS.'category')) { mkdir('./'.UPLOADS .'category', 0777, TRUE); }
                if (!is_dir(UPLOADS . 'category/menu')) {
                    mkdir('./' . UPLOADS . 'category/menu', 0777, TRUE);
                }
                $destination = UPLOADS . 'category/menu/';
                $insert_icon = $insert_menuimage = $insert_appicon = '';
                //Icon Code Start
                if (isset($icon) && $icon != '') {
                    $icon_file_name = $_FILES['icon']['name'];
                    $icon_file_path = $_FILES['icon']['tmp_name'];
                    $crop_array = array(
                        'filename' => $icon_file_name,
                        'filepath' => $icon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Menu_Icon',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $insert_icon = $this->project_image->crop($crop_array);
                }
                //Menu Image Code Start
                if (isset($menuimage) && $menuimage != '') {
                    $menu_file_name = $_FILES['menuimage']['name'];
                    $menu_file_path = $_FILES['menuimage']['tmp_name'];
                    $crop_array = array(
                        'filename' => $menu_file_name,
                        'filepath' => $menu_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Menu_Image',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $insert_menuimage = $this->project_image->crop($crop_array);
                }
                //App Icon Code
                if (isset($app_icon) && $app_icon != '') {
                    $app_file_name = $_FILES['app_icon']['name'];
                    $app_file_path = $_FILES['app_icon']['tmp_name'];
                    $crop_array = array(
                        'filename' => $app_file_name,
                        'filepath' => $app_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Menu_App',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $insert_appicon = $this->project_image->crop($crop_array);
                }
                $insert_array = array(
                    'title' => $menu,
                    'menu_icon' => $insert_icon,
                    'app_icon' => $insert_appicon,
                    'image' => $insert_menuimage,
                    'priority'=>$priority,
                    'created_date' => DATE,
                    'created_ip_address' => $this->ipaddress,
                    'created_by' => $this->adminid,
                    'created_role' => 1,
                );
                $display_message = $menu . ' added successfully';
                $insert = $this->Crud->commonInsert('menu_tbl', $insert_array, $display_message);
                echo $insert;
                exit;
            } else {
                $response[CODE] = EXISTS_CODE;
                $response[MESSAGE] = 'Already Exists';
                $response[DESCRIPTION] = $menu . ' already exists';
            }
        } else {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validation Error';
            $response[DESCRIPTION] = '* Please fill manditory feilds';
        }
        echo json_encode($response);
    }
    //update Menu
    public function updateMenu()
    {
        error_reporting(0);
//        print_r($_POST);
//        print_r($_FILES);exit;
        $response = array();
        $menu = $this->input->post('title');
        $priority = $this->input->post('menupriority');
        $id = $this->input->post('menu_id');
        $icon_image = $this->input->post('icon_image');
        $menu_image = $this->input->post('menu_image');
        $appicon_image = $this->input->post('appicon_image');
        $icon = $_FILES['icon']['name'];
        $menuimage = $_FILES['menuimage']['name'];
        $app_icon = $_FILES['app_icon']['name'];
        $icon_image=(empty($icon))?str_replace(base_url().UPLOADS.'category/menu/','', $icon_image):$icon_image;
        $menu_image=(empty($menuimage))?str_replace(base_url().UPLOADS.'category/menu/','', $menu_image):$menu_image;
        $appicon_image=(empty($app_icon))?str_replace(base_url().UPLOADS.'category/menu/','', $appicon_image):$appicon_image;
        if (!empty($menu) && !empty($id)) {
            /* Check Menu Exists or Not */
            $check = $this->Crud->commonCheck('id', 'menu_tbl', array('title' => $menu,'id !='=>$id,'activation_status !='=>5));
            if ($check == 0) {
                /*unset, resize of images start*/
                 if (!is_dir(UPLOADS.'category')) { mkdir('./'.UPLOADS .'category', 0777, TRUE); }
                if (!is_dir(UPLOADS . 'category/menu')) {
                    mkdir('./' . UPLOADS . 'category/menu', 0777, TRUE);
                }
                $destination=UPLOADS . 'category/menu/';
                //Icon
                if (isset($icon) && $icon != '') {
                    /*unset*/
                    unlink(str_replace(base_url(),'', $icon_image));
                    /*unset end*/
                    $icon_file_name = $_FILES['icon']['name'];
                    $icon_file_path = $_FILES['icon']['tmp_name'];
                     $crop_array = array(
                        'filename' => $icon_file_name,
                        'filepath' => $icon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Menu_Icon',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $icon_image = $this->project_image->crop($crop_array);
                }
                //Menu Image
                if (isset($menuimage) && $menuimage != '') {
                    /*unset*/
                    unlink(str_replace(base_url(),'', $menu_image));
                    /*unset end*/
                    $menu_file_name = $_FILES['menuimage']['name'];
                    $menu_file_path = $_FILES['menuimage']['tmp_name'];
                     $crop_array = array(
                        'filename' => $menu_file_name,
                        'filepath' => $menu_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Menu_Image',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $menu_image = $this->project_image->crop($crop_array);
                }
                //App Icon
                if (isset($app_icon) && $app_icon != '') {
                    /*unset*/
                    unlink(str_replace(base_url(),'', $appicon_image));
                    /*unset end*/
                    $app_file_name = $_FILES['app_icon']['name'];
                    $app_file_path = $_FILES['app_icon']['tmp_name'];
                    $crop_array = array(
                        'filename' => $app_file_name,
                        'filepath' => $app_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Menu_App',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $appicon_image = $this->project_image->crop($crop_array);
                }
                /*unset, resize of images end*/
                $update_array = array(
                    'title' => $menu,
                    'priority'=>$priority,
                    'menu_icon'=>$icon_image,
                    'app_icon'=>$appicon_image,
                    'image'=>$menu_image,
                );
                $display_message = $menu . ' updated successfully';
                $update = $this->Crud->commonUpdate('menu_tbl', $update_array,array('id'=>$id), $display_message);
                echo $update;
                exit;
            } else {
                $response[CODE] = EXISTS_CODE;
                $response[MESSAGE] = 'Already Exists';
                $response[DESCRIPTION] = $menu . ' already exists';
            }
        } else {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validation Error';
            $response[DESCRIPTION] = '* Please fill manditory feilds';
        }
        echo json_encode($response);
    }
    //SubMenu Insert 
    public function insertSubMenu() {
        $response = array();
        $menu = $this->input->post('menu');
        $priority = $this->input->post('menupriority');
        $sm_data = $this->input->post('title');
        $icon = $_FILES['icon']['name'];
        $subimage = $_FILES['image']['name'];
        $app_icon = $_FILES['app_icon']['name'];
        $count = count($sm_data);
        $icon_image=$submenu_image=$appicon_image='';
        if (num_check($menu) && num_check($count)) {
            $insert_array = array();
            for ($i = 0; $i < $count; $i++) {
                $sm_name = $sm_data[$i];
                $check = $this->Crud->commonCheck('id', 'submenu_tbl', array('title' => $sm_name, 'menu_id' => $menu));
                if ($check == 0) {
                     if (!is_dir(UPLOADS.'category')) { mkdir('./'.UPLOADS .'category', 0777, TRUE); }
                    if (!is_dir(UPLOADS . 'category/submenu')) {
                    mkdir('./' . UPLOADS . 'category/submenu', 0777, TRUE);
                }
                    $destination='uploads/category/submenu/';
                     //Icon
                    if (isset($icon) && $icon != '') {
                    $icon_file_name = $_FILES['icon']['name'];
                    $icon_file_path = $_FILES['icon']['tmp_name'];
                    $crop_array = array(
                        'filename' => $icon_file_name,
                        'filepath' => $icon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Submenu_Icon',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $icon_image = $this->project_image->crop($crop_array);
                }
                //Menu Image
                if (isset($subimage) && $subimage != '') {
                    $submenu_file_name = $_FILES['image']['name'];
                    $submenu_file_path = $_FILES['image']['tmp_name'];
                    $crop_array = array(
                        'filename' => $submenu_file_name,
                        'filepath' => $submenu_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Submenu_Image',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $submenu_image = $this->project_image->crop($crop_array);
                }
                 //App Icon
                if (isset($app_icon) && $app_icon != '') {
                    $app_file_name = $_FILES['app_icon']['name'];
                    $app_file_path = $_FILES['app_icon']['tmp_name'];
                     $crop_array = array(
                        'filename' => $app_file_name,
                        'filepath' => $app_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Submenu_App',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $appicon_image = $this->project_image->crop($crop_array);
                }
                    $insert_array[] = array(
                        'menu_id' => $menu,
                        'title' => $sm_name,
                        'icon' => $icon_image,
                        'image' => $submenu_image,
                        'priority'=>$priority,
                        'app_icon' => $appicon_image,
                        'created_date' => DATE,
                        'created_ip_address' => $this->ipaddress,
                        'created_by' => $this->adminid,
                        'created_role' => 1,
                        'activation_status' => 1,
                    );
                }
            }
            if (count($insert_array) > 0 && is_array($insert_array)) {
                $insert_bulk = $this->Crud->batchInsert('submenu_tbl', $insert_array);
                echo $insert_bulk;
                exit;
            } else {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validations';
                $response[DESCRIPTION] = "$sm_name already exists..";
            }
        } else {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validations';
            $response[DESCRIPTION] = '* please fill manditory feilds';
        }
        echo json_encode($response);
    }
    //update sub menu
    public function updateSubMenu()
    {
//        print_r($_POST);
//        print_r($_FILES);exit;
        error_reporting(0);
        $response = array();
        $updateid = $this->input->post('updateid');
        $title = $this->input->post('title');
        $priority = $this->input->post('menupriority');
        $sm_image = $this->input->post('sm_image');
        $sm_icon = $this->input->post('sm_icon');
        $sm_appicon = $this->input->post('sm_appicon');
        $icon = $_FILES['icon']['name'];
        $subimage = $_FILES['image']['name'];
        $appicon = $_FILES['app_icon']['name'];
        $sm_icon=(empty($icon))?str_replace(base_url().UPLOADS.'category/submenu/','', $sm_icon):$sm_icon;
        $sm_image=(empty($subimage))?str_replace(base_url().UPLOADS.'category/submenu/','', $sm_image):$sm_image;
        $sm_appicon=(empty($appicon))?str_replace(base_url().UPLOADS.'category/submenu/','', $sm_appicon):$sm_appicon;
        if (!empty($title) && !empty($updateid)) {
            /* Check Sub menu Exists or Not */
            $check = $this->Crud->commonCheck('id', 'submenu_tbl', array('title'=>$title,'id !='=>$updateid,'activation_status !='=>5));
            if($check==0)
            {
                 if (!is_dir(UPLOADS.'category')) { mkdir('./'.UPLOADS .'category', 0777, TRUE); }
                 if (!is_dir(UPLOADS . 'category/submenu')) {
                    mkdir('./' . UPLOADS . 'category/submenu', 0777, TRUE);
                }
                    $destination=UPLOADS.'category/submenu/';
                //Icon
                if (isset($icon) && $icon != '') {
                    /*unset*/
                    unlink(str_replace(base_url(),'', $sm_icon));
                    /*unset end*/
                    $icon_file_name = $_FILES['icon']['name'];
                    $icon_file_path = $_FILES['icon']['tmp_name'];
                    $crop_array = array(
                        'filename' => $icon_file_name,
                        'filepath' => $icon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Submenu_Icon',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $sm_icon = $this->project_image->crop($crop_array);
                }
                //Image
                 if (isset($subimage) && $subimage != '') {
                    /*unset*/
                    unlink(str_replace(base_url(),'', $sm_image));
                    /*unset end*/
                    $icon_file_name = $_FILES['image']['name'];
                    $icon_file_path = $_FILES['image']['tmp_name'];
                   $crop_array = array(
                        'filename' => $icon_file_name,
                        'filepath' => $icon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Submenu_Image',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $sm_image = $this->project_image->crop($crop_array);
                }
                //App Icon
                 if (isset($appicon) && $appicon != '') {
                    /*unset*/
                    unlink(str_replace(base_url(),'', $sm_appicon));
                    /*unset end*/
                    $icon_file_name = $_FILES['app_icon']['name'];
                    $icon_file_path = $_FILES['app_icon']['tmp_name'];
                    $crop_array = array(
                        'filename' => $icon_file_name,
                        'filepath' => $icon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Submenu_Image',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $sm_appicon = $this->project_image->crop($crop_array);
                }
                
                $update_array = array(
                    'title' => $title,
                    'icon'=>$sm_icon,
                    'app_icon'=>$sm_appicon,
                    'image'=>$sm_image,
                    'priority'=>$priority,
                );
                $display_message = $title . ' updated successfully';
                $update = $this->Crud->commonUpdate('submenu_tbl', $update_array,array('id'=>$updateid), $display_message);
                echo $update;
                exit;
            }
            else
            {
                $response[CODE] = EXISTS_CODE;
                $response[MESSAGE] = 'Already Exists';
                $response[DESCRIPTION] = $title . ' already exists';
            }
        }
        else
        {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validation Error';
            $response[DESCRIPTION] = '* Please fill manditory feilds';
        }
        echo json_encode($response);
    } 
    //ListSubMenu Insert 
    public function insertListSubMenu() {
        $response = array();
        $menu = $this->input->post('menu');
        $submenu = $this->input->post('submenu');
        $sml_data = $this->input->post('title');
        $icon = $_FILES['icon']['name'];
        $listsubimage = $_FILES['image']['name'];
        $appicon = $_FILES['app_icon']['name'];
        $sm_appicon=$lsm_icon=$lsm_image='';
        $count = count($sml_data);
        if (num_check($menu) && num_check($submenu) && num_check($count)) {
            $insert_array = array();
            for ($i = 0; $i < $count; $i++) {
                $sml_name = $sml_data[$i];
                $check = $this->Crud->commonCheck('id', 'listsubmenu_tbl', array('title' => $sml_name, 'submenu_id' => $submenu));
                if ($check == 0) {
                     if (!is_dir(UPLOADS.'category')) { mkdir('./'.UPLOADS .'category', 0777, TRUE); }
                    if (!is_dir(UPLOADS.'category/listsubmenu')) { mkdir('./'.UPLOADS .'category/listsubmenu', 0777, TRUE); }
                    $destination=UPLOADS.'category/listsubmenu/';
                    //Icon
                    if (isset($icon) && $icon != '') {
                        $icon_file_name = $_FILES['icon']['name'];
                        $icon_file_path = $_FILES['icon']['tmp_name'];
                         $crop_array = array(
                        'filename' => $icon_file_name,
                        'filepath' => $icon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'LSM_Icon',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $lsm_icon = $this->project_image->crop($crop_array);
                    }
                    //Image
                     if (isset($listsubimage) && $listsubimage != '') {
                        $img_file_name = $_FILES['image']['name'];
                        $img_file_path = $_FILES['image']['tmp_name'];
                        $crop_array = array(
                        'filename' => $img_file_name,
                        'filepath' => $img_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'LSM_Image',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $lsm_image = $this->project_image->crop($crop_array);
                    }
                    //App Icon
                     if (isset($appicon) && $appicon != '') {
                        $appicon_file_name = $_FILES['app_icon']['name'];
                        $crop_array = array(
                        'filename' => $appicon_file_name,
                        'filepath' => $appicon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'LSM_App',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $sm_appicon = $this->project_image->crop($crop_array);
                    }
                    $insert_array[] = array(
                        'submenu_id' => $submenu,
                        'title' => $sml_name,
                        'icon' => $lsm_icon,
                        'app_icon' => $sm_appicon,
                        'image' => $lsm_image,
                        'created_date' => DATE,
                        'created_ip_address' => $this->ipaddress,
                        'created_by' => $this->adminid,
                        'created_role' => 1,
                        'activation_status' => 1,
                    );
                }
            }
            if (count($insert_array) > 0 && is_array($insert_array)) {
                $insert_bulk = $this->Crud->batchInsert('listsubmenu_tbl', $insert_array);
                echo $insert_bulk;
                exit;
            } else {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validations';
                $response[DESCRIPTION] = 'Entered list submenu exists..';
            }
        } else {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validations';
            $response[DESCRIPTION] = '* please fill manditory feilds';
        }
        echo json_encode($response);
    }
//update list sub menu
    public function updateListSubMenu()
    {
        error_reporting(0);
        $response=array();
        $updateid = $this->input->post('updateid');
        $title = $this->input->post('title');
        $lsm_image = $this->input->post('lsm_image');
        $lsm_icon = $this->input->post('lsm_icon');
        $lsm_appicon = $this->input->post('lsm_appicon');
        $icon = $_FILES['icon']['name'];
        $listsubimage = $_FILES['image']['name'];
        $appicon = $_FILES['app_icon']['name'];
        $lsm_icon=(empty($icon))?str_replace(base_url().UPLOADS.'category/listsubmenu/','', $lsm_icon):$lsm_icon;
        $lsm_image=(empty($listsubimage))?str_replace(base_url().UPLOADS.'category/listsubmenu/','', $lsm_image):$lsm_image;
        $lsm_appicon=(empty($appicon))?str_replace(base_url().UPLOADS.'category/listsubmenu/','', $lsm_appicon):$lsm_appicon;
         if (!empty($title) && !empty($updateid)) {
            /* Check Sub menu Exists or Not */
            $check = $this->Crud->commonCheck('id', 'listsubmenu_tbl', array('title'=>$title,'id !='=>$updateid,'activation_status !='=>5));
            if($check==0)
            {
                 if (!is_dir(UPLOADS.'category')) { mkdir('./'.UPLOADS .'category', 0777, TRUE); }
                 if (!is_dir(UPLOADS.'category/listsubmenu')) { mkdir('./'.UPLOADS .'category/listsubmenu', 0777, TRUE); }
                $destination=UPLOADS.'category/listsubmenu/';
                //Icon
                if (isset($icon) && $icon != '') {
                    /*unset*/
                    unlink(str_replace(base_url(),'', $lsm_icon));
                    /*unset end*/
                    $icon_file_name = $_FILES['icon']['name'];
                      $crop_array = array(
                        'filename' => $icon_file_name,
                        'filepath' => $icon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'LSM_Icon',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $lsm_icon = $this->project_image->crop($crop_array);
                }
                //Image
                 if (isset($listsubimage) && $listsubimage != '') {
                    /*unset*/
                    unlink(str_replace(base_url(),'', $lsm_image));
                    /*unset end*/
                    $icon_file_name = $_FILES['image']['name'];
                    $icon_file_path = $_FILES['image']['tmp_name'];
                     $crop_array = array(
                        'filename' => $icon_file_name,
                        'filepath' => $icon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'LSM_Image',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $lsm_image = $this->project_image->crop($crop_array);
                }
                //App Icon
                 if (isset($appicon) && $appicon != '') {
                    /*unset*/
                    unlink(str_replace(base_url(),'', $lsm_appicon));
                    /*unset end*/
                    $icon_file_name = $_FILES['app_icon']['name'];
                    $icon_file_path = $_FILES['app_icon']['tmp_name'];
                     $crop_array = array(
                        'filename' => $icon_file_name,
                        'filepath' => $icon_file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'LSM_App',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $lsm_appicon = $this->project_image->crop($crop_array);
                }
                
                $update_array = array(
                    'title' => $title,
                    'icon'=>$lsm_icon,
                    'app_icon'=>$lsm_appicon,
                    'image'=>$lsm_image,
                );
                $display_message = $title . ' updated successfully';
                $update = $this->Crud->commonUpdate('listsubmenu_tbl', $update_array,array('id'=>$updateid), $display_message);
                echo $update;
                exit;
            }
            else
            {
                $response[CODE] = EXISTS_CODE;
                $response[MESSAGE] = 'Already Exists';
                $response[DESCRIPTION] = $title . ' already exists';
            }
        }
         else
        {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validation Error';
            $response[DESCRIPTION] = '* Please fill manditory feilds';
        }
        echo json_encode($response);         
    }
}
