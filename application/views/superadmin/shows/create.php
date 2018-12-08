<?php
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : create.php
 * Page Type             : View
 * Page Purpose         :  Create Artist
 * Controller Name     :  superadmin/Other/artist/Create
 * Alias                      : projectname_/superadmin/Other/artist/Create
 * Designed By           : 
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : Venkateswara Achari
 * Created On            : 25-04-2016
 * Modified By          : 
 * Modified On          : 
 * Extra notes            :
 * Folder Path           : views/superadmin/artist/create.php
 */
//echo $artist_details;
$artist_data=json_decode($artist_details);
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
                            <h4 class="text-left">Create Show</h4>
                            <form role="form" name="show_form" id="show_form" method="post">
                                
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Title<sup>*</sup><span id="showtitle_error"></span></label>
                                            <input type="text" name="showtitle" id="showtitle" class="form-control input-md floatlabel" placeholder="Show title" title="Show title" maxlength="60" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                     <div class="form-group">
                                            <label>Artist List<sup>*</sup><span id="artistname_error"></span></label>
                                            <div class="clearfix">&nbsp;</div>
                                            <?php foreach($artist_data->artist_list as $art_res){
                                                $art_id=$art_res->id;
                                                $art_name=$art_res->name;?>
                                            <input type="checkbox"  name="artistname[]" id="artistname<?php echo $art_id;?>" value="<?php echo $art_id;?>"/>&nbsp;<?php echo $art_name;?>
                                            <?php } ?>
                                    </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Start Date<sup>*</sup><span id="startdate_error"></span></label>
                                            <input class="form-control date" type="text" name="startdate" id="startdate" placeholder="Start time" title="Start time" autocomplete="off" />
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>End date<sup>*</sup><span id="enddate_errror"></span></label>
                                            
                                            <input class="form-control date" type="text" name="enddate" id="enddate" placeholder="End date" title="End date" autocomplete="off" />
                                          </div>
                                    </div>
                                </div>
                                <div class="row">
                                       <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Description<sup></sup><span id='description_error'></span></label>
                                                <textarea name="description" id="description" class="form-control input-md floatlabel" placeholder="Description" title="Description" rows="4" cols="10" autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Venue<sup></sup><span id="address_error"></span></label>
                                            <textarea name="address" id="address" class="form-control input-md floatlabel" placeholder="Address :: " title="Enter Address" rows="4" cols="10" ></textarea>
                                        </div>
                                        </div>
                                </div>
                                 <div class="row">
                                       <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Show Image<sup></sup><span id='image_error'></span></label>
                                                <input type="file" name="showimage" id="showimage" class="form-control input-md floatlabel" title="Upload image"/>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                   <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <button type="reset" class="btn btn-default  btn-md pull-right">Reset</button>
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

    </body>

</html>
<script type="text/javascript" src="<?php echo ADMIN_JS_PATH; ?>jquery.datetimepicker.full.js"></script>
<script>
$.datetimepicker.setLocale('en');
var currentTime = new Date();
var extendDate = new Date(currentTime.getFullYear(),currentTime.getMonth() +1,currentTime.getDate());
$('.date').datetimepicker({value:new Date(),minDate: new Date(),maxDate:extendDate,format:"d-m-Y H:i:s",minTime:'10',pickTime:true, timepicker: true,}).css({'color':'#000'});
</script>
<script type="text/javascript">
    $('#product_name').blur(function () {
        $('#search_keywords').val($(this).val() + ',');
    });
    /*Adding the text feild*/
    function add_feild()
    {
        $('<div class="row"><div class="col-xs-6 col-sm-6 col-md-6"><div class="form-group"><input type="text" name="title[]" id="title" class="form-control input-md floatlabel" placeholder="Title"><a href="javascript:void(0);" class="multi_remove" ><i class="fa fa-times" aria-hidden="true"></i> Remove</a> </div></div></div>').appendTo(".append_dynamicfeilds");
    }
    /*removing the text feild*/
    $('.append_dynamicfeilds').on('click', '.multi_remove', function () {
        $(this).parent("div").remove();
    });
</script>
 <script language="javascript" type="text/javascript">
     $("#profilepicture").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#disp_main_imgae");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:120px;width: 150px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        $(function () {
            $("#works_multiple").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#disp_multiple_image");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:120px;width: 150px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });
    </script>
<script type="text/javascript">
    $('#show_form').on('submit', function (p) {
        p.preventDefault();
        str=true;
        var showtitle=$('#showtitle').val();
        var showtitle_err=V1_funEmptyCheck(showtitle);
        if(showtitle_err!=''){$('#showtitle_error').html('Enter show title');}
           else{$('#showtitle_error').html('');}
        var artist_array=new Array();
        $('input[name="artistname[]"]:checked').each(function(){artist_array.push($(this).val());});
        var artistlist=""+artist_array;
        var artist_err=V1_funEmptyCheck(artistlist);
        if(artist_err!=''){$('#artistname_error').html('Choose atleast one artist');}
           else{$('#artistname_error').html('');}
        var startdate=$('#startdate').val();
        var startdate_err=V1_funEmptyCheck(startdate);
        if(startdate_err!=''){$('#startdate_error').html('select start date');}
           else{$('#startdate_error').html('');}
        var enddate=$('#enddate').val();
        var enddate_err=V1_funEmptyCheck(enddate);
        if(enddate_err!=''){$('#enddate_errror').html('select end date');}
           else{$('#enddate_errror').html('');}
        if(showtitle_err!='' || artist_err!='' || startdate_err!='' || enddate_err!=''){
        str=false;
       }
        var showimage=$('#showimage').val().trim();
   //     if(showimage=='' || showimage=='0'){$('#showimage').css('border','1px solid red').focus();$('#image_error').html('Please upload show image');str=false;}
        if(showimage!='' && image_validate(showimage)==0){$('#showimage').css('border','1px solid red');$('#image_error').html('It allows Jpeg,jpg,png files only');str=false;}
       if(str==true)
       {
          $.ajax({
            type:"POST",
            dataType:"JSON",
            data : new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            url:"<?php echo SITE_ADMIN_LINK; ?>Other/insertShow",
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