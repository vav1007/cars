<?php
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
//echo $result_details;
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
          

.card {
    padding-top: 20px;
    margin: 10px 0 20px 0;
    background-color: rgba(214, 224, 226, 0.2);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card .card-heading {
    padding: 0 20px;
    margin: 0;
}

.card .card-heading.simple {
    font-size: 20px;
    font-weight: 300;
    color: #777;
    border-bottom: 1px solid #e5e5e5;
}

.card .card-heading.image img {
    display: inline-block;
    width: 46px;
    height: 46px;
    margin-right: 15px;
    vertical-align: top;
    border: 0;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}

.card .card-heading.image .card-heading-header {
    display: inline-block;
    vertical-align: top;
}

.card .card-heading.image .card-heading-header h3 {
    margin: 0;
    font-size: 14px;
    line-height: 16px;
    color: #262626;
}

.card .card-heading.image .card-heading-header span {
    font-size: 12px;
    color: #999999;
}

.card .card-body {
    padding: 0 20px;
    margin-top: 20px;
}

.card .card-media {
    padding: 0 20px;
    margin: 0 -14px;
}

.card .card-media img {
    max-width: 100%;
    max-height: 100%;
}

.card .card-actions {
    min-height: 30px;
    padding: 0 20px 20px 20px;
    margin: 20px 0 0 0;
}

.card .card-comments {
    padding: 20px;
    margin: 0;
    background-color: #f8f8f8;
}

.card .card-comments .comments-collapse-toggle {
    padding: 0;
    margin: 0 20px 12px 20px;
}

.card .card-comments .comments-collapse-toggle a,
.card .card-comments .comments-collapse-toggle span {
    padding-right: 5px;
    overflow: hidden;
    font-size: 12px;
    color: #999;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.card-comments .media-heading {
    font-size: 13px;
    font-weight: bold;
}

.card.people {
    position: relative;
    display: inline-block;
    width: 170px;
    height: 300px;
    padding-top: 0;
    margin-left: 20px;
    overflow: hidden;
    vertical-align: top;
}

.card.people:first-child {
    margin-left: 0;
}

.card.people .card-top {
    position: absolute;
    top: 0;
    left: 0;
    display: inline-block;
    width: 170px;
    height: 150px;
    background-color: #ffffff;
}

.card.people .card-top.green {
    background-color: #53a93f;
}

.card.people .card-top.blue {
    background-color: #427fed;
}

.card.people .card-info {
    position: absolute;
    top: 150px;
    display: inline-block;
    width: 100%;
    height: 101px;
    overflow: hidden;
    background: #ffffff;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card.people .card-info .title {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 16px;
    font-weight: bold;
    line-height: 18px;
    color: #404040;
}

.card.people .card-info .desc {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 12px;
    line-height: 16px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.people .card-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    display: inline-block;
    width: 100%;
    padding: 10px 20px;
    line-height: 29px;
    text-align: center;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: rgba(214, 224, 226, 0.2);
}

.card.hovercard .cardheader {
    background: url("http://lorempixel.com/850/280/nature/4/");
    background-size: cover;
    height: 135px;
}

.card.hovercard .avatar {
    position: relative;
    top: -50px;
    margin-bottom: -50px;
}

.card.hovercard .avatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.5);
}

.card.hovercard .info {
    padding: 4px 8px 10px;
}

.card.hovercard .info .title {
    margin-bottom: 4px;
    font-size: 24px;
    line-height: 1;
    color: #262626;
    vertical-align: middle;
}

.card.hovercard .info .desc {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
    margin-top: 17px;
}


        </style>
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
                        <button class="btn btn-success btn-md statusActivate" onclick="activateData(1, 'artists');"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Active</button>
                        <button class="btn btn-warning btn-md statusDeActivate" onclick="deActivateData(0, 'artists');"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;In Active</button>
                        <a href="<?php echo $create_link_url; ?>"><button class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create New</button></a>
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
                                <a href="<?php echo current_url(); ?>"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </form>
                    <!--Search Block Code End-->
                    <div class="clearfix"></div>
                    <!--Display messges Block Code Start-->
                    <div class="display_message_class"> </div>
                    <!--Display messges Block Code End-->
                    <div class="info col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="checkbox" class="multi_select" />Select All
                        <div class="row">
                            <?php
                            $request = json_decode($result_details);
                            if ($request->code == SUCCESS_CODE) {
                                $statisticks_result = $request->statistics;
                                foreach ($request->artist_result as $response) {
                                    ?>
                                   
                                        <div class="col-lg-3 col-sm-6">

                                            <div class="card hovercard">
                                                <div class="cardheader">

                                                </div>
                                                <div class="avatar">
                                                    <img alt="" src="<?php echo base_url().UPLOADS.'artist/profilepic/'.$response->profilepic; ?>">
                                                    <i class="fa fa-circle text-right" aria-hidden="true" style="font-size:16px;color:green;float: right;margin-top: 91px;margin-right: 5px;font-size:16px;color:<?php echo ($response->status==1) ?'green':'red'; ?>"></i>
                                                </div>
                                                
                                                <div class="info">
                                                    <div class="title">
                                                        <a target="_blank" href=""><?php echo fetch_ucfirst($response->name); ?></a>
                                                    </div>
                                                    <div class="desc"><?php echo $response->email; ?></div>
                                                    <div class="desc"><?php echo $response->mobile; ?></div>
                                                    <div class="desc"><?php echo $response->city; ?></div>
                                                    <?php if($response->createdrole==1){?>
                                                    <div class="desc"><?php echo 'Created from Front-end'; ?></div>
                                                    <a href="<?php echo SITE_ADMIN_LINK;?>Other/artistWorks/<?php echo $response->id;?>">View Works </a> 
                                                    <?php } ?>
                                                </div>
                                                <div class="bottom" >
                                                    <div class="btn-group" data-toggle="buttons">
			
			<label>
				<input type="checkbox" name="multiple[]" value="<?php echo $response->id;  ?>">
				<!-- <span class="glyphicon glyphicon-ok"></span> -->
			</label>			
	
		</div>
                                                    <a class="btn btn-success  btn-sm" href="<?php echo $update_link; ?><?php echo urlencode($response->name); ?>/<?php echo base64_encode($response->id); ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" href="">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    
                                                      <b style="float:right;padding-top:5px;color:<?php echo ($response->status==1) ?'green':'red'; ?>;"> <?php echo ($response->status==1) ?'Active':'In-active'; ?></b>
                                                    
                                                </div>
                                            </div>

                                        </div>

                                  
                                <?php }
                            } ?>

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
    $('#search_lsm,#search_activation').on('change', function () {
        $('#table_submit').click();
    });
</script>

