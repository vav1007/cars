<?php
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : dashboard.php
 * Page Type             : View
 * Page Purpose         :Dashboard
 * Controller Name     : --
 * Alias                      : projectname_/superadmin
 * Designed By           : Mouli
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : Venkateswara Achari
 * Created On            : 20-04-2016
 * Modified By          : 
 * Modified On          : 
 * Extra notes            :
 * Folder Path           : views/superadmin/dashboard
 */
//echo $dashboard_statistics;
$dashboard_data=json_decode($dashboard_statistics);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Project Related Code Start -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo SUPERADMIN_TITLE; ?><?php echo $url_title; ?></title>
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
            <div class="container">
    <div class="row">
        <h2>Dashboard</h2>
    </div>
    
    <div class="row">
    <?php foreach($dashboard_data->dashboardlist as $result){ ?>
    <a href="<?php echo SITE_ADMIN_LINK.$result->link;?>">
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="<?php echo $result->classname;?>">
                <div class="shape">
                    <div class="shape-text">
                        <span class="<?php echo $result->icon;?>"></span>                            
                    </div>
                </div>
                <div class="offer-content">
                    <h3 class="lead">
                    <?php echo ucwords($result->title);?>
                    </h3>
                    <p>
                         <h3>
                         <?php $sub_res=$result->tabledetails;?>
                         <label class="label label-primary"><?php echo $d_total=$sub_res->total;?></label>
                         <label class="label label-success"><?php echo $d_active=$sub_res->active;?></label>
                         <label class="label label-danger"><?php echo $d_inactive=$sub_res->inactive;?></label>
                         </h3>
                        <br> 
                        <?php $progress=num_check($d_total)?floor(($d_active/$d_total)*100):0;?>
                        <div class="progress">
             <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress;?>%" >
                     <?php echo $progress.' %';?>
                        </div>
                   </div>
                    </p>
                </div>
            </div>
        </div>
     </a>
    <?php } ?>
    </div>
</div>
      <?php $this->load->view(ADMIN_INCLUDES_PATH . 'footer'); /* Loading the Footer*/ ?>
        <div class="clearfix"></div>
        </div>
    </body>

</html>


