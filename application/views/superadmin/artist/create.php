<?php
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : create.php
 * Page Type             : View
 * Page Purpose         :  Create Artist
 * Controller Name     :  superadmin/Other/artist/Create
 * Alias                      : projectname_/superadmin/Other/artist/Create
 * Designed By           : 
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : Venkateswara Achari
 * Created On            : 25-04-2016
 * Modified By          : 
 * Modified On          : 
 * Extra notes            :
 * Folder Path           : views/superadmin/artist/create.php
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
                            <h4 class="text-left">Create Artist</h4>
                            <form role="form" name="artist_form" id="artist_form" method="post">
                                
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Name<sup>*</sup><span id="name_error"></span></label>
                                            <input type="text" name="name" id="name" class="form-control input-md floatlabel" placeholder="Name" title="Name" maxlength="60" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Email<sup></sup><span id='email_error'></span></label>
                                            <input type="text" name="email" id="email" class="form-control input-md floatlabel" placeholder="Email" title="Email" maxlength="60" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Mobile<sup></sup><span id="mobile_error"></span></label>
                                            <input type="text" name="mobile" id="mobile" class="form-control input-md floatlabel number_class" placeholder="Mobile" title="Mobile" maxlength="10" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>City<sup></sup><span id="artist_city_errror"></span></label>
                                            <input type="text" name="artist_city" id="artist_city" class="form-control input-md floatlabel" placeholder="City" title="City" maxlength="60" autocomplete="off" value=""/>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Address<sup></sup><span id="address_error"></span></label>
                                            <textarea name="address" id="address" class="form-control input-md floatlabel" placeholder="Address :: " title="Enter Address" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>About Artist<sup></sup><span id="about_artist_error"></span></label>
                                            <textarea name="about_artist" id="about_artist" class="form-control input-md floatlabel" placeholder="Describe about artist " title="Describe about artist" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Profile Picture (Size : _ _ * _ _)<sup></sup><span id="profilepicture_error"></span></label>
                                            <input type="file" name="profilepicture" id="profilepicture" class="form-control input-md floatlabel" accept="image/*"/>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Works <i class="fa fa-question-circle" aria-hidden="true" title="Can upload multiple images"></i>(Size : _ _ * _ _)<sup></sup><span id="works_multiple_error"></span></label>
                                            <input type="file" name="works_multiple[]" id="works_multiple" class="form-control input-md floatlabel" accept="image/*" multiple/>
                                        </div>
                                    </div> -->
                                </div>
                              <div class="row">
                                  <div class="col-xs-6 col-sm-6 col-md-6" id="disp_main_imgae">
                                            
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6" id="disp_multiple_image">
                                        
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">

                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <a href="<?php echo SITE_ADMIN_LINK; ?>Other/artist"><button type="button" class="btn btn-default  btn-md pull-right">Reset</button></a>
                                            <button type="submit" class="btn btn-danger btn-md pull-right">Submit</button>
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
    $('#artist_form').on('submit', function (p) {
        p.preventDefault();
        str=true;
        $('#name,#email,#mobile,#artist_city,#address,#about_artist,#profilepicture').css('border','');
        $('#name_error,#email_error,#mobile_error,#artist_city_errror,#address_error,#about_artist_error,#profilepicture_error,#works_multiple_error').text('');
        var mobilepattern = /^[6-9]+[0-9]{9}$/;
        var emailpattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        var name=$('#name').val().trim();
        var email=$('#email').val().trim();
        var mobile=$('#mobile').val().trim();
//        var artist_city=$('#artist_city').val().trim();
//        var address=$('#address').val().trim();
//        var about_artist=$('#about_artist').val().trim();
        var profilepicture=$('#profilepicture').val().trim();
        //var works_multiple=$('#works_multiple').val().trim();
       if(name=='' || name=='0'){$('#name').css('border','1px solid red').focus();$('#name_error').html('Please enter artist name');str=false;}
        //if(email=='' || email=='0'){$('#email').css('border','1px solid red').focus();$('#email_error').html('Please enter email');str=false;}
         if(email!='' && !emailpattern.test(email)){$('#email').css('border','1px solid red');$('#email_error').html('Please enter valid email id');str=false;}
         //if(mobile=='' || mobile=='0'){$('#mobile').css('border','1px solid red');$('#mobile_error').html('Please enter mobile');str=false;}
        if(mobile!='' && !mobilepattern.test(mobile)){$('#mobile').css('border','1px solid red');$('#mobile_error').html('Please enter valid mobile number');str=false;}
        // if(artist_city==''){$('#artist_city').css('border','1px solid red').focus();$('#artist_city_errror').html('Please enter city');str=false;}
        //if(address==''){$('#address').css('border','1px solid red').focus();$('#address_error').html('Please enter address');str=false;}
       // if(about_artist==''){$('#about_artist').css('border','1px solid red').focus();$('#about_artist_error').html('Enter about artist');str=false;}
       // if(profilepicture=='' || profilepicture=='0'){$('#profilepicture').css('border','1px solid red').focus();$('#profilepicture_error').html('Please upload profile picture');str=false;}
        if(profilepicture!='' && image_validate(profilepicture)==0){$('#profilepicture').css('border','1px solid red');$('#profilepicture_error').html('It allows Jpeg,jpg,png files only');str=false;}
        if(str==true){
      $.ajax({
                    dataType:'JSON',
                   method:'POST',
                   data:new FormData(this),
                   url:"<?php echo SITE_ADMIN_LINK; ?>Other/insertArtist",
                   contentType: false,
                    cache: false,
                    processData: false,
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
                       break;
                    }
                    },
                   error:function(e){console.log(e);}

                });
   }
        return str;
    });
</script>