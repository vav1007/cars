<?php
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : email.php
 * Page Type             : View
 * Page Purpose         :  email to user/newsletter
 * Controller Name     :  superadmin/Cms/newsletter/email
 * Alias                      : projectname_/superadmin/Cms/newsletter/email
 * Designed By           : 
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : Kavitha
 * Created On            : 15-5-2016
 * Modified By          : 
 * Modified On          : 
 * Extra notes            :
 * Folder Path           : views/superadmin/newsletter/email.php
 */
 //echo $email_id_details;
 $email_req=json_decode($email_id_details);
 $emails='';
 if($email_req->code==SUCCESS_CODE)
 {
    foreach($email_req->emails_result as $response)
    {
        $emails.=$response->emails.',';
    }
    $emails=rtrim($emails,',');
 }
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
        <style type="text/css">
        .error{color:red; font-size: 12px;}
        </style>
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
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-left search" style="display: none;">
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
                            <h4 class="text-left">Send Email</h4>
                            <form role="form" name="email_form" id="email_form" method="post">
                                
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>To (Enter email id's comma seperated)<sup>*</sup></label>
                                            <textarea name="emailids" id="emailids" class="form-control input-md floatlabel" placeholder="Enter Email id's" title="Enter Email id's" autocomplete="off" cols="10" rows="5"><?php echo $emails;?></textarea><span class="error" id="emailids_error"></span>
                                        </div>
                                    </div>
                                     <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Description<sup>*</sup></label>
                                            <textarea name="description" id="description" placeholder="Description" cols="10" rows="5" class="form-control" autocomplete="off"></textarea><span class="error" id="description_error"></span>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                   <!--<div class="col-xs-6 col-sm-6 col-md-6">
                                          <div class="form-group">
                                                <label>Select<sup>*</sup></label>
                                                <input type="checkbox" id="newsletters" name="newsletters" value="1"/>News Letter
                                                <input type="checkbox" id="users" name="users" value="1" />User's
                                                <div class="clearfix">&nbsp;</div>
                                        </div> 
                                    </div>-->
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Upload Image<sup></sup></label>
                                        <input type="file" name="image" id="image" class="form-control"/></div>
                                    </div>
                                     <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Subject<sup>*</sup></label>
                                        <input type="text" name="subject" id="subject" placeholder="Enter Subject" maxlength="60"class="form-control"/>
                                        <span class="error" id="subject_error"></span></div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                </div>
                                   <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <button type="reset" class="btn btn-default  btn-md pull-right">Reset</button>
                                            <button type="submit" class="btn btn-danger btn-md pull-right" id="btn_sendemail">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
 <script type="text/javascript" src="<?php echo ADMIN_JS_PATH; ?>date-picker.js"></script>
        <script type='text/javascript'>
                            $(function () {
                                $(".date").datepicker({
                                    autoclose: true,
                                    todayHighlight: true,
                                    
                                }).datepicker('update', new Date());

                            });
        </script>
<script type="text/javascript">
    $('#product_name').blur(function () {
        $('#search_keywords').val($(this).val() + ',');
    });
    /*Adding the text feild*/
    function add_feild()
    {
        $('<div class="row"><div class="col-xs-6 col-sm-6 col-md-6"><div class="form-group"><input type="text" name="title[]" id="title" class="form-control input-md floatlabel" placeholder="Title"><a href="javascript:void(0);" class="multi_remove" ><i class="fa fa-times" aria-hidden="true"></i> Remove</a> </div></div></div>').appendTo(".append_dynamicfeilds");
    }
    /*removing the text feild*/
    $('.append_dynamicfeilds').on('click', '.multi_remove', function () {
        $(this).parent("div").remove();
    });
</script>
 <script language="javascript" type="text/javascript">
     $("#profilepicture").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#disp_main_imgae");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:120px;width: 150px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        $(function () {
            $("#works_multiple").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#disp_multiple_image");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:120px;width: 150px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });
    </script>
<script type="text/javascript">
    $('#email_form').on('submit', function (p) {
        p.preventDefault();
        $('#emailids,#description,#subject').css('border','');
        $('#emailids_error,#description_error,#subject_error').text('');
        str=true;
        var mulemailpatterns=/^((\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*)*([,])*)*$/;
        var email=$('#emailids').val();
        var desc=$('#description').val();
        var subject=$('#subject').val();
        //var user=document.getElementById('users').checked;
        //var newsletter=document.getElementById('newsletters').checked;
        if(email=='')
        {
            $('#emailids').css('border','1px solid red');
            $('#emailids_error').html('Enter email id or email id\'s');
            str=false;
        }
        if(email!='')
        {
            if(!mulemailpatterns.test(email)){
            $('#emailids').css('border','1px solid red');
            $('#emailids_error').html('Enter valid email id or email id\'s');
            str=false;
            }
        }
        if(desc=='')
        {
            $('#description').css('border','1px solid red');
            $('#description_error').html('Enter description');
            str=false;
        }
        if(subject=='')
        {
            $('#subject').css('border','1px solid red');
            $('#subject_error').html('Enter subject');
            str=false;
        }
       if(str==true)
       {
          $('#btn_sendemail').hide();
          $.ajax({
            type:"POST",
            dataType:"JSON",
            data : new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            url:"<?php echo SITE_ADMIN_LINK; ?>Cms/sendEmailNotification",
            success:function(data){
                   console.log(data);
                    switch(data.code)
                {
                    case 200:
                     $('.display_message_class').html(data.description).addClass('alert alert-success fade in');
                        setTimeout(function(){window.location='<?php echo $link_url; ?>'; },3000);
                     break;
                    case 204:
                    case 301:
                    case 422:
                    case 575:
                        $('.display_message_class').html(data.description).addClass('alert alert-danger fade in');
                        $('#btn_sendemail').show();
                   break;
                }
                },
                   error:function(e){console.log(e);}
            });  
       }
       return str;

    });
</script>