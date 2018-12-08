<?php
//echo $show_details;
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : product_list.php
 * Page Type             : View
 * Page Purpose         :  Listing the Products
 * Controller Name     :  superadmin/Product/index
 * Alias                      : projectname_/superadmin/Product/
 * Designed By           : 
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : Venkateswara Achari
 * Created On            : 25-04-2016
 * Modified By          : 
 * Modified On          : 
 * Extra notes            :
 * Folder Path           : views/superadmin/product/product_list
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
        <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS_PATH; ?>jquery.datetimepicker.css"/>
        <link href="<?php echo ADMIN_CSS_PATH; ?>custom.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMIN_CSS_PATH; ?>responsive.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMIN_CSS_PATH; ?>font-awesome.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php $this->load->view(ADMIN_INCLUDES_PATH . 'header'); /* Loading the Login Header */ ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                    <div class="bread col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                    <div class="bread col-lg-5 col-md-5 col-sm-5 col-xs-12 pull-right">
                        <button class="btn btn-success btn-md statusActivate" onclick="activateData(1,'shows');"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Active</button>
                        <button class="btn btn-warning btn-md statusDeActivate" onclick="deActivateData(0,'shows');"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;In Active</button>
                        <a href="<?php echo $create_link_url; ?>"><button class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create New</button></a>
                        <button class="btn btn-danger btn-md statusDisable" onclick="deleteData(5, 'shows');" ><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="details col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--Search Block Code Start-->
                    <form action="" method="post" id="table_form">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 details-date">
                      
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-left">
                            <select name="search_activation" id="search_activation" class="minimal chanagecity col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <option value="">--Choose Status--</option>
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-left search">
                            <div class="input-group">
                                <input type="text" class="form-control showdates" placeholder="Select from date" aria-describedby="basic-addon2" name="search_fromdate" id="search_fromdate" autocomplete="off" maxlength="60"/>
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-left search">
                            <div class="input-group">
                                <input type="text" class="form-control showdates" placeholder="Select to date" aria-describedby="basic-addon2" name="search_todate" id="search_todate" autocomplete="off" maxlength="60"/>
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 pull-left search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Artist name" aria-describedby="basic-addon2" name="search_name" id="search_name" autocomplete="off" maxlength="60"/>
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-left search">
                            <button type="submit" id="table_submit" class="btn btn-success btn-md">Search</button>
                        </div>
                         <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-left search">
                             <a href="<?php echo current_url(); ?>" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        </div> 
                    </div>
                    </form>
                    <!--Search Block Code End-->
                    <div class="clearfix"></div>
                    <!--Display messges Block Code Start-->
                    <div class="display_message_class"> </div>
                    <!--Display messges Block Code End-->
                    <div class="info col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <?php 
                               $request=  json_decode($show_details);
                                if($request->code==SUCCESS_CODE){
                                    $statisticks_result=$request->statistics;
                                ?>
                                <tr>
                                    <td>Statistics :</td>
                                    <td>Total : <?php echo $statisticks_result->total; ?></td>
                                    <td>Active :  <?php echo $statisticks_result->active; ?></td>
                                    <td>In-active : <?php echo $statisticks_result->inactive; ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th><input type="checkbox" class="multi_select" />&nbsp;&nbsp;Select  All</th>
                                    <th>Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Venue</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--Listing The Data table-->
                                <?php
                                $colspan=9;
                                if($request->code==SUCCESS_CODE){
                                    foreach($request->shows_result as $response){
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="multiple[]" value="<?php echo $response->id;  ?>"/></td>
                                    <td><?php echo fetch_ucfirst($response->name); ?></td>
                                    <td><?php echo $response->startdate; ?></td>
                                    <td><?php echo $response->enddate; ?></td>
                                    <td> <?php echo fetch_ucfirst($response->address); ?></td>
                                    <td><?php echo fetch_ucfirst($response->description); ?></td>
                                    <td style="font-weight:bold;text-align:center;color:<?php echo ($response->status==1) ?'green':'red'; ?>"><?php echo fetch_ucfirst($response->status_message); ?></td>
                                    <td><a href="<?php echo SITE_ADMIN_LINK; ?>Other/shows/details/<?php echo urlencode($response->name); ?>/<?php echo $response->id; ?>"  class="btn btn-primary btn-md"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                    <div class="clearfix">&nbsp;</div>
                                    <a href="<?php echo SITE_ADMIN_LINK; ?>Other/shows/viewartists/<?php echo urlencode($response->name); ?>/<?php echo $response->id; ?>"  class="btn btn-primary btn-md"><i class="fa fa-search" aria-hidden="true"></i> View Artists</a></td>
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
<script type="text/javascript" src="<?php echo ADMIN_JS_PATH; ?>jquery.datetimepicker.full.js"></script>
<script>
$.datetimepicker.setLocale('en');
var currentTime = new Date();
var extendDate = new Date(currentTime.getFullYear(),currentTime.getMonth() +1,currentTime.getDate());
$('.showdates').datetimepicker({format:"d-m-Y"}).css({'color':'#000'});
</script>

<script type="text/javascript">
$('#search_activation').on('change',function(){
    $('#table_submit').click();
});
</script>

<script type="text/javascript">
    function deleteShows()
    {
        var con=confirm('Are you sure to delete??');
        if(con==true)
        {
            var del_array=new Array();
            $('input[name="multiple[]"]:checked').each(function(){del_array.push($(this).val());});
            var deletelist=""+del_array;
             $('.statusDisable').prop('disabled',true);
             $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'deletelist':deletelist},
             url:'<?php echo SITE_ADMIN_LINK;?>Cms/deleteShow',
             success:function(w){
                 console.log(w);
                  switch(w.code)
                    {
                        case 200:
                            $('.display_message_class').html(w.description).addClass('alert alert-success fade in');
                            break;
                        case 204:
                        case 301:
                        case 422:
                        case 575:
                         $('.display_message_class').html(w.description).addClass('alert alert-danger fade in');
                            break;
                    }
                 setTimeout(function(){window.location=location.href;},3000);
             },
              error:function(e){console.log(e);$('.display_message_class').html(e).addClass('alert alert-warning fade in');}
         });
        }
    }
</script>

