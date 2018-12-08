<?php
defined('BASEPATH') or die('Error occured while loading the Categories');
/*
 * Page Name        :    Cms_model
 * page Type          :    Model
 * Folder Path         :   model/superadmin/Cms_model
 * purpose              :    Other (artist,)
 * Created By         :   Venkateswara achari
 * Created Date      :      4-05-2018
 */
class Cms_model extends CI_Model{
    //faq list for view page
    public function faqList($search=NULL)
    {
        $response=array();
        $table_name='faq_tbl';
        $table_name=trim($table_name);
        $where=array('activation_status !='=>5);
        $name_search=$search['name'];
        $activation_search=$search['activation'];
        $case_status="activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="id as id,question as question,answer as answer,CASE $case_status  END as status_message,activation_status as status";
        $this->db->select($cols,false)->from($table_name)->where($where);
         (!empty($name_search))?$this->db->like('question',$name_search,'both'):'';
         ($activation_search!='')?$this->db->where('activation_status',$activation_search):'';
               $this->db->order_by('id','desc');
       $sql=  $this->db->get();
       $error= $this->db->error();
       if($error['code']==0)
       {
            $count=$sql->num_rows();
            $response[CODE]=SUCCESS_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
            $response['faq_result']=($count > 0)?$sql->result():array();
            $response['statistics']=array(
                'currentcount'=>$count,
                'total'=>$this->Crud->statistics($table_name,array('activation_status !='=>5)),
                'inactive'=>$this->Crud->statistics($table_name,array('activation_status'=>0)),
                'active'=>$this->Crud->statistics($table_name,array('activation_status'=>1)),
            );
       }  
       else
       {
            $error_message=$error['message'];
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='Database error';
            $response[DESCRIPTION]=$error_message;
       }  
       return json_encode($response);
    }
    //Faq details based  on id
    public function faqDetails($id)
    {
        $response=array();
        $common_where=array('activation_status !='=>5,'id'=>$id);
        $sql=  $this->db->select('id as id,question as question,answer as answer')->from('faq_tbl')->where($common_where)->limit(1)->get();
        $error=  $this->db->error();
        $error_msg=$error['message'];
        if($error['code']==0)
        {
             $count=$sql->num_rows();
             $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
             $response[MESSAGE]=($count > 0)?'Success':'Fail';
             $response[DESCRIPTION]=($count > 0)?'Success':'No records found';
             $response['faq_details']=($count > 0)?$sql->row():array();
        }
        else
        {
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='Database error';
            $response[DESCRIPTION]=$error_msg;
        }
        return json_encode($response);
    }
    //testimonials list for view
    public function testimonialsList($search_array)
    {
        $response=array();
        $table_name='testimonials_tbl';
        $table_name=trim($table_name);
        $where=array('activation_status !='=>5);
        $testimonialspath=base_url().'uploads/testimonials/userpictures/';
        //$name_search=$search['name'];
        //$activation_search=$search['activation'];
        $case_status="activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="id as id,title as title,username as username,comment as comment,
        CONCAT('".$testimonialspath."',picture) as picture,CASE $case_status END as status_message,activation_status as status";
        $this->db->select($cols,false)->from($table_name)->where($where);
        // (!empty($name_search))?$this->db->like('name',$name_search,'both'):'';
        // ($activation_search!='')?$this->db->where('activation_status',$activation_search):'';
        //         $this->db->order_by('id','desc');
       $sql=  $this->db->get();
       $error= $this->db->error();
       if($error['code']==0)
       {
            $count=$sql->num_rows();
            $response[CODE]=SUCCESS_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
            $response['testimonials_result']=($count > 0)?$sql->result():array();
            $response['statistics']=array(
                'currentcount'=>$count,
                'total'=>$this->Crud->statistics($table_name,array()),
                'inactive'=>$this->Crud->statistics($table_name,array('activation_status'=>0)),
                'active'=>$this->Crud->statistics($table_name,array('activation_status'=>1)),
            );
       }  
       else
       {
            $error_message=$error['message'];
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='Database error';
            $response[DESCRIPTION]=$error_message;
       }  
       return json_encode($response);
    }
    //testimonial details details based on id
    public function testimonialDetails($id)
    {
        $response=array();
        if(num_check($id))
        {
                $testimonialspath=base_url().'uploads/testimonials/userpictures/';
                $cols="id as id,title as title,username as username,comment as comment,
                CONCAT('".$testimonialspath."',picture) as picture,created_date as created_date";
                $where=array('activation_status !='=>5,'id'=>$id);
                $sql=$this->db->select($cols,false)->from('testimonials_tbl')->where($where)->get();
                $db_error=  $this->db->error();
                $db_error_msg=$db_error['message'];
                if($db_error['code']==0)
                {
                    $count=$sql->num_rows();
                    $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                    $response[MESSAGE]=($count > 0)?'Success':'Fail';
                    $response[DESCRIPTION]=($count > 0)?'Getting the testimonial details':'No records found';
                    $response['testimonial_result']=($count > 0)?$sql->row():array();
                }
                else
                {
                    $response[CODE]=DB_ERROR_CODE;
                    $response[MESSAGE]='Db error';
                    $response[DESCRIPTION]=$db_error_msg;
                }
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Invalid input data';
            $response[DESCRIPTION]='Invalid testimonial id';
        }
        return json_encode($response);
    }
    //getting advisory list for view
    public function advisoryList($search)
    {
        //print_r($search_array);
        $response=array();
        $table_name='advisory_tbl';
        $table_name=trim($table_name);
        $where=array('activation_status !='=>5);
        $advisorypath=base_url().'uploads/advisoryboard/userpictures/';
        $name_search=$search['name'];
        $activation_search=$search['activation'];
        $case_status="activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="id as id,title as title,email as email,mobile as mobile,suggestion as suggestion,
        CONCAT('".$advisorypath."',picture) as picture,CASE $case_status END as status_message,activation_status as status";
        $this->db->select($cols,false)->from($table_name)->where($where);
         if(!empty($name_search)){
             $this->db->like('title',$name_search,'both');
             $this->db->or_like('email',$name_search,'both');
             $this->db->or_like('mobile',$name_search,'both');
         }
         ($activation_search!='')?$this->db->where('activation_status',$activation_search):'';
                 $this->db->order_by('id','desc');
       $sql=  $this->db->get();
       $error= $this->db->error();
       if($error['code']==0)
       {
            $count=$sql->num_rows();
            $response[CODE]=SUCCESS_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
            $response['advisory_result']=($count > 0)?$sql->result():array();
            $response['statistics']=array(
                'currentcount'=>$count,
                'total'=>$this->Crud->statistics($table_name,array('activation_status !='=>5)),
                'inactive'=>$this->Crud->statistics($table_name,array('activation_status'=>0)),
                'active'=>$this->Crud->statistics($table_name,array('activation_status'=>1)),
            );
       }  
       else
       {
            $error_message=$error['message'];
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='Database error';
            $response[DESCRIPTION]=$error_message;
       }  
       return json_encode($response);
    } 
    //News letter list
    public function newsletterList($search)
    {
        $response=array();
        $name_search=$search['name'];
        $activation_search=$search['activation'];
        $table_name='newsletter_tbl';
        $case_status="activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="id as id,email as email,CASE $case_status END as status_message,activation_status as status,created_date as created_date";
        $this->db->select($cols,false)->from($table_name);
        if(!empty($name_search)){
             $this->db->like('email',$name_search,'both');
         }
         ($activation_search!='')?$this->db->where('activation_status',$activation_search):'';
        $sql=  $this->db->order_by('id','DESC')->get();
        $db_error=  $this->db->error();
        $db_error_msg=$db_error['message'];
        if($db_error['code']==0)
        {
                $count=$sql->num_rows();
                $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?$count. ' results found':'No results found';
                $response['news_result']=($count > 0)?$sql->result():array();
                 $response['statistics']=array(
                                            'currentcount'=>$count,
                                            'total'=>$this->Crud->statistics($table_name,array('activation_status !='=>5)),
                                            'inactive'=>$this->Crud->statistics($table_name,array('activation_status'=>0)),
                                            'active'=>$this->Crud->statistics($table_name,array('activation_status'=>1)),
                                        );
        }
        else
        {
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='DB error';
            $response[DESCRIPTION]=$db_error.' message occured';
        }
        return json_encode($response);
    }
     //getting email id's for newsletter purpose
    public function getNewsletterEmails($emailids)
    {
        $response=array();
        $sql=  $this->db->select('email as emails')->from('newsletter_tbl')->where_in('id',explode(',', $emailids))->get();
        $db_error=  $this->db->error();
        if($db_error['code']==0)
        {
                $count=$sql->num_rows();
                $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
                $response['emails_result']=($count > 0)?$sql->result():array();
        }
        else
        {
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='DB error';
            $response[DESCRIPTION]=$db_error['message'].' error occured';
        }
        return json_encode($response);
    }
}