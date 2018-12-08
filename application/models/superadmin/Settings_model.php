<?php
defined('BASEPATH') or die('Unable to load : SSM');
/*
 * Page Name        :    Settings
 * page Type          :    Model
 * Folder Path         :   model/superadmin/Settings_model.php
 * purpose              :    Site related(slider,brand,color,size etc)
 * Created By         :    V.Venkateswara Achari
 * Created Date      :      23-03-2018
 */
class Settings_model extends CI_Model{
    
    public function sliderList($search=NULL)
    {
        $response=array();
        $table_name='slider_tbl';
        $table_name=trim($table_name);
        $slider_folder=  base_url().UPLOADS.'slider/';
        $name_search=$search['name'];
        $activation_search=$search['activation'];
        $case_status="activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="id as sliderid,title as title,description as slidercontent,url_link as urllink,CONCAT('".$slider_folder."',slider_image) as sliderpath,CASE $case_status  END as sliderstatus,activation_status as status,DATE_FORMAT(created_date,'%b %d %Y %h:%i %p') as createddate";
        $this->db->select($cols,false)->from($table_name);
        (!empty($name_search))?$this->db->like('title',$name_search,'both'):'';
        ($activation_search!='')?$this->db->where('activation_status',$activation_search):'';
        $this->db->order_by('id','desc');
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code']==0) {
            try{
                $sql=  $this->db->get();
                $count=$sql->num_rows();
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
                $response['slider_result']=($count > 0)?$sql->result():array();
                $response['statistics']=array(
                    'currentcount'=>$count,
                    'total'=>$this->Crud->statistics($table_name,array()),
                    'inactive'=>$this->Crud->statistics($table_name,array('activation_status'=>0)),
                    'active'=>$this->Crud->statistics($table_name,array('activation_status'=>1)),
                );
            } catch (Exception $ex) {
                $response[CODE]=FAIL_CODE;
                $response[MESSAGE]='Fail';
                $response[DESCRIPTION]='Some thing error occured';
                $response['slider_result']=array();
            }
        }
        else
        {
            $response[code]=DB_ERROR_CODE;
            $response[MESSAGE]='Database error';
            $response[DESCRIPTION]=$error_message;
        }
        return  json_encode($response);
    }
    //Slider Details
    public function sliderDetails($sliderid)
    {
         $response=array();
        $table_name='slider_tbl';
        $table_name=trim($table_name);
        $slider_folder=  base_url().UPLOADS.'slider/';
        $cols="id as sliderid,title as title,description as slidercontent,ulink as urllink,CONCAT('".$slider_folder."',slider_image) as sliderpath";
        $this->db->select($cols,false)->from($table_name)->where(array('id'=>$sliderid));
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code']==0) 
        {
                $sql=  $this->db->get();
                $count=$sql->num_rows();
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
                $response['slider_result']=($count > 0)?$sql->row():array();
        }
        else
        {
            $response[code]=DB_ERROR_CODE;
            $response[MESSAGE]='Database error';
            $response[DESCRIPTION]=$error_message;
        }
        return json_encode($response);
    }
    //Size 
     public function sizeList($search=NULL){
        $response=array();
        $table_name='size_tbl';
        $table_name=trim($table_name);
        $where=array('activation_status !'=>4);
        $name_search=$search['name'];
        $activation_search=$search['activation'];
        $case_status="activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="id as id,height as height,width as width,length as length,CASE $case_status  END as status_message,activation_status as status";
        $this->db->select($cols,false)->from($table_name);
        if(!empty($name_search)) { 
            $this->db->like('height',$name_search,'both');
            $this->db->or_like('width',$name_search,'both');
            $this->db->or_like('length',$name_search,'both');
        }
        ($activation_search!='')?$this->db->where('activation_status',$activation_search):'';
                $this->db->order_by('id','desc');
                $sql=  $this->db->get();
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code']==0) {
                $count=$sql->num_rows();
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
                $response['size_result']=($count > 0)?$sql->result():array();
                $response['statistics']=array(
                    'currentcount'=>$count,
                    'total'=>$this->Crud->statistics($table_name,array()),
                    'inactive'=>$this->Crud->statistics($table_name,array('activation_status'=>0)),
                    'active'=>$this->Crud->statistics($table_name,array('activation_status'=>1)),
                );
            
        }
        else
        {
            $response[code]=DB_ERROR_CODE;
            $response[MESSAGE]='Database error';
            $response[DESCRIPTION]=$error_message;
        }
        return  json_encode($response);
    }
    //Size details code 
    public function sizeDetails($id)
    {
        $response=array();
        $common_where=array('id'=>$id,'activation_status !='=>5);
        $sql=  $this->db->select('id as id,height as height,width as width,length as length')->from('size_tbl')->where($common_where)->limit(1)->get();
        $error=  $this->db->error();
        $error_message=$error['message'];
        if($error['code']==0)
        {
                $count=$sql->num_rows();
                $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Success':'No results found';
                $response['size_details']=($count > 0)?$sql->row():array();
        }
        else
        {
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='Database error';
            $response[DESCRIPTION]=$error_message;
        }
        return json_encode($response);
    }
}