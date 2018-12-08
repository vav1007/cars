<?php
defined('BASEPATH') or die('Some thing error occured');

class Home extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function sliderList()
    {
        $response=array();
        $table_name='slider_tbl';
        $slider_folder=  base_url().UPLOADS.'slider/';
        $cols="id as sliderid,title as title,description as slidercontent,url_link as urllink,CONCAT('".$slider_folder."',slider_image) as sliderpath";
        $this->db->select($cols,false)->from($table_name);
        $this->db->where('activation_status',1);
        $this->db->order_by('id','desc');
        $sql = $this->db->get();
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code'] == 0)
        {
            $count = $sql->num_rows();    
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['slider_result']=($count > 0)?$sql->result():array();
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Some thing error occured';
        }
        return json_encode($response);
    }

    public function testimonials()
    {
        $response=array();
        $table_name='testimonials_tbl';
        $folder=  base_url().UPLOADS.'testimonials/userpictures/';
        $cols="title as title,username as username,comment as comment,CONCAT('".$folder."',picture) as userpic,created_date as created_date";
        $this->db->select($cols,false)->from($table_name);
        $this->db->where('activation_status',1);
        $this->db->order_by('id','desc');
        $sql = $this->db->get();
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code'] == 0)
        {
            $count = $sql->num_rows();    
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['testimonial_result']=($count > 0)?$sql->result():array();
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Some thing error occured';
        }
        return json_encode($response);
    }

    public function brands()
    {
        $response=array();
        $table_name='brand_tbl';
        $folder=  base_url().UPLOADS.'brand/';
        $cols="id as brandid,title as brandname,CONCAT('".$folder."',icon) as brand_icon";
        $this->db->select($cols,false)->from($table_name);
        $this->db->where('activation_status',1);
        $this->db->order_by('id','desc');
        $sql = $this->db->get();
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code'] == 0)
        {
            $count = $sql->num_rows();    
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['brand_result']=($count > 0)?$sql->result():array();
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Some thing error occured';
        }
        return json_encode($response);
    }

    //Best seller products
    public function productList($search=NULL)
    {
        $col='';
        $limit=4;
        $promotion_type =  $search['promotion'];
        switch($promotion_type)
        {
            case 'bestseller':$col='promotion_bestselling';break;
            case 'featured':$col='promotion_featured';$limit=6;break;
            case 'latest':$col='promotion_latest';$limit=6;break;
            case 'newselling':$col='promotion_newselling';break;
        }
        $response=[];
        $where=[];
        $table_name='product_tbl';
        if(!empty($col)){
            $where =[$col=>1];
        }
        $folder=  base_url().UPLOADS.'products/';
        $cols="id as product_id,product_name as product_name,CONCAT('".$folder."',product_image) as product_pic,rating as rating,mrp_price as mrp,selling_price as selling_price,product_label as product_label";
        $this->db->select($cols,false)->from($table_name);
        $this->db->where('activation_status',1);
        $this->db->where($where);
        $this->db->order_by('id','RANDOM')->limit(4);
        $sql = $this->db->get();
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code'] == 0)
        {
            $count = $sql->num_rows();    
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['product_result']=($count > 0)?$sql->result():array();
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Some thing error occured';
        }
        return json_encode($response);
    }

    //List submenu details
    public function listSubMenuList($params=NULL)
    {
        $response=[];
        $where=['activation_status'=>1];
        $cols="id as listsubmenuid,title as title";
        $this->db->select($cols,false)->from('listsubmenu_tbl');
        $this->db->where($where);
        $this->db->order_by('id','RANDOM')->limit(4);
        $sql = $this->db->get();
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code'] == 0)
        {
            $count = $sql->num_rows();    
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['listsubmenu_result']=($count > 0)?$sql->result():array();
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Some thing error occured';
        }
        return json_encode($response);
    }

}