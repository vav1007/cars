<?php
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : create.php
 * Page Type             : View
 * Page Purpose         :  Create  Menu
 * Controller Name     :  superadmin/Categories/menu/Create
 * Alias                      : projectname_/superadmin/Categories/menu/Create
 * Designed By           : 
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : Venkateswara Achari
 * Created On            : 23-04-2016
 * Modified By          : K kavitha
 * Modified On          : 9-6-2016
 * Extra notes            :
 * Folder Path           : views/superadmin/categories/submenu
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
                            <h4 class="text-center">Create  Menu</h4>
                            <form role="form" name="m_form" id="m_form" method="post">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Title<sup>*</sup><span id='title_error'></span></label>
                                            <input type="text" name="title" id="title" class="form-control input-md floatlabel" placeholder="Title" autocomplete="off"/>
                                            
                                        </div>
                                    </div>
                                     <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Icon ( Size : _ _ * _ _)<sup></sup><span id='icon_error'></span></label>
                                            <input type="file" name="icon" id="icon" class="form-control input-md floatlabel"  accept="image/*"  title="Upload Icon"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Menu Image ( Size : _ _ * _ _)<sup></sup><span id='menuimage_error'></span></label>
                                            <input type="file" name="menuimage" id="menuimage" class="form-control input-md floatlabel" accept="image/*"   title="Upload Menu Image"/>
                                        </div>
                                    </div>
                                     <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>App Icon ( Size : _ _ * _ _)<sup></sup><span id='app_icon_error'></span></label>
                                            <input type="file" name="app_icon" id="app_icon" class="form-control input-md floatlabel" accept="image/*"     title="Upload App Icon"/>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Priority (Numeric value)<sup></sup><span id='menupriority_error'></span></label>
                                            <input type="text" name="menupriority" id="menupriority" class="form-control input-md floatlabel number_class" title="Give priority number for menu"/>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <span class="form_loading_show" style="display:none;color:blue;font-weight:bold;"><img src="<?php echo SUPERADMIN_LOADING_IMAGE; ?>"/> Please wait uploading...</span>
                                            <span class="form_loading_hide">
                                            <button type="reset" class="btn btn-default  btn-md pull-right">Reset</button>
                                            <button type="submit" class="btn btn-danger btn-md pull-right">Submit</button>
                                            </span>
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
$('#m_form').on('submit',function(smle){
    smle.preventDefault();
    str=true;
    $('#title_error,#icon_error,#menuimage_error,#app_icon_error').html('');
    $('#title,#icon,#menuimage,#app_icon').css('border','');
    var title=$('#title').val().trim();
    var icon=$('#icon').val();
    var menuimage=$('#menuimage').val();
    var app_icon=$('#app_icon').val();
    if(title=='' || title=='0'){$('#title').css('border','1px solid red').focus();$('#title_error').html('Please menu title');str=false;}
   // if(app_icon==''){$('#app_icon').css('border','1px solid red');$('#app_icon_error').html('Please upload App Icon');str=false;}
    if(app_icon!='' && image_validate(app_icon)==0){$('#app_icon').css('border','1px solid red');$('#app_icon_error').html('It allows Jpeg,jpg,png files only');str=false;}
    if(menuimage!='' && image_validate(menuimage)==0){$('#menuimage').css('border','1px solid red');$('#menuimage_error').html('It allows Jpeg,jpg,png files only');str=false;}
    if(icon!='' && image_validate(icon)==0){$('#icon').css('border','1px solid red');$('#icon_error').html('It allows Jpeg,jpg,png files only');str=false;}
    if(str==true){
        $('.form_loading_hide').hide();
                    $('.form_loading_show').show();
      $.ajax({
                    dataType:'JSON',
                   method:'POST',
                   data:new FormData(this),
                   url:"<?php echo SITE_ADMIN_LINK; ?>Categories/insertMenu",
                   contentType: false,
                    cache: false,
                    processData: false,
                   success:function(data){
                       console.log(data);
                        switch(data.code)
                    {
                        case 200:
                            $('.form_loading_show').hide();
                         $('.display_message_class').html(data.description).addClass('alert alert-success fade in');
                            setTimeout(function(){window.location='<?php echo $link_url; ?>'; },3000);
                         break;
                        case 204:
                        case 301:
                        case 422:
                        case 575:
                            $('.display_message_class').html(data.description).addClass('alert alert-danger fade in');
                            $('.form_loading_hide').show();
                            $('.form_loading_show').hide();
                       break;
                    }
                    },
                   error:function(e){console.log(e);}

                });
   }
    return str;
});
</script>
