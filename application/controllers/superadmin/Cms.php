<?php
defined('BASEPATH') or die('Error occured while loading the Categories');
/*
 * Page Name        :    Cms
 * page Type          :    Controllor
 * Folder Path         :   controller/superadmin/Cms.php
 * purpose              :    Admin related
 * Created By         :   V.Venkateswara achari
 * Created Date      :     20-040-2018
 */
class Cms extends CI_Controller{
   public $data,$ipaddress,$adminid,$current_controller,$settings_viewfolder_path;
   public function __construct() {
    parent::__construct();
    $this->data = array();
    $this->load->model(array('superadmin/Cms_model'));
    $this->ipaddress = $this->input->ip_address();
    $this->adminid=$this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'id');
    $this->current_controller=SITE_ADMIN_LINK.'Cms/';
    $this->viewfolder_path=ADMIN_VIEW_PATH;
    $this->load->library('user_agent');
}
/*
|--------------------------------------------------------------------------
   Cms modules
    1) FAQ (Create : done | view : done | update : complete | Delete : pending)
    2) Testimonials (Create : done | view : done | update : complete | Delete : complete)
   
    
|--------------------------------------------------------------------------
*/
public function emailConfigurations()
    {
          $config['protocol'] =  SMTP_PROTOCAL;
          $config['smtp_host'] = SMTP_HOST;
          $config['smtp_port'] = SMTP_PORT;
          $config['smtp_user'] = SMTP_USER;
          $config['smtp_pass'] = SMTP_PASSWORD;
          $config['charset'] = "iso-8859-1";
          $config['mailtype'] = "html";
          $config['newline'] = "\r\n";
          $config['wordwrap'] = TRUE;
          $config['mailpath'] = '/usr/sbin/sendmail';
          return $config;
    }
    //FAQ Code
public function faq($page_type = NULL) {
    $main_list='FAQ List';
    $main_link=$this->current_controller.'faq';
    $create_link=$this->current_controller.'faq/Create';
    switch ($page_type) {
        /* Create Page Code */
        case 'Create':
        $this->data['URL_TITLE'] = 'Create FAQ';
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' => 'Create FAQ', 'link' =>$create_link, 'class' => 'active'),
            );
        $page_name = 'create';
        break;
            //Details
        case 'details':
        $id=  $this->uri->segment(5);
        $this->data['URL_TITLE'] = 'Update Faq';
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' => 'Update FAQ', 'link' =>$create_link, 'class' => 'active'),
            );
        $this->data['faq_details']=  $this->Cms_model->faqDetails($id);
        $page_name = 'update';
        break;
        /* List Page Code */
        default :
        $this->data['URL_TITLE'] = $main_list;
        $this->data['create_link_url'] = $create_link;
        $this->data['create_link_title'] = 'Create FAQ';
        $page_name = 'faq_list';
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
        $this->data['faq_details']=$this->Cms_model->faqList($search_array);
    }
    $this->data['breadcrumb'] = json_encode($breadcrumb_array);
    $this->load->view($this->viewfolder_path. 'faq/' . $page_name, $this->data);
}
   //insert faq
public function insertfaq()
{
        //print_r($_POST);exit;
    $response=array();
    $question=$this->input->post('question');
    $answer=$this->input->post('answer');
    if(!empty($question) && !empty($answer))
    {
        $insert_array=array(
            'question'=>$question,
            'answer'=>$answer,
            'created_date'=>DATE,
            'created_by'=>  $this->adminid,
            'created_role'=>1,
            );
            //print_r($insert_array);exit;
        $display_name="question added successfully";
        $insert=$this->Crud->commonInsert('faq_tbl',$insert_array,$display_name);
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
    //update Faq
public function updateFaq()
{
        //print_r($_POST);exit;
    $response=array();
    $question=$this->input->post('question');
    $answer=$this->input->post('answer');
    $faq_id=$this->input->post('faq_id');
    if(!empty($question) && !empty($answer) && num_check($faq_id))
    {
        $update_array=array(
            'question'=>$question,
            'answer'=>$answer,
            );
        $display_name="Faq updated successfully";
        $update=$this->Crud->commonUpdate('faq_tbl',$update_array,array('id'=>$faq_id),$display_name);
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
//testimonials
public function testimonials($page_type = NULL)
{
    $main_list='Testimonials';
    $main_link=$this->current_controller.'testimonials';
    $create_link=$this->current_controller.'testimonials/Create';
    switch ($page_type) {
        /* Create Page Code */
        case 'Create':
        $this->data['URL_TITLE'] = 'Create Testimonial';
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' => 'Create Testimonial', 'link' =>$create_link, 'class' => 'active'),
            );
        $page_name = 'create';
        break;
        case 'details':
        $title_name=  urldecode($this->uri->segment(5));
        $id=  $this->uri->segment(6);
        $this->data['URL_TITLE'] ='Testimonials *'.$title_name.' *Details' ;
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' =>'Details', 'link' =>$main_link, 'class' => ''),
            array('title' => $title_name, 'link' =>'', 'class' => 'active'),
            );
        $this->data['testimonial_details']=  $this->Cms_model->testimonialDetails($id);
        $page_name = 'update';
        break;
        /* List Page Code */
        default :
        $this->data['URL_TITLE'] = $main_list;
        $this->data['create_link_url'] = $create_link;
        $this->data['create_link_title'] = 'Create Testimonial';
        $page_name = 'testimonials_list';
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
        $this->data['testimonials_details']=$this->Cms_model->testimonialsList($search_array);
    }
    $this->data['breadcrumb'] = json_encode($breadcrumb_array);
    $this->load->view($this->viewfolder_path. 'testimonials/' . $page_name, $this->data);
} 
    //insert testimonial
public function insertTestimonial()
{
        //print_r($_POST);
        //print_r($_FILES);
    $response=array();
    $title=$this->input->post('test_title');
    $username=$this->input->post('username');
    $commentdate=$this->input->post('commentdate');
    $comment=$this->input->post('comment');
    $picture=$_FILES['profilepicture']['name'];
    $insert_profilepicture='';
    if(!empty($title) && !empty($username) && !empty($commentdate) && !empty($comment))
    {
        if(!empty($picture))
        {
            if(!is_dir(UPLOADS.'testimonials')){mkdir('./'.UPLOADS.'testimonials',0777,TRUE);}
            if(!is_dir(UPLOADS.'testimonials/userpictures')){mkdir('./'.UPLOADS.'testimonials/userpictures',0777,TRUE);}
            $destination=UPLOADS.'testimonials/userpictures/';
            if(isset($picture) && $picture!='')
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
       }
       $insert_array=array(
        'title'=>$title,
        'username'=>$username,
        'commentdate'=>date('Y-m-d h:i:s',strtotime($commentdate)),
        'comment'=>$comment,
        'picture'=>$insert_profilepicture,
        'created_date'=>DATE,
        'created_by'=>  $this->adminid,
        'created_role'=>1,
        );
       $display_name="$title added successfully";
       $insert=$this->Crud->commonInsert('testimonials_tbl',$insert_array,$display_name);
       echo $insert;exit;   
   }
   else
   {
    $response[CODE]=VALIDATION_CODE;
    $response[MESSAGE]='Validation';
    $response[DESCRIPTION]='* Please fill manditory fields';
}
echo json_encode($response);
}  
    //Update testimonials code
public function updateTestimonials()
{
        //print_r($_FILES);
    $response=array();
    $id=  $this->input->post('testmonial_id');
    $title=$this->input->post('test_title');
    $username=$this->input->post('username');
    $commentdate=$this->input->post('commentdate');
    $comment=$this->input->post('comment');
    $old_picture=$this->input->post('old_profile_pic');
    $picture=$_FILES['profilepicture']['name'];
    $insert_profilepicture='';
    $testimonial_folder=UPLOADS.'testimonials/userpictures/';
    if(!empty($title) && !empty($username) && !empty($commentdate) && !empty($comment) && num_check($id))
    {
        if(!empty($picture))
        {
            if(!is_dir(UPLOADS.'testimonials')){mkdir('./'.UPLOADS.'testimonials',0777,TRUE);}
            if(!is_dir(UPLOADS.'testimonials/userpictures')){mkdir('./'.UPLOADS.'testimonials/userpictures',0777,TRUE);}

            if(isset($picture) && $picture!='')
            {
               $file_name=$_FILES['profilepicture']['name'];
               $file_path=$_FILES['profilepicture']['tmp_name'];
               $crop_array = array(
                'filename' => $file_name,
                'filepath' => $file_path,
                'uploadpath' => $testimonial_folder,
                'extension_name' => 'profilepic',
                'clarity' => 100,
                'width' => 500,
                'height' => 500,
                );
               $insert_profilepicture = $this->project_image->crop($crop_array);
               if($insert_profilepicture)
               {
                unlink(str_replace(base_url(),'', $old_picture));
            }
        }
    }
    $update_array=array(
        'title'=>$title,
        'username'=>$username,
        'commentdate'=>date('Y-m-d h:i:s',strtotime($commentdate)),
        'comment'=>$comment,
        'picture'=>(!empty($insert_profilepicture))?$insert_profilepicture:str_replace(base_url().$testimonial_folder,'',$old_picture),
        );
    $display_name="$title updated successfully";
    $update=$this->Crud->commonUpdate('testimonials_tbl',$update_array,array('id'=>$id),$display_name);
    echo $update;exit;   
}
else
{
    $response[CODE]=VALIDATION_CODE;
    $response[MESSAGE]='Validation';
    $response[DESCRIPTION]='* Please fill manditory fields';
}
echo json_encode($response);
}  
    //delete show
public function deleteShow()
{
    $response=array();
    $deletelist=$this->input->post('deletelist');
    if(!empty($deletelist))
    {
        $delete=$this->Common->commonMultipleDelete('shows_tbl','id',$deletelist,'Shows');
        echo $delete;exit;
    }
    else {
        $response[CODE] = VALIDATION_CODE;
        $response[MESSAGE] = 'Validations';
        $response[DESCRIPTION] = 'You need to select before you delete..';
    }
    echo json_encode($response);
}  
    //advisory board
public function advisoryboard($page_type = NULL)
{
 $main_list='Advisory board';
 $main_link=$this->current_controller.'advisoryboard';
 $create_link=$this->current_controller.'advisoryboard/Create';
 switch ($page_type) {
    /* Create Page Code */
    case 'Create':
    $this->data['URL_TITLE'] = 'Create Advise';
    $this->data['link_url'] =$main_link;
    $this->data['link_title'] = $main_list;
    $breadcrumb_array = array(
        array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
        array('title' => 'Create Advise', 'link' =>$create_link, 'class' => 'active'),
        );
    $page_name = 'create';
    break;
    /* List Page Code */
    default :
    $this->data['URL_TITLE'] = $main_list;
    $this->data['create_link_url'] = $create_link;
    $this->data['create_link_title'] = 'Create Advise';
    $page_name = 'advisory_list';
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
    $this->data['advisory_details']=$this->Cms_model->advisoryList($search_array);
}
$this->data['breadcrumb'] = json_encode($breadcrumb_array);
$this->load->view($this->viewfolder_path. 'advisoryboard/' . $page_name, $this->data);
} 
    //insert advisory
public function insertAdvisory()
{
        // print_r($_POST);
        // print_r($_FILES);exit;
    $response=array();
    $title=$this->input->post('adv_name');
    $email=$this->input->post('email');
    $mobile=$this->input->post('mobile');
    $suggestion=$this->input->post('suggestion');
    $commentdate=$this->input->post('commentdate');
    $picture=$_FILES['profilepicture']['name'];
    $insert_profilepicture='';
    if(!empty($title) && !empty($suggestion) && !empty($commentdate))
    {
        if(!empty($picture))
        {
            if(!is_dir(UPLOADS.'advisoryboard')){mkdir('./'.UPLOADS.'advisoryboard',0777,TRUE);}
            if(!is_dir(UPLOADS.'advisoryboard/userpictures')){mkdir('./'.UPLOADS.'advisoryboard/userpictures',0777,TRUE);}
            $destination=UPLOADS.'advisoryboard/userpictures/';
            if(isset($picture) && $picture!='')
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
       }
       $insert_array=array(
        'title'=>$title,
        'email'=>$email,
        'mobile'=>$mobile,
        'suggesteddate'=>date('Y-m-d h:i:s',strtotime($commentdate)),
        'suggestion'=>$suggestion,
        'picture'=>$insert_profilepicture,
        'created_date'=>DATE,
        'created_by'=>  $this->adminid,
        'created_role'=>1,
        'created_ipaddress'=>$this->ipaddress,
        );
       $display_name="suggestion added successfully";
       $insert=$this->Crud->commonInsert('advisory_tbl',$insert_array,$display_name);
       echo $insert;exit;   
   }
   else
   {
    $response[CODE]=VALIDATION_CODE;
    $response[MESSAGE]='Validation';
    $response[DESCRIPTION]='* Please fill manditory fields';
}
echo json_encode($response);
}  
/*****************Delete related code start******************/
public function deleteTestimonial()
{
    $id=  $this->uri->segment(4);
    if(num_check($id))
    {
        $image_details=  $this->Crud->checkAndReturn('picture','testimonials_tbl',array('id'=>$id));
        if(!empty($image_details)){ $image_path=UPLOADS.'testimonials/userpictures/'.$image_details; unlink($image_path); }
        $delete=  $this->db->delete('testimonials_tbl',array('id'=>$id));
    }
    redirect($this->agent->referrer());
}
    //News letter
public function newsletter($page_type=NULL)
{
    $main_list='News letter';
    $main_link=$this->current_controller.'newsletter';
    $create_link=$this->current_controller.'';
    switch ($page_type) {
        /* Create Page Code */
        case 'email':
        $news_ids=$this->uri->segment(5);
        $this->data['URL_TITLE'] = 'Send Email';
        $this->data['link_url'] =$main_link;
        $this->data['link_title'] = $main_list;
        $breadcrumb_array = array(
            array('title' => $main_list, 'link' =>$main_link, 'class' => ''),
            array('title' => 'Send Email', 'link' =>$create_link, 'class' => 'active'),
            );
        $this->data['email_id_details']=$this->Cms_model->getNewsletterEmails($news_ids);
        $page_name = 'email';
        break;
        /* List Page Code */
        default :
        $this->data['URL_TITLE'] = $main_list;
        $this->data['create_link_url'] = $create_link;
        $this->data['create_link_title'] = 'Send Newsletter';
        $page_name = 'newsletter_list';
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
        $this->data['newsletter_details']=$this->Cms_model->newsletterList($search_array);
    }
    $this->data['breadcrumb'] = json_encode($breadcrumb_array);
    $this->load->view($this->viewfolder_path. 'newsletter/' . $page_name, $this->data);    
}
    //sending email for user & newsletter
public function sendEmailNotification()
{
        // print_r($_POST);
        // print_r($_FILES);
    $response=array();
    $emails=$this->input->post('emailids');
    $description=$this->input->post('description');
        //$newsletters=$this->input->post('newsletters');
        //$users=$this->input->post('users');
    $subject=$this->input->post('subject');
    $image=$_FILES['image']['name'];
    $allemails=array();
    /*textbox emails start*/
    $textemails=explode(',',$emails);
    $textemailscount=(!empty($emails))?count($textemails):0;
    if($textemailscount>0)
    {
        for($i=0;$i<$textemailscount;$i++)
        {
            $allemails[]=$textemails[$i];
        }
    }
    /*user emails start*/
        // if($users==1)
        // {
        //     $useremails=$this->db->select('email')->from('users_tbl')->get();
        //     $usercount=$useremails->num_rows();
        //     if($usercount>0)
        //     {
        //         foreach($useremails->result() as $uemail)
        //         {
        //             $allemails[]=$uemail->email;
        //         }
        //     }
        // }
    /*user emails start*/
    /*newsletter emails start*/
        // if($newsletters==1)
        // {
        //     $newsletteremails=$this->db->select('email')->from('newsletter_tbl')->get();
        //     $newslettercount=$newsletteremails->num_rows();
        //     if($newslettercount>0)
        //     {
        //         foreach($newsletteremails->result() as $newsemail)
        //         {
        //             $allemails[]=$newsemail->email;
        //         }
        //     }
        // }
    /*newsletter emails end*/
    $emailcount=count($allemails);
    if(!empty($description) && $emailcount> 0)
    {
        /*sending email start*/
        /*sending email end*/
        /*inserting into notification table*/
        $emails_text=implode(",",$allemails);
        $notify_image='';
        if (!is_dir(UPLOADS.'notifications')) { mkdir('./'.UPLOADS .'notifications', 0777, TRUE); }
        if (isset($image) && $image != '') {
            $file_name = $_FILES['image']['name'];
            $file_path = $_FILES['image']['tmp_name'];
            $icon_extension=  fileExtension($file_name);
            $info = getimagesize($file_path);
            $source=$file_path;
                    //Jpg
            if ($info['mime'] == 'image/jpeg') 
                $i_image = imagecreatefromjpeg($source);
                    //GIF
            elseif ($info['mime'] == 'image/gif') 
                $i_image = imagecreatefromgif($source);
                    //PNG
            elseif ($info['mime'] == 'image/png') 
                $i_image = imagecreatefrompng($source);
            $destination='uploads/notifications/';
            $notify_image=sha1(rand(100000,999999).time()).'.'.$icon_extension;
            $move= imagejpeg($i_image, $destination.$notify_image, 50);
        }
        $insert_array = array(
            'emails'=>$emails_text, 
            'description'=>$description,
            'subject'=>$subject, 
            'image' =>$notify_image, 
            'created_date' =>DATE, 
            'created_ipaddress' =>$this->ipaddress, 
            'created_by' =>$this->adminid, 
            );
            //print_r($insert_array);
        $insert=$this->Crud->commonInsert('notifications_tbl',$insert_array,'Notification added successfully..');
        $ins_req=json_decode($insert);
        if($ins_req->code==SUCCESS_CODE)
        {
            /*sending email code start*/
            $list=explode(',',$emails_text);
            //print_r($email_list);exit;
            $config=$this->emailConfigurations();
            $data['subject']=$subject;
            $data['description']=$description;
            $template=$this->load->view(ADMIN_EMAIL_TEMPLATE_PATH.'template_newsletter',$data,TRUE);
            $this->email->initialize($config);
            $this->email->from(SMTP_FROM_EMAIL,SMTP_FROM_NAME);
            //$this->email->to($list);
            $this->email->bcc($list);
            $this->email->reply_to(SMTP_FROM_EMAIL,SMTP_FROM_NAME);
            $this->email->subject($data['subject']);
            $this->email->message($template);
            $link= base_url() . 'uploads/notifications/';
            if(!empty($notify_image))
            {
                $attched_file = $link .$notify_image ;
                $this->email->attach($attched_file);
            }
            $send=$this->email->send();
            if($send==1)
            {
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]='Success';
                $response[DESCRIPTION]='Mail sent successfully..';
            }
            else
            {
                $response[CODE]=FAIL_CODE;
                $response[MESSAGE]='Fail';
                $response[DESCRIPTION]='Newsletter inserted.. But mail not sent successfully..';
            }
            /*sending email code end*/
        }
        /*inserting into notification table end*/
    }
    else
    {
        $response[CODE]=VALIDATION_CODE;
        $response[MESSAGE]='Validation';
        $response[DESCRIPTION]='* Please fill manditory fields';
    }
    echo json_encode($response);
}
    //delete newsletter
public function deleteNewsletter()
{
    $response=array();
    $deletelist=$this->input->post('deletelist');
    if(!empty($deletelist))
    {
        $delete=$this->Common->commonMultipleDelete('newsletter_tbl','id',$deletelist,'Newsletter');
        echo $delete;exit;
    }
    else {
        $response[CODE] = VALIDATION_CODE;
        $response[MESSAGE] = 'Validations';
        $response[DESCRIPTION] = 'You need to select before you delete..';
    }
    echo json_encode($response);
}
    
}