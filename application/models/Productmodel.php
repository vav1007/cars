<?php
defined('BASEPATH') or die('Some thing error occured');

class Productmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //Product description details 
    public function productDetails($params)
    {
        $response=[];
        $folder=  base_url().UPLOADS.'products/';
        $productid = $params['product_id'];
        $where=['p.id'=>$productid,'p.activation_status'=>1];
        $cols="p.id as product_id,p.submenu_id as submenu_id,p.list_submenu_id as list_submenu_id,p.product_code as product_code,";
        $cols.="p.product_sku_code as sku_code,p.product_name as product_name,p.mrp_price as mrp,p.selling_price as selling_price,p.product_description as description,";
        $cols.="CONCAT('".$folder."',product_image) as product_pic,CONCAT('".$folder."',product_original_image) as product_org_pic,p.search_keywords as search_keywords,";
        $cols.="p.rating as rating,p.customisation_status as customisation,p.stock as stock,p.shipping_days as shipping_days,p.shipping_charges as shipping_charges,";
        $cols.="pt.title as product_type,b.title as brand_name,c.title as color_name,m.title as modelname,s.title as shape_name";
        $cols.=",sm.title as submenu_name,lsm.title as listsubmenu_name";
        $this->db->select($cols,false)->from('product_tbl p');
        $this->db->join('producttype_tbl pt','pt.id=p.product_type','left');
        $this->db->join('shape_tbl s','s.id=p.shape','left');
        $this->db->join('model_tbl m','m.id=p.model','left');
        $this->db->join('brand_tbl b','b.id=p.brand_id','left');
        $this->db->join('color_tbl c','c.id=p.color','left');
        $this->db->join('submenu_tbl sm','sm.id=p.submenu_id','left');
        $this->db->join('listsubmenu_tbl lsm','lsm.id=p.list_submenu_id','left');
        $this->db->where($where);
        $sql = $this->db->get();
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code'] == 0)
        {
            $count = $sql->num_rows();    
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['product_result']=($count > 0)?$sql->row():array();
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Some thing error occured';
        }
        return   json_encode($response);
    }

    public function productSectionList($params)
    {
        $response=[];
        $where = ['activation_status'=>1];
        $folder=  base_url().UPLOADS.'products/';
        $cols="id as product_id,product_name as product_name,CONCAT('".$folder."',product_image) as product_pic,rating as rating,mrp_price as mrp,selling_price as selling_price,product_label as product_label";
        $this->db->select($cols,false)->from('product_tbl');
        $this->db->where('activation_status',1);
        $this->db->where($where);
        $this->db->order_by('id','RANDOM')->limit(20);
        $sql = $this->db->get();
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code'] == 0)
        {
            $count = $sql->num_rows();    
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['total_product_count']=$count;
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
}