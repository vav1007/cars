<?php
defined('BASEPATH') or die('Error occured while loading the Categories');
/*
 * Page Name        :    Settings
 * page Type          :    Controllor
 * Folder Path         :   controller/superadmin/Settings.php
 * purpose              :    Site related(slider,brand,color,size etc)
 * Created By         :    V.Venkateswara Achari
 * Created Date      :      18-04-2018
 */
class Settings extends CI_Controller{
    public $data,$ipaddress,$adminid,$current_controller,$settings_viewfolder_path;
     public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('superadmin/Settings_model');
        $this->ipaddress = $this->input->ip_address();
        $this->adminid=$this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'id');
        $this->current_controller=SITE_ADMIN_LINK.'Settings/';
        $this->settings_viewfolder_path=ADMIN_VIEW_PATH.'settings/';
    }
  /*
   |--------------------------------------------------------------------------
    Settings modules
      1) Slider (Create : done | view : done | update : done | Delete : pending)
      2) Size (Create : done | view : done | update : done | Delete : pending)
     
   |--------------------------------------------------------------------------
   */
    public function slider($page_type = NULL) {
            $main_list='Slider List';
        switch ($page_type) {
            /* Create Page Code */
            case 'Create':
                $this->data['URL_TITLE'] = 'Create Slider';
                $this->data['link_url'] = $this->current_controller. 'slider';
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>  $this->current_controller. 'slider', 'class' => ''),
                    array('title' => 'Create Slider', 'link' => $this->current_controller .'slider/Create', 'class' => 'active'),
                );
                $page_name = 'create';
                break;
            //Slider details code
             case 'details':
                $slider_title= urldecode($this->uri->segment(5));
                $slider_id=  $this->uri->segment(6);
                $this->data['URL_TITLE'] =$slider_title.' Details' ;
                $this->data['link_url'] = $this->current_controller. 'slider';
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>  $this->current_controller. 'slider', 'class' => ''),
                    array('title' =>'Details', 'link' =>'', 'class' => ''),
                    array('title' => "<b style='color:green;'>$slider_title</b>", 'link' => '', 'class' => 'active'),
                );
                $this->data['slider_details']=  $this->Settings_model->sliderDetails($slider_id);
                $page_name = 'update';
                break;
            /* List Page Code */
            default :
                $this->data['URL_TITLE'] = $main_list;
                $this->data['create_link_url'] = $this->current_controller . 'slider/Create';
                $this->data['create_link_title'] = 'Add Slider';
                $page_name = 'view';
                $breadcrumb_array = array(
                    array('title' =>$main_list, 'link' =>  $this->current_controller .'slider', 'class' => 'active'),
                );
                /*Search Condition Code Start*/
                   $search_array=array();
                  $search_name=  $this->input->post('search_name');
                  $search_activation=  $this->input->post('search_activation');
                  $search_array['name']=(!empty($search_name))?$search_name:'';
                  $search_array['activation']=($search_activation!='')?$search_activation:'';
                /*Search Condition Code End*/
                $this->data['slider_details'] = $this->Settings_model->sliderList($search_array);
        }
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view($this->settings_viewfolder_path. 'slider/' . $page_name, $this->data);
    }
    public function insertSlider()
    {
        $response=array();
        $title=  $this->input->post('title');
        $description=$this->input->post('description');
        $url=$this->input->post('url');
        $slider=$_FILES['sliderimage']['name'];
        if($title!='' && $slider!='')   {
                if (!is_dir(UPLOADS.'slider')) { mkdir('./'.UPLOADS .'slider', 0777, TRUE); }
                $slider_folder=UPLOADS.'slider/';
                $insert_slider_image='';
                //Slider Code Start
                    if(isset($slider) && $slider!='')
                     {
                         $slider_file_name=$_FILES['sliderimage']['name'];
                         $slider_file_path=$_FILES['sliderimage']['tmp_name'];
                            $crop_array = array(
                                        'filename' => $slider_file_name,
                                        'filepath' => $slider_file_path,
                                        'uploadpath' => $slider_folder,
                                        'extension_name' => 'Slider',
                                        'clarity' => 100,
                                        'width' => 1200,
                                        'height' => 474,
                                    );
                                     $insert_slider_image = $this->project_image->crop($crop_array);
                     }
                     $insert_array=array(
                         'title'=>$title,
                         'slider_image'=>$insert_slider_image,
                         'description'=>$description,
                         'url_link'=>$url,
                         'created_date'=>DATE,
                         'created_ip_address'=>  $this->ipaddress,
                         'created_by'=>  $this->adminid,
                         'created_role'=>1,
                     );
                     $display_message=$title.' Slider added successfully';
                    $insert=  $this->Crud->commonInsert('slider_tbl',$insert_array,$display_message);
                    echo $insert;exit;
        }
        else{
                $response[CODE]=VALIDATION_CODE;
                $response[MESSAGE]='Validation Error';
                $response[DESCRIPTION]='* Please fill manditory feilds';
        }
    }
    //update Slider
    public function updateSlider()
    {
        $response=array();
        $sliderid=  $this->input->post('sliderid');
        $title=  $this->input->post('title');
        $description=$this->input->post('description');
        $url=$this->input->post('url');
        $slider=$_FILES['sliderimage']['name'];
        if($title!='' && num_check($sliderid) )   {
                if (!is_dir(UPLOADS.'slider')) { mkdir('./'.UPLOADS .'slider', 0777, TRUE); }
                $slider_folder=UPLOADS.'slider/';
                $insert_slider_image='';
                //Slider Code Start
                    if(isset($slider) && $slider!='')
                     {
                         $slider_file_name=$_FILES['sliderimage']['name'];
                         $slider_file_path=$_FILES['sliderimage']['tmp_name'];
//                         $slider_display_name='Slider'.md5($title.time()).  rand(0000, 9999);
//                         $extension=fileExtension($slider_file_name);
//                         $insert_slider_image=$slider_display_name.'.'.$extension;
//                         //move_uploaded_file($slider_file_path,$slider_folder.$insert_slider_image);
//                          $info = getimagesize($slider_file_path);
//                          //Jpg
//                            if ($info['mime'] == 'image/jpeg')  $image = imagecreatefromjpeg($slider_file_path);
//                            //GIF
//                            elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($slider_file_path);
//                            //PNG
//                            elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($slider_file_path);
//                            $move= imagejpeg($image, $slider_folder.$insert_slider_image, 50);
                                 $crop_array = array(
                                        'filename' => $slider_file_name,
                                        'filepath' => $slider_file_path,
                                        'uploadpath' => $slider_folder,
                                        'extension_name' => 'Slider',
                                        'clarity' => 100,
                                        'width' => 1200,
                                        'height' => 474,
                                    );
                                     $insert_slider_image = $this->project_image->crop($crop_array);
                     }
                     $update_array=array(
                         'title'=>$title,
                         'description'=>$description,
                         'ulink'=>$url,
                     );
                     if(!empty($insert_slider_image))
                     {
                         $update_array=array(
                                                            'title'=>$title,
                                                            'description'=>$description,
                                                            'ulink'=>$url,
                                                            'slider_image'=>$insert_slider_image,
                                                           );
                     }
                     $display_message=$title.' Slider updated successfully';
                    $update=  $this->Crud->commonUpdate('slider_tbl',$update_array,array('id'=>$sliderid),$display_message);
                    echo $update;exit;
        }
        else{
                $response[CODE]=VALIDATION_CODE;
                $response[MESSAGE]='Validation Error';
                $response[DESCRIPTION]='* Please fill manditory feilds';
        }
    }
    /*Sizes Code Start*/
    public function size($page_type = NULL) {
            $main_list='Size List';
            $main_link=$this->current_controller.'size';
            $create_link=$this->current_controller.'size/Create';
        switch ($page_type) {
            /* Create Page Code */
            case 'Create':
                $this->data['URL_TITLE'] = 'Create Size';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => 'Create ', 'link' =>$create_link, 'class' => 'active'),
                );
                $page_name = 'create';
                break;
            case 'details':
                $size_id=  $this->uri->segment(5);
                $this->data['URL_TITLE'] = 'update Size';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => 'Details', 'link' =>'', 'class' => ''),
                    array('title' => 'Update ', 'link' =>'', 'class' => 'active'),
                );
                $this->data['size_details']=  $this->Settings_model->sizeDetails($size_id);
                $page_name = 'update';
                break;
            /* List Page Code */
            default :
                $this->data['URL_TITLE'] = $main_list;
                $this->data['create_link_url'] = $create_link;
                $this->data['create_link_title'] = 'Create Size';
                $page_name = 'view';
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
                $this->data['result_details'] = $this->Settings_model->sizeList($search_array);
        }
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view($this->settings_viewfolder_path. 'size/' . $page_name, $this->data);
    }
    //Insert Sizes
     public function insertSize()
    {
        $response=array();
        $height=  $this->input->post('height');
        $width=  $this->input->post('width');
        $length=  $this->input->post('length');
        if($height!='' || $width!='' || $length!='')
        {
                $insert_array=array(
                    'height'=>$height,
                    'width'=>$width,
                    'length'=>$length,
                    'created_date'=>DATE,
                    'created_ipaddress'=>  $this->ipaddress,
                    'created_by'=>  $this->adminid,
                    'created_role'=>1,
                    'activation_status'=>1,
                );
            $insert=  $this->Crud->commonInsert('size_tbl',$insert_array,'Size added successfully..!');
            echo $insert;exit;
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validations';
            $response[DESCRIPTION]='* please fill manditory feilds';
        }
        echo json_encode($response);
    }
    //Update Size Details
     public function updateSize()
    {
        $response=array();
        $id=  $this->input->post('size_id');
        $height=  $this->input->post('height');
        $width=  $this->input->post('width');
        $length=  $this->input->post('length');
        if(($height!='' || $width!='' || $length!='') && num_check($id))
        {
                $update_array=array(
                    'height'=>$height,
                    'width'=>$width,
                    'length'=>$length,
                );
            $update=  $this->Crud->commonUpdate('size_tbl',$update_array,array('id'=>$id),'Size updated successfully..!');
            echo $update;exit;
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validations';
            $response[DESCRIPTION]='* please fill manditory feilds';
        }
        echo json_encode($response);
    }
}