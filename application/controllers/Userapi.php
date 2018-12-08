<?php 
defined('BASEPATH') or die('Some thing error occured');
/*
Purpose : User related here - Insert/update/ etc..

*/
class Userapi extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['UserModel'=>'user']);
    }   


    public function signup()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $name = (isset($req_response->username)) ? input_data($req_response->username) : '';
            $email = (isset($req_response->useremail)) ? $req_response->useremail : '';
            $mobile = (isset($req_response->usermobile)) ? $req_response->usermobile : '';
            $password = (isset($req_response->userpassword)) ? trim($req_response->userpassword) : '';
            $app_type = (isset($req_response->app)) ?'web': 'app';
            /*Validatio Section */
            if ($name == '') {$error_message.='* Username is missing ,'; $error = 1;}
            if (!email_check($email)) { $error_message .= '* invalid email ,';$error = 1;}
            if (!mobile_check($mobile)) {$error_message .= '* invalid mobile ,';$error = 1;}
            if (strlen($password) < 6) { $error_message .= '* password length should be minimum 6 required.';$error = 1; }
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $userData=[
                   'username'=>$name,
                   'email'=>$email,
                   'mobile'=>$mobile,
                   'password'=>$password,
                   'app_type'=>$app_type,
               ];
               $signUpResponseReq=  $this->user->createUser($userData);
               $signUpResponse=json_decode($signUpResponseReq);
               if($signUpResponse->code == SUCCESS_CODE)
               {
                   
                    //sending email code
                 /*   $result = $this->sendmail->sendEmail(
                                        array(
                                            'to' => array($email),
                                            'cc' => array('info@' . SITE_DOMAIN),
                                            'bcc' => array(BCC_EMAIL),
                                            'subject' => 'User signup - verification mail',
                                            'data' => array('user_details' => $signUpResponse->user_response),
                                            'template' =>'mail_templates/signup_email',
                                        )
                                    );
                   */
                  $response[CODE]=SUCCESS_CODE;
                  $response[MESSAGE]='success';
                  $response[DESCRIPTION]='Account created successfully.Please verify the email to continue';                  
               }
               else
               {
                   echo $signUpResponseReq;exit;
               }
            }
        }
        echo json_encode($response);
    }

    public function verifyaccount()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $verificationcode = (isset($req_response->verificationcode)) ? input_data($req_response->verificationcode) : '';
            
            /*Validatio Section */
            if ($verificationcode == '') {$error_message.='* verification is missing ,'; $error = 1;}
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                   'verification_code'=>$verificationcode,
               ];
               $verificationResponse=  $this->user->newUserAccountVerification($reqData);
               echo $verificationResponse;exit;
               
            }
        }
        echo json_encode($response);
    }

    public function userLogin()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $username = (isset($req_response->loginusername)) ? input_data($req_response->loginusername) : '';
            $password = (isset($req_response->loginpassword)) ? input_data($req_response->loginpassword) : '';
            $app = 'web';
            $cururl = (isset($req_response->cur_url)) ? input_data($req_response->cur_url) : ''; 
            /*Validatio Section */
            if ($username == '') {$error_message.='* enter email/mobile ,'; $error = 1;}
            if ($password == '') {$error_message.='* password is missing ,'; $error = 1;}
            if ($password != '' && strlen($password) < 6) { $error_message .= '* password length should be minimum 6 required.';$error = 1; }
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $loginData=[
                            'username'=>$username,
                            'password'=>$password,
                            'app'=>$app,
                          ];
               $loginResponse=  $this->user->userLogin($loginData);
               
                $logReq = json_decode($loginResponse);
                if($logReq->code==SUCCESS_CODE)
                {
                        $userInfo = $logReq->user_details;
                        $userId= $userInfo->user_id;
                        $username = $userInfo->user_name;
                        $profile_status= $userInfo->profile_status;
                        $sess_userid=$userInfo->userid;
                        if($profile_status == 1)
                        {
                            $response[CODE]=SUCCESS_CODE;
                            $response[MESSAGE]='Login Success';
                            $response[DESCRIPTION]='Login success. Please wait..';
                            
                            if($app!='app')
                            {
                                $loginSessionData=[
                                                    US_EXT.'userid'=>$userId,
                                                    US_EXT.'username'=>$username,
                                                    'user_login_status'=>1,
                                                    US_EXT.'sess_userid'=>$sess_userid,
                                                  ];
                                                
                                $this->session->set_userdata($loginSessionData);
                                //$response['redirection_link']=base_url().'profile';                  
                                /*if($cururl == base_url().'reservation') {
                                    $response['redirection_link']=base_url().'reservation';                  
                                } */     
                                $response['redirection_link']='profile';
                                
                            }
                            else
                            {
                                $response['user_details']=$userInfo;
                                $response['redirection_link']=base_url().'profile';
                            }
                            
                        }
                        else
                        {
                            $status_msg='';
                            switch($profile_status)
                            {
                                case 0 :$status_msg='Your account blocked';break;
                                case 2 :$status_msg='Account de-activated';break;
                                case 3 :$status_msg='Please verify the email to activate account';break;
                                case 4 :$status_msg='Account under forgot password state.Please check the mail and reset the password';break;
                            }
                            
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'FAIL';
                            $response[DESCRIPTION] =$status_msg;
                            $response['user_details']=(object)(null);
                        }
                }   
                else
                {
                    //Login fail condition
                    echo $loginResponse;exit;   
                } 
            }
        }
        echo json_encode($response);
    }

    public function userForgotReq()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $username = (isset($req_response->username)) ? input_data($req_response->username) : '';
            
            /*Validatio Section */
            if ($username == '') {$error_message.='* enter email / mobile number ,'; $error = 1;}
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                   'username'=>$username,
               ];
               $forgotReq=  $this->user->forgotPasswordReq($reqData);
               $forgotRes = json_decode($forgotReq);
               if($forgotRes->code!=SUCCESS_CODE)
               {
                    echo $forgotReq;exit;
               }
               elseif($forgotRes->code==SUCCESS_CODE)
               {
                        $userRes = $forgotRes->user_details;
                        $userName = $userRes->username;
                        $userEmail = $userRes->email;
                        $userMobile = $userRes->mobile;
                        $forgotEmailData=[
                            'username'=>$userName,
                            'useremail'=>$userEmail,
                            'usermobile'=>$userMobile,
                            'verification_code'=>$forgotRes->verification_code
                        ];
                         //sending email code
                 /*   $sendEmail = $this->sendmail->sendEmail(
                                        array(
                                            'to' => array($email),
                                            'cc' => array('info@' . SITE_DOMAIN),
                                            'bcc' => array(BCC_EMAIL),
                                            'subject' => 'User Forgot - verification mail',
                                            'data' => array('user_details' =>$forgotEmailData),
                                            'template' =>'mail_templates/forgot_email',
                                        )
                                    );
                   */
                    $sendEmail=1;
                    $response[CODE]=SUCCESS_CODE;
                    $response[MESSAGE]='Success';
                    $response[DESCRIPTION]='Verification code sent to '.$userEmail.' Please check the email';              
                }               
            }
        }
        echo json_encode($response);
    }

    //Reset password
    public function setForgotPassword()
    {
        $response = array();  
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input))
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $verificationcode = (isset($req_response->verificationcode)) ? input_data($req_response->verificationcode) : '';
            $password = (isset($req_response->password)) ? input_data($req_response->password) : '';
            
            
            /*Validatio Section */
            if ($verificationcode == '') {$error_message.='* verification code is missing ,'; $error = 1;}
            if ($password == '') {$error_message.='* password is missing ,'; $error = 1;}
            if ($password != '' && strlen($password) < 6) { $error_message .= '* password length should be minimum 6 required.';$error = 1; }
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                   'verification_code'=>$verificationcode,
                   'password'=>$password,
               ];
               $verificationResponse=  $this->user->setUserForgotPassword($reqData);
               echo $verificationResponse;exit;
               
            }
        }
        echo json_encode($response);
    }

    public function changePassword()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            $password = (isset($req_response->current_password)) ? input_data($req_response->current_password) : '';
            $old_password = (isset($req_response->old_password)) ? input_data($req_response->old_password) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($password == '') {$error_message.='* password is missing ,'; $error = 1;}
            if ($old_password == '') {$error_message.='* old password is missing ,'; $error = 1;}
            if ($old_password == $password) {$error_message.='* old password should not same as new password ,'; $error = 1;}
            if ($password != '' && strlen($password) < 6) { $error_message .= '* password length should be minimum 6 required.';$error = 1; }
            if ($old_password != '' && strlen($old_password) < 6) { $error_message .= '* password length should be minimum 6 required.';$error = 1; }
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                   'userid'=>$userid,
                   'password'=>$password,
                   'old_password'=>$old_password,
               ];
               $changePasswordResponse=  $this->user->updatePassword($reqData);
               echo $changePasswordResponse;exit;
               
            }
        }
        echo json_encode($response);
    }
     //profile Details
    public function profileDetails()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                            'userid'=>$userid,
                        ];
               $userData=  $this->user->profileDetails($reqData);
               echo $userData;exit;
               
            }
        }
        echo json_encode($response);
    }

    //User profile - update
    public function updateProfile()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            $username = (isset($req_response->username)) ? input_data($req_response->username) : '';
            
            $address = (isset($req_response->address)) ? input_data($req_response->address) : '';
            $landmark    = (isset($req_response->landmark)) ? input_data($req_response->landmark) : '';
            $area = (isset($req_response->area)) ? input_data($req_response->area) : '';
            $city = (isset($req_response->city)) ? input_data($req_response->city) : '';
            $state = (isset($req_response->state)) ? input_data($req_response->state) : '';
            $country = (isset($req_response->country)) ? input_data($req_response->country) : '';
            $pincode = (isset($req_response->pincode)) ? input_data($req_response->pincode) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($username == '') {$error_message.='user name is missing ,'; $error = 1;}
            
            if ($address == '') {$error_message.='address is missing ,'; $error = 1;}
            if ($landmark == '') {$error_message.='landmark is missing ,'; $error = 1;}
            if ($area == '') {$error_message.='area is missing ,'; $error = 1;}
            if ($city == '') {$error_message.='city is missing ,'; $error = 1;}
            if ($state == '') {$error_message.='state is missing ,'; $error = 1;}
            if ($country == '') {$error_message.='country is missing ,'; $error = 1;}
            if ($pincode == '') {$error_message.='pincode is missing ,'; $error = 1;}
            
            if(!pincode_check($pincode)){$error_message.='invalid pincode ,'; $error = 1;}
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                            'userid'=>$userid,
                            'username'=>$username,
                            'address'=>$address,
                            'landmark'=>$landmark,
                            'area'=>$area,
                            'city'=>$city,
                            'state'=>$state,
                            'country'=>$country,
                            'pincode'=>$pincode,
                            
                        ];
               $userData=  $this->user->updateProfile($reqData);
               echo $userData;exit;
               
            }
        }
        echo json_encode($response);
    }

    /*
    | Address Module Section Code
    |
    */

    public function createaddress()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            $username = (isset($req_response->username)) ? input_data($req_response->username) : '';
            $mobile = (isset($req_response->mobile)) ? input_data($req_response->mobile) : '';
            $address = (isset($req_response->address)) ? input_data($req_response->address) : '';
            $landmark    = (isset($req_response->landmark)) ? input_data($req_response->landmark) : '';
            $area = (isset($req_response->area)) ? input_data($req_response->area) : '';
            $city = (isset($req_response->city)) ? input_data($req_response->city) : '';
            $state = (isset($req_response->state)) ? input_data($req_response->state) : '';
            $country = (isset($req_response->country)) ? input_data($req_response->country) : '';
            $pincode = (isset($req_response->pincode)) ? input_data($req_response->pincode) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($username == '') {$error_message.='user name is missing ,'; $error = 1;}
            if ($mobile == '') {$error_message.='mobile is missing ,'; $error = 1;}
            if ($address == '') {$error_message.='address is missing ,'; $error = 1;}
            if ($landmark == '') {$error_message.='landmark is missing ,'; $error = 1;}
            if ($area == '') {$error_message.='area is missing ,'; $error = 1;}
            if ($city == '') {$error_message.='city is missing ,'; $error = 1;}
            if ($state == '') {$error_message.='state is missing ,'; $error = 1;}
            if ($country == '') {$error_message.='country is missing ,'; $error = 1;}
            if ($pincode == '') {$error_message.='pincode is missing ,'; $error = 1;}
            if(!mobile_check($mobile)){$error_message.='invalid mobile number ,'; $error = 1;}
            if(!pincode_check($pincode)){$error_message.='invalid pincode ,'; $error = 1;}
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                            'userid'=>$userid,
                            'username'=>$username,
                            'mobile'=>$mobile,
                            'address'=>$address,
                            'landmark'=>$landmark,
                            'area'=>$area,
                            'city'=>$city,
                            'state'=>$state,
                            'country'=>$country,
                            'pincode'=>$pincode,
                        ];
               $userData=  $this->user->createNewAddress($reqData);
               echo $userData;exit;
               
            }
        }
        echo json_encode($response);
    }

    //address list 
    public function userAddressList()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                            'userid'=>$userid,
                        ];
               $addressData=  $this->user->addressBookList($reqData);
               echo $addressData;exit;
               
            }
        }
        echo json_encode($response);
    }

    public function addressDetails()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            $addressid = (isset($req_response->addressid)) ? input_data($req_response->addressid) : '';
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($addressid == '') {$error_message.='* address id is missing ,'; $error = 1;}
            
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                            'userid'=>$userid,
                            'addressid'=>$addressid,
                        ];
               $addressData=  $this->user->addressDetails($reqData);
               echo $addressData;exit;
               
            }
        }
        echo json_encode($response);
    }


    // update address 
    public function updateAddress()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            $addressid = (isset($req_response->addressid)) ? input_data($req_response->addressid) : '';
            $username = (isset($req_response->username)) ? input_data($req_response->username) : '';
            $mobile = (isset($req_response->mobile)) ? input_data($req_response->mobile) : '';
            $address = (isset($req_response->address)) ? input_data($req_response->address) : '';
            $landmark    = (isset($req_response->landmark)) ? input_data($req_response->landmark) : '';
            $area = (isset($req_response->area)) ? input_data($req_response->area) : '';
            $city = (isset($req_response->city)) ? input_data($req_response->city) : '';
            $state = (isset($req_response->state)) ? input_data($req_response->state) : '';
            $country = (isset($req_response->country)) ? input_data($req_response->country) : '';
            $pincode = (isset($req_response->pincode)) ? input_data($req_response->pincode) : '';
            
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($addressid == '') {$error_message.='address id is missing ,'; $error = 1;}
            if ($username == '') {$error_message.='user name is missing ,'; $error = 1;}
            if ($mobile == '') {$error_message.='mobile is missing ,'; $error = 1;}
            if ($address == '') {$error_message.='address is missing ,'; $error = 1;}
            if ($landmark == '') {$error_message.='landmark is missing ,'; $error = 1;}
            if ($area == '') {$error_message.='area is missing ,'; $error = 1;}
            if ($city == '') {$error_message.='city is missing ,'; $error = 1;}
            if ($state == '') {$error_message.='state is missing ,'; $error = 1;}
            if ($country == '') {$error_message.='country is missing ,'; $error = 1;}
            if ($pincode == '') {$error_message.='pincode is missing ,'; $error = 1;}
            if(!mobile_check($mobile)){$error_message.='invalid mobile number ,'; $error = 1;}
            if(!pincode_check($pincode)){$error_message.='invalid pincode ,'; $error = 1;}
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                            'userid'=>$userid,
                            'addressid'=>$addressid,
                            'username'=>$username,
                            'mobile'=>$mobile,
                            'address'=>$address,
                            'landmark'=>$landmark,
                            'area'=>$area,
                            'city'=>$city,
                            'state'=>$state,
                            'country'=>$country,
                            'pincode'=>$pincode,
                        ];
               $updateAddresResoponse=  $this->user->updateAddress($reqData);
               echo $updateAddresResoponse;exit;
               
            }
        }
        echo json_encode($response);
    }
    // Delete address 
    public function deleteAddress()
    {
        $response = array();    
        $error_message = ''; $error=0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) 
        {
            $response[CODE]=VALIDATION_CODE;
            $response[MESSAGE]='Validation';
            $response[DESCRIPTION]='Input data should be in JSON format only';
        }
        else
        {
            $req_response = json_decode($req_input);
            $userid = (isset($req_response->userid)) ? input_data($req_response->userid) : '';
            $addressid = (isset($req_response->addressid)) ? input_data($req_response->addressid) : '';
            /*Validatio Section */
            if ($userid == '') {$error_message.='* user id is missing ,'; $error = 1;}
            if ($addressid == '') {$error_message.='* address id is missing ,'; $error = 1;}
            
            /*Validation Section ends here*/
            if($error==1)
            {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] =rtrim($error_message,',');
            }
            else
            {
               //No errors we can proceeed
               $reqData=[
                            'userid'=>$userid,
                            'addressid'=>$addressid,
                        ];
               $deleteAddress=  $this->user->deleteUserAddress($reqData);
               echo $deleteAddress;exit;
               
            }
        }
        echo json_encode($response);
    }
    /*
    | Address Module Section Code End
    |
    */

    public function getProfileDetails($userid)
    {
        $reqData=[
            'userid'=>$userid,
        ];
        $userData=  $this->user->profileDetails($reqData);
        echo $userData;exit;
    }
}