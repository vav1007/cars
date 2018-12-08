<?php
defined('BASEPATH') or die('Some thing error occured');

class Cart extends CI_Controller
{
        public $cartsession,$userid;
        public function __construct()
        {
            parent::__construct();
            $this->data = array();
            $this->load->model(['Home'=>'home','Cartmodel'=>'cart']);
            $this->cartsession=$this->session->userdata('cartsession');
            $this->ipaddress = $this->input->ip_address();
            $this->userid =$this->session->userdata(US_EXT.'sess_userid'); 
        }

        public function cartList()
        {
            $this->data['url_title']='Cart';
            $params=[];
            $params['cartsession']=$this->cartsession;
            $this->data['cart_details']=$this->cart->cartList($params); 
            $this->load->view(FRONT_VIEW_PATH.'cart/cartList',$this->data);
        }

        public function headercartlist($cartsession)
        {
            $params=[];
            $params['cartsession']=$cartsession;
            $cart=$this->cart->cartList($params); 
            echo $cart;
        }

        public function checkout()
        {
            
            $this->data['url_title']='Checkout';
            $params=[];
            $params['cartsession']=$this->cartsession;
            $this->data['cart_details']=$this->cart->cartList($params); 
            $this->load->view(FRONT_VIEW_PATH.'cart/checkout',$this->data);
        }

        public function addToCart()
        {
            $response=[];
            $error =  1;
            $productid = $this->input->post('productid');
            $qty = $this->input->post('qty');
            if(!number_check($productid)){ $error=0; $error_msg='product is missing';}
            if(!number_check($qty)){ $error=0; $error_msg='allows number only';}
            if($error == 0)
            {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='Fail';
                    $response[DESCRIPTION]='Some thing error occured';
            }
            else
            {
                $cartData = [
                    'qty'=>$qty,
                    'productid'=>$productid,
                    'cart_session'=>$this->cartsession,
                    'ipaddress'=>$this->ipaddress,
                ];
                $addToCart = $this->cart->addToCart($cartData);
                echo $addToCart;exit;
            }    
            echo json_encode($response);
        }

        public function addToCompare()
        {
            $response=[];
            $error =  1;
            $productid = $this->input->post('productid');
            if(!number_check($productid)){ $error=0; $error_msg='product is missing';}
            if($error == 0)
            {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='Fail';
                    $response[DESCRIPTION]='Some thing error occured';
            }
            else
            {
                $insertData = [
                    'productid'=>$productid,
                    'cart_session'=>$this->cartsession,
                    'ipaddress'=>$this->ipaddress,
                ];
                $addTocompare = $this->cart->addToCompare($insertData);
                echo $addTocompare;exit;
            }    
            echo json_encode($response);
        }

        public function addToWishlist()
        {
            $response=[];
            $error =  1;
            $productid = $this->input->post('productid');
            if(!number_check($productid)){ $error=0; $error_msg='product is missing';}
            if($error == 0)
            {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='Fail';
                    $response[DESCRIPTION]='Some thing error occured';
            }
            else
            {
                $cartData = [
                                'productid'=>$productid,
                                'cart_session'=>$this->cartsession,
                                'ipaddress'=>$this->ipaddress,
                                'userid'=>$this->userid,
                            ];
                $addToWishlist = $this->cart->addToWishlist($cartData);
                echo $addToWishlist;exit;
            }    
            echo json_encode($response);
        }

        public function deleteCartItem()
        {
            $response=[];
            $error =  1;
            $cartid = $this->input->post('cartid');
            if(!number_check($cartid)){ $error=0; $error_msg='cart is missing';}
            if($error == 0)
            {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='Fail';
                    $response[DESCRIPTION]='Some thing error occured';
            }
            else
            {
                $where = [
                    'id'=>$cartid,
                    'cart_session'=>$this->cartsession,
                    ];
                $delete = $this->db->delete('cart_tbl',$where);
                $count = $this->db->affected_rows();
                $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Cart item deleted successfully':'Some thing error occured';
            }    
            echo json_encode($response);
        }

        //Update cart qty
        public function updateCartQty()
        {
            $response=[];
            $error =  1;
            $cartid = $this->input->post('cartid');
            $qty = $this->input->post('qty');
            if(!number_check($cartid)){ $error=0; $error_msg='cart is missing';}
            if(!number_check($qty)){ $error=0; $error_msg='allows number only';}
            if($error == 0)
            {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='Fail';
                    $response[DESCRIPTION]='Some thing error occured';
            }
            else
            {
                $cartData = [
                    'qty'=>$qty,
                    'cartid'=>$cartid,
                    'cart_session'=>$this->cartsession,
                    'ipaddress'=>$this->ipaddress,
                ];
                $addToCart = $this->cart->updateCartQty($cartData);
                echo $addToCart;exit;
            }    
            echo json_encode($response);
        }

        //check coupon details 
        public function checkCouponDetails()
        {
            $response=[];
            $error =  1;
            $couponcode = $this->input->post('couponcode');
            if($couponcode==''){ $error=0; $error_msg='coupon code is missing';}
            
            if($error == 0)
            {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='Fail';
                    $response[DESCRIPTION]='Some thing error occured';
            }
            else
            {
                $params = [];
                $params['coupon_code']=$couponcode;
                $params['cart_session']=$this->cartsession;
                $checkcouponcodeSql = $this->cart->checkCouponCode($params);
                $couponres = json_decode($checkcouponcodeSql);
                if($couponres->code == 200)
                {
                     $couponresult = $couponres->coupondetails;
                     $couponcode = $couponresult->CouponCode;
                     $coupon_discount = $couponresult->OfferValue;
                     $this->session->set_userdata(['coupon_code'=>$couponcode,'coupon_discount'=>$coupon_discount]);
                     $response[CODE]=SUCCESS_CODE;
                     $response[MESSAGE]='success';
                     $response[DESCRIPTION]='Coupon applied successfully';    
                }
                else
                {
                    //Invalid details
                    $response[CODE]=FAIL_CODE;
                     $response[MESSAGE]='fail';
                     $response[DESCRIPTION]='Invalid coupon code or coupon may expired';    
                }
            }    
            echo json_encode($response);
        }
}