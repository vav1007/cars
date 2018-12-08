<?php
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : create.php
 * Page Type             : View
 * Page Purpose         :  Create List Submenu
 * Controller Name     :  superadmin/Categories/listSubMenu/Create
 * Alias                      : projectname_/superadmin/Categories/listSubMenu/Create
 * Designed By           : 
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : Venkateswara Achari
 * Created On            : 22-04-2016
 * Modified By          : 
 * Modified On          : 
 * Extra notes            :
 * Folder Path           : views/superadmin/categories/listsubmenu
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
                            <h4 class="text-center">Create List Sub Menu</h4>
                            <form role="form" name="sml_form" id="sml_form" method="post">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Menu<sup>*</sup><span id="menu_error"></span></label>
                                            <select class="selectpicker form-control input-md" name="menu" id="menu">
                                                <option <option value="0">--Choose Menu--</option>
                                                <?php $menu_req=  json_decode($menu_details);
                                                if($menu_req->code==SUCCESS_CODE){
                                                    foreach($menu_req->menu_result as $menu_response){ ?>
                                                <option value="<?php echo $menu_response->id; ?>"><?php echo fetch_ucwords($menu_response->title); ?></option>
                                                    <?php }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Sub Menu<sup>*</sup><span id="submenu_error"></span></label>
                                            <select class="selectpicker form-control input-md" name="submenu" id="submenu">
                                                <option value="0">--Choose Sub Menu--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Title<sup>*</sup><span id='title_error'></span></label>
                                            <input type="text" name="title[]" id="title" class="form-control input-md floatlabel" placeholder="Title">
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
                                            <label>Image ( Size : _ _ * _ _)<sup></sup><span id='image_error'></span></label>
                                            <input type="file" name="image" id="image" class="form-control input-md floatlabel" accept="image/*"   title="Upload Image"/>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>App Icon ( Size : _ _ * _ _)<sup></sup><span id='app_icon_error'></span></label>
                                            <input type="file" name="app_icon" id="app_icon" class="form-control input-md floatlabel" accept="image/*"     title="Upload App Icon"/>
                                            
                                        </div>
                                    </div>
                                </div>
                               <!--  <div class="append_dynamicfeilds"></div> -->
                               
                                <div class="row">
                                   <!--  <div class="col-xs-6 col-sm-6 col-md-6">
                                        <a href="javascript:void(0);" class="multi_add" onclick="add_feild();"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add More</a>
                                    </div> -->
                                    <div class="col-xs-6 col-sm-6 col-md-6" id="btn_insert">
                                        <div class="form-group">
                                            <a href="<?php echo SITE_ADMIN_LINK; ?>Categories/listSubMenu"><button type="button" class="btn btn-default  btn-md pull-right">Cancel</button></a>
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
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo ADMIN_JS_PATH; ?>date-picker.js"></script>
        <script type='text/javascript'>
            $(function () {
                $("#datepicker").datepicker({
                    autoclose: true,
                    todayHighlight: true
                }).datepicker('update', new Date());
                
            });
        </script>

    </body>

</html>
<script type="text/javascript">
 $('img').error(function(){ $(this).attr('src', '<?php echo LOGO_PATH; ?>'); });
/*Adding the text feild*/
function add_feild()
{
         $('<div class="row"><div class="col-xs-6 col-sm-6 col-md-6"><div class="form-group"><input type="text" name="title[]" id="title" class="form-control input-md floatlabel" placeholder="Title"><a href="javascript:void(0);" class="multi_remove" ><i class="fa fa-times" aria-hidden="true"></i> Remove</a> </div></div></div>').appendTo(".append_dynamicfeilds");
 }
/*removing the text feild*/
$('.append_dynamicfeilds').on('click', '.multi_remove', function() { $(this).parent("div").remove(); });
</script>
<script type="text/javascript">
$('#sml_form').on('submit',function(smle){
    smle.preventDefault();
    $('.display_message_class').html('');
    str=true;
    $('#menu_error,#submenu_error,#title_error').html('');
    $('#menu,#submenu').css('border','');
    var menu=$('#menu').val().trim();
    var submenu=$('#submenu').val().trim();
    var title=$('#title').val().trim();
    if(menu=='' || menu=='0'){$('#menu').css('border','1px solid red');$('#menu_error').html('Please choose menu');str=false;}
    if(submenu=='' || submenu=='0'){$('#submenu').css('border','1px solid red');$('#submenu_error').html('Please choose submenu');str=false;}
    if(title=='')
    {
        $('#title_error').text('Enter title');
        $('#title').css('border','1px solid red');
        str=false;
    }
   if(str==true){
    $('#btn_insert').hide();
    $('.display_message_class').html('Please wait..').addClass('alert alert-success fade in');
    $.ajax({
                    dataType:'JSON',
                   method:'POST',
                   data:new FormData(this),
                   url:"<?php echo SITE_ADMIN_LINK; ?>Categories/insertListSubMenu",
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
                            $('.display_message_class').html(data.description).addClass('alert alert-danger fade in');$('#btn_insert').show();
                       break;
                    }
                    },
                   error:function(e){console.log(e);}

                });
   }
    return str;
});
</script>
