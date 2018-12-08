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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 details-date" >
                       
                        

                    </div>
                    <!--Search Block Code End-->
                    <div class="clearfix"></div>
                    <!--Display messges Block Code Start-->
                    <div class="display_message_class"></div>
                    <!--Display messges Block Code End-->
                    <form action="" id="assignPaintsToShow" method="post" enctype="multipart/form-data" >
                    <div class="info col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php 
                   //print_r($search_details);
                    ?>
                        <input type="hidden" name="paint_artist_id" id="paint_artist_id" value="<?php echo $search_details['search_artist_id']; ?>"/>
                        <input type="hidden" name="paint_show_id" id="paint_show_id" value="<?php echo $search_details['search_show_id']; ?>"/>
                        <table class="table table-bordered">
                        <tr align="center">
                            <th><input type="checkbox" id="paintAllSelect" value="1" />Select All</th>
                            <th>Art Image</th>
                            <th>Art Name</th>
                            <th>Art Price</th>

                        </tr>
                        <?php $paint_req = json_decode($artist_works);
                if($paint_req->code == SUCCESS_CODE){
                    $psno=1;
                  foreach($paint_req->paint_result as $paint_res){
                         ?>
                            <tr>
                            <td>
                            <input type="hidden" name="artPrice[]" id="artPrice<?php echo $paint_res->paint_id; ?>" value="<?php echo $paint_res->show_price; ?>">
                            <?php echo $psno; ?><input type="checkbox" name="assignToShow[]" id="assign_to_show<?php echo $paint_res->paint_id; ?>" value="<?php echo $paint_res->paint_id; ?>"></td>
                            <td><img src="<?php echo $paint_res->product_image; ?>" style="height:80px;width:80px;"></td>
                            <td>Product Code :  <?php echo $paint_res->product_code; ?>
                                Product Name : <?php echo $paint_res->productname; ?>
                            </td>
                            <td>Rs. <?php echo $paint_res->show_price; ?></td>
                            </tr>
                            <?php $psno++; } ?>
                            <tr>
                            <td colspan="3">
                            <div class=" text-center paint_error_message"></div>
                            </td>
                            <td colspan="1" align="right"><button type="submit" id="paint_submit" class="btn btn-success">Assign</button></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    </form>
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
    // Submit for  : for assinging the paint to the show bassed on the artist id
$('#assignPaintsToShow').on('submit',function(k){
    k.preventDefault();
    str=true;
    var selected_artist_id =  $('#paint_artist_id').val();
    var selected_show_id =  $('#paint_show_id').val();
    var selected_paint_count = 0;
   
    if(str==true)
    {
            $('#paint_submit').hide();
            $('.paint_error_message').html('Please wait..').css({'color':'blue'});
            $.ajax({
            type:"POST",
            dataType:"JSON",
            data : new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            url:"<?php echo SITE_ADMIN_LINK; ?>Other/assignArtsToShow",
            success:function(data){ console.log(data)

                   switch(data.code)
                {
                    case 200:
                     $('.paint_error_message').html(data.description).addClass('alert alert-success fade in');
                        setTimeout(function(){window.location=location.href; },3000);
                     break;
                    case 204:
                    case 301:
                    case 422:
                    case 575:
                     $('#paint_submit').show();
                        $('.paint_error_message').html(data.description).addClass('alert alert-danger fade in');
                   break;
                }

            },
            error:function(er){console.log(er);}
        });
    }
    return str;
});
</script>