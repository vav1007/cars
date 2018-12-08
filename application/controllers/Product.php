<?php
defined('BASEPATH') or die('Some thing error occured');

class Product extends CI_Controller
{
        public $cart_session;   
        public function __construct()
        {
            parent::__construct();
            $this->data = array();
            $this->load->model(['Productmodel'=>'product','Home'=>'home']);
            $this->cart_session=$this->session->userdata('cartsession');
        }

        public function productDescription()
        {
            $productName = $this->uri->segment(2);
            $product_id =  $this->uri->segment(3);
            $product_id = base64_decode($product_id);
            $this->data['url_title']=$productName. ' details';
            $params=[];
            $params['product_id']=$product_id;
            $this->data['best_selling']=$this->home->productList(['promotion'=>'bestseller']);
            $this->data['featured_products']=$this->home->productList(['promotion'=>'featured']);
            $this->data['product_details']=$this->product->productDetails($params);
            $this->load->view(FRONT_VIEW_PATH.'products/description',$this->data);
        }

        public function productListing()
        {
            $params=[];
            $this->data['level_three_categories']=$this->home->listSubMenuList();
            $this->data['product_details']=$this->product->productSectionList($params);
            $this->data['type_details']=  $this->Common->producttypes();
            $this->data['brand_details']=  $this->Common->brands();
            $this->data['model_details']=  $this->Common->models();
            $this->data['color_details']=  $this->Common->colors();
            $this->data['shape_details']=  $this->Common->shapes();
            $this->load->view(FRONT_VIEW_PATH.'products/product_listing',$this->data);
        }
    
}