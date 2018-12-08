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
class Productsettings extends CI_Controller{
    public $data,$ipaddress,$adminid,$current_controller,$settings_viewfolder_path;
     public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model(['superadmin/Productsettings_model'=>'productsetting']);
        $this->ipaddress = $this->input->ip_address();
        $this->adminid=$this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'id');
        $this->current_controller=SITE_ADMIN_LINK.'Productsettings/';
        $this->settings_viewfolder_path=ADMIN_VIEW_PATH.'productsettings/';
    }
  /*
   |--------------------------------------------------------------------------
    Settings modules
      1) Slider (Create : done | view : done | update : done | Delete : pending)
      2) Size (Create : done | view : done | update : done | Delete : pending)
     
   |--------------------------------------------------------------------------
   */
    public function brand($page_type = NULL) {
            $main_list='Brand List';
        switch ($page_type) {
            /* Create Page Code */
            case 'Create':
                $this->data['URL_TITLE'] = 'Create Brand';
                $this->data['link_url'] = $this->current_controller. 'brand';
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>  $this->current_controller. 'brand', 'class' => ''),
                    array('title' => 'Create Brand', 'link' => $this->current_controller .'brand/Create', 'class' => 'active'),
                );
                $page_name = 'create';
                break;
            //Slider details code
             case 'details':
                $slider_title= urldecode($this->uri->segment(5));
                $slider_id=  $this->uri->segment(6);
                $this->data['URL_TITLE'] =$slider_title.' Details' ;
                $this->data['link_url'] = $this->current_controller. 'brand';
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>  $this->current_controller. 'brand', 'class' => ''),
                    array('title' =>'Details', 'link' =>'', 'class' => ''),
                    array('title' => "<b style='color:green;'>$slider_title</b>", 'link' => '', 'class' => 'active'),
                );
                $this->data['slider_details']=  $this->productsetting->brandDetails($slider_id);
                $page_name = 'update';
                break;
            /* List Page Code */
            default :
                $this->data['URL_TITLE'] = $main_list;
                $this->data['create_link_url'] = $this->current_controller . 'brand/Create';
                $this->data['create_link_title'] = 'Add Brand';
                $page_name = 'view';
                $breadcrumb_array = array(
                    array('title' =>$main_list, 'link' =>  $this->current_controller .'brand', 'class' => 'active'),
                );
                /*Search Condition Code Start*/
                   $search_array=array();
                  $search_name=  $this->input->post('search_name');
                  $search_activation=  $this->input->post('search_activation');
                  $search_array['name']=(!empty($search_name))?$search_name:'';
                  $search_array['activation']=($search_activation!='')?$search_activation:'';
                /*Search Condition Code End*/
                $this->data['slider_details'] = $this->productsetting->brandList($search_array);
        }
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view($this->settings_viewfolder_path. 'brand/' . $page_name, $this->data);
    }
    
    public function insertBrand()
    {
        $response=array();
        $title=  $this->input->post('title');
        $slider=$_FILES['sliderimage']['name'];
        if($title!='' && $slider!='')   {
                if (!is_dir(UPLOADS.'brand')) { mkdir('./'.UPLOADS .'brand', 0777, TRUE); }
                $slider_folder=UPLOADS.'brand/';
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
                                        'extension_name' => 'Brand',
                                        'clarity' => 100,
                                        'width' => 200,
                                        'height' => 120,
                                    );
                                     $insert_slider_image = $this->project_image->crop($crop_array);
                     }
                     $insert_array=array(
                         'title'=>$title,
                         'icon'=>$insert_slider_image,
                         'created_date'=>DATE,
                         'created_ipaddress'=>$this->ipaddress,
                         'created_by'=>  $this->adminid,
                         'created_role'=>1,
                     );
                     $display_message=$title.' Brand added successfully';
                    $insert=  $this->Crud->commonInsert('brand_tbl',$insert_array,$display_message);
                    echo $insert;exit;
        }
        else{
                $response[CODE]=VALIDATION_CODE;
                $response[MESSAGE]='Validation Error';
                $response[DESCRIPTION]='* Please fill manditory feilds';
        }
    }
    //update Brand
    public function updateBrand()
    {
        $response=array();
        $sliderid=  $this->input->post('sliderid');
        $title=  $this->input->post('title');
       
        $slider=$_FILES['sliderimage']['name'];
        if($title!='' && num_check($sliderid) )   {
                if (!is_dir(UPLOADS.'brand')) { mkdir('./'.UPLOADS .'brand', 0777, TRUE); }
                $slider_folder=UPLOADS.'brand/';
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
                                        'extension_name' => 'Brand',
                                        'clarity' => 100,
                                        'width' => 200,
                                        'height' => 120,
                                    );
                                     $insert_slider_image = $this->project_image->crop($crop_array);
                     }
                     $update_array=array(
                         'title'=>$title,
                        
                     );
                     if(!empty($insert_slider_image))
                     {
                         $update_array=array(
                                                            'title'=>$title,
                                                            'icon'=>$insert_slider_image,
                                                           );
                     }
                     $display_message=$title.' brand updated successfully';
                    $update=  $this->Crud->commonUpdate('brand_tbl',$update_array,array('id'=>$sliderid),$display_message);
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

    //----------- Shape
    public function shapes($page_type = NULL) {
        $main_list='Shape List';
    switch ($page_type) {
        /* Create Page Code */
        case 'Create':
            $this->data['URL_TITLE'] = 'Create Shape';
            $this->data['link_url'] = $this->current_controller. 'shapes';
            $this->data['link_title'] = $main_list;
            $breadcrumb_array = array(
                array('title' => $main_list, 'link' =>  $this->current_controller. 'shapes', 'class' => ''),
                array('title' => 'Create Shape', 'link' => $this->current_controller .'shapes/Create', 'class' => 'active'),
            );
            $page_name = 'create';
            break;
        //Slider details code
         case 'details':
            $slider_title= urldecode($this->uri->segment(5));
            $slider_id=  $this->uri->segment(6);
            $this->data['URL_TITLE'] =$slider_title.' Details' ;
            $this->data['link_url'] = $this->current_controller. 'shapes';
            $this->data['link_title'] = $main_list;
            $breadcrumb_array = array(
                array('title' => $main_list, 'link' =>  $this->current_controller. 'shapes', 'class' => ''),
                array('title' =>'Details', 'link' =>'', 'class' => ''),
                array('title' => "<b style='color:green;'>$slider_title</b>", 'link' => '', 'class' => 'active'),
            );
            $this->data['slider_details']=  $this->productsetting->shapeDetails($slider_id);
            $page_name = 'update';
            break;
        /* List Page Code */
        default :
            $this->data['URL_TITLE'] = $main_list;
            $this->data['create_link_url'] = $this->current_controller . 'shapes/Create';
            $this->data['create_link_title'] = 'Upload new shape';
            $page_name = 'view';
            $breadcrumb_array = array(
                array('title' =>$main_list, 'link' =>  $this->current_controller .'shapes', 'class' => 'active'),
            );
            /*Search Condition Code Start*/
               $search_array=array();
              $search_name=  $this->input->post('search_name');
              $search_activation=  $this->input->post('search_activation');
              $search_array['name']=(!empty($search_name))?$search_name:'';
              $search_array['activation']=($search_activation!='')?$search_activation:'';
            /*Search Condition Code End*/
            $this->data['slider_details'] = $this->productsetting->shapeList($search_array);
    }
    $this->data['breadcrumb'] = json_encode($breadcrumb_array);
    $this->load->view($this->settings_viewfolder_path. 'shape/' . $page_name, $this->data);
}
public function insertShape()
{
    $response=array();
    $title=  $this->input->post('title');
    $slider=$_FILES['sliderimage']['name'];
    if($title!='')   {
            if (!is_dir(UPLOADS.'shape')) { mkdir('./'.UPLOADS .'shape', 0777, TRUE); }
            $slider_folder=UPLOADS.'shape/';
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
                                    'extension_name' => 'shape',
                                    'clarity' => 100,
                                    'width' => 200,
                                    'height' => 120,
                                );
                                 $insert_slider_image = $this->project_image->crop($crop_array);
                 }
                 $insert_array=array(
                     'title'=>$title,
                     'icon'=>$insert_slider_image,
                     'created_date'=>DATE,
                     'created_ipaddress'=>$this->ipaddress,
                     'created_by'=>  $this->adminid,
                     'created_role'=>1,
                 );
                 $display_message=$title.' Shape added successfully';
                $insert=  $this->Crud->commonInsert('shape_tbl',$insert_array,$display_message);
                echo $insert;exit;
    }
    else{
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation Error';
            $response[DESCRIPTION]='* Please fill manditory feilds';
    }
}

//update Shape
public function updateShape()
{
    $response=array();
    $sliderid=  $this->input->post('sliderid');
    $title=  $this->input->post('title');
   
    $slider=$_FILES['sliderimage']['name'];
    if($title!='' && num_check($sliderid) )   {
            if (!is_dir(UPLOADS.'shape')) { mkdir('./'.UPLOADS .'shape', 0777, TRUE); }
            $slider_folder=UPLOADS.'shape/';
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
                                    'extension_name' => 'shape',
                                    'clarity' => 100,
                                    'width' => 200,
                                    'height' => 120,
                                );
                                 $insert_slider_image = $this->project_image->crop($crop_array);
                 }
                 $update_array=array(
                     'title'=>$title,
                    
                 );
                 if(!empty($insert_slider_image))
                 {
                     $update_array=array(
                                                        'title'=>$title,
                                                        'icon'=>$insert_slider_image,
                                                       );
                 }
                 $display_message=$title.' shape updated successfully';
                $update=  $this->Crud->commonUpdate('shape_tbl',$update_array,array('id'=>$sliderid),$display_message);
                echo $update;exit;
    }
    else{
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation Error';
            $response[DESCRIPTION]='* Please fill manditory feilds';
    }
}

// product type module section start
public function producttype($page_type = NULL) {
    $main_list='Product Type';
    $main_link=$this->current_controller.'producttype';
    $create_link=$this->current_controller.'producttype/Create';
switch ($page_type) {
    /* Create Page Code */
    case 'Create':
        $this->data['URL_TITLE'] = 'Create Product Type';
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' => 'Create ', 'link' =>$create_link, 'class' => 'active'),
        );
        $page_name = 'create';
        break;
    case 'details':
         $producttype_id=  $this->uri->segment(5);
        $this->data['URL_TITLE'] = 'update product type';
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' => 'Details', 'link' =>'', 'class' => ''),
            array('title' => 'Update ', 'link' =>'', 'class' => 'active'),
        );
        $this->data['producttype_details']=  $this->productsetting->productTypeDetails($producttype_id);
        $page_name = 'update';
        break;
    /* List Page Code */
    default :
        $this->data['URL_TITLE'] = $main_list;
        $this->data['create_link_url'] = $create_link;
        $this->data['create_link_title'] = 'Create Product type';
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
        $this->data['result_details'] = $this->productsetting->productTypeList($search_array);
}
$this->data['breadcrumb'] = json_encode($breadcrumb_array);
$this->load->view($this->settings_viewfolder_path. 'producttype/' . $page_name, $this->data);
}

public function insertProductType()
{
    $error=0;$error_messge='';
    $response=[];
    $title = $this->input->post('title');
    if(!is_array($title)){$error=1;$error_messge.='Please enter product type details';}

    if($error == 0 )
    {
        $insertData = [];
        for($i=0;$i<count($title);$i++)
        {
            $insertData[]=[
                'title'=>$title[$i],
                'created_date'=>DATE,
                'created_ipaddress'=>$this->ipaddress,
                'created_by'=>$this->adminid,
                'created_role'=>1,
            ];
        }

        if(is_array($insertData) && count($insertData) > 0)
        {
            $insert = $this->db->insert_batch('producttype_tbl',$insertData);
            $insertCount = $this->db->affected_rows();
            $response[CODE]=($insertCount > 0)?SUCCESS_CODE:VALIDATION_CODE;
            $response[MESSAGE]=($insertCount > 0)?'succes':'fail';
            $response[DESCRIPTION]=($insertCount > 0)?'Product types added successfully':'Product type data is missing';
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Product type data is missing';
        }
    }
    else
    {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation Error';
            $response[DESCRIPTION]='* Please fill manditory feilds';
    }
    echo json_encode($response);
}


public function updateProductType()
    {
        $response=array();
        $id=  $this->input->post('title_id');
        $title=  $this->input->post('title');
        if(($title!='') && num_check($id))
        {
                $update_array=array(
                    'title'=>$title,
                    
                );
            $update=  $this->Crud->commonUpdate('producttype_tbl',$update_array,array('id'=>$id),'Product type updated successfully..!');
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

/* >> Color secion module code start */
public function colors($page_type = NULL) {
    $main_list='Colors';
    $main_link=$this->current_controller.'colors';
    $create_link=$this->current_controller.'colors/Create';
switch ($page_type) {
    /* Create Page Code */
    case 'Create':
        $this->data['URL_TITLE'] = 'Create color';
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' => 'Create ', 'link' =>$create_link, 'class' => 'active'),
        );
        $page_name = 'create';
        break;
    case 'details':
         $producttype_id=  $this->uri->segment(5);
        $this->data['URL_TITLE'] = 'update color';
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' => 'Details', 'link' =>'', 'class' => ''),
            array('title' => 'Update ', 'link' =>'', 'class' => 'active'),
        );
        $this->data['result_details']=  $this->productsetting->colorDetails($producttype_id);
        $page_name = 'update';
        break;
    /* List Page Code */
    default :
        $this->data['URL_TITLE'] = $main_list;
        $this->data['create_link_url'] = $create_link;
        $this->data['create_link_title'] = 'Create color';
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
        $this->data['result_details'] = $this->productsetting->colorList($search_array);
}
$this->data['breadcrumb'] = json_encode($breadcrumb_array);
$this->load->view($this->settings_viewfolder_path. 'color/' . $page_name, $this->data);
}

public function insertColor()
{
    $error=0;$error_messge='';
    $response=[];
    $title = $this->input->post('title');
    if(!is_array($title)){$error=1;$error_messge.='Please enter product type details';}

    if($error == 0 )
    {
        $insertData = [];
        for($i=0;$i<count($title);$i++)
        {
            $insertData[]=[
                'title'=>$title[$i],
                'created_date'=>DATE,
                'created_ipaddress'=>$this->ipaddress,
                'created_by'=>$this->adminid,
                'created_role'=>1,
            ];
        }

        if(is_array($insertData) && count($insertData) > 0)
        {
            $insert = $this->db->insert_batch('color_tbl',$insertData);
            $insertCount = $this->db->affected_rows();
            $response[CODE]=($insertCount > 0)?SUCCESS_CODE:VALIDATION_CODE;
            $response[MESSAGE]=($insertCount > 0)?'succes':'fail';
            $response[DESCRIPTION]=($insertCount > 0)?'colors added successfully':'color is missing';
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='colors data is missing';
        }
    }
    else
    {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation Error';
            $response[DESCRIPTION]='* Please fill manditory feilds';
    }
    echo json_encode($response);
}


public function updateColor()
    {
        $response=array();
        $id=  $this->input->post('title_id');
        $title=  $this->input->post('title');
        if(($title!='') && num_check($id))
        {
                $update_array=array(
                    'title'=>$title,
                    
                );
            $update=  $this->Crud->commonUpdate('color_tbl',$update_array,array('id'=>$id),'color updated successfully..!');
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
/*>> Coloe section module code end */


/* >> Model secion module code start */
public function models($page_type = NULL) {
    $main_list='Models';
    $main_link=$this->current_controller.'models';
    $create_link=$this->current_controller.'models/Create';
switch ($page_type) {
    /* Create Page Code */
    case 'Create':
        $this->data['URL_TITLE'] = 'Create Model';
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' => 'Create ', 'link' =>$create_link, 'class' => 'active'),
        );
        $page_name = 'create';
        break;
    case 'details':
         $producttype_id=  $this->uri->segment(5);
        $this->data['URL_TITLE'] = 'update Model';
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' => 'Details', 'link' =>'', 'class' => ''),
            array('title' => 'Update ', 'link' =>'', 'class' => 'active'),
        );
        $this->data['result_details']=  $this->productsetting->modelDetails($producttype_id);
        $page_name = 'update';
        break;
    /* List Page Code */
    default :
        $this->data['URL_TITLE'] = $main_list;
        $this->data['create_link_url'] = $create_link;
        $this->data['create_link_title'] = 'Create Model';
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
        $this->data['result_details'] = $this->productsetting->modelList($search_array);
}
$this->data['breadcrumb'] = json_encode($breadcrumb_array);
$this->load->view($this->settings_viewfolder_path. 'model/' . $page_name, $this->data);
}

public function insertModel()
{
    $error=0;$error_messge='';
    $response=[];
    $title = $this->input->post('title');
    if(!is_array($title)){$error=1;$error_messge.='Please enter model details';}

    if($error == 0 )
    {
        $insertData = [];
        for($i=0;$i<count($title);$i++)
        {
            $insertData[]=[
                'title'=>$title[$i],
                'created_date'=>DATE,
                'created_ipaddress'=>$this->ipaddress,
                'created_by'=>$this->adminid,
                'created_role'=>1,
            ];
        }

        if(is_array($insertData) && count($insertData) > 0)
        {
            $insert = $this->db->insert_batch('model_tbl',$insertData);
            $insertCount = $this->db->affected_rows();
            $response[CODE]=($insertCount > 0)?SUCCESS_CODE:VALIDATION_CODE;
            $response[MESSAGE]=($insertCount > 0)?'succes':'fail';
            $response[DESCRIPTION]=($insertCount > 0)?'Model added successfully':'models is missing';
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='model data is missing';
        }
    }
    else
    {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation Error';
            $response[DESCRIPTION]='* Please fill manditory feilds';
    }
    echo json_encode($response);
}


public function updateModel()
    {
        $response=array();
        $id=  $this->input->post('title_id');
        $title=  $this->input->post('title');
        if(($title!='') && num_check($id))
        {
                $update_array=array(
                    'title'=>$title,
                    
                );
            $update=  $this->Crud->commonUpdate('model_tbl',$update_array,array('id'=>$id),'Model updated successfully..!');
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
/*>> Model section module code end */
}