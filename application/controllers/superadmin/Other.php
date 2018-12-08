<?php
defined('BASEPATH') or die('Error occured while loading the Categories');
/*
 * Page Name        :    Other
 * page Type          :    Controllor
 * Folder Path         :   controller/superadmin/Other.php
 * purpose              :    Admin related
 * Created By         :    V.Venkateswara Achari
 * Created Date      :      25-04-2018
 */
class Other extends CI_Controller{
     public $data,$ipaddress,$adminid,$current_controller,$settings_viewfolder_path;
     public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model(array('superadmin/Other_model'));
        $this->ipaddress = $this->input->ip_address();
        $this->adminid=$this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'id');
        $this->current_controller=SITE_ADMIN_LINK.'Other/';
        $this->viewfolder_path=ADMIN_VIEW_PATH;
    }
    /*
	 |--------------------------------------------------------------------------
	 	Other modules
		 	1) Artist	(Create : done | view : done | update : complete | Delete : pending)
		 	1) Show	(Create : done | view : done | update : complete | Delete : pending)
	 |--------------------------------------------------------------------------
	 */
    //Artist Code
     public function artist($page_type = NULL) {
            $main_list='Artist List';
            $main_link=$this->current_controller.'artist';
            $create_link=$this->current_controller.'artist/Create';
        switch ($page_type) {
            /* Create Page Code */
            case 'Create':
                $this->data['URL_TITLE'] = 'Create Artist';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => 'Create Artist', 'link' =>$create_link, 'class' => 'active'),
                );
                $page_name = 'create';
                break;
             /* Update Page Code */
            case 'Details':
                $updatename=urldecode($this->uri->segment(5));
                $updateid=base64_decode($this->uri->segment(6));
                $this->data['URL_TITLE'] = 'Update Artist';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => 'Update Artist', 'link' =>$create_link, 'class' => 'active'),
                );
                $page_name = 'update';
                $this->data['artist_details'] =$this->Other_model->getArtistsList($updateid);
                break;
            /* List Page Code */
            default :
                $this->data['URL_TITLE'] = $main_list;
                $this->data['create_link_url'] = $create_link;
                $this->data['create_link_title'] = 'Create Artist';
                $page_name = 'artist_list';
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
                $this->data['update_link']=SITE_ADMIN_LINK.'Other/artist/Details/';
                $this->data['result_details'] = $this->Other_model->artistList($search_array);
        }
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view($this->viewfolder_path. 'artist/' . $page_name, $this->data);
    }
    //Insert Artist
    public function insertArtist(){
        $response=array();
        $name=  $this->input->post('name');
        $email=  $this->input->post('email');
        $mobile=  $this->input->post('mobile');
        $city=  $this->input->post('artist_city');
        $address=  $this->input->post('address');
        $about=  $this->input->post('about_artist');
        $profilepicture=$_FILES['profilepicture']['name'];
        if($name!='') 
       {
            if (!is_dir(UPLOADS.'artist')) { mkdir('./'.UPLOADS .'artist', 0777, TRUE); }
            if (!is_dir(UPLOADS.'artist/profilepic')) { mkdir('./'.UPLOADS .'artist/profilepic', 0777, TRUE); }
                $destination=UPLOADS.'artist/profilepic/';
                $insert_profilepicture='';
                    //Profile Picture
                    if(isset($profilepicture) && $profilepicture!='')
                     {
                         $file_name=$_FILES['profilepicture']['name'];
                         $file_path=$_FILES['profilepicture']['tmp_name'];
                          $crop_array = array(
                        'filename' => $file_name,
                        'filepath' => $file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'profilepic',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $insert_profilepicture = $this->project_image->crop($crop_array);
                     }
            $insert_array=array(
                'name'=>$name,
                'email'=>$email,
                'mobile'=>$mobile,
                'city'=>$city,
                'address'=>$address,
                'description'=>$about,
                'profile_picture'=>$insert_profilepicture,
                'created_date'=>DATE,
                'created_by'=>  $this->adminid,
                'created_role'=>0,
            );
            $display_name="$name artist added successfully";
            $insert=$this->Crud->commonInsert('artist_tbl',$insert_array,$display_name,1);
            echo $insert;exit;
        } else {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='* Please fill manditory fields';
        }
        echo json_encode($response);
    }
	 //Shows Code
     public function shows($page_type = NULL) {
            $main_list='Shows List';
            $main_link=$this->current_controller.'shows';
            $create_link=$this->current_controller.'shows/Create';
        switch ($page_type) {
            /* Create Page Code */
            case 'Create':
                $this->data['URL_TITLE'] = 'Create Show';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => 'Create Show', 'link' =>$create_link, 'class' => 'active'),
                );
                $this->data['artist_details']=  $this->Common->artists();
                $page_name = 'create';
                break;
            /*Update Page Code Start*/
            case 'details':
                $title_name=  urldecode($this->uri->segment(5));
                $show_id=  $this->uri->segment(6);
                $this->data['URL_TITLE'] = 'Show'.$title_name.' Details';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => 'Details', 'link' =>'', 'class' => ''),
                    array('title' => $title_name, 'link' =>'', 'class' => 'active'),
                );
                $this->data['artist_details']=  $this->Common->artists();
                $this->data['show_details']=  $this->Other_model->showDetails($show_id);
                $page_name = 'update';
                break;
                /*Artist view Page Code Start*/
            case 'viewartists':
                $title_name=  urldecode($this->uri->segment(5));
                $show_id=  $this->uri->segment(6);
                $this->data['URL_TITLE'] = 'Show'.$title_name.' Details';
                $this->data['link_url'] =$main_link;
                $this->data['link_title'] = $main_list;
                $breadcrumb_array = array(
                    array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                    array('title' => $title_name, 'link' =>'', 'class' => 'active'),
                );
                $this->data['show_artist_details']=  $this->Other_model->getShowArtistsDetails($show_id);
                $page_name = 'artistsdata';
                break;
            /*upload artist works code start*/
            case 'viewupload':
            $show_id=  $this->uri->segment(5);
            $artist_id=  $this->uri->segment(6);
            $show_title=  ude_friendly($this->uri->segment(7));
            $artist_title=  ude_friendly($this->uri->segment(8));
            $this->data['URL_TITLE'] = 'Show Details';
            $this->data['link_url'] =$main_link;
            $this->data['link_title'] = $main_list;
            $breadcrumb_array = array(
                array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
                array('title' => $show_title, 'link' =>'', 'class' => ''),
                array('title' => $artist_title.' works', 'link' =>'', 'class' => 'active'),
            );
            $this->data['search_details']=array('search_artist_id'=>$artist_id,'search_show_id'=>$show_id);
            $this->data['artist_works'] = $this->Other_model->getArtistPaints($artist_id);
            $this->data['artists_works_details']=$this->Other_model->getArtistsWorksDetails($show_id,$artist_id);
            $page_name = 'uploadworks';
            break;
            /* List Page Code */
            default :
                $this->data['URL_TITLE'] = $main_list;
                $this->data['create_link_url'] = $create_link;
                $this->data['create_link_title'] = 'Create Show';
                $page_name = 'show_list';
                $breadcrumb_array = array(
                    array('title' =>$main_list, 'link' =>$main_link, 'class' => 'active'),
                );
                /*Search Condition Code Start*/
                  $search_array=array();
                  $search_name=  $this->input->post('search_name');
                  $search_activation=  $this->input->post('search_activation');
                  $search_fromdate=  $this->input->post('search_fromdate');
                  $search_todate=  $this->input->post('search_todate');
                  $search_array['name']=(!empty($search_name))?$search_name:'';
                  $search_array['activation']=($search_activation!='')?$search_activation:'';
                  $search_array['fromdate']=($search_fromdate!='')?$search_fromdate:'';
                  $search_array['todate']=($search_todate!='')?$search_todate:'';
                 /*Search Condition Code End*/
                $this->data['show_details'] = $this->Other_model->showList($search_array);
        }
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view($this->viewfolder_path. 'shows/' . $page_name, $this->data);
    }
    //insert show
    public function insertShow()
    {
        $response=array();
        $showtitle=$this->input->post('showtitle');
        $artistname=$this->input->post('artistname');
        $artist_list=implode(",",$artistname);
        $startdate=$this->input->post('startdate');
        $enddate=$this->input->post('enddate');
        $description=$this->input->post('description');
        $address=$this->input->post('address');
        $show_image=$_FILES['showimage']['name'];
        if(!empty($showtitle) && !empty($artist_list) && !empty($startdate) && !empty($enddate))
        {
            /*image compress and upload*/
            $destination=UPLOADS.'shows/';
            $show_icon='';
            if (!is_dir(UPLOADS.'shows')) { mkdir('./'.UPLOADS .'shows', 0777, TRUE); }
            if (isset($show_image) && $show_image != '') {
                        $icon_file_name = $_FILES['showimage']['name'];
                        $icon_file_path = $_FILES['showimage']['tmp_name'];
                        $crop_array = array(
                           'filename' => $icon_file_name,
                           'filepath' => $icon_file_path,
                           'uploadpath' => $destination,
                           'extension_name' => 'Show',
                           'clarity' => 100,
                           'width' => 500,
                           'height' => 500,
                       );
                        $show_icon = $this->project_image->crop($crop_array);
                    }
            $insert_array=array(
                'title'=>$showtitle,
                'artists_list'=>$artist_list,
                'startdate'=>date('Y-m-d h:i:s',strtotime($startdate)),
                'enddate'=>date('Y-m-d h:i:s',strtotime($enddate)),
                'description'=>$description,
                'image'=>$show_icon,
                'venue'=>$address,
                'created_date'=>DATE,
                'created_by'=>  $this->adminid,
                'created_role'=>1,
            );
            //print_r($insert_array);exit;
            $display_name="$showtitle added successfully";
            $insert=$this->Crud->commonInsert('shows_tbl',$insert_array,$display_name);
            echo $insert;exit;
        } 
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='* Please fill manditory feilds';
        }
    echo json_encode($response);
    }  
    //Update Show based on show id
     public function updateShow()
    {
        $response=array();
        $show_id=$this->input->post('show_id');
        $showtitle=$this->input->post('showtitle');
        $artistname=$this->input->post('artistname');
        $artist_list=implode(",",$artistname);
        $startdate=$this->input->post('startdate');
        $enddate=$this->input->post('enddate');
        $description=$this->input->post('description');
        $address=$this->input->post('address');
        $oldshowimage=$this->input->post('oldshowimage');
        $new_image=$_FILES['showimage']['name'];
        $oldshowimage=(empty($new_image))?str_replace(base_url().UPLOADS.'shows/','', $oldshowimage):$oldshowimage;
        if(!empty($showtitle) && !empty($artist_list) && !empty($startdate) && !empty($enddate) && num_check($show_id))
        {
             //Image
                if (isset($new_image) && $new_image != '') {
                     $destination='uploads/shows/';
                    /*unset*/
                    @unlink(str_replace(base_url(),'', $oldshowimage));
                    /*unset end*/
                    $icon_file_name = $_FILES['showimage']['name'];
                    $icon_file_path = $_FILES['showimage']['tmp_name'];
//                    $destination='uploads/shows/';
//                    $oldshowimage=$this->image_Resize_Upload($icon_file_name,$icon_file_path,$destination,'Show_',50);
                            $crop_array = array(
                           'filename' => $icon_file_name,
                           'filepath' => $icon_file_path,
                           'uploadpath' => $destination,
                           'extension_name' => 'Show',
                           'clarity' => 100,
                           'width' => 500,
                           'height' => 500,
                       );
                        $oldshowimage = $this->project_image->crop($crop_array);
                }
            $update_array=array(
                'title'=>$showtitle,
                'artists_list'=>$artist_list,
                'image'=>$oldshowimage,
                'startdate'=>date('Y-m-d h:i:s',strtotime($startdate)),
                'enddate'=>date('Y-m-d h:i:s',strtotime($enddate)),
                'description'=>$description,
                'venue'=>$address,
            );
            //print_r($insert_array);exit;
            $display_name="$showtitle show updated successfully";
            $update=$this->Crud->commonUpdate('shows_tbl',$update_array,array('id'=>$show_id),$display_name);
            echo $update;exit;
        } 
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='* Please fill manditory feilds';
        }
    echo json_encode($response);
    }  
    //update artist
    public function updateArtist()
    {
        error_reporting(0);
        $response=array();
        $name=  $this->input->post('name');
        $email=  $this->input->post('email');
        $mobile=  $this->input->post('mobile');
        $city=  $this->input->post('artist_city');
        $address=  $this->input->post('address');
        $about=  $this->input->post('about_artist');
        $updateid=  $this->input->post('updateid');
        $oldprofilepic=  $this->input->post('oldprofilepic');
        $profilepicture=$_FILES['profilepicture']['name'];
        $oldprofilepic=(empty($profilepicture))?str_replace(base_url().UPLOADS.'artist/profilepic/','', $oldprofilepic):$oldprofilepic;
        if($name!='') {
                 //Image
                 if (isset($profilepicture) && $profilepicture != '') {
                    $destination='uploads/artist/profilepic/';
                    /*unset*/
                    unlink(str_replace(base_url(),'', $oldprofilepic));
                    /*unset end*/
                    $file_name = $_FILES['profilepicture']['name'];
                    $file_path = $_FILES['profilepicture']['tmp_name'];
                    $crop_array = array(
                        'filename' => $file_name,
                        'filepath' => $file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'profilepic',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $oldprofilepic = $this->project_image->crop($crop_array);
                }
                $update_array = array(
                    'name'=>$name,
                    'email'=>$email,
                    'mobile'=>$mobile,
                    'city'=>$city,
                    'address'=>$address,
                    'description'=>$about,
                    'profile_picture'=>$oldprofilepic,
                );
                $display_message = $name . ' updated successfully';
                $update = $this->Crud->commonUpdate('artist_tbl', $update_array,array('id'=>$updateid), $display_message);
                echo $update;
                exit;
        }
         else {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='* Please fill manditory fields';
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
    //upload artist works
    public function updateArtistWorks()
    {
         // print_r($_POST);
         // print_r($_FILES);exit;
        $response=array();
        $showid = $this->input->post('work_showid');
        $artistid = $this->input->post('work_artistid');
        $description = $this->input->post('worksdescription');
        $title = $this->input->post('work_name');
        $size= $this->input->post('work_size');
        $medium = $this->input->post('work_medium');
        $workimages=$_FILES['worksimage']['name'];
        $imagecount=count($workimages);
        if(num_check($showid) && num_check($artistid) && num_check($imagecount)){
            $insert_array=array();
            for ($i = 0; $i < $imagecount; $i++) {
                if (!is_dir(UPLOADS.'artist')) { mkdir('./'.UPLOADS .'artist', 0777, TRUE); }
                if (!is_dir(UPLOADS.'artist/works')) { mkdir('./'.UPLOADS .'artist/works', 0777, TRUE); }
                //Image
                if (isset($workimages) && $workimages != '') {
                    $file_name = $_FILES['worksimage']['name'][$i];
                    $file_path = $_FILES['worksimage']['tmp_name'][$i];
                    $destination='uploads/artist/works/';
                    if($file_name!=''){
                        $crop_array = array(
                        'filename' => $file_name,
                        'filepath' => $file_path,
                        'uploadpath' => $destination,
                        'extension_name' => 'Works',
                        'clarity' => 100,
                        'width' => 500,
                        'height' => 500,
                    );
                     $uploaded_image = $this->project_image->crop($crop_array);
                    }
                }
                $insert_array[] = array(
                        'show_id' => $showid,
                        'artist_id' => $artistid,
                        'image' => $uploaded_image,
                        'title' => $title,
                        'size' => $size,
                        'medium' => $medium,
                        'description' => $description[$i],
                        'created_date' => DATE,
                        'created_ip_address' => $this->ipaddress,
                        'created_by' => $this->adminid,
                    );
            }
            //print_r($insert_array);exit;
            if (count($insert_array) > 0 && is_array($insert_array)) {
                $insert_bulk = $this->Crud->batchInsert('show_artist_details_tbl', $insert_array);
                echo $insert_bulk;
                exit;
            } 
        }
        else {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validations';
            $response[DESCRIPTION] = '* please fill manditory feilds';
        }
        echo json_encode($response);
    } 
    //view artists works
    public function artistWorks()
    {
       echo $artist_id=$this->uri->segment(4);
       echo "working";exit;
       //$this->load->view('');
    }

    // 10-06-2017 code start
    public function assignArtsToShow()
    {
      
        $response= array(); 
        $artist_id =  $this->input->post('paint_artist_id');
        $show_id =  $this->input->post('paint_artist_id');
        $artlist=  $this->input->post('assignToShow');
        $artprice = $this->input->post('artPrice');
        $error = 0; 
        if($error == 0)
        {
            $insert_data  = array();
            for($s=0;$s<count($artlist);$s++){
                $insert_data[]=array(
                                'show_id'=>$show_id,
                                'artist_id'=>$artist_id,
                                'art_id'=>$artlist[$s],
                                'art_amount'=>$artprice[$s],
                                'created_date'=>DATE
                    );
             }
                if (count($insert_data) > 0 && is_array($insert_data)) {
                    $insert_bulk = $this->Crud->batchInsert('show_assign_arts', $insert_data);
                    echo $insert_bulk;
                    exit;
                }
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='validations';
            $response[DESCRIPTION]='Validation error';
        }
        echo json_encode($response);
    } 
    //10-06-2017 code end
}