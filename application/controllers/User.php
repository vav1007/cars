<?php
defined('BASEPATH') or die('Some thing error occured');

class User extends CI_Controller
{
        public $cartsession,$userid;
        public function __construct()
        {
            parent::__construct();
            $this->data = array();
            $this->load->model(['Home'=>'home','Cartmodel'=>'cart']);
            $this->cartsession=$this->session->userdata('cartsession');
            $this->ipaddress = $this->input->ip_address();
            $this->userid =$this->userid =$this->session->userdata(US_EXT.'sess_userid'); 
        }

        public function register()
        {
            $this->data['url_title']='Register';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'user/register',$this->data);
        }

        public function login()
        {
            $this->data['url_title']='Login';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'user/login',$this->data);
        }

        public function wishlist()
        {
            $this->data['url_title']='wishlist';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'user/wishlist',$this->data);
        }

        public function profile()
        {
            $this->data['url_title']='profile';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'user/profile',$this->data);
        }

        public function signOut()
        {
            $this->session->sess_destroy();
            redirect(base_url());
        }
}