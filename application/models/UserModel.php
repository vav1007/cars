<?php 
defined('BASEPATH') or die('Some thing error occured');
class UserModel extends CI_Model{
    
    public $user_tbl,$address_tbl;
    public function __construct()
    {
        parent::__construct();
        $this->user_tbl='users_info';
        $this->address_tbl='user_address';
    }

    //Create New User
    public function createUser($params)
    {
        $response=[CODE=>VALIDATION_CODE,MESSAGE=>'Invalid format'];
        if(is_array($params))
        {
            $username = $params['username'];
            $email = $params['email'];
            $mobile = $params['mobile'];
            $password = $params['password'];
            $app = $params['app_type'];
            /*>> Checking duplication section code statrt */
            $duplication_email = $this->Crud->duplicationCheck([
                'table'=>$this->user_tbl,
                'column'=>'user_id',
                'condition'=>['email_id'=>$email]
            ]);
            $duplication_mobile = $this->Crud->duplicationCheck([
                'table'=>$this->user_tbl,
                'column'=>'user_id',
                'condition'=>['mobile_number'=>$mobile]
            ]);
            /*>> Checking duplication section code end */
            if($duplication_email == 1 || $duplication_mobile == 1)
            {
                    $duplication_msg='';
                    $duplication_msg.=($duplication_email==1)?$email .',':'';
                    $duplication_msg.=($duplication_mobile==1)?$mobile .',':'';
                    $duplication_msg = rtrim($duplication_msg,',');
                    $response[CODE] = FAIL_CODE;
                    $response[MESSAGE] = 'Exists';
                    $response[DESCRIPTION] =$duplication_msg .' account already exists';
            }
            else
            {
                    $verification_code= substr($mobile, 9, 10) . mt_rand(1000, 99999);
                    $userInsertData=[
                                        'user_authtoken'=>sha1(substr($email, 0, 6) . substr($mobile, 8, 10) . time()),
                                        'user_name'=>fetch_ucwords($username),
                                        'email_id'=>$email,
                                        'mobile_number'=>$mobile,
                                        'user_security_code'=> hash("SHA256", $password . $this->config->item('salt'), false),
                                        'verification_code'=>$verification_code,
                                        'created_on'=>DATE,
                                        'register_app'=>strtolower($app),
                                    ];
                    $userInsertSql= $this->db->insert_string($this->user_tbl,$userInsertData);
                    $userInsertString = $this->db->query($userInsertSql);
                    $userInsertStatus = $this->db->affected_rows();
                    $response[CODE] = ($userInsertStatus > 0)?SUCCESS_CODE:FAIL_CODE;
                    $response[MESSAGE] =($userInsertStatus > 0)?'success':'fail';
                    $response[DESCRIPTION] =($userInsertStatus > 0)?'Account created successfully.Please verify the email to continue':'Some thing went wrong in the time of account creation.Please try again later.';
                    $userReturnData=[];
                    if($userInsertStatus > 0)
                    {
                        $userReturnData=[
                            'username'=>$username,
                            'email'=>$email,
                            'mobile'=>$mobile,
                            'email_verification_link'=>$verification_code,
                            'mobile_verification_code'=>$verification_code,
                        ];
                    }
                    $response['user_response']=$userReturnData;
            }
        }
        return json_encode($response);
    }
    
    //Resend Verification Link
    public function resendVerificationLink($params)
    {

    }

    //verify account of  New User    
    public function newUserAccountVerification($params)
    {
        $response=[CODE=>VALIDATION_CODE,MESSAGE=>'Invalid format'];
        if(is_array($params))
        {
            $verification_code = $params['verification_code'];
            $updateData = ['verification_code'=>'','profile_status'=>1];
            $updateWhere =  ['verification_code'=>$verification_code];
            $verificationSql = $this->db->update_string($this->user_tbl,$updateData,$updateWhere);
            $verification = $this->db->query($verificationSql);
            $verificationStatus = $this->db->affected_rows();
            $response[CODE] = ($verificationStatus > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE] =($verificationStatus > 0)?'success':'fail';
            $response[DESCRIPTION] =($verificationStatus > 0)?'Account verified successfully. Please login to continue':'Invalid verification code or verification code may expired';
        }
        return json_encode($response);
    }

    //User Login
    public function userLogin($params)
    {
        $username = $params['username'];
        $password = $params['password'];
        $enc_password =  hash("SHA256", $password . $this->config->item('salt'), false);
        $app = $params['app'];
        $this->db->select('user_id as userid,user_authtoken as user_id,user_name as user_name,email_id as email,mobile_number as mobile,	profile_status as  	profile_status');
        $this->db->from($this->user_tbl);
        $this->db->where('user_security_code',$enc_password);
        $this->db->group_start();
        $this->db->where('email_id',$username);
        $this->db->or_where('mobile_number',$username);
        $this->db->group_end();
        $sql  = $this->db->limit(1)->get();
        //echo $this->db->last_query();exit;  
        $dbError = $this->db->error();
        if($dbError['code']!=0)
        {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] =' Some thing error occured. Please inform to suppot team';
            //Send email of exception pening..
        }
        else
        {
                $count = $sql->num_rows();
                $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                $response[MESSAGE]=($count > 0)?'success':'fail';
                $response[DESCRIPTION]=($count > 0)?'Account login success':'Invalid login details';
                $response['user_details']=($count > 0)?$sql->row():(object)(null);
        }
        return json_encode($response);
    }

    //Forgot password req
    public function forgotPasswordReq($params)
    {
        $response=[];
        $username = $params['username'];
        $this->db->select('user_id,user_name as username,email_id as email,mobile_number as mobile')->from($this->user_tbl);
        $this->db->group_start();
        $this->db->where('email_id',$username);
        $this->db->or_where('mobile_number',$username);
        $this->db->group_end();
        $sql  = $this->db->limit(1)->get();
        $dbError = $this->db->error();
        if($dbError['code']!=0)
        {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] =' Some thing error occured. Please inform to suppot team';
            //Send email of exception pening..
        }
        else
        {
                $count = $sql->num_rows();
                if(!number_check($count))
                {
                    $response[CODE] = FAIL_CODE;
                    $response[MESSAGE] = 'Fail';
                    $response[DESCRIPTION] ='With this '.$username.'  no account details found.';
                }
                elseif(number_check($count))
                {
                    
                    $userId= $sql->row()->user_id;
                    $verification_code=$userId. mt_rand(1000, 99999);
                    $updateData = ['forgot_verification_code'=>$verification_code,'profile_status'=>4];
                    $updateWhere =  ['user_id'=>$userId];
                    $reqSql = $this->db->update_string($this->user_tbl,$updateData,$updateWhere);
                    $req_res = $this->db->query($reqSql);
                    $reqStatus = $this->db->affected_rows();
                    $response[CODE] = ($reqStatus > 0)?SUCCESS_CODE:FAIL_CODE;
                    $response[MESSAGE] =($reqStatus > 0)?'success':'fail';
                    $response[DESCRIPTION] =($reqStatus > 0)?'success':'Some thing error occured in the process. Please try it later';
                    $response['user_details']=($reqStatus > 0)?$sql->row():(object)(null);
                    $response['verification_code']=$verification_code;
                }
        }
        return json_encode($response);
    }

    //Reset password
    public function setUserForgotPassword($params)
    {
        $response=[CODE=>VALIDATION_CODE,MESSAGE=>'Invalid format'];
        if(is_array($params))
        {
            $verification_code = $params['verification_code'];
            $password = $params['password'];
            $enc_password =  hash("SHA256", $password . $this->config->item('salt'), false);
            $updateData = ['forgot_verification_code'=>'','profile_status'=>1,'user_security_code'=>$enc_password];
            $updateWhere =  ['forgot_verification_code'=>$verification_code];
            $verificationSql = $this->db->update_string($this->user_tbl,$updateData,$updateWhere);
            $verification = $this->db->query($verificationSql);
            $verificationStatus = $this->db->affected_rows();
            $response[CODE] = ($verificationStatus > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE] =($verificationStatus > 0)?'success':'fail';
            $response[DESCRIPTION] =($verificationStatus > 0)?'Password changed successfully':'Invalid verification code or verification code may expired';
        }
        return json_encode($response);
    }

    //change password 
    public function updatePassword($params)
    {
        $response=[CODE=>VALIDATION_CODE,MESSAGE=>'Invalid format'];
        if(is_array($params))
        {
            $userid = $params['userid'];
            $password = $params['password'];
            $oldPassword = $params['old_password'];
            $enc_password =  hash("SHA256", $password . $this->config->item('salt'), false);
            $enc_old_password =  hash("SHA256", $oldPassword . $this->config->item('salt'), false);
            $updateData = ['user_security_code'=>$enc_password];
            $updateWhere =  ['user_authtoken'=>$userid,'user_security_code'=>$enc_old_password];
            $updateSql = $this->db->update_string($this->user_tbl,$updateData,$updateWhere);
            $changePasswordQry = $this->db->query($updateSql);
            $updatationStatus = $this->db->affected_rows();
            $response[CODE] = ($updatationStatus > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE] =($updatationStatus > 0)?'success':'fail';
            $response[DESCRIPTION] =($updatationStatus > 0)?'Password changed successfully':'Old password current password not matched';
        }
        return json_encode($response);
    }

      //profile Details
      public function profileDetails($params)
      {
            $response=[];
            $userid = $params['userid'];
            $where=['user_authtoken'=>$userid];
            $cols = "user_authtoken as userid,user_name as username,email_id as email,mobile_number as mobile,address as address,landmark as landmark,area as area,city as city,state as state,country as country,pincode as pincode,";
            $cols.="proifile_picutre as user_pic,about_profile as profile_details";
            $this->db->select($cols)->from($this->user_tbl)->where($where);
            $sql = $this->db->limit(1)->get();
            $dbError = $this->db->error();
            if($dbError['code']!=0)
            {
                $response[CODE] = FAIL_CODE;
                $response[MESSAGE] = 'Fail';
                $response[DESCRIPTION] =' Some thing error occured. Please inform to suppot team';
                $response['user_details']=(object)(null);
                //Send email of exception pening..
            }
            else
            {
                $count = $sql->num_rows();
                $response[CODE] = ($count > 0)?SUCCESS_CODE:FAIL_CODE;
                $response[MESSAGE] =($count > 0)?'success':'fail';
                $response[DESCRIPTION] =($count > 0)?'Getting profile details   ':'No user details found';
                $response['user_details']=($count > 0)?$sql->row():(object)(null);
            }
            return json_encode($response);   
      }

    //profile update
    public function updateProfile($params)
    {
        $response=[CODE=>VALIDATION_CODE,MESSAGE=>'Invalid format'];
        if(is_array($params))
        {
            $userid = $params['userid'];
            $username = $params['username'];
            $address = $params['address'];
            $landmark = $params['landmark'];
            $area = $params['area'];
            $city = $params['city'];
            $state = $params['state'];
            $country = $params['country'];
            $pincode = $params['pincode'];

          
            $updateData = [
                'user_name'=>$username,
                'address'=>$address,
                'landmark'=>$landmark,
                'area'=>$area,
                'city'=>$city,
                'state'=>$state,
                'country'=>$country,
                'pincode'=>$pincode,
                'last_login_date'=>DATE,
            ];
            $updateWhere =  ['user_authtoken'=>$userid];
            $updateSql = $this->db->update_string($this->user_tbl,$updateData,$updateWhere);
            $updateProfile = $this->db->query($updateSql);
            $updatationStatus = $this->db->affected_rows();
            $response[CODE] = ($updatationStatus > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE] =($updatationStatus > 0)?'success':'fail';
            $response[DESCRIPTION] =($updatationStatus > 0)?'Profile details updated successfully':'Unable to update the data.';
        }
        return json_encode($response);
    }

    //create New address
    public function createNewAddress($params)
    {
        $response=[CODE=>VALIDATION_CODE,MESSAGE=>'Invalid format'];
        if(is_array($params))
        {
            $userid = $params['userid'];
            $username = $params['username'];
            $address = $params['address'];
            $landmark = $params['landmark'];
            $area = $params['area'];
            $city = $params['city'];
            $state = $params['state'];
            $country = $params['country'];
            $pincode = $params['pincode'];

          
            $insertData = [
                                'address_auth_token'=>sha1($userid.mt_rand(00000,9999).time()),
                                'user_id'=>$userid,
                                'user_name'=>$username,
                                'address'=>$address,
                                'landmark'=>$landmark,
                                'area'=>$area,
                                'city'=>$city,
                                'state'=>$state,
                                'country'=>$country,
                                'pincode'=>$pincode,
                                'created_on'=>DATE,
                            ];
            $insertSql = $this->db->insert_string($this->address_tbl,$insertData);
            $insertProfile = $this->db->query($insertSql);
            $insertionStatus = $this->db->affected_rows();
            $response[CODE] = ($insertionStatus > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE] =($insertionStatus > 0)?'success':'fail';
            $response[DESCRIPTION] =($insertionStatus > 0)?'Address added successfully':'Some thing error occured while inserting address';
        }
        return json_encode($response);
    }

    //User related address list
    public function addressBookList($params)
    {
            $response=[];
            $userid = $params['userid'];
            $where=['user_id'=>$userid,'trash_status'=>0];
            $cols = "address_auth_token as address_id,user_id as user_id,user_name as username,mobile as mobile,address as address,landmark as landmark,area as area,city as city,";
            $cols.="state as state,country as country,pincode as pincode,created_on as created_on,flag_status as address_status";
            $this->db->select($cols)->from($this->address_tbl)->where($where);
            $sql = $this->db->get();
            $dbError = $this->db->error();
            if($dbError['code']!=0)
            {
                $response[CODE] = FAIL_CODE;
                $response[MESSAGE] = 'Fail';
                $response[DESCRIPTION] =' Some thing error occured. Please inform to suppot team';
                $response['result_count']=0;
                $response['address_result']=[];
                //Send email of exception pening..
            }
            else
            {
                $count = $sql->num_rows();
                $response[CODE] = ($count > 0)?SUCCESS_CODE:FAIL_CODE;
                $response[MESSAGE] =($count > 0)?'success':'fail';
                $response[DESCRIPTION] =($count > 0)?'Getting profile address list   ':'No address list found';
                $response['result_count']=$count;
                $response['address_result']=($count > 0)?$sql->result():[];
            }
            return json_encode($response);   
    }

    //update address
    public function addressDetails($params)
    {
        $response=[];
        $userid = $params['userid'];
        $addressid = $params['addressid'];
        $where=['user_id'=>$userid,'address_auth_token'=>$addressid,'trash_status'=>0];
        $cols = "address_auth_token as address_id,user_id as user_id,user_name as username,mobile as mobile,address as address,landmark as landmark,area as area,city as city,";
        $cols.="state as state,country as country,pincode as pincode,created_on as created_on,flag_status as address_status";
        $this->db->select($cols)->from($this->address_tbl)->where($where);
        $sql = $this->db->limit(1)->get();
        $dbError = $this->db->error();
        if($dbError['code']!=0)
        {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] =' Some thing error occured. Please inform to suppot team';
            $response['address_result']=(object)(null);
            $response['result_count']=0;
            //Send email of exception pening..
        }
        else
        {
            $count = $sql->num_rows();
            $response[CODE] = ($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE] =($count > 0)?'success':'fail';
            $response[DESCRIPTION] =($count > 0)?'Getting address details   ':'No results found';
            $response['result_count']=$count;
            $response['address_result']=($count > 0)?$sql->row():(object)(null);;
        }
        return json_encode($response); 
    }

     //Update address
     public function updateAddress($params)
     {
        
        $response=[CODE=>VALIDATION_CODE,MESSAGE=>'Invalid format'];
        if(is_array($params))
        {
            $userid = $params['userid'];
            $addressid = $params['addressid'];
            $username = $params['username'];
            $address = $params['address'];
            $landmark = $params['landmark'];
            $area = $params['area'];
            $city = $params['city'];
            $state = $params['state'];
            $country = $params['country'];
            $pincode = $params['pincode'];

            $updateCondition = [
                                'address_auth_token'=>$addressid,
                                'user_id'=>$userid,
                                'trash_status'=>0,
                                ];
            $updateData = [
                                'user_name'=>$username,
                                'address'=>$address,
                                'landmark'=>$landmark,
                                'area'=>$area,
                                'city'=>$city,
                                'state'=>$state,
                                'country'=>$country,
                                'pincode'=>$pincode,
                                'modified_on'=>DATE,
                            ];
            $updateSql = $this->db->update_string($this->address_tbl,$updateData,$updateCondition);
            $updateProfile = $this->db->query($updateSql);
            $updateStatus = $this->db->affected_rows();
            $response[CODE] = ($updateStatus > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE] =($updateStatus > 0)?'success':'fail';
            $response[DESCRIPTION] =($updateStatus > 0)?'Address updated successfully':'Some thing error occured while updating address';
        }
        return json_encode($response);
     }

    //Delete Address
    public function deleteUserAddress($params)
    {
        $response=[CODE=>VALIDATION_CODE,MESSAGE=>'Invalid format'];
        if(is_array($params))
        {
            $userid = $params['userid'];
            $addressid= $params['addressid'];
            $deleteData = ['trash_status'=>1,'flag_status'=>0,'trash_created_on'=>DATE];
            $deleteWhere =  ['address_auth_token'=>$addressid,'user_id'=>$userid];
            $deleteSql = $this->db->update_string($this->address_tbl,$deleteData,$deleteWhere);
            $delete = $this->db->query($deleteSql);
            $deletionStatus = $this->db->affected_rows();
            $response[CODE] = ($deletionStatus > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE] =($deletionStatus > 0)?'success':'fail';
            $response[DESCRIPTION] =($deletionStatus > 0)?'Address deleted successfully':'Some thing error occured while deleting the address';
        }
        return json_encode($response);
    }

    //Upload user Profile Picture
    public function uploadProfilePicture($params)
    {
            //Not required
    }

     //De-active self profile
     public function deactiveSelfProfile($params)
     {
            //Not required
     }

     public function ordersList($params)
     {
         $response=[];
         $userid = $params['userid'];
         $where = ['o.user_id'=>$userid];
         $cols ="o.*,COUNT(oi.cart_id) as item_count,SUM(oi.sub_total) as sub_total";
         $this->db->select($cols)->from('catering_order o')
         ->join('cart_item_catering oi','oi.order_id=o.order_id','inner')
            ->where($where)->group_by('o.order_id');
          $sql = $this->db->order_by('o.order_id',"DESC")->get();
          $dbError = $this->db->error();
          if($dbError['code']!=0)
          {
              $response[CODE] = FAIL_CODE;
              $response[MESSAGE] = 'Fail';
              $response[DESCRIPTION] =' Some thing error occured. Please inform to suppot team';
              $response['orders_result']=(object)(null);
              $response['result_count']=0;
              //Send email of exception pening..
          }
          else
          {
              $count = $sql->num_rows();
              $response[CODE] = ($count > 0)?SUCCESS_CODE:FAIL_CODE;
              $response[MESSAGE] =($count > 0)?'success':'fail';
              $response[DESCRIPTION] =($count > 0)?'Orders result   ':'No results found';
              $response['result_count']=$count;
              $response['orders_result']=($count > 0)?$sql->result():(object)(null);;
          }
          return json_encode($response);
     }
}