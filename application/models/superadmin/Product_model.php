<?php
defined('BASEPATH') or die('Unable to load : SSM');
/*
 * Page Name        :    Product
 * page Type          :    Model
 * Folder Path         :   model/superadmin/Product_model.php
 * purpose              :    Product Related CRUD,Search etc..
 * Created By         :    V.Venkateswara Achari
 * Created Date      :      24-03-2018
 */
class Product_model extends CI_Model{
    //sub menu with menu
    public function productSubMenu()
    {
        $response=array('menu_result'=>array());
        $where=array('activation_status'=>1);
        $sub_sql=  $this->db->select('id as id,title as title,')->from('menu_tbl')->where($where)->get();
        $sub_count=$sub_sql->num_rows();
        if($sub_count > 0)
        {
            $sub_array=array();
            foreach($sub_sql->result() as $sub_result)
            {
                $sub_array['id']=$sub_result->id;
                $sub_array['menu']=$sub_result->title;
                $sub_array['submenu_result']=array();
                   // subMenu
                    $sm_where=array(
                        'activation_status'=>1,
                        'menu_id'=>$sub_result->id,
                    );
                    $sql=  $this->db->select('id as id,menu_id as menuid,title as title')->from('submenu_tbl')->where($sm_where)->get();
                    $count=$sql->num_rows();
                    $list_sub_array=array();
                    if($count > 0)
                    {
                            foreach($sql->result() as $lsm_result)
                            {
                                    $list_sub_array['id']=$lsm_result->id;
                                    $list_sub_array['title']=$lsm_result->title;
                                    $list_sub_array['menuid']=$lsm_result->menuid;
                                    array_push($sub_array['submenu_result'], $list_sub_array);
                            }
                    }
                    array_push($response['menu_result'], $sub_array);
            }
            $response[CODE]=SUCCESS_CODE;
            $response[MESSAGE]='Success';
            $response[DESCRIPTION]=$sub_count.' results found';
        }
        else
        {
            $response[CODE]=FAIL_CODE;
            $response[MESSAGE]='Fail';
            $response[DESCRIPTION]='No results found';
        }
        return json_encode($response);
    }
    //List Submenu with submenu
    public function productListSubMenu()
    {
        $response=array('submenu_result'=>array());
        $where=array('activation_status'=>1);
        $sub_sql=  $this->db->select('id as id,title as title,')->from('submenu_tbl')->where($where)->get();
        $sub_count=$sub_sql->num_rows();
        if($sub_count > 0)
        {
            $sub_array=array();
            foreach($sub_sql->result() as $sub_result)
            {
                $sub_array['id']=$sub_result->id;
                $sub_array['submenu']=$sub_result->title;
                $sub_array['listsubmenu_result']=array();
                   //List subMenu
                    $lsm_where=array(
                        'activation_status'=>1,
                        'submenu_id'=>$sub_result->id,
                    );
                    $sql=  $this->db->select('id as id,submenu_id as submenuid,title as title')->from('listsubmenu_tbl')->where($lsm_where)->get();
                    $count=$sql->num_rows();
                    $list_sub_array=array();
                    if($count > 0)
                    {
                            foreach($sql->result() as $lsm_result)
                            {
                                    $list_sub_array['id']=$lsm_result->id;
                                    $list_sub_array['title']=$lsm_result->title;
                                    $list_sub_array['submenuid']=$lsm_result->submenuid;
                                    array_push($sub_array['listsubmenu_result'], $list_sub_array);
                            }
                    }
                    array_push($response['submenu_result'], $sub_array);
            }
            $response[CODE]=SUCCESS_CODE;
            $response[MESSAGE]='Success';
            $response[DESCRIPTION]=$sub_count.' results found';
        }
        else
        {
            $response[CODE]=FAIL_CODE;
            $response[MESSAGE]='Fail';
            $response[DESCRIPTION]='No results found';
        }
        return json_encode($response);
    }
    //product Promotion
    public function productPromotions()
    {
        $response=array();
        $where=array('activation_status'=>1);
        $sql=  $this->db->select('id as id,title as title')->from('product_promotiontype_tbl')->where($where)->order_by('title','ASC')->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
        $response['promotion_result']=($count > 0)?$sql->result():array();
        return json_encode($response);
    }
     //product Promotion
    public function productStatus()
    {
        $response=array();
        $where=array('activation_status'=>1);
        $sql=  $this->db->select('id as id,title as title')->from('product_status')->where($where)->order_by('title','ASC')->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
        $response['productstatus_result']=($count > 0)?$sql->result():array();
        return json_encode($response);
    }
    //product List
    public function productList($search)
    {
            $response=array();
            $table_name='product_tbl';
            $table_name=trim($table_name);
            $product_path=  base_url().UPLOADS.'products/';
            $lsm_search=$search['lsm'];
            $name_search=$search['name'];
            $activation_search=$search['activation'];
            $where=array('p.activation_status !='=>5,'sm.activation_status !='=>5);
            $case_status="p.activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
            //$popular_case_status="p.popular_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
            $popular_case_status='';
            $cols="p.id as id,p.submenu_id as submenu_id,p.list_submenu_id as listsubmenuid,p.product_code as productcode,"
                   . "p.product_name as productname,"
                   . "p.mrp_price as mrp,p.selling_price as sellingprice,"
                   . "p.product_description as description,"
                   . "sm.title as submenuname,lsm.title as listsubmenu,CASE $case_status  END as activationstatus,"
                   . "p.activation_status as status,CONCAT('".$product_path."',product_image) as product_image,"
                   ." p.promotion_featured as featured,p.promotion_latest as latest,p.promotion_bestselling as bestselling,p.promotion_newselling as newselling";
            $this->db->select($cols,false)->from($table_name.' p')
                    ->join('submenu_tbl sm','sm.id=p.submenu_id','inner')
                    ->join('listsubmenu_tbl lsm','lsm.id=p.list_submenu_id','left');
            $this->db->where($where);
            (!empty($lsm_search))?$this->db->where('p.list_submenu_id',$lsm_search):'';
            (!empty($name_search))?$this->db->like('p.product_name',$name_search,'both'):'';
             ($activation_search!='')?$this->db->where('p.activation_status',$activation_search):'';
             $sql=$this->db->order_by('p.id','desc');
             $error = $this->db->error();
             $error_message=$error['message'];
            if($error['code']==0) {
            try{
                $sql=  $this->db->get();
              //  echo $this->db->last_query();exit;
                $count=$sql->num_rows();
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
                $response['product_result']=($count > 0)?$sql->result():array();
                $response['statistics']=array(
                    'currentcount'=>$count,
                    'total'=>$this->Crud->statistics($table_name,array('activation_status !='=>5)),
                    'inactive'=>$this->Crud->statistics($table_name,array('activation_status'=>0)),
                    'active'=>$this->Crud->statistics($table_name,array('activation_status'=>1)),
                );
            } catch (Exception $ex) {
                $response[CODE]=FAIL_CODE;
                $response[MESSAGE]='Fail';
                $response[DESCRIPTION]='Some thing error occured';
                $response['product_result']=array();
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
   //getting product details for update
    public function getProductDetails($updateid)
    {
        $response=array();
        $mainproductpath=base_url().UPLOADS.'products/';
        $otherimagespath=base_url().UPLOADS.'products/otherimages/';
        $where=array('p.activation_status !='=>5,'sm.activation_status !='=>5,'p.id'=>$updateid);
        $sql=$this->db->select("p.id as id,p.artist_id as artistid,lsm.title as listsubmenu,p.submenu_id as submenuid,p.showprice as showprice,p.list_submenu_id as lsmid,p.product_code as productcode,p.product_sku_code as skucode,p.product_name as productname,p.medium as medium,p.year as year,p.size as size,p.quantity as quantity,p.mrp_price as mrp,p.selling_price as sellingprice,p.product_status as prodstatus,p.product_promotion_status as promotionstatus,p.product_description as description,frame_price as frameprice,CONCAT('".$mainproductpath."',p.product_image) as mainimage,GROUP_CONCAT('".$otherimagespath."',other.product_image) as otherimages,p.search_keywords as keywords",false)->from('product_tbl p')
                             ->join('product_images_tbl other','p.id=other.product_id','inner')
                             ->join('submenu_tbl sm','sm.id=p.submenu_id','inner')
                             ->join('listsubmenu_tbl lsm','lsm.id=p.list_submenu_id','left')
                             ->where($where)->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
        $response['product_details_res']=($count > 0)?$sql->row():array();
        return json_encode($response);
    }   
    //getting LSM details based on submenu
    public function subListmenuDetails($where)
    {
        $response=array();
        $sql=$this->db->select('id as id,title as lsmtitle')->from('listsubmenu_tbl')
            ->where($where)->where('activation_status !=',5)->get();
        //print_r($this->db->last_query());
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
        $response['lsm_res']=($count > 0)?$sql->result():array();
        return json_encode($response);
    }
}