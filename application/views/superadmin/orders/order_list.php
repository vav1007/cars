<?php
//echo $show_details;
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
                        <!-- <button class="btn btn-success btn-md statusActivate" onclick="activateData(1,'shows');"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Active</button>
                        <button class="btn btn-warning btn-md statusDeActivate" onclick="deActivateData(0,'shows');"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;In Active</button> -->
                        <!-- <a href="<?php echo $create_link_url; ?>"><button class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create New</button></a> -->
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-left search">
                            <a href="<?php echo SITE_ADMIN_LINK; ?>Orders"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        </div> 
                        <button class="btn btn-danger btn-md" onclick="alert('Coming Soon')" ><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="details col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--Search Block Code Start-->
                    <form action="" method="post" id="table_form">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 details-date">
                      
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-left">
                            <select name="search_activation" id="search_activation" class="minimal chanagecity col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <option value="">Order Status</option>
                                <option value="0">New</option>
                                <option value="1">Approved</option>
                                <option value="2">Dispatched</option>
                                <option value="3">Cancelled</option>
                                <option value="4">Returned</option>
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
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-left search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search by order number" aria-describedby="basic-addon2" name="search_name" id="search_name" autocomplete="off" maxlength="60"/>
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-left search">
                            <button type="submit" id="table_submit" class="btn btn-success btn-md">Search</button>
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
                               // echo $order_details;exit;
                               $request=  json_decode($order_details);
                                if($request->code==SUCCESS_CODE){
                                    $statisticks_result=$request->statistics;
                                ?>
                                <tr>
                                    <td>Statistics :</td>
                                    <td>Total : <?php echo $statisticks_result->total; ?></td>
                                    <td>New : <?php echo $statisticks_result->placed; ?></td>
                                    <td>Approved : <?php echo $statisticks_result->approved; ?></td>
                                    <td>Dispatched : <?php echo $statisticks_result->dispatched; ?></td>
                                    <td>Cancelled : <?php echo $statisticks_result->cancelled; ?></td>
                                    <td>Returned : <?php echo $statisticks_result->returned; ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th><input type="checkbox" class="multi_select" />&nbsp;&nbsp;Select  All</th>
                                    <th>Order ID</th>
                                    <th>Price</th>
                                    <th>Order Date & Time</th>
                                    <th>Address</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--Listing The Data table-->
                                <?php
                                $colspan=9;
                                if($request->code==500){
                                    foreach($request->order_result as $response){
                                        $order_id=$response->id;
                                        switch ($response->status)
                                            {
                                                case 0 :$orderstatusmessage="<strong style='color:orange;'>Order Placed</strong>";break;
                                                case 1 :$orderstatusmessage="<strong style='color:violet;'>Approved </strong>";break;
                                                case 2 :$orderstatusmessage="<strong style='color:green;'>Dispatched</strong>";break;
                                                case 3 :$orderstatusmessage="<strong style='color:red;'>Cancelled</strong>";break;
                                                case 4 :$orderstatusmessage="<strong style='color:blue;'>Returned</strong>";break;
                                            }
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="multiple[]" value="<?php echo $order_id;  ?>"/></td>
                                    <td><?php echo $response->ord_number; ?></td>
                                    <td><?php echo "Rs. ".$response->totalprice; ?></td>
                                    <td><?php echo $response->createddate; ?></td>
                                    <td><?php echo ucwords($response->address); ?></td>
                                    <td><?php echo $orderstatusmessage;?></td>
                                    <td><?php if($response->status==0){ ?> <a href="<?php echo SITE_ADMIN_LINK;?>Orders/approveOrder/<?php echo $order_id; ?>">Confirm Order</a><?php }?></td>
                                </tr>
                                <?php } }  ?>
                                <tr>
                                    <td colspan="<?php echo $colspan; ?>" style="align:center;font-weight:bold;text-align:center;color:<?php echo ($request->code==SUCCESS_CODE) ?'green':'red'; ?>">No results found</td>
                                    
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

