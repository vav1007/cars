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
//echo $lsm_details;
$lsm_data=json_decode($lsm_details);
$lsm_res=$lsm_data->lsm_result;
$menu=ucwords($lsm_res->menu);
$submenu=ucwords($lsm_res->submenu);
$title=ucwords($lsm_res->title);
$updateid=$lsm_res->id;
$o_icon=$lsm_res->icon;
$o_appicon=$lsm_res->appicon;
$o_image=$lsm_res->image;
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
                            <h4 class="text-center">Update List Sub Menu</h4>
                            <form role="form" name="sml_update_form" id="sml_update_form" method="post">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Menu<sup>*</sup><span id="menu_error"></span></label>
<!--                                            <select class="selectpicker form-control input-md" name="menu" id="menu">
                                                <option disabled value="0"><?php echo $menu;?></option>
                                            </select>-->
                                            <input type="text" name="menu" id="menu" class="form-control input-md floatlabel" placeholder="Menu" readonly value="<?php echo $menu;?>">
                                        
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Sub Menu<sup>*</sup><span id="submenu_error"></span></label>
<!--                                            <select class="selectpicker form-control input-md" name="submenu" id="submenu">
                                                <option disabled value="0"><?php echo $submenu;?></option>
                                            </select>-->
                                              <input type="text" name="submenu" id="submenu" readonly class="form-control input-md floatlabel" placeholder="Sub menu" value="<?php echo $submenu;?>">
                                      
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Title<sup>*</sup><span id='title_error'></span></label>
                                            <input type="text" name="title" id="title" class="form-control input-md floatlabel" placeholder="Title" value="<?php echo $title;?>">
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
                                            <input type="file" name="app_icon" id="app_icon" class="form-control input-md floatlabel" accept="image/*" title="Upload App Icon"/>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label>Image</label>
                                           <span><img style="width:100px;height:100px;" src="<?php echo $o_image;?>"/></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label>Icon</label>
                                           <span><img style="width:100px;height:100px;" src="<?php echo $o_icon;?>"/></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label>App Icon</label>
                                           <span><img style="width:100px;height:100px;" src="<?php echo $o_appicon;?>"/></span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="updateid" name="updateid" value="<?php echo $updateid; ?>"/>
                                <input type="hidden" id="lsm_image" name="lsm_image" value="<?php echo $o_image; ?>"/>
                                <input type="hidden" id="lsm_icon" name="lsm_icon" value="<?php echo $o_icon; ?>"/>
                                <input type="hidden" id="lsm_appicon" name="lsm_appicon" value="<?php echo $o_appicon; ?>"/>
                               <!--  <div class="append_dynamicfeilds"></div> -->
                               <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                   <!--  <div class="col-xs-6 col-sm-6 col-md-6">
                                        <a href="javascript:void(0);" class="multi_add" onclick="add_feild();"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add More</a>
                                    </div> -->
                                    <div class="col-xs-6 col-sm-6 col-md-6" id="btn_update">
                                        <div class="form-group">
                                            <a href="<?php echo SITE_ADMIN_LINK; ?>Categories/listSubMenu"><button type="button" class="btn btn-default  btn-md pull-right">Cancel</button></a>
                                            <button type="submit" class="btn btn-danger btn-md pull-right">Update</button>
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
$('#sml_update_form').on('submit',function(smle){
    smle.preventDefault();
    str=true;
    $('.display_message_class').html('');
    $('#title_error').html('');
    $('#title').css('border','');
    var title=$('#title').val().trim();
    if(title=='')
    {
        $('#title_error').text('Enter title');
        $('#title').css('border','1px solid red');
        str=false;
    }
   if(str==true){
    $('#btn_update').hide();
    $('.display_message_class').html('Please wait..').addClass('alert alert-success fade in');
      $.ajax({
                dataType:'JSON',
                method:'POST',
                data:new FormData(this),
                url:"<?php echo SITE_ADMIN_LINK; ?>Categories/updateListSubMenu",
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
                            $('.display_message_class').html(data.description).addClass('alert alert-danger fade in');$('#btn_update').show();
                       break;
                    }
                    },
                   error:function(e){console.log(e);}

                });
   }
    return str;
});
</script>
