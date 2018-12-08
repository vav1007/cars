<?php
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : update.php
 * Page Type             : View
 * Page Purpose         :  Update Show
 * Controller Name     :  superadmin/Other/artist/details
 * Alias                      : projectname_/superadmin/Other/artist/details/(show)/(showid)
 * Designed By           : 
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : Venkateswara Achari
 * Created On            : 12-05-2016
 * Modified By          : 
 * Modified On          : 
 * Extra notes            :
 * Folder Path           : views/superadmin/artist/update.php
 */
//echo $artists_works_details;
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
                            <h4 class="text-left">Upload Works</h4>
                            <form role="form" name="works_form" id="works_form" method="post">
                            <?php  $show_id=  $this->uri->segment(5);
                                   $artist_id=  $this->uri->segment(6);
                            ?>
                            <input type="hidden" id="work_showid" name="work_showid" value="<?php echo $show_id;?>"/>
                            <input type="hidden" id="work_artistid" name="work_artistid" value="<?php echo $artist_id;?>"/>
                                <div class="row">
                                       <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Image<sup>*</sup><span id='worksimage_error'></span></label>
                                                <input type="file" name="worksimage[]" id="worksimage" class="form-control input-md floatlabel" title="Upload works"/>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Description<sup></sup></label>
                                                <textarea name="worksdescription[]" id="worksdescription" class="form-control input-md floatlabel" rows="5" cols="10" title="Enter description" placeholder="Enter description"></textarea>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                       <div class="col-xs-6 col-sm-6 col-md-6">
                                               <div class="form-group">
                                                <label>Title<sup></sup><span id="work_name_error"></span></label>
                                                <input type="text" name="work_name" id="work_name" class="form-control input-md floatlabel" placeholder="Title" title="Enter Title" autocomplete="off" maxlength="60"/>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Size<sup></sup><span id="work_size_error"></span></label>
                                                <input type="text" name="work_size" id="work_size" class="form-control input-md floatlabel" placeholder="Size" title="Enter Size" autocomplete="off" maxlength="20"/>
                                            </div>
                                        </div>
                                </div>
                               <div class="row">
                                       <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Medium<sup></sup><span id='work_medium_error'></span></label>
                                                <input type="text" name="work_medium" id="work_medium" class="form-control input-md floatlabel" placeholder="Medium" title="Enter Medium" autocomplete="off" maxlength="20"/>
                                            </div>
                                        </div>
                               </div>
                                <!-- <div class="append_dynamicfeilds"></div> -->
                                <div class="row">

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                         <div class="form-group">
                                        <!-- <a href="javascript:void(0);" class="multi_add" onclick="add_feild();"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add More</a> -->
                                        </div>
                                    </div>
                                   
                                   <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <a href="<?php echo current_url(); ?>"><button type="button" class="btn btn-default  btn-md pull-right">Reset</button></a>
                                            <button type="submit" class="btn btn-danger btn-md pull-right">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="info col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" >
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Size</th>
                                    <th>Medium</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <!--Listing The Data table-->
                                <?php
                                $colspan=8;
                                $request=json_decode($artists_works_details);
                                if($request->code==SUCCESS_CODE){
                                    foreach($request->works_result as $response){
                                        $id=$response->id;
                                ?>
                                <tr>
                                    <td><?php echo $response->title; ?></td>
                                    <td><img style="width:100px;height: 100px;" src="<?php echo $response->workimages;?>"/></td>
                                    <td><?php echo $response->description; ?></td>
                                    <td><?php echo $response->size; ?></td>
                                    <td><?php echo $response->medium; ?></td>
                                </tr>
                                <?php } }  ?>
                                <tr>
                                    <td colspan="<?php echo $colspan; ?>" style="align:center;font-weight:bold;text-align:center;color:<?php echo ($request->code==SUCCESS_CODE) ?'green':'red'; ?>"><?php echo $request->description; ?></td>
                                    
                                </tr>
                                <!--Listing The Data table end-->
                            </tbody>
                        </table>
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
        var dynamic_list='';
        dynamic_list+='<div><hr/><div class="row">';
        dynamic_list+='<div class="col-xs-6 col-sm-6 col-md-6"><div class="form-group">';
        dynamic_list+='<input type="file" name="worksimage[]" id="worksimage" class="form-control input-md floatlabel" title="Upload works"/>';
        dynamic_list+='</div></div>';
        //second 
        dynamic_list+='<div class="col-xs-6 col-sm-6 col-md-6"><div class="form-group">';
        dynamic_list+='<textarea name="worksdescription[]" id="worksdescription" class="form-control input-md floatlabel" rows="5" cols="10" title="Enter description" placeholder="Enter description"></textarea>';
        dynamic_list+='</div></div>';
        dynamic_list+='</div><a href="javascript:void(0);" class="multi_remove" ><i class="fa fa-times" aria-hidden="true"></i> Remove</a></div>';
        $(dynamic_list).appendTo(".append_dynamicfeilds");
    }
    /*removing the text feild*/
    $('.append_dynamicfeilds').on('click', '.multi_remove', function () {
        $(this).parent("div").remove();
    });
</script>
<script type="text/javascript">
    $('#works_form').on('submit', function (p) {
        p.preventDefault();
        str=true;
        var worksimage=$('#worksimage').val();
        if(worksimage=='')
        {
            $('#worksimage').css('border','1px solid red');
            $('#worksimage_error').text('Upload your work');
            str=false;
        }
        if(str==true)
        {
          $.ajax({
            type:"POST",
            dataType:"JSON",
            data : new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            url:"<?php echo SITE_ADMIN_LINK; ?>Other/updateArtistWorks",
            success:function(data){
                   console.log(data);
                    switch(data.code)
                {
                    case 200:
                     $('.display_message_class').html(data.description).addClass('alert alert-success fade in');
                        setTimeout(function(){window.location=location.href; },3000);
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