<?php
defined('BASEPATH') or die('Error occured while page loading');
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
                    <div class="bread col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                    <div class="bread col-lg-8 col-md-8 col-sm-8 col-xs-12 pull-right">
                        <button class="btn btn-success btn-sm statusActivate" onclick="promotionStatus(1,'feature');"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Featured</button>
                        <button class="btn btn-danger btn-sm statusActivate" onclick="promotionStatus(0,'feature');"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;Featured</button>
                        |
                        <button class="btn btn-success btn-sm statusActivate" onclick="promotionStatus(1,'latest');"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Latest</button>
                        <button class="btn btn-danger btn-sm statusActivate" onclick="promotionStatus(0,'latest');"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;Latest</button>
                        |
                        <button class="btn btn-success btn-sm statusActivate" onclick="promotionStatus(1,'bestselling');"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Best selling</button>
                        <button class="btn btn-danger btn-sm statusActivate" onclick="promotionStatus(0,'bestselling');"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;Best selling</button>
                        |
                        <button class="btn btn-success btn-sm statusActivate" onclick="activateData(1,'product');"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Active</button>
                        <button class="btn btn-danger btn-sm statusDeActivate" onclick="deActivateData(0,'product');"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;In Active</button>
                        <a href="<?php echo $create_link_url; ?>"><button class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create New</button></a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="details col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--Search Block Code Start-->
                    <form action="" method="post" id="table_form">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 details-date">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-left">
                            <select name="search_lsm" id="search_lsm" class="minimal chanagecity col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <option value="0">-- List Sub Menu--</option>
                                <?php
                                                $listsubmenu_req = json_decode($listsubmenu_details);
                                                if ($listsubmenu_req->code == SUCCESS_CODE) {
                                                    foreach ($listsubmenu_req->submenu_result as $listsubmenu_response) {
                                                        ?>
                                                        <optgroup label="<?php echo $listsubmenu_response->submenu; ?>">
                                                            <?php foreach ($listsubmenu_response->listsubmenu_result as $lsm_response) { ?>
                                                                <option value="<?php echo $lsm_response->id; ?>"><?php echo fetch_ucwords($lsm_response->title); ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                        <?php
                                                    }
                                                }
                                                ?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-left">
                            <select name="search_activation" id="search_activation" class="minimal chanagecity col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <option value="">--Choose Status--</option>
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2" name="search_name" id="search_name" autocomplete="off" maxlength="60"/>
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-left search">
                            <button type="submit" id="table_submit" class="btn btn-success btn-md">Search</button>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-left search">
                            <a class="btn btn-primary" href="<?php echo current_url(); ?>"><i class="fa fa-refresh" aria-hidden="true"></i></a>
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
                               $request=  json_decode($product_details);
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
                                    <th>Sub Menu</th>
                                    <th>List Sub Menu</th>
                                    <th>Price Details (in Rs)</th>
                                    <th>Work Image</th>
                                    <th>Status</th>
                                    <th>Product Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--Listing The Data table-->
                                <?php
                                $colspan=11;
                                if($request->code==SUCCESS_CODE){
                                    foreach($request->product_result as $response){
                                        $LSM_title=isset($response->listsubmenu)?$response->listsubmenu:'--';
                                        $prod_title=!empty($response->productname)?$response->productname:'--';
                                        $price=!empty($response->mrp)?$response->mrp:'-';
                                        $offerprice=!empty($response->sellingprice)?$response->sellingprice:'-';
                                        $frameprice=!empty($response->frameprice)?$response->frameprice:'-';
                                        $totalprice=!empty($response->totalprice)?$response->totalprice." /-":'-';
                                        $year=!empty($response->year)?" & ".$response->year:'';
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="multiple[]" value="<?php echo $response->id;  ?>"/>&nbsp;&nbsp;<?php echo $response->productcode; ?></td>
                                    
                                    <td><?php echo fetch_ucfirst($prod_title); ?></td>
                                     <td><?php echo fetch_ucfirst($response->submenuname); ?></td>
                                    <td><?php echo fetch_ucfirst($LSM_title); ?></td>
                                    
                                    <td>
                                        Price : <?php echo fetch_ucfirst($price); ?><br/>
                                        Offer Price : <?php echo fetch_ucfirst($offerprice); ?><br/>
                                        
                                    </td>
                                   <?php $update_link=SITE_ADMIN_LINK.'Product/updateProduct/'?>
                                    <td><img src="<?php echo  $response->product_image; ?>" style="height:50px;width:50px;"/></td>
                                    <td style="font-weight:bold;text-align:center;color:<?php echo ($response->status==1) ?'green':'red'; ?>"><?php echo fetch_ucfirst($response->activationstatus); ?></td>
                                    <td>
                                        <b>Featured Status :</b> <?php echo ($response->featured ==  1)?'Yes':'No'; ?><br/>
                                        <b>Latest Status :</b> <?php echo ($response->latest ==  1)?'Yes':'No'; ?><br/>
                                        <b>Best Selling Status :</b> <?php echo ($response->bestselling ==  1)?'Yes':'No'; ?><br/> 
                                    </td>
                                    <td>
                                    <!-- <a href="<?php echo $update_link; ?><?php echo base64_encode($response->id); ?>" class="btn btn-primary btn-md"><i class="fa fa-edit" aria-hidden="true"></i> Update</a> -->
                                    <a href="javascript:void(0);" onclick="alert('Coming Soon..!')" class="btn btn-primary btn-md"><i class="fa fa-edit" aria-hidden="true"></i> Update</a>
                                    </td>
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
<script type="text/javascript">
$('#search_lsm,#search_activation').on('change',function(){
    $('#table_submit').click();
});
</script>
<script type="text/javascript">
function addToPopular(s,t){productPopular(s,t);}
function removeFromPopular(s,t){productPopular(s,t);}
 function productPopular(s,t)
 {
     $('.statusDisable').prop('disabled',true);
     var data_array=new Array();
    $('input[name="multiple[]"]:checked').each(function(){data_array.push($(this).val());});
    var checklist=""+data_array;
         $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'status':s,'inputdata':checklist},
             url:'<?php echo SITE_ADMIN_LINK;?>Product/popularStatus',
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

 function promotionStatus(s,t)
 {
    $('.statusActivate').prop('disabled',true);
     var data_array=new Array();
    $('input[name="multiple[]"]:checked').each(function(){data_array.push($(this).val());});
    var checklist=""+data_array;
         $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'status':s,'promotion':t,'inputdata':checklist},
             url:'<?php echo SITE_ADMIN_LINK;?>Product/promotionStatus',
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
</script>
