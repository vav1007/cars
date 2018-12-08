<?php
defined('BASEPATH') or die('Unable to load : SSM');
/*
 * Page Name    : Categories_model
 * page Type    : Model
 * Folder Path  : models/superadmin/Categories_model
 * purpose      : This is for Category List
 * Created By   : V.Venkateswara Achari
 * Created Date : 20-04-2018
*/
class Categories_model extends CI_Model{
    
    /*
    |--------------------------------------------------------------------------
    | Menu Details
    |--------------------------------------------------------------------------
    |*/
    //Menu list
     public function menuList($search){
        $response=array();
        $name_search=$search['name'];
        $activation_search=$search['activation'];
        $where=array('activation_status !='=>5);
        $menu_folder=  base_url().UPLOADS.'category/menu/';
        $case_status="activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="id as id,title as title,CONCAT('".$menu_folder."',menu_icon) as icon,CONCAT('".$menu_folder."',app_icon) as appicon,CONCAT('".$menu_folder."',image) as menuimage,CASE $case_status  END as menustatus,activation_status as status,priority as priority";
        $this->db->select($cols,false)->from('menu_tbl')->where($where);
        (!empty($name_search))?$this->db->like('title',$name_search,'both'):'';
        ($activation_search!='')?$this->db->where('activation_status',$activation_search):'';
                $this->db->order_by('id','desc');
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code']==0) {
            try{
                $sql=  $this->db->get();
                $count=$sql->num_rows();
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
                $response['menu_result']=($count > 0)?$sql->result():array();
                $response['statistics']=array(
                    'total'=>$count,
                    'inactive'=>$this->statistics('menu_tbl',array('activation_status'=>0)),
                    'active'=>$this->statistics('menu_tbl',array('activation_status'=>1)),
                );
            } catch (Exception $ex) {
                $response[CODE]=FAIL_CODE;
                $response[MESSAGE]='Fail';
                $response[DESCRIPTION]='Some thing error occured';
                $response['menu_result']=array();
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
    //Menu details 
    public function menuDetails($id)
    {
        $response=array();
        $menu_folder=  base_url().UPLOADS.'category/menu/';
        $common_where=array('activation_status !='=>5);
        $sql=$this->db->select("id as id,title as title,priority as priority,CONCAT('".$menu_folder."',menu_icon) as icon,CONCAT('".$menu_folder."',app_icon) as appicon,CONCAT('".$menu_folder."',image) as menuimage",false)->from('menu_tbl')->where($common_where)->where('id',$id)->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?'Getting the menu details':'No results found';
        $response['menu_result']=($count > 0)?$sql->row():array();
        return json_encode($response);
    }
    /*
    |--------------------------------------------------------------------------
    | Sub Menu Details
    |--------------------------------------------------------------------------
    |*/
    //SubMenu Code
    public function subMenuList($search=NULL){
        $response=array();
        $where=array('sm.activation_status!='=>5,'m.activation_status !='=>5);
        $menu_search=$search['menu'];
        $name_search=$search['name'];
        $activation_search=$search['activation'];
        $submenu_folder=  base_url().UPLOADS.'category/submenu/';
        $case_status="sm.activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="sm.id as id,sm.title as title,sm.priority as priority,CONCAT('".$submenu_folder."',sm.icon) as icon,CONCAT('".$submenu_folder."',sm.image) as image,CONCAT('".$submenu_folder."',sm.app_icon) as appicon,sm.menu_id as menuid,m.title as menu,CASE $case_status  END as submenustatus,sm.activation_status as status";
        $this->db->select($cols,false)->from('submenu_tbl sm')
                ->join('menu_tbl m','m.id=sm.menu_id','inner')
                ->where($where);
        (!empty($menu_search))?$this->db->where('sm.menu_id',$menu_search):'';
        (!empty($name_search))?$this->db->like('sm.title',$name_search,'both'):'';
        ($activation_search!='')?$this->db->where('sm.activation_status',$activation_search):'';
                $this->db->order_by('sm.id','desc');
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code']==0) {
            try{
                $sql=  $this->db->get();
                $count=$sql->num_rows();
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
                $response['submenu_result']=($count > 0)?$sql->result():array();
                $response['statistics']=array(
                    'total'=>$this->statistics('submenu_tbl',array('activation_status !='=>5)),
                    'inactive'=>$this->statistics('submenu_tbl',array('activation_status'=>0)),
                    'active'=>$this->statistics('submenu_tbl',array('activation_status'=>1)),
                );
            } catch (Exception $ex) {
                $response[CODE]=FAIL_CODE;
                $response[MESSAGE]='Fail';
                $response[DESCRIPTION]='Some thing error occured';
                $response['submenu_result']=array();
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
    //sub menu details for update
    public function submenuDetails($id)
    {
        $response=array();
        $where=array('sm.activation_status !='=>5,'m.activation_status !='=>5,'sm.id'=>$id);
        $submenu_folder=  base_url().UPLOADS.'category/submenu/';
        $sql=$this->db->select("sm.id as id,sm.title as title,sm.priority as priority,m.title as menu,CONCAT('".$submenu_folder."',sm.icon) as icon,CONCAT('".$submenu_folder."',sm.app_icon) as appicon,CONCAT('".$submenu_folder."',sm.image) as image",false)->from('submenu_tbl sm')->join('menu_tbl m','sm.menu_id=m.id','inner')->where($where)->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?'Getting the sub menu details':'No results found';
        $response['submenu_result']=($count > 0)?$sql->row():array();
        return json_encode($response);
    }
    //List Sub Menu Code
     public function listSubMenuList($search=NULL){
        $response=array();
        $where=array('sml.activation_status !='=>5,'sm.activation_status !='=>5,'m.activation_status !='=>5);
        $lsm_path=base_url().UPLOADS.'category/listsubmenu/';
        $submenu_search=$search['submenu'];
        $name_search=$search['name'];
        $activation_search=$search['activation'];
        $case_status="sml.activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="sml.id as id,sml.title as title,sml.submenu_id as submenuid,sm.title as submenu,m.title as menu,CONCAT('".$lsm_path."',sml.icon) as icon,CONCAT('".$lsm_path."',sml.app_icon) as appicon,CONCAT('".$lsm_path."',sml.image) as image, CASE $case_status  END as listsubmenustatus,sml.activation_status as status";
        $this->db->select($cols,false)->from('listsubmenu_tbl sml')
                ->join('submenu_tbl sm','sm.id=sml.submenu_id','inner')
                ->join('menu_tbl m','m.id=sm.menu_id','inner')
                ->where($where);
        (!empty($submenu_search))?$this->db->where('sml.submenu_id',$submenu_search):'';
        (!empty($name_search))?$this->db->like('sml.title',$name_search,'both'):'';
        ($activation_search!='')?$this->db->where('sml.activation_status',$activation_search):'';
        $this->db->where($where)->order_by('sml.id','desc');
        $error = $this->db->error();
        $error_message=$error['message'];
        if($error['code']==0) {
            try{
                $sql=  $this->db->get();
                $count=$sql->num_rows();
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
                $response['listsubmenu_result']=($count > 0)?$sql->result():array();
                $response['statistics']=array(
                    'total'=>$this->statistics('listsubmenu_tbl',array('activation_status !='=>5)),
                    'inactive'=>$this->statistics('listsubmenu_tbl',array('activation_status'=>0)),
                    'active'=>$this->statistics('listsubmenu_tbl',array('activation_status'=>1)),
                );
            } catch (Exception $ex) {
                $response[CODE]=FAIL_CODE;
                $response[MESSAGE]='Fail';
                $response[DESCRIPTION]='Some thing error occured';
                $response['listsubmenu_result']=array();
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
    //getting List Sub Menu details for update
    public function getLSMDetails($updateid)
    {
        $response=array();
        $where=array('sml.activation_status !='=>5,'sm.activation_status !='=>5,'m.activation_status !='=>5,'sml.id'=>$updateid);
        $lsm_path=base_url().UPLOADS.'category/listsubmenu/';
        $sql=$this->db->select("sml.id as id,sml.title as title,sm.title as submenu,m.title as menu,CONCAT('".$lsm_path."',sml.icon) as icon,CONCAT('".$lsm_path."',sml.app_icon) as appicon,CONCAT('".$lsm_path."',sml.image) as image",false)
            ->from('listsubmenu_tbl sml')
            ->join('submenu_tbl sm','sm.id=sml.submenu_id','inner')
            ->join('menu_tbl m','m.id=sm.menu_id','inner')->where($where)->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?'Getting the list submenu details':'No results found';
        $response['lsm_result']=($count > 0)?$sql->row():array();
        return json_encode($response);
    }
    //Statistics Code 
    public function statistics($table,$where)
    {
        return $sql=$this->db ->where($where) ->count_all_results($table);
    }
}