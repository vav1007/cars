<?php
defined('BASEPATH') or die('Error occured while loading the Categories');
/*
 * Page Name        :    Other_model
 * page Type          :    Model
 * Folder Path         :   model/superadmin/Other_model
 * purpose              :    Other (artist,)
 * Created By         :    V.Venkateswara Achari
 * Created Date      :      25-03-2018
 */
class Other_model extends CI_Model{
    
      public function artistList($search=NULL){
        $response=array();
        $table_name='artist_tbl';
        $table_name=trim($table_name);
        $where=array('activation_status !='=>5);
         $name_search=$search['name'];
        $activation_search=$search['activation'];
        $case_status="activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="id as id,name as name,email as email,mobile as mobile,city as city,address as address,profile_picture as profilepic,"
                . "CASE $case_status  END as status_message,created_role as createdrole,activation_status as status";
        $this->db->select($cols,false)->from($table_name);
        $this->db->where($where);
        (!empty($name_search))?$this->db->like('name',$name_search,'both'):'';
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
                $response['artist_result']=($count > 0)?$sql->result():array();
                $response['statistics']=array(
                    'currentcount'=>$count,
                    'total'=>$this->Crud->statistics($table_name,array()),
                    'inactive'=>$this->Crud->statistics($table_name,array('activation_status'=>0)),
                    'active'=>$this->Crud->statistics($table_name,array('activation_status'=>1)),
                );
            } catch (Exception $ex) {
                $response[CODE]=FAIL_CODE;
                $response[MESSAGE]='Fail';
                $response[DESCRIPTION]='Some thing error occured';
                $response['artist_result']=array();
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
    //show list for view page
    public function showList($search=NULL)
    {
        $response=array();
        $table_name='shows_tbl';
        $table_name=trim($table_name);
        $where=array('activation_status !='=>5);
        $name_search=$search['name'];
        $activation_search=$search['activation'];
        $fromdate_search=(!empty($search['fromdate']))?date('Y-m-d',strtotime($search['fromdate'])):'';
        $todate_search=(!empty($search['todate']))?date('Y-m-d',strtotime($search['todate'])):'';
        $case_status="activation_status WHEN 0 THEN 'In-active' WHEN 1 THEN 'Active'";
        $cols="id as id,title as name,artists_list as artists,DATE_FORMAT(startdate,'%b %d %Y %h:%i %p') as startdate,DATE_FORMAT(enddate,'%b %d %Y %h:%i %p') as enddate,description as description,venue as address,CASE $case_status  END as status_message,activation_status as status";
        $this->db->select($cols,false)->from($table_name);
        $this->db->where($where);
        (!empty($name_search))?$this->db->like('title',$name_search,'both'):'';
        (!empty($fromdate_search) && !empty($todate_search))?$this->db->where('DATE(startdate) >=', $fromdate_search)->where('DATE(enddate) <=',$todate_search):'';
        ($activation_search!='')?$this->db->where('activation_status',$activation_search):'';
                 $this->db->order_by('id','desc');
                 
       $sql=  $this->db->get();
       //print_r($this->db->last_query());
       $error= $this->db->error();
       if($error['code']==0)
       {
            $count=$sql->num_rows();
            $response[CODE]=SUCCESS_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
            $response['shows_result']=($count > 0)?$sql->result():array();
            $response['statistics']=array(
                'currentcount'=>$count,
                'total'=>$this->Crud->statistics($table_name,array('activation_status !='=>5)),
                'inactive'=>$this->Crud->statistics($table_name,array('activation_status'=>0)),
                'active'=>$this->Crud->statistics($table_name,array('activation_status'=>1)),
            );
       }  
       else
       {
            $error_message=$error['message'];
            $response[CODE]=DB_ERROR_CODE;
            $response[MESSAGE]='Database error';
            $response[DESCRIPTION]=$error_message;
       }  
       return json_encode($response);
    }
    //Getting the Show Details based on show id
    public function showDetails($showid)
    {
        $response=array();
        $imagepath=base_url().UPLOADS.'shows/';
        $sql=  $this->db->select("id as id,title as title,artists_list as artists,startdate as showstartdate,enddate as showenddate,description as description,venue as venue,CONCAT('".$imagepath."',image) as showimage",false)
                ->from('shows_tbl')->where('id',$showid)->get();
        $db_error=  $this->db->error();
        $db_error_message=$db_error['message'];
        if($db_error['code']==0)
        {
            $count=$sql->num_rows();
            $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE]=($count > 0)?'Success':'Fail';
            $response[DESCRIPTION]=($count > 0)?'Getting the Show details':'No records found';
            $response['show_result']=($count > 0)?$sql->row():array();
        }
        else
        {
             $response[CODE]=DB_ERROR_CODE;
             $response[MESSAGE]='Database error';
             $response[DESCRIPTION]=$db_error_message. ' occured';
        }
        return json_encode($response);
    }
    //getting artist details for update
    public function getArtistsList($updateid)
    {
        $response=array();
        $pathname=base_url().UPLOADS.'artist/profilepic/';
        $sql=$this->db->select("id as id,name as name,email as email,mobile as mobile,city as city,address as address,description as description,CONCAT('".$pathname."',profile_picture) as profilepic",false)->from('artist_tbl')->where('id',$updateid)->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
        $response['artist_result']=($count > 0)?$sql->row():(object) null;
        return json_encode($response);
    }
    //getting show, artists for representations page
    public function getShowArtistsDetails($showid)
    {
        $response=array('artistarray'=>array());
        $sql=$this->db->select('id as id,artists_list as artists,')->from('shows_tbl')
        ->where('id',$showid)->get();
        $a_count=$sql->num_rows();
        $art_list_ids=$sql->row()->artists;
        $art_qry=$this->db->select('a.id as artistid,a.name as artistname')
            ->from('artist_tbl a')
            ->where_in('a.id',explode(",",$art_list_ids))->get();
        $upload_qry=$this->db->select('GROUP_CONCAT(DISTINCT(artist_id)) as uplded_artist')->from('show_artist_details_tbl')->where('show_id',$showid)->get();
        $upl_art_list_ids=$upload_qry->row()->uplded_artist;
        //print_r($this->db->last_query());
        $up_count=$upload_qry->num_rows();
        $count=$art_qry->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
        $response['artist_result']=($count > 0)?$art_qry->result():(object) null;
        $response['upload_result']=($up_count > 0)?$upl_art_list_ids:(object) null;
        return json_encode($response);
    }
    //listing artists works details
    public function getArtistsWorksDetails($show_id,$artist_id)
    {
        $response=array();
        $where=array(
            'show_id'=>$show_id,
            'artist_id'=>$artist_id,
            );
        $image_path=base_url().'uploads/artist/works/';
        $sql=$this->db->select("id as id,CONCAT('".$image_path."',image) as workimages,description as description,title as title,size as size,medium as medium",false)
                    ->from('show_artist_details_tbl')->where($where)->get();
        $count=$sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($count > 0)?'Total '.$count.' results found':'NO results found';
        $response['works_result']=($count > 0)?$sql->result():(object) null;
        return json_encode($response);
    }

/*
10-06-2017 code start
*/
public function getArtistPaints($artistid){
    $response=array();
     $product_path=  base_url().UPLOADS.'products/';
     $where =  array('artist_id'=>$artistid);
    $sql= $this->db->select("id as paint_id,artist_id as artist_id,show_price as show_price,art_display_type as paint_assign_to,product_name as productname,product_code as product_code,CONCAT('".$product_path."',product_image) as product_image",false)
    ->from('product_tbl')->where_in('art_display_type',array(2,3))->where($where)
    ->order_by('id','desc')->get();
    $db_error =  $this->db->error();
    if($db_error['code']==0)
    {
        $count =  $sql->num_rows();
        $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count > 0 )?'Succcess':'Fail';
        $response[DESCRIPTION]=($count > 0 )?'Getting the artist based paint list':'No paints are assigned';
        $response['paint_result']= ($count > 0)?$sql->result():array();
    }
    else
    {
        $response[CODE]=DB_ERROR_CODE;
        $response[MESSAGE]='DB Error';
        $response[DESCRIPTION]='Internal server error'.$db_error['message'];
    }
    return json_encode($response);
}

}