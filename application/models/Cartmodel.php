<?php
defined('BASEPATH') or die('Some thing error occured');

class Cartmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addToCart($params)
    {
        $response=[];
        $productid = $params['productid'];
        $cart_session = $params['cart_session'];
        $ipaddress = $params['ipaddress'];
        $qty=$params['qty'];

        $duplicationCheck = $this->Crud->commonCheck('id','cart_tbl',['cart_status'=>0,'cart_session'=>$cart_session,'product_id'=>$productid]);
        if($duplicationCheck == 0)
        {
            $cartInsertData=[
                'cart_qty'=>$qty,
                'product_id'=>$productid,
                'cart_session'=>$cart_session,
                'created_date'=>DATE,
                'created_ip_address'=>$ipaddress,
            ]; 
            $insert=$this->Crud->commonInsert('cart_tbl',$cartInsertData,'Product add to cart successfully');
          
        }
        else
        {
            $cartUpdateData=[
                'cart_qty'=>$qty,
            ]; 
            $cartWhere = ['product_id'=>$productid,'cart_session'=>$cart_session];
            $insert=$this->Crud->commonUpdate('cart_tbl',$cartUpdateData,$cartWhere,'Product add to cart successfully');
            
        }
        
        $res = json_decode($insert);
        $response[CODE]=$res->code;
        $response[MESSAGE]=$res->message;
        $response[DESCRIPTION]=($res->code==200)?$res->description:'Product already exists in your cart';
        $response['cart_count']=0;
        $response['sub_total']=$this->cartSubTotal($cart_session);
        return json_encode($response);
    }

    public function addToCompare($params)
    {
        $response=[];
        $productid = $params['productid'];
        $cart_session = $params['cart_session'];
        $ipaddress = $params['ipaddress'];

        $duplicationCheck = $this->Crud->commonCheck('compare_id','product_compare_tbl',['product_id'=>$productid,'cart_session'=>$cart_session]);
        if($duplicationCheck == 0)
        {
            $compareInsertData=[
                'product_id'=>$productid,
                'cart_session'=>$cart_session,
                'created_date'=>DATE,
                'created_ip_address'=>$ipaddress,
            ]; 
            $insert=$this->Crud->commonInsert('product_compare_tbl',$compareInsertData,'Product added to compare list');
            return $insert;   
        }
        else
        {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='Fail';
                    $response[DESCRIPTION]='product already exists in your compare list';
        }
        return json_encode($response);
        
    }

    public function addToWishlist($params)
    {
        $response=[];
        $productid = $params['productid'];
        $cart_session = $params['cart_session'];
        $user_id = $params['userid'];
        $ipaddress = $params['ipaddress'];

        $duplicationCheck = $this->Crud->commonCheck('id','wishlist_tbl',['product_id'=>$productid,'user_id'=>$user_id]);
        if($duplicationCheck == 0)
        {
            $wishlistInsertData=[
                'product_id'=>$productid,
                'user_id'=>$user_id,
                'cart_session'=>$cart_session,
                'created_date'=>DATE,
                'ip_address'=>$ipaddress,
            ]; 
            $insert=$this->Crud->commonInsert('wishlist_tbl',$wishlistInsertData,'Product added to wishlist successfully');
            return $insert;   
        }
        else
        {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='Fail';
                    $response[DESCRIPTION]='product already exists in your wishlist';
        }
        return json_encode($response);
        
    }

    //Getting cart list
    public function cartList($params)
    {
        $response=[];
        $cart_session=$params['cartsession'];
        $where=['c.cart_session'=>$cart_session,'c.cart_status'=>0];
        $folder=  base_url().UPLOADS.'products/';
        $cols="c.*,p.product_name as product_name,p.selling_price as sellingprice,p.mrp_price as mrp,p.rating as rating,CONCAT('".$folder."',p.product_image) as product_pic";
        $this->db->select($cols,false)->from('cart_tbl c');
        $this->db->join('product_tbl p','p.id=c.product_id','inner');
        $this->db->where($where);
        $sql = $this->db->order_by('c.id','ASC')->get();
       // echo $this->db->last_query();exit;
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code'] == 0)
        {
            $count = $sql->num_rows();    
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?$count.' results found':'No results found';
            $response['cart_count']=$count;
            $response['cart_result']=($count > 0)?$sql->result():array();
            $response['sub_total']=$this->cartSubTotal($cart_session);
        }
        else
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Some thing error occured';
            $response['cart_count']=0;
            $response['sub_total']=0;
        }
        return json_encode($response);  
    }

    public function cartSubTotal($cartsession)
    {
        $where=['c.cart_session'=>$cartsession,'c.cart_status'=>0];
        $cart_sql = $this->db->select('SUM(p.selling_price * c.cart_qty) as cart_total')->from('cart_tbl c')
        ->join('product_tbl p','p.id=c.product_id','inner')
        ->where($where)->get();
        $cart_count  = $cart_sql->num_rows();
        $cart_subtotal = ($cart_count > 0 && $cart_sql->row()->cart_total)?$cart_sql->row()->cart_total:0;
        return $cart_subtotal;
    }


    public function updateCartQty($params)
    {
        $response=[];
        $qty = $params['qty'];
        $cartid = $params['cartid'];
        $cart_session = $params['cart_session'];
        $updateSet = ['cart_qty'=>$qty];
        $updateWhere = ['id'=>$cartid,'cart_session'=>$cart_session,'cart_status'=>0];
        $updateSql = $this->db->update_string('cart_tbl',$updateSet,$updateWhere);
        $update = $this->db->query($updateSql);
        $updateStatus = $this->db->affected_rows();
        $response[CODE]=($updateStatus > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($updateStatus > 0)?'success':'fail';
        $response[DESCRIPTION]=($updateStatus > 0)?'Qty updated successfully':'Unable to update the qty';
        return json_encode($response);
    }

    // Check coupon code 
    public function checkCouponCode($params)
    {
        $response=[];
        $couponcode = $params['coupon_code'];
        $cart_session = $params['cart_session'];
        $couponWhere=['CouponCode' => strtoupper($couponcode),'flag_status'=>1];
        $couponSql = $this->db->select('*')->from('coupon_tbl')->where($couponWhere)->get();
        $couponCount = $couponSql->num_rows();
        $response[CODE]=($couponCount > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($couponCount > 0)?'success':'fail';
        $response[DESCRIPTION]=($couponCount > 0)?'coupon applied successfully':'Invalid coupon code or Expired';
        $response['coupondetails'] = ($couponCount > 0)?$couponSql->row():[];
        return json_encode($response);
    }

    
}