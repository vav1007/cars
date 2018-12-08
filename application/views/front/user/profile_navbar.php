<?php
//print_r($this->session->all_userdata());
                    $user_sess_log_status =  $this->session->userdata('user_login_status');    
                    $user_sess_name='';
                    if($user_sess_log_status == 1){
                      $user_sess_id = $this->session->userdata(US_EXT.'userid'); 
                      $user_sess_name = $this->session->userdata(US_EXT.'username'); 
                      $main_sess_userid=$this->session->userdata(US_EXT.'sess_userid'); 
                    }
                    ?>
<div class="shadow part-one" style="display: -webkit-flex;">
                                          
                                          <div class="content-div">
                                              <div style="font-size:12px;">Hello</div>
                                              <div class="con-two"><?php echo $user_sess_name; ?></div>
                                          </div>
                                      </div>
                                       <div class="shadow part-two" style="margin-bottom: 16px;">
                                       <div>
                                           <div style="padding-bottom: 12px;">
                                                <div style="padding: 20px 12px 5px 24px;display: -webkit-flex;">
                                                    <i class="fa fa-user fa-2x" style="width:20px;height:20px;"></i>
                                                    <div class="part-label">Account Settings</div>
                                               </div>
                                               <div>
                                                   <a href="<?php echo base_url(); ?>profile">
                                                       <div class="NqIFxw HDbIt8">Profile Information</div>
                                                   </a>
                                                   <a href="<?php echo base_url(); ?>wishlist">
                                                       <div class="NqIFxw">Wishlist</div>
                                                   </a>
                                                  
                                               </div>
                                               
                                           </div>
                                           <div class="_1zr6a1"></div>
                                           </div>
                                        <div>
                                           <div class="hide" style="padding-bottom: 12px;">
                                                <div style="padding: 20px 12px 5px 24px;display: -webkit-flex;">
                                                    <i class="fa fa-user fa-2x" style="width:20px;height:20px;"></i>
                                                    <div class="part-label">My Stuff</div>
                                               </div>
                                               <div>
                                                   <a href="wishlist_1.php">
                                                       <div class="NqIFxw">wishlist</div>
                                                   </a>
                                                   <a href="#">
                                                       <div class="NqIFxw">Orders</div>
                                                   </a>
                                                   <a href="#">
                                                       <div class="NqIFxw">My reviwes</div>
                                                   </a>
                                                  
                                               </div>
                                               
                                           </div>
                                           <div class="_1zr6a1"></div>
                                           </div>
                                            <div>
                                           <div style="padding-bottom: 12px;">
                                                <div style="padding: 20px 12px 5px 24px;display: -webkit-flex;">
                                                    <i class="fa fa-power-off fa-2x" style="width:20px;height:20px;"></i>
                                                    <div class="part-label"><a href="<?php echo base_url();?>logout">Log out</a></div>
                                               </div>
                                           </div>
                                           </div> 
                                       </div>
                                       <div class="shadow part-three hide" style="padding: 16px;font-size: 12px;">
                                       <div style="padding-bottom: 5px;font-weight: 500;">frequently asked:
                                        </div>
                                        <div style="display: -webkit-flex;">
                                            <a style="padding: 5px 9px 0 0;">change password</a>
                                            <a style="padding: 5px 9px 0 0;">change</a>
                                            <a style="padding: 5px 9px 0 0;">change </a>
                                        </div>   
                                       </div>