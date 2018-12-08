<?php
defined('BASEPATH') or die('Error occured while loading the Categories');
/*
 * Page Name        :    Orders
 * page Type          :    Controllor
 * Folder Path         :   controller/superadmin/Orders.php
 * purpose              :    Order related
 * Created By         :   Venkateswara Achari
 * Created Date      :      13-04-2018
 */
class Orders extends CI_Controller{
   public $data,$ipaddress,$adminid,$current_controller,$settings_viewfolder_path;
   public function __construct() 
   {
    parent::__construct();
    $this->data = array();
    $this->load->model(array('superadmin/Order_model'));
    $this->ipaddress = $this->input->ip_address();
    $this->adminid=$this->session->userdata(PROJECT_SESS_ADMIN_CODE . 'id');
    $this->current_controller=SITE_ADMIN_LINK.'Orders/';
    $this->viewfolder_path=ADMIN_VIEW_PATH.'orders/';
    $this->load->library('user_agent');
}
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
        /*
        |--------------------------------------------------------------------------
            Order Module
        1) Orders ( view : done | update : _ _  | Delete : _ _)
        |--------------------------------------------------------------------------
        */
        //Order List
        public function index()
        {
            $main_list='Orders';
            $main_link=$this->current_controller;
            $this->data['URL_TITLE']='Orders List';
            $this->data['create_link_url'] = '';
            $this->data['create_link_title'] = '';
            $breadcrumb_array = array(   array('title' =>$main_list, 'link' =>$main_link, 'class' => 'active'),  );
             /*Search Condition Code Start*/
            $search_array=array();
            $search_name=  $this->input->post('search_name');
            $search_fromdate=  $this->input->post('search_fromdate');
            $search_todate=  $this->input->post('search_todate');
            $search_activation=  $this->input->post('search_activation');
            $search_array['name']=(!empty($search_name))?$search_name:'';
            $search_array['fromdate']=($search_fromdate!='')?$search_fromdate:'';
            $search_array['todate']=($search_todate!='')?$search_todate:'';
            $search_array['activation']=($search_activation!='')?$search_activation:'';
            /*Search Condition Code End*/
            $this->data['breadcrumb'] = json_encode($breadcrumb_array);
            $this->data['order_details']=  $this->Order_model->orderList($search_array);
            $this->load->view($this->viewfolder_path. 'order_list', $this->data);
        }
        //view enquiry list
        public function enquiry()
        {
            $main_list='Enquiries';
            $main_link=$this->current_controller;
            $this->data['URL_TITLE']='Enquired List';
            $this->data['create_link_url'] = '';
            $this->data['create_link_title'] = '';
            $breadcrumb_array = array(   array('title' =>$main_list, 'link' =>$main_link, 'class' => 'active'),  );
            /*Search Condition Code Start*/
            $search_array=array();
            $search_name=  $this->input->post('search_name');
            $search_date=  $this->input->post('search_date');
            $search_array['name']=(!empty($search_name))?$search_name:'';
            $search_array['date']=($search_date!='')?$search_date:'';
            /*Search Condition Code End*/
            $this->data['breadcrumb'] = json_encode($breadcrumb_array);
            $this->data['enq_details']=  $this->Order_model->enquiryList($search_array);
            $this->load->view($this->viewfolder_path. 'enquiry_list', $this->data);
        }
        //delete enquiry
        public function deleteEnquiry()
        {
            $response=array();
            $deletelist=$this->input->post('deletelist');
            if(!empty($deletelist))
            {
                $delete=$this->Common->commonMultipleDelete('product_enquiry_tbl','id',$deletelist,'Enquiry');
                echo $delete;exit;
            }
            else {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validations';
                $response[DESCRIPTION] = 'You need to select before you delete..';
            }
            echo json_encode($response);
        }
        //approving order
        public function approveOrder()
        {
            $response=array();
            $order_id=$this->uri->segment(4);
            if(num_check($order_id))
            {
                $update_array=array(
                    'order_status'=>1,
                    );
                $display_name="Order confirmed successfully";
                $table='order_tbl';
                $update=$this->Crud->commonUpdate($table,$update_array,array('id'=>$order_id),$display_name);
                $update_req=json_decode($update);
                if($update_req->code==SUCCESS_CODE)
                {
                   
                    $order_number=$this->Crud->checkAndReturn('order_number',$table,array('id'=>$order_id));
                    $user_email=$this->Crud->checkAndReturn('email',$table,array('id'=>$order_id));
                    /*sending email to customer about confirmation*/
                    $list=explode(',',$user_email);
                    $config=$this->emailConfigurations();
                    $data['subject']='Order confirmation';
                    $data['description']="$order_number has been confirmed.Thanks for placing order..";
                    $template=$this->load->view(ADMIN_EMAIL_TEMPLATE_PATH.'template_order_confirmation',$data,TRUE);
                    $this->email->initialize($config);
                    $this->email->from(SMTP_FROM_EMAIL,SMTP_FROM_NAME);
                    $this->email->to($list);
                    $this->email->bcc(BCC_EMAIL);
                    $this->email->reply_to(SMTP_FROM_EMAIL,SMTP_FROM_NAME);
                    $this->email->subject($data['subject']);
                    $this->email->message($template);
                    $link= base_url() . 'uploads/notifications/';
                    $send=$this->email->send();
                    if($send==1)
                    {
                        $response[CODE] = SUCCESS_CODE;
                        $response[MESSAGE] = 'Success';
                        $response[DESCRIPTION] = "$order_number has been confirmed..";
                    }
                    else
                    {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = "$order_number has been confirmed.. Sending email failed..";
                    }
                    /*sending email to customer about confirmation*/
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }
        public function emailTest()
        {
            $emails_text='achariphp@gmail.com';
            $list=explode(',',$emails_text);
        //print_r($email_list);exit;
            $config=$this->emailConfigurations();
            $data['email'] =$emails_text;
            $data['subject']='Order confirmation';
            $data['description']='dfghjk';
        //$template=$this->load->view(ADMIN_EMAIL_TEMPLATE_PATH.'template_order_confirmation',$data,TRUE);
            $template=$this->load->view(ADMIN_EMAIL_TEMPLATE_PATH.'template_order_confirmation',$data);
            print_r($template);exit;
            $this->email->initialize($config);
            $this->email->from(SMTP_FROM_EMAIL,SMTP_FROM_NAME);
        //$list = array($data['email']);
        //print_r( $list);exit;
            $this->email->to($list);
            $this->email->bcc(BCC_EMAIL);
            $this->email->reply_to(SMTP_FROM_EMAIL,SMTP_FROM_NAME);
            $this->email->subject($data['subject']);
            $this->email->message($template);
            $link= base_url() . 'uploads/notifications/';
            $send=$this->email->send();
        }
        
        public function insertenquiry(){
            $reponse=array();
            $enq_id=  $this->input->post('enq_id');
            $enq_comment=  $this->input->post('enq_comment');
            $error=0;$error_msg='';
            if(!num_check($enq_id)){$error=1;$error_msg.='Enquiry ID is missing';}
            if($enq_comment==''){$error=1;$error_msg.='Comment is missing';}
            if($error==0){
                
                    $insert_comment_data=array('enq_id'=>$enq_id,'enq_comment'=>  addslashes($enq_comment),'created_date'=>DATE);
                    $insert_comment=  $this->Crud->commonInsert('enquiry_comment_tbl',$insert_comment_data,'Comment added successfully');
                    echo $insert_comment;exit;
            }
            else{
                $response[CODE]=VALIDATION_CODE;
                $response[MESSAGE]='Validation Error';
                $response[DESCRIPTION]=$error_msg;
            }
            return json_encode($response);
        }
      //Enquiry Comment List code start 
        public function enquirylist($enqid)
        {
                $enq_id=  base64_decode($enqid);
                if(!num_check($enq_id)){
                    redirect(SITE_ADMIN_LINK.'Orders/enquiry');
                }else{
                         $main_list='Enquiry  Comment List';
            $main_link=$this->current_controller;
            $this->data['URL_TITLE']='Enquiry Comment  List';
            $this->data['create_link_url'] = '';
            $this->data['create_link_title'] = '';
            $breadcrumb_array = array(   array('title' =>$main_list, 'link' =>$main_link, 'class' => 'active'),  );
            $this->data['breadcrumb'] = json_encode($breadcrumb_array);
            $this->data['enq_details']=  $this->Order_model->enquiryCommentList($enq_id);
            $this->load->view($this->viewfolder_path. 'enquiry_comment_list', $this->data);
                }
                
        }
    }