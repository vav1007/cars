<?php
defined('BASEPATH') or die('Unable to load : MS');
/*
 * Page Name    : Admin_profile_model
 * page Type    : Model
 * Folder Path  : models/superadmin/Admin_profile_model
 * purpose      : Profile related 
 * Created By   : V.Venkateswara Achari
 * Created Date : 19-04-2018
*/
class Admin_profile_model extends CI_Model{
    
    public $admin_table;
    public function __construct() {
        parent::__construct();
        $this->admin_table='superadmin_userlist_tbl';
    }
    
    //Login authentication
    public function adminAuthenticate($array)
    {
        $response=array();
        $log_col=(is_null($array['username']))?'mobile':'email';
        $where=array(
            $log_col=>$array['username'],
            'admin_secure_code'=>$array['password'],
            'trash'=>0,
        );
        $cols='id as id,admin_profile_code as profilecode,name as name,display_name as displayname,email as email,mobile as mobile,profile_status as status,last_login_date as lastlogin,role as role,role_access as permissions,online_status as onlinestatus';
        $sql=  $this->db->select($cols)->from($this->admin_table)->where($where)->get();
        $this->db->last_query();
        $count=$sql->num_rows();
        if($count > 0)
        {
           $response[CODE]=SUCCESS_CODE;
           $response[MESSAGE]='Login Success';
           $response[DESCRIPTION]='Login success';
           $response['admin_profile_details']=$sql->row();
        }
        else
        {
            $response[CODE]=FAIL_CODE;
            $response[MESSAGE]='Fail';
            $response[DESCRIPTION]='Invalid credentials';
        }
        return json_encode($response);
    }
     //dash board statistics
    public function getDashboard()
    {
        $response=array('dashboardlist'=>array());
        $sql=$this->db->select('id as id,title as title,table_name as table,column_name as column,link as link,icon as icon,class_name as classname')->from('dashboard_tbl')->order_by('priority')->get();
        $count=$sql->num_rows();
        if($count > 0)
        {
            foreach($sql->result() as $dashboard_res)
            {
               $firstarray=array();
               $firstarray['id']=$dashboard_res->id;
               $firstarray['title']=$dashboard_res->title;
               $firstarray['tablename']=$dashboard_res->table;
               $firstarray['column']=$dashboard_res->column;
               $firstarray['link']=$dashboard_res->link;
               $firstarray['icon']=$dashboard_res->icon;
               $firstarray['classname']=$dashboard_res->classname;
               $firstarray['tabledetails']=$this->dashboardStatistics($dashboard_res->table);
               array_push($response['dashboardlist'],$firstarray);
            }
        }
        return json_encode($response);
    }
    //getting dashboard statistics
    public function dashboardStatistics($tablename)
    {
        $tabletotalsql=$this->db->select('COUNT(id) as totalcount')->from($tablename)->get();
        $tableactivesql=$this->db->select('COUNT(id) as activecount')->from($tablename)->where('activation_status',1)->get();
        $tableinactivesql=$this->db->select('COUNT(id) as inactivecount')->from($tablename)->where('activation_status',0)->get();
       // $total=$tabletotalsql->row()->totalcount;
        //$active=$tableactivesql->row()->activecount;
        //$inactive=$tableinactivesql->row()->inactivecount;
        $statistics=array(
            'total'=>0,
            'active'=>0,
            'inactive'=>0,
            );
        return $statistics;
    }
    //getting the list of admin bank account details
    public function bankAccountList($search)
    {
            $response=array();
            $name_search=$search['name'];
            $activation_search=$search['activation'];
            $case_status="activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
             $this->db->select("id as id,bank_name as bankname,account_number as accountnumber, ifsc_code as ifsccode,account_type as accounttype,branch as branch,address as address,city as city,CASE $case_status  END as status_message,activation_status as status,")
                    ->from('admin_bankdetails_tbl',false);
             if(!empty($name_search))
            {
                 $this->db->like('account_number',$name_search,'both');
                 $this->db->or_like('ifsc_code',$name_search,'both');
                 $this->db->or_like('city',$name_search,'both');
             }
            ($activation_search!='')?$this->db->where('activation_status',$activation_search):'';
            $sql=  $this->db->order_by('id','desc')->get();
            $db_error=  $this->db->error();
            $db_error_msg=$db_error['message'];
            if($db_error['code']==0)
            {
                    $count=$sql->num_rows();
                    $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                    $response[MESSAGE]=($count > 0)?'Success':'Failed';
                    $response[DESCRIPTION]=($count > 0)?$count. ' results found':'No results found';
                    $response['bank_result']=($count > 0)?$sql->result():array();
                    $table_name='admin_bankdetails_tbl';
                    $response['statistics']=array(
                                    'currentcount'=>$count,
                                    'total'=>$this->Crud->statistics($table_name,array()),
                                    'inactive'=>$this->Crud->statistics($table_name,array('activation_status'=>0)),
                                    'active'=>$this->Crud->statistics($table_name,array('activation_status'=>1)),
                            );
            }
            else
            {
                    $response[CODE]=DB_ERROR_CODE;
                    $response[MESSAGE]='Database error';
                    $response[DESCRIPTION]=$db_error_msg .' has been occured';
            }
            return json_encode($response);
    }
    //bank Account details based on id
    public function bankAccountDetails($id)
    {
            $response=array();
            if(num_check($id))
            {
                   $sql=  $this->db->select('id as id,admin_id as adminid,bank_name as bankname,account_number as accountnumber,ifsc_code as ifsccode,account_type as accounttype,branch as branch,address as address,city as city')
                          ->from('admin_bankdetails_tbl')->where('id',$id)->get();
                   $count=$sql->num_rows();
                   $db_error=  $this->db->error();
                   $db_error_msg=$db_error['message'];
                   if($db_error['code']==0)
                   {
                       $count=$sql->num_rows();
                       $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                       $response[MESSAGE]=($count > 0)?'Success':'Fail';
                       $response[DESCRIPTION]=($count > 0)?'Getting the bank account details':'No results found';
                       $response['bank_result']=($count > 0)?$sql->row():array();
                   }
                   else
                   {
                        $response[CODE]=DB_ERROR_CODE;
                        $response[MESSAGE]='Db error';
                        $response[DESCRIPTION]=$db_error_msg.' occured';
                   }
            }
            else
            {
                   $response[CODE]=VALIDATION_CODE;
                   $response[MESSAGE]='Validation';
                   $response[DESCRIPTION]='Invalid account number';
            }
            return json_encode($response);
    }
}