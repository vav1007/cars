<?php
defined('BASEPATH') or die('Unable to load : SSM');
/*
 * Page Name  : Order_model 
 * page Type    : Model
 * Folder Path  : models/superadmin/Order_model
 * purpose        : Orders List
 * Created By   : V.Venkateswara Achari
 * Created Date : 12-04-2018
*/
class Order_model extends CI_Model
{
    
    public function orderList($search)
    {
            $response=array();
            $table_name='order_tbl';
            $where=array('payment_status'=>1);
            /*search code*/
            $name_search=$search['name'];
            $activation_search=$search['activation'];
            /*search code end*/
            $this->db->select("id as id,order_number as ord_number,order_qty as qty,payment_selection_type as paymenttype,DATE_FORMAT(order_created_date,'%b %d %Y %h:%i %p') as createddate,order_status as status,payment_status as paymentstatus,order_payment_type as order_paytype,order_total_price as totalprice,user_name as username,email as useremail,mobile as usermobile,address as address,landmark as landmark,city as city,state as state,country as country,pincode as pincode")->from($table_name)->where($where);
            (!empty($name_search) && isset($name_search))?$this->db->where('order_number',$name_search):'';
            ($activation_search!='')?$this->db->where('order_status',$activation_search):'';
            if(!empty($search['fromdate']) && !empty($search['todate']))
            {
                $fromdate_search=date('Y-m-d', strtotime($search['fromdate']));
                $todate_search=date('Y-m-d', strtotime($search['todate']));
                $date_where="order_created_date BETWEEN '".$fromdate_search."' AND '".$todate_search."'";
                $this->db->where($date_where);
            }
            $sql=$this->db->order_by('id','DESC')->get();
            //print_r($this->db->last_query());
            $db_error=  $this->db->error();
            $db_error_message=$db_error['message'];
            if($db_error['code']==0)
            {
                $count=$sql->num_rows();
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
                $response['order_result']=($count > 0)?$sql->result():array();
                $response['statistics']=array(
                    'currentcount'=>$count,
                    'total'=>$this->Crud->statistics($table_name,array()),
                    'placed'=>$this->Crud->statistics($table_name,array('order_status'=>0)),
                    'approved'=>$this->Crud->statistics($table_name,array('order_status'=>1)),
                    'dispatched'=>$this->Crud->statistics($table_name,array('order_status'=>2)),
                    'cancelled'=>$this->Crud->statistics($table_name,array('order_status'=>3)),
                    'returned'=>$this->Crud->statistics($table_name,array('order_status'=>4)),
                );
            }
            else
            {
                $response[CODE]=DB_ERROR_CODE;
                $response[MESSAGE]='Database error';
                $response[DESCRIPTION]= $db_error_message.' error occured';
            }
            return json_encode($response);
    }
    //enquired person's list
    public function enquiryList($search)
    {
        $response=array();
            $table_name='product_enquiry_tbl';
            $name_search=$search['name'];
            $date_search=$search['date'];
            $image_path=base_url().UPLOADS."products/";
            $this->db->select("p.product_name as pro_name,p.product_code as pro_code,p.product_sku_code as pro_skucode,CONCAT('".$image_path."',product_image) as pro_image,e.id as id,e.name as name,e.email as email,e.mobile as mobile,e.message as message,DATE_FORMAT(e.created_date,'%b %d %Y %h:%i %p') as do_enq",false)->from($table_name.' e')
            ->join('product_tbl p','e.product_id=p.id','inner');
            if(!empty($name_search))
            {
                if(num_check($name_search)){
                $this->db->like('e.mobile',$name_search,'both');
                }else{$this->db->like('e.email',$name_search,'both');$this->db->or_where('p.product_code',$name_search);}
            }
            if(!empty($date_search))
            {
               $date_where=array(
                'date(e.created_date)'=>date('Y-m-d', strtotime($date_search)),
                );
               $this->db->where($date_where);
            }
            $sql= $this->db->order_by('id','DESC')->get();
            //print_r($this->db->last_query());
            $db_error=  $this->db->error();
            $db_error_message=$db_error['message'];
            if($db_error['code']==0)
            {
                $count=$sql->num_rows();
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]=($count > 0)?'Success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
                $response['enq_result']=($count > 0)?$sql->result():array();
                $response['statistics']=array(
                    'currentcount'=>$count,
                    'total'=>$this->Crud->statistics($table_name,array()),
                );
            }
            else
            {
                $response[CODE]=DB_ERROR_CODE;
                $response[MESSAGE]='Database error';
                $response[DESCRIPTION]= $db_error_message.' error occured';
            }
            return json_encode($response);
    }
    
    public function enquiryCommentList($enq_id){
                $response=array();
                $sql=  $this->db->select('id as id,enq_id as enq_id,enq_comment as enq_comment,created_date as created_date')
                        ->from('enquiry_comment_tbl')->where('enq_id',$enq_id)->order_by('id','desc')->get();
                $count=$sql->num_rows();
                $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                $response[MESSAGE]=($count > 0)?'success':'Fail';
                $response[DESCRIPTION]=($count > 0)?'Getting the comment list':'No results found';
                $response['comment_result']=($count > 0)?$sql->result():array();
                return json_encode($response);
    }
}