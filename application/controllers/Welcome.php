<?php
defined('BASEPATH') or die('Some thing error occured');

class Welcome extends CI_Controller
{
        public $cart_session;   
        public function __construct()
        {
            parent::__construct();
            $this->data = array();
            $this->load->model(['Home'=>'home']);
            $this->cart_session=$this->session->userdata('cartsession');
        }

        public function index()
        {
            $this->data['url_title']='Home';
            $this->data['slider'] = $this->home->sliderList();
            $this->data['testimonials'] = $this->home->testimonials();
            $this->data['brands'] = $this->home->brands();
            $this->data['best_selling']=$this->home->productList(['promotion'=>'bestseller']);
            $this->data['featured_products']=$this->home->productList(['promotion'=>'featured']);
            $this->data['latest_products']=$this->home->productList(['promotion'=>'latest']);
            $this->data['newselling_products']=$this->home->productList(['promotion'=>'newselling']);
            //echo $this->home->productList(['promotion'=>'newselling']);exit;
            $this->data['level_three_categories']=$this->home->listSubMenuList();
            $this->load->view(FRONT_VIEW_PATH.'home',$this->data);
        }

        public function headerMenuList()
        {
            $headerMenu = $this->Common->headerMenuList();
            echo $headerMenu;
        }
    
}