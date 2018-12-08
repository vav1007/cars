<?php
defined('BASEPATH') OR exit('Some thing error occured while M_CR');
/*
 * Page Name    : Crud
 * page Type    : Model
 * Folder Path  : models/Welcome.php
 * purpose      : Writing common Crud related queries 
 * Created By   : V.Venkateswara Achari
 * Created Date : 08-03-2016
 */

class Crud extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->cartsession=$this->session->userdata('cartsession');
        if(!isset($this->cartsession) && empty($this->cartsession))
        {
            $set_new_session=md5(CS_EXT.time().rand(3,99999));
            $this->session->set_userdata('cartsession',$set_new_session);
            $this->cartsession=$set_new_session;
        }
    }

    /*
      |--------------------------------------------------------------------------
      | Function : check(column,tablename,wherecondition)
      |--------------------------------------------------------------------------
      |  column          :  Search ID (Single column name)
      |  tablename      :  table name
      |  wherecondition :  colmnname => inputdata (wherecondition should be in array format)
      |  Example        :  commonCheck('ID','table_name',array('colmn'=>'abcd','colmn2'=>'abcd'));
      |  Result         :   It will return 0 or 1.(If count exists it will return 1 other wise it will return as 0)
     */

    public function commonCheck($cols, $table, $wherecondition) {
        $count = $this->db->select($cols)->from($table)->where($wherecondition)->get()->num_rows();
        return ($count > 0) ? 1 : 0;
    }

    /*
      |--------------------------------------------------------------------------
      | Function : commonInsert(table,insertdata,displaymessage,debug)
      |--------------------------------------------------------------------------
      |  tablename      :  table name
      |  insertdata     :  It is the combination of table column name with input data. & it should be in array format only
      |  Example        :  commonInsert('table',array('col'=>data,'col1'=>'data1'),'Added Successfully','');
      |  debug          :  debug column !='' & its value equal to 'debug' then it will show the query & will not execute the query
      |  Result         :  It will return data in json format with parameteres
      |  Returened Params: array('code'=>'','message'=>'','desc'=>'','inserted_id'=>'',)
     */

    public function commonInsert($table, $insertdata, $displaymessage = NULL, $debug = NULL) {
        $response = array();
        //$sql_show= $this->db->set($insertdata)->get_compiled_insert($table);
        if (is_array($insertdata)) {
            $sql = $this->db->insert_string($table, $insertdata);
            if (isset($debug) && $debug == 'debug') {
                $response[QUERY_MESSAGE] = $sql;
            } else {
                $insert = $this->db->query($sql);
                $error = $this->db->error();
                $error_message = $error['message'];
                if ($error['code'] == 0) {
                    try {
                        if ($insert) {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $displaymessage;
                            $response[INSERTED_ID] = $this->db->insert_id();
                        } else {
                            throw new Exception('Error occured while inserting data');
                        }
                    } catch (Exception $ex) {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = 'Some thing error occured';
                    }
                } else {
                    $response[CODE] = DB_ERROR_CODE;
                    $response[MESSAGE] = 'Databse Error';
                    $response[DESCRIPTION] = $error_message;
                }
                if (QUERY_DEBUG == 1) {
                    $response[QUERY_DEBUG_MESSAGE] = $error_message;
                    $response[QUERY_MESSAGE] = $sql;
                }
            }
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
        }
        return json_encode($response);
    }

    /*
      |--------------------------------------------------------------------------
      | Function : commonUpdate(table,updatedata,updatecondtion,displaymessage,debug)
      |--------------------------------------------------------------------------
      |
     */

    public function commonUpdate($table, $update_data, $update_condition, $displaymessage = NULL, $debug = NULL) {
        $response = array();
        if (is_array($update_data) && is_array($update_condition)) {
            $sql = $this->db->update_string($table, $update_data, $update_condition);
            if (isset($debug) && $debug == 'debug') {
                $response[QUERY_MESSAGE] = $sql;
            } else {
                $update = $this->db->query($sql);
                $error = $this->db->error();
                $error_message = $error['message'];
                if ($error['code'] == 0) {
                    try {
                        $count = $this->db->affected_rows();
                        if ($count > 0) {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $displaymessage;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] = 'Data not updated';
                        }
                    } catch (Exception $ex) {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = 'Some thing error occured';
                    }
                } else {
                    $response[CODE] = DB_ERROR_CODE;
                    $response[MESSAGE] = 'Database Error';
                    $response[DESCRIPTION] = $error_message;
                }
                if (QUERY_DEBUG == 1) {
                    $response[QUERY_DEBUG_MESSAGE] = $error_message;
                    $response[QUERY_MESSAGE] = $sql;
                }
            }
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
        }
        return json_encode($response);
    }

    /*
      |--------------------------------------------------------------------------
      | Function : commonStatusUpdate(table,updatedata,updatecondtion,displaymessage,debug)
      |--------------------------------------------------------------------------
      |
     */

    public function commonStatusUpdate($table, $update_data, $update_condition, $input_status, $debug = NULL) {
        $response = array();
        if (is_array($update_data)) {
            $sql = $this->db->update_string($table, $update_data, $update_condition);
            if (isset($debug) && $debug == 'debug') {
                $response[QUERY_MESSAGE] = $sql;
            } else {
                $update = $this->db->query($sql);
                $error = $this->db->error();
                $error_message = $error['message'];
                if ($error['code'] == 0) {
                    try {
                        $count = $this->db->affected_rows();
                        if ($count > 0) {
                            $status_message='';
                            switch ($input_status){
                                case 0:$status_message='De-Activated';break;
                                case 1:$status_message='Activated';break;
                                case 5:$status_message='Deleted';break;
                            }
                            $activation_message = $status_message;
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $count . " results $activation_message successfully";
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] = 'Data not modified';
                        }
                    } catch (Exception $ex) {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = 'Some thing error occured';
                    }
                } else {
                    $response[CODE] = DB_ERROR_CODE;
                    $response[MESSAGE] = 'Database Error';
                    $response[DESCRIPTION] = $error_message;
                }
                if (QUERY_DEBUG == 1) {
                    $response[QUERY_DEBUG_MESSAGE] = $error_message;
                    $response[QUERY_MESSAGE] = $sql;
                }
            }
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
        }
        return json_encode($response);
    }
     //Multiple  Insert
    public function batchInsert($table,$insertdata,$displaymessage=NULL)
    {
        $response=array();
        $sql=$this->db->insert_batch($table,$insertdata);
        $affected_rows=$this->db->affected_rows();
        $response[CODE]=($affected_rows > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($affected_rows > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($affected_rows > 0)?"$affected_rows  records added successfully":'No results found';
        return json_encode($response);
    }
      //Statistics Code 
    public function statistics($table,$where)
    {
        return $sql=$this->db ->where($where) ->count_all_results($table);
    }
    //Check & return based
    public function checkAndReturn($colname,$table,$checkdatawith)
    {
        /*It will return the Single value Only*/
        $check=$this->db->select($colname)->from($table)->where($checkdatawith)->get();
        $count=$check->num_rows();
        return ($count > 0)?$check->row()->$colname:0;
    }
     //Delete
    public function commonDelete($table,$condition,$relationname)
    {
        $response=array();
        $sql=$this->db->delete($table,$condition);
        $delete=$this->db->affected_rows();
        $response[CODE]=($delete > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($delete > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($delete > 0)?"<b>$relationname</b> Deleted successfully":'Unable to delete';
        return json_encode($response);
    }

    public function duplicationCheck($params)
    {
        $returnData='';
        $table =  $params['table'];
        $cols=  $params['column'];
        $where =  $params['condition'];
        $sql = $this->db->Select($cols)->from($table)->where($where)->get();
        //echo $this->db->last_query();exit;
        $dbError = $this->db->error();
        if($dbError['code']==0)
        {
            $returnData = ($sql->num_rows() > 0)?1:0;
        }
        return $returnData;
    }
}
