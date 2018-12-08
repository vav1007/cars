<?php
defined('BASEPATH') or die('Some thing error occured');

class Cms extends CI_Controller
{
        public $cart_session;   
        public function __construct()
        {
            parent::__construct();
            $this->data = array();
          
            $this->cart_session=$this->session->userdata('cartsession');
        }

        public function aboutus()
        {
            $this->data['url_title']='About us';
            $this->data['main_heading']='About us';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'cms/aboutus',$this->data);
        }

        public function contactus()
        {
            $this->data['url_title']='Contact us';
            $this->data['main_heading']='Contact us';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'cms/contactus',$this->data);
        }
        public function blog()
        {
            $this->data['url_title']='Blog';
            $this->data['main_heading']='Blog';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'cms/aboutus',$this->data);
        }
        public function affiliates()
        {
            $this->data['url_title']='Affiliates';
            $this->data['main_heading']='Affiliates';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'cms/aboutus',$this->data);
        }
        public function careers()
        {
            $this->data['url_title']='Careers';
            $this->data['main_heading']='Careers';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'cms/aboutus',$this->data);
        }
        public function faqs()
        {
            $this->data['url_title']='Faqs';
            $this->data['main_heading']='Faqs';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'cms/aboutus',$this->data);
        }
        public function support()
        {
            $this->data['url_title']='Support';
            $this->data['main_heading']='Support';
            $params=[];
            $this->load->view(FRONT_VIEW_PATH.'cms/aboutus',$this->data);
        }
}