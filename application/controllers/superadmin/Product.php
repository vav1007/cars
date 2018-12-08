<?php
defined('BASEPATH') or die('Error occured while loading the Categories');
/*
 * Page Name        :    Products
 * page Type          :    Controllor
 * Folder Path         :   controller/superadmin/Products.php
 * purpose              :    Product Related(CRUD ,search,etc..)
 * Created By         :    V.Venkateswara Achari
 * Created Date      :      19-04-2018
 */
class Product extends CI_Controller{
     public $data,$ipaddress,$adminid,$current_controller,$settings_viewfolder_path;
     public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model(array('superadmin/Product_model','superadmin/Settings_model','superadmin/Categories_model'));
        $this->ipaddress = $this->input->ip_address();
        $this->adminid=$this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'id');
        $this->current_controller=SITE_ADMIN_LINK.'Product/';
        $this->product_viewfolder_path=ADMIN_VIEW_PATH.'product/';
        $this->data['menu_details']=  $this->Common->menu();
        error_reporting(0);
        $this->data['submenu_details']=  $this->Common->subMenu();
    }
    /*
   |--------------------------------------------------------------------------
    Product modules
      1) Product (Create : done | view : done | update : pending | Delete : pending)
     
   |--------------------------------------------------------------------------
   */
    public function index() {
        
            $main_list='Product List';
            $main_link=$this->current_controller;
            $create_link=$this->current_controller.'createProduct';
            $this->data['URL_TITLE'] = $main_list;
            $this->data['create_link_url'] = $create_link;
            $this->data['create_link_title'] = 'Create Product';
            $breadcrumb_array = array(
                array('title' =>$main_list, 'link' =>$main_link, 'class' => 'active'),
            );
                /*Search Condition Code Start*/
                   $search_array=array();
                   $search_lsm=  $this->input->post('search_lsm');
                  $search_name=  $this->input->post('search_name');
                  $search_activation=  $this->input->post('search_activation');
                  $search_array['lsm']=(!empty($search_lsm))?$search_lsm:'';
                  $search_array['name']=(!empty($search_name))?$search_name:'';
                  $search_array['activation']=($search_activation!='')?$search_activation:'';
                /*Search Condition Code End*/
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->data['listsubmenu_details']=  $this->Product_model->productListSubMenu();
        $this->data['product_details']=  $this->Product_model->productList($search_array);
        $this->load->view($this->product_viewfolder_path.'product_list', $this->data);
    }
    public function createProduct()
    {
                $main_list='Product List';
                $main_link=$this->current_controller;
                $create_link=$this->current_controller.'createProduct';
                $this->data['URL_TITLE'] = 'Create Product';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => 'Create Product', 'link' =>$create_link, 'class' => 'active'),
                );
                $this->data['submenu_details']=  $this->Product_model->productSubMenu();
                $this->data['type_details']=  $this->Common->producttypes();
                $this->data['brand_details']=  $this->Common->brands();
                $this->data['model_details']=  $this->Common->models();
                $this->data['color_details']=  $this->Common->colors();
                $this->data['shape_details']=  $this->Common->shapes();
                $this->data['breadcrumb'] = json_encode($breadcrumb_array);
                $this->load->view($this->product_viewfolder_path.'create', $this->data);
    }
    public function updateProduct()
    {
      $updateid=base64_decode($this->uri->segment(4));
                $main_list='Product List';
                $main_link=$this->current_controller;
                $create_link=$this->current_controller.'updateProduct';
                $this->data['URL_TITLE'] = 'Update Product';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => 'Update Product', 'link' =>'', 'class' => 'active'),
                );
                $this->data['submenu_details']=  $this->Product_model->productSubMenu();
                $this->data['listsubmenu_details']=  $this->Product_model->productListSubMenu();
                $this->data['size_details']=  $this->Common->size();
                $this->data['promotion_details']=  $this->Product_model->productPromotions();
                $this->data['prostatus_details']=  $this->Product_model->productStatus();
                $this->data['artist_details']=  $this->Common->artists();
                $this->data['breadcrumb'] = json_encode($breadcrumb_array);
                $this->data['product_details']=$this->Product_model->getProductDetails($updateid);
                $this->load->view($this->product_viewfolder_path.'update', $this->data);
    }
    //Insert Product
    public function insertProduct()
    {
       // print_r($_POST);exit;
        ini_set('post_max_size', '500M');
        ini_set('upload_max_filesize', '10M');
        $response=array();
        $submenu=  $this->input->post('submenu');
        $listsubmenu=  $this->input->post('listsubmenu');
        $product_name=  $this->input->post('product_name');
        $product_code=  $this->input->post('product_code');
        $brand=  $this->input->post('brand');
        $productype=  $this->input->post('productype');
        $model=  $this->input->post('model');
        $color=  $this->input->post('color');
        $shape=  $this->input->post('shape');
        $mrp=  $this->input->post('mrp');
        $sellingprice=  $this->input->post('sellingprice');
        $stock=  $this->input->post('stock');
        $deliverdays=  $this->input->post('deliverdays');
        $description=  $this->input->post('description');
        $search_keywords=  $this->input->post('search_keywords');
        $product_status=  $this->input->post('product_status');
        $customisation=  $this->input->post('customisation');
        $product_image=$_FILES['productimage']['name'];
        $multiple_image_count=count($_FILES['productimage_multiple']['name']);
        /*validation part code*/
        if(num_check($submenu) && $product_image!=''){
           if (!is_dir(UPLOADS.'products')) { mkdir('./'.UPLOADS .'products', 0777, TRUE); }
                $destination=UPLOADS.'products/';
                $insert_product_image='';
                //Slider Code Start
                    if(isset($_FILES['productimage']['name']) && $_FILES['productimage']['name']!='')
                     {
                         $file_name=$_FILES['productimage']['name'];
                         $file_path=$_FILES['productimage']['tmp_name'];
                         $display_name='Org_product_'.md5($product_name.time()).  rand(0000, 9999);
                         $extension=fileExtension($file_name);
                         $org_insert_product_image=$display_name.'.'.$extension;
                         $file_properties = getimagesize($file_path);
                         $file_width=$file_properties[0];
                         $file_height=$file_properties[1];
                          $crop_array = array(
                            'filename' => $file_name,
                            'filepath' => $file_path,
                            'uploadpath' => $destination,
                            'extension_name' => 'product',
                            'clarity' => 100,
                            'width' =>round($file_width),
                            'height' =>round($file_height),
                        );
                        $insert_product_image = $this->project_image->crop($crop_array);
                        /*Making another image code */
                        $c_file_properties = getimagesize($destination.'/'.$insert_product_image);
                        $c_file_width=$file_properties[0];
                        $c_file_height=$file_properties[1];
                     //   if($c_file_width==$c_file_height){$c_height=200; $c_width=200;}
                       // elseif($c_file_width > $c_file_height){$c_height=174; $c_width=240;} //Width is more
                        //elseif($c_file_width < $c_file_height){$c_height=200; $c_width=174;} //Height is more
                        $test_crop_array = array(
                            'filename' =>$insert_product_image,
                            'filepath' => $destination.'/'.$insert_product_image,
                            'uploadpath' => $destination,
                            'extension_name' => 'thumb_product',
                            'clarity' => 100,
                            'width' =>round($file_width/2),
                            'height' =>round($file_height/2),
                        );
                        $crop_insert_product_image = $this->project_image->crop($test_crop_array);
                        /*Making another image code */
                         move_uploaded_file($file_path,$destination.$org_insert_product_image);
                     }
                     /*Insert Code Start*/
                     $insert_array=array(
                        'submenu_id'=>(int)$submenu,
                        'list_submenu_id'=>(int)$listsubmenu,
                        'product_code'=>$product_code,
                        'product_name'=>$product_name,
                        'mrp_price'=>$mrp,
                        'selling_price'=>$sellingprice,
                        'product_description'=>$description,
                        'product_image'=>$crop_insert_product_image,
                        'product_original_image'=>$insert_product_image,
                        'created_date'=>DATE,
                        'created_ipaddress'=>  $this->ipaddress,
                        'created_by'=> (int)$this->adminid,
                        'created_role'=>1,
                        'search_keywords'=>$search_keywords,
                        'brand_id'=>$brand,
                        'product_type'=>$productype,
                        'model'=>$model,
                        'color'=>$color,
                        'shape'=>$shape,
                        'stock'=>$stock,
                        'promotion_featured'=>0,
                        'promotion_latest'=>1,
                        'promotion_bestselling'=>0,
                        'promotion_newselling'=>0,
                        'promotion_newselling'=>0,
                        'customisation_status'=>$customisation,
                         );
                     //print_r($insert_array);exit;
             $display_message=$product_name.' Product added successfully';
             $insert=$this->Crud->commonInsert('product_tbl',$insert_array,$display_message);
             $input_req=  json_decode($insert);
             if($input_req->code==SUCCESS_CODE){
               $insert_product_id=$input_req->inserted_id;
               $product_code=PRODUCT_CODE.$insert_product_id;
               $this->Crud->commonUpdate('product_tbl',array('product_sku_code'=>$product_code),array('id'=>$insert_product_id),'');
               /*Multiple images code start*/
                if($multiple_image_count > 0)
                {     
                    $mul_destination='uploads/products/otherimages/';
                    if (!is_dir(UPLOADS.'products')) { mkdir('./'.UPLOADS .'products', 0777, TRUE); }
                    if (!is_dir(UPLOADS.'products/otherimages')) { mkdir('./'.UPLOADS .'products/otherimages', 0777, TRUE); }
                          for($k=0;$k<$multiple_image_count;$k++)
                        {
                               $mul_image_name=$_FILES['productimage_multiple']['name'][$k];
                               $mul_image_tmp=$_FILES['productimage_multiple']['tmp_name'][$k];
                               if(!empty($_FILES['productimage_multiple']['name'][$k])){
                                        $mul_prod_array = array(
                                                 'filename' => $mul_image_name,
                                                 'filepath' => $mul_image_tmp,
                                                 'uploadpath' => $mul_destination,
                                                 'extension_name' => 'product',
                                                 'clarity' => 100,
                                                 'width' => 500,
                                                 'height' => 500,
                                             );
                                              $img_name = $this->project_image->crop($mul_prod_array);
                                       $insert_image_array[]=array(
                                           'product_id'=>(int)$insert_product_id,
                                           'product_image'=>$img_name,
                                           'created_date'=>DATE,
                                           'created_ipaddress'=>  $this->ipaddress,
                                           'created_by'=>  $this->adminid,
                                           'created_role'=>1,
                                       );
                               }
                        }
                         if(count($insert_image_array) > 0)
                         {
                             $this->Crud->batchInsert('product_images_tbl',$insert_image_array,'');
                         }
                    }
                /*Multiple image code end*/
             } 
             echo $insert;exit;
        } else {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation error';
            $response[DESCRIPTION]='* Please fill manditory feilds';
        }
        echo json_encode($response);
    }
    //update product
    public function updateProductData()
    {
      // print_r($_POST);
      //  print_r($_FILES);exit;
      $response=array();
      $artist=  $this->input->post('artist');
      $updateid=  $this->input->post('updateid');
      $submenu=  $this->input->post('submenu');
      //$product_code=  $this->input->post('product_code');
      $listsubmenu=  $this->input->post('listsubmenu');
      $showprice=  $this->input->post('showprice');
      $product_name=  $this->input->post('product_name');
      $medium=  $this->input->post('medium');
      $year=  $this->input->post('year');
      $size=  $this->input->post('size');
      $quantity=  $this->input->post('quantity');
      $mrp=  $this->input->post('mrp');
      $sellingprice=  $this->input->post('sellingprice');
      $frameprice=  $this->input->post('frameprice');
      $description=  $this->input->post('description');
      $search_keywords=  $this->input->post('search_keywords');
      $product_promotion=  $this->input->post('product_promotion');
      $product_status=  $this->input->post('product_status');
      $product_image=$_FILES['productimage']['name'];
      $old_main_image=$this->input->post('old_mainimage');
      $old_main_image=(empty($product_image))?str_replace(base_url().UPLOADS.'products/','', $old_main_image):$old_main_image;
      $multiple_image_count=count($_FILES['productimage_multiple']['name']);
      if(num_check($artist) && num_check($submenu)){
        if (!is_dir(UPLOADS.'products')) { mkdir('./'.UPLOADS .'products', 0777, TRUE); }
         if(isset($_FILES['productimage']['name']) && $_FILES['productimage']['name']!='')
         {
             /*unlink*/
             @unlink(str_replace(base_url(),'', $old_main_image));
             /*unlink end*/
              $file_name = $_FILES['productimage']['name'];
              $file_path = $_FILES['productimage']['tmp_name'];
              $destination='uploads/products/';
//              $old_main_image=$this->image_Resize_Upload($file_name,$file_path,$destination,'product_',50);
                    $crop_array = array(
                                  'filename' => $file_name,
                                  'filepath' => $file_path,
                                  'uploadpath' => $destination,
                                  'extension_name' => 'product',
                                  'clarity' => 100,
                                  'width' => 500,
                                  'height' => 500,
                              );
                               $old_main_image = $this->project_image->crop($crop_array);
         }
         $update_array=array(
                          'artist_id'=>(int)$artist,
                          // 'product_code'=>$product_code,
                           'submenu_id'=>(int)$submenu,
                          'showprice'=>(int)$showprice,
                          'list_submenu_id'=>(int)$listsubmenu,
                          'product_name'=>$product_name,
                          'medium'=>$medium,
                         'year'=>(int)$year,
                         'size'=>(int)$size,
                         'quantity'=>(int)$quantity,
                         'mrp_price'=>(int)$mrp,
                         'selling_price'=>(int)$sellingprice,
                         'product_status'=>(int)$product_status,
                         'product_promotion_status'=>(int)$product_promotion,
                         'product_description'=>$description,
                         'frame_price'=>(int)$frameprice,
                         'product_image'=>$old_main_image,
                         'product_original_image'=>'Org_'.$old_main_image,
                         'search_keywords'=>$search_keywords,
                         );
          $display_message=$product_name.'  updated successfully';
            $update=$this->Crud->Crud->commonUpdate('product_tbl', $update_array,array('id'=>$updateid), $display_message);
            $update_res=json_decode($update);
            if($update_res->code==200)
            {
               /*Multiple images code start*/
                if($multiple_image_count > 0)
                {     
                    if (!is_dir(UPLOADS.'products')) { mkdir('./'.UPLOADS .'products', 0777, TRUE); }
                  if (!is_dir(UPLOADS.'products/otherimages')) { mkdir('./'.UPLOADS .'products/otherimages', 0777, TRUE); }
                          for($k=0;$k<$multiple_image_count;$k++)
                        {
                               $mul_image_name=$_FILES['productimage_multiple']['name'][$k];
                                $mul_image_tmp=$_FILES['productimage_multiple']['tmp_name'][$k];
                                $mul_destination='uploads/products/otherimages/';
                                
//                                $mul_extension=  fileExtension($mul_image_name);
//                                $info = getimagesize($mul_image_tmp);
//                                $source=$mul_image_tmp;
//                                //Jpg
//                                if ($info['mime'] == 'image/jpeg') 
//                                $image = imagecreatefromjpeg($source);
//                                //GIF
//                                elseif ($info['mime'] == 'image/gif') 
//                                $image = imagecreatefromgif($source);
//                                //PNG
//                                elseif ($info['mime'] == 'image/png') 
//                                $image = imagecreatefrompng($source);
//                                $destination='uploads/products/otherimages/';
//                                $img_name=sha1(rand(100000,999999).base64_encode($updateid).'mulimage'.time()).'.'.$mul_extension;
//                               $move= imagejpeg($image, $destination.$img_name, 50);
                                 if(!empty($_FILES['productimage_multiple']['name'][$k])){
                                        $mul_prod_array = array(
                                        'filename' => $mul_image_name,
                                        'filepath' => $mul_image_tmp,
                                        'uploadpath' => $mul_destination,
                                        'extension_name' => 'product',
                                        'clarity' => 100,
                                        'width' => 500,
                                        'height' => 500,
                                    );
                                     $img_name = $this->project_image->crop($mul_prod_array);
                              $insert_image_array[]=array(
                                  'product_id'=>(int)$updateid,
                                  'product_image'=>$img_name,
                                  'created_date'=>DATE,
                                  'created_ipaddress'=>  $this->ipaddress,
                                  'created_by'=>  $this->adminid,
                                  'created_role'=>1,
                              );
                             }
                        }
                         if(count($insert_image_array) > 0)
                         {
                             $this->Crud->batchInsert('product_images_tbl',$insert_image_array,'');
                         }
                    }
                /*Multiple image code end*/
            }
            echo $update;
            exit;
        } else {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation error';
            $response[DESCRIPTION]='* Please fill manditory feilds';
        }
        echo json_encode($response);
    }  
    //image re-size, upload 
    public function image_Resize_Upload($filename,$filepath,$destination,$im_name,$resolution)
    {
        $extension=  fileExtension($filename);
        $info = getimagesize($filepath);
        $source=$filepath;
        //Jpg
        if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);
        //GIF
        elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);
        //PNG
        elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);
        $pic_name=$im_name.sha1(rand(100000,999999).time()).'.'.$extension;
        $move= imagejpeg($image, $destination.$pic_name, 50);
        return $pic_name;
    }          
    
    //popular status
    public function popularStatus()
    {
        $response=array();
        $product_id_list=  $this->input->post('inputdata');
        $product_status=  $this->input->post('status');
        if(!empty($product_id_list) && is_numeric($product_status))
        {
            $condition = "id IN  (" . $product_id_list . ")";
            $update = $this->Crud->commonStatusUpdate(trim('product_tbl'), array('popular_status'=> $product_status), $condition, $product_status);
            echo $update;exit;
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Please choose minimum one product';
        }
        echo json_encode($response);
    }
    //getting list sub menu based on submenu
    public function subListmenuDetails()
    {
        //print_r($_POST);
        $submenu=$this->input->post('submenu');
        $this->data['lsm_details']=$this->Product_model->subListmenuDetails(array('submenu_id'=>$submenu));
            $names=json_decode($this->data['lsm_details']);
            $list='<option value="">--Choose List Sub Menu--</option>';
           // print_r($names);
            if($names->code==SUCCESS_CODE){
                    foreach($names->lsm_res as $lsm_res)
                    {
                            $list.="<option value='".$lsm_res->id."'>".$lsm_res->lsmtitle."</option>";
                    }
            }
            echo $list;
    }

    public function promotionStatus()
    {
        $response=array();
        $product_id_list=  $this->input->post('inputdata');
        $product_status=  $this->input->post('status');
        $product_promotion=  $this->input->post('promotion');
        if(!empty($product_id_list) && is_numeric($product_status))
        {
            $cols='';
            switch($product_promotion)
            {
                case 'feature':$cols='promotion_featured';break;
                case 'latest':$cols='promotion_latest';break;
                case 'bestselling':$cols='promotion_bestselling';break;
            }
            $condition = "id IN  (" . $product_id_list . ")";
            $update = $this->Crud->commonStatusUpdate(trim('product_tbl'), array($cols=> $product_status), $condition, $product_status);
            echo $update;exit;
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Please choose minimum one product';
        }
        echo json_encode($response);
    }
}
