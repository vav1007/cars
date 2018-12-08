<?php
defined('BASEPATH') OR exit('Some thing error occured while CM');
class Common extends CI_Model {
    //Menu List
    public function menu($where=NULL) {
        $response=array();
        $where=array('trash'=>0,'activation_status !='=>5);
        $sql=  $this->db->select('id as id,title as title')->from('menu_tbl')->where($where)->order_by('title','ASC')->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0 )?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?'Total '.$count .'results found':'No results found';
        $response['menu_result']=($count > 0)?$sql->result():array();
        return json_encode($response);
    }
    public function subMenu($where=NULL) {
        $response=array();
        $common_where=array('trash'=>0);
        $this->db->select('id as id,title as title,menu_id as menuid')->from('submenu_tbl')->where($common_where);
        ($where!='' && is_array($where))?$this->db->where($where):'';
        $sql=$this->db->order_by('title','ASC')->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0 )?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?'Total '.$count .'results found':'No results found';
        $response['submenu_result']=($count > 0)?$sql->result():array();
        return json_encode($response);
    }
    
    //Sizes Code 
    public function size()
    {
        $response=array();
        $common_where=array('trash'=>0);
        $this->db->select("id as id,concat(length,' (L)* ',width,' (W)* ',height,' (H)')title")->from('size_tbl')->where($common_where);
        $sql=$this->db->order_by('id','ASC')->get();
        //print_r($this->db->last_query());exit;
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0 )?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?'Total '.$count .'results found':'No results found';
        $response['size_result']=($count > 0)?$sql->result():array();
        return json_encode($response);
    }
    //Artist List code start
    public function artists()
    {
        $response=array();
        $common_where=array( 'activation_status'=>1, );
        $artist_profilepic_folder=  base_url().UPLOADS.'artist/profilepic/';
        $cols="id as id,name as name,email as email,mobile as mobile,city as city,address as address,CONCAT('".$artist_profilepic_folder."',profile_picture) as profilepic";
        $sql=$this->db->select($cols,false)->from('artist_tbl')->where($common_where)->order_by('name','asc')->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
        $response['artist_list']=($count > 0)?$sql->result():array();
        return json_encode($response);
    }
    //Multiple Delete
    public function commonMultipleDelete($table,$condition,$whereInCondition,$relationname)
    {
       $response=array();
        $this->db->where_in('id', explode(',',$whereInCondition));
        $sql=$this->db->delete($table);
        $delete=$this->db->affected_rows();
        $response[CODE]=($delete > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($delete > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($delete > 0)?"<b>$relationname</b> deleted successfully":'Unable to delete';
        return json_encode($response);
    }
    //Home menu List
    public function headerMenuList()
    {
        $response=array('menu_result'=>array());
        $menu_sql=  $this->db->select('id as id,title as title')->from('menu_tbl')->where('activation_status',1)
            ->order_by('id','DESC')->get();
        $menu_count=$menu_sql->num_rows();
        $db_error=  $this->db->error();
        $db_error_msg=$db_error['message'];
        if($db_error['code']==0)
        {
                $menu_array=array();
                $count=$menu_sql->num_rows();
                if($count > 0)
                {
                    foreach ($menu_sql->result() as $menu_result)
                    {
                            $menu_array['id']=$menu_result->id;
                            $menu_array['title']=  fetch_ucwords($menu_result->title);
                            $menu_array['submenu_result']=array();
                            //Submenu list details based on menuid
                            $submenu_where=array('activation_status'=>1,'menu_id'=>(int)$menu_result->id);
                            $submenu_sql=  $this->db->select('id as id,title as title')->from('submenu_tbl')->where($submenu_where)
                                    ->order_by('title','ASC')->get();
                            $db_error=  $this->db->error();
                            if($db_error['code']==0)
                            {
                                   $submenu_array=array();
                                    foreach($submenu_sql->result() as $submenu_result)
                                    {
                                            $submenu_array['id']=$submenu_result->id;
                                            $submenu_array['title']=$submenu_result->title;
                                            array_push($menu_array['submenu_result'], $submenu_array);
                                    }
                            }
                            array_push($response['menu_result'],$menu_array);
                    }
                }
                $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        }
        else
        {
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='DB error';
            $response[DESCRIPTION]='Error occured while loading...';
        }
        return json_encode($response);
    }
    //cart related data
     public function cartProperties($cartsession)
        {
                $response=array();
                $where=array('cart_session'=>$cartsession,'cart_status'=>0);
                $sql=  $this->db->select("COUNT(id) as cart_qty,SUM(cart_qty) as total_item_qty,SUM(cart_price) as cart_total,SUM((cart_qty*product_price)) as cart_subtotal,SUM((cart_qty*shipping_charges)) as shipping_charges")
                                       ->from('cart_tbl')->where($where)->get();
                //print_r($this->db->last_query());exit;
                $db_error=  $this->db->error();
                if($db_error['code']==0)
                {
                            $count=$sql->num_rows();
                            if($count > 0)
                            {
                                $cart_result=$sql->row();
                            }
                            $response['cart_qty']=($count > 0)?$cart_result->cart_qty:0;
                            $response['cart_item_qty']=($count > 0)?$cart_result->total_item_qty:0;
                            $response['cart_subtotal']=($count > 0)?$cart_result->cart_subtotal:0;
                            $response['cart_total']=($count > 0)?$cart_result->cart_total:0;
                            $response['cart_shipping_charge']=($count > 0)?$cart_result->shipping_charges:0;
                }
                else
                {
                            $response['cart_qty']=0;
                            $response['cart_item_qty']=0;
                            $response['cart_subtotal']=0;
                            $response['cart_total']=0;
                            $response['cart_shipping_charge']=0;
                }
                return json_encode($response);
        }
        //wishlist properties
        public function wishlistCount($ipaddress)
        {
            
            $response=array();
            $where=array('ip_address'=>$ipaddress);
            $sql=$this->db->select('COUNT(id) as w_count')->from('wishlist_tbl')->where($where)->get();
            // print_r($this->db->last_query());exit;
            $db_error=$this->db->error();
            $response['wish_count']=0;
            if($db_error['code']==0)
            {
                  $count=$sql->num_rows();
                  $response['wish_count']=($count > 0)?$sql->row()->w_count:0;
            }
            return json_encode($response);
        }

        //Brand details
        public function brands()
        {
            $response=array();
            $common_where=array( 'activation_status'=>1, );
            $cols="id as brandid,title as brand";
            $sql=$this->db->select($cols,false)->from('brand_tbl')->where($common_where)->order_by('title','asc')->get();
            $count=$sql->num_rows();
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['brands']=($count > 0)?$sql->result():array();
            return json_encode($response);
        }
        //product type details
        public function producttypes()
        {
            $response=array();
            $common_where=array( 'activation_status'=>1, );
            $cols="id as typeid,title as producttype";
            $sql=$this->db->select($cols,false)->from('producttype_tbl')->where($common_where)->order_by('title','asc')->get();
            $count=$sql->num_rows();
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['producttypes']=($count > 0)?$sql->result():array();
            return json_encode($response);
        }
        //model details
        public function models()
        {
            $response=array();
            $common_where=array( 'activation_status'=>1, );
            $cols="id as modelid,title as model";
            $sql=$this->db->select($cols,false)->from('model_tbl')->where($common_where)->order_by('title','asc')->get();
            $count=$sql->num_rows();
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['models']=($count > 0)?$sql->result():array();
            return json_encode($response);
        }
        //Color details
        public function colors()
        {
            $response=array();
            $common_where=array( 'activation_status'=>1, );
            $cols="id as colorid,title as color";
            $sql=$this->db->select($cols,false)->from('color_tbl')->where($common_where)->order_by('title','asc')->get();
            $count=$sql->num_rows();
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['colors']=($count > 0)?$sql->result():array();
            return json_encode($response);
        }
        //Shape details
        public function shapes()
        {
            $response=array();
            $common_where=array( 'activation_status'=>1, );
            $cols="id as shapeid,title as shape";
            $sql=$this->db->select($cols,false)->from('shape_tbl')->where($common_where)->order_by('title','asc')->get();
            $count=$sql->num_rows();
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['shapes']=($count > 0)?$sql->result():array();
            return json_encode($response);
        }
}