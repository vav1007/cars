<?php
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : update.php
 * Page Type             : View
 * Page Purpose         : Update bank   account details
 * Controller Name     :  superadmin/Welcome/bankaccount/details
 * Alias                      : projectname_/superadmin/Welcome/bankaccounts/details/(id)
 * Designed By           : 
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : Venkateswara Achari
 * Created On            : 13-05-2016
 * Modified By          : 
 * Modified On          : 
 * Extra notes            :
 * Folder Path           : views/superadmin/bankdetails/update.php
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Project Related Code Start -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo SUPERADMIN_TITLE; ?><?php echo $URL_TITLE; ?></title>
        <meta name="description" content="<?php echo META_TAGS; ?>"/>
        <meta name="keywords" content="<?php echo META_KEYWORDS; ?>"/>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON_PATH; ?>">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Project Related Code End -->
        <link href="<?php echo ADMIN_CSS_PATH; ?>bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Custom CSS -->
        <link href="<?php echo ADMIN_CSS_PATH; ?>custom.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMIN_CSS_PATH; ?>responsive.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMIN_CSS_PATH; ?>font-awesome.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php $this->load->view(ADMIN_INCLUDES_PATH . 'header'); /* Loading the Login Header */ ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                    <div class="bread col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <ul>
                            <li><a href="<?php echo SITE_ADMIN_LINK; ?>" class="active"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li><a href="<?php echo SITE_ADMIN_LINK; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                            <?php
                            $breadcrumb_details = json_decode($breadcrumb);
                            $breadcrumb_count = count($breadcrumb_details);
                            foreach ($breadcrumb_details as $breadcrumb) {
                                ?>
                                <li><a href="<?php echo $breadcrumb->link; ?>" class="<?php echo $breadcrumb->class; ?>"><?php echo fetch_ucwords($breadcrumb->title); ?></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                            <?php } ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    
                </div>
                <div class="clearfix"></div>
                <div class="details col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--Search Block Code Start-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 details-date" style="display:none;">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-left">
                            <select name="city" id="city" class="minimal chanagecity col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <option value="1" data-city="1">&nbsp;Nellore</option>
                                <option value="19" data-city="19">&nbsp;Tirupathi</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-left">
                            <select name="city" id="city" class="minimal chanagecity col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <option value="1" data-city="1">&nbsp;Nellore</option>
                                <option value="19" data-city="19">&nbsp;Tirupathi</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-left search">
                            <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                                <input class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-left search">
                            <button class="btn btn-success btn-md">Search</button>
                        </div>

                    </div>
                    <!--Search Block Code End-->
                    <div class="clearfix"></div>
                    <!--Display messges Block Code Start-->
                    <div class="display_message_class"></div>
                    <!--Display messges Block Code End-->
                    <div class="info col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="reg col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-2 col-md-push-2 col-sm-push-3 col-xs-push-0">
                            <h4 class="text-center">Update Bank Account</h4>
                            <?php
                            $req=  json_decode($bank_details);
                            if($req->code==SUCCESS_CODE){
                               $response=$req->bank_result;
                            ?>
                            <form role="form" name="bankaccount_form" id="bankaccount_form" method="post">
                                <input type="hidden" name="account_id" id="account_id" value="<?php echo $response->id; ?>"/>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Bank Name<sup>*</sup><span id='bankname_error'></span></label>
                                            <input type="text" name="bankname" id="bankname" class="form-control input-md floatlabel" placeholder="Bank Name" autocomplete="off" maxlength="60" value="<?php echo $response->bankname; ?>"/>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Account Number<sup>*</sup><span id='account_number_error'></span></label>
                                            <input type="text" name="account_number" id="account_number" class="form-control input-md floatlabel" placeholder="Account Number" autocomplete="off" maxlength="30" value="<?php echo $response->accountnumber; ?>"/>
                                            
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>IFSC Code<sup>*</sup><span id='ifsccode_error'></span></label>
                                            <input type="text" name="ifsccode" id="ifsccode" class="form-control input-md floatlabel" placeholder="IFSC Code" autocomplete="off" maxlength="30" value="<?php echo $response->ifsccode; ?>"/>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Account Type<sup>*</sup><span id='accounttype_error'></span></label>
                                            <select name="account_type" id="account_type" class="form-control input-md floatlabel">
                                                <option value="Saving" <?php echo ($response->bankname=='Saving')?'selected':'';?>>Saving</option>
                                                <option value="Current" <?php echo ($response->bankname=='Current')?'selected':'';?>>Current</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Branch<sup>*</sup><span id='branch_error'></span></label>
                                            <input type="text" name="branch" id="branch" class="form-control input-md floatlabel" placeholder="Bank Branch" autocomplete="off" maxlength="30" value="<?php echo $response->branch; ?>"/>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Address<sup>*</sup><span id='address_error'></span></label>
                                            <textarea name="address" id="address" placeholder="Enter Bank address ::" cols="45" rows="4"><?php echo $response->address; ?></textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>City<sup>*</sup><span id='bank_city_error'></span></label>
                                            <input type="text" name="city" id="bank_city" class="form-control input-md floatlabel" placeholder="City" autocomplete="off" maxlength="30" value="<?php echo $response->city; ?>"/>
                                            
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger btn-md pull-right">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php } else { ?>
                            <div class="display_message_class alert alert-danger fade in"><?php echo fetch_ucwords($req->description); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>  
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <?php $this->load->view(ADMIN_INCLUDES_PATH . 'footer'); /* Loading the Footer */ ?>
        <div class="clearfix"></div>
    </body>
</html>
<script type="text/javascript">
$('#bankaccount_form').on('submit',function(pu){
    pu.preventDefault();
    str=true;
    $('#bankname_error,#account_number_error,#ifsccode_error,#accounttype_error,#branch_error,#address_error,#bank_city').html('');
    $('#bankname,#account_number,#ifsccode,#account_type,#branch,#address,#bank_city').css('border','');
    var bankname=$('#bankname').val().trim();
    var account_number=$('#account_number').val().trim();
    var ifsccode=$('#ifsccode').val().trim();
    var account_type=$('#account_type').val().trim();
    var branch=$('#branch').val().trim();
    var address=$('#address').val().trim();
    var city=$('#bank_city').val().trim();
    if(bankname==''){$('#bankname_error').html('Please enter bank name');$('#bankname').css('border','1px solid red');str=false;}
    if(account_number==''){$('#account_number_error').html('Please enter account number');$('#account_number').css('border','1px solid red');str=false;}
    if(ifsccode==''){$('#ifsccode_error').html('Please enter IFSC code');$('#ifsccode').css('border','1px solid red');str=false;}
    if(account_type==''){$('#account_type_error').html('Please choose account type');$('#account_type').css('border','1px solid red');str=false;}
    if(branch==''){$('#branch_error').html('Please enter branch');$('#branch').css('border','1px solid red');str=false;}
    if(address==''){$('#address_error').html('Please enter address');$('#address').css('border','1px solid red');str=false;}
    if(city==''){$('#bank_city_error').html('Please enter city');$('#bank_city').css('border','1px solid red');str=false;}
     if(str==true){
         var formdetails=JSON.stringify($('#bankaccount_form').serializeObject());
      $.ajax({
                    dataType:'JSON',
                   method:'POST',
                   data:formdetails,
                   url:"<?php echo SITE_ADMIN_LINK; ?>Welcome/updateBankDetails",
                   success:function(data){
                       console.log(data);
                        switch(data.code)
                    {
                        case 200:
                         $('.display_message_class').html(data.description).addClass('alert alert-success fade in');
                            setTimeout(function(){window.location=location.href; },3000);
                         break;
                        case 204:
                        $('.display_message_class').html(data.description).addClass('alert alert-danger fade in');
                        break;
                        case 301:
                        case 422:
                        case 575:
                            $('.display_message_class').html(data.description).addClass('alert alert-danger fade in');
                       break;
                    }
                    },
                   error:function(e){console.log(e);}

                });
   }
    return str;
});
</script>
