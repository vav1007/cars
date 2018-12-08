<?php
defined('BASEPATH') or die('Error occured while page loading');
/*
 * Page Name            : update.php
 * Page Type             : View
 * Page Purpose         :  Update Product
 * Controller Name     :  superadmin/Product/updateProduct
 * Alias                      : projectname_/superadmin/Product/updateProduct
 * Designed By           : 
 * Designed On           : --
 * Design Completed On  : --
 * Created By            : kavitha
 * Created On            : 13-05-2016
 * Modified By          : 
 * Modified On          : 
 * Extra notes            :
 * Folder Path           : views/superadmin/product/update
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
                            <h4 class="text-left">Update Product</h4>
                            <form role="form" name="product_form" id="product_form" method="post">
                            <?php $pro_data=json_decode($product_details);
                            if($pro_data->code==200){
                                $pro_res=$pro_data->product_details_res;
                                $artistid=$pro_res->artistid;
                                $lsmid=$pro_res->lsmid;
                                $promotionstatus=$pro_res->promotionstatus;
                                $prodstatus=$pro_res->prodstatus;
                                $size=$pro_res->size;
                            ?>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Artist<sup>*</sup><span id="artist_error"></span></label>
                                            <select class=" form-control input-md" name="artist" id="artist">
                                                <option value="">--Choose Artist--</option>
                                                <?php
                                                $artist_req = json_decode($artist_details);
                                                if ($artist_req->code == SUCCESS_CODE) {
                                                    foreach ($artist_req->artist_list as $artist_response) {
                                                        ?>
                                                <option value="<?php echo $artist_response->id;  ?>" <?php if($artistid==($artist_response->id)) {echo "selected";}?>><?php echo fetch_ucwords($artist_response->name); ?></option>
                                                        <?php  }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Product Code<sup>*</sup><span id="product_code_error"></span></label>
                                            <input type="text" readonly name="product_code" id="product_code" class="form-control input-md floatlabel" placeholder="Product Code" title="Enter Product Code" autocomplete="off" maxlength="30" value="<?php echo $pro_res->productcode;?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>List Sub Menu<sup>*</sup><span id="listsubmenu_error"></span></label>
                                            <select class="selectpicker form-control input-md" name="listsubmenu" id="listsubmenu">
                                                <option value="">--Choose List Sub Menu--</option>
                                                <?php
                                                $listsubmenu_req = json_decode($listsubmenu_details);
                                                if ($listsubmenu_req->code == SUCCESS_CODE) {
                                                    foreach ($listsubmenu_req->submenu_result as $listsubmenu_response) {
                                                        ?>
                                                       <optgroup label="<?php echo $listsubmenu_response->submenu; ?>"> 
                                                            <?php foreach ($listsubmenu_response->listsubmenu_result as $lsm_response) { ?>
                                                                <option value="<?php echo $lsm_response->id; ?>" <?php if($lsmid==$lsm_response->id){echo "selected";}?>><?php echo fetch_ucwords($lsm_response->title); ?></option>
                                                            <?php } ?>
                                                     </optgroup> 
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Title<sup>*</sup><span id="product_name_error"></span></label>
                                            <input type="text" name="product_name" id="product_name" class="form-control input-md floatlabel" placeholder="Title" title="Enter Product Name" autocomplete="off" maxlength="80" value="<?php echo $pro_res->productname;?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Medium<sup>*</sup><span id='medium_error'></span></label>
                                            <input type="text" name="medium" id="medium" class="form-control input-md floatlabel" placeholder="medium" title="medium" maxlength="60" autocomplete="off" value="<?php echo $pro_res->medium;?>"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Year<sup>*</sup><span id='year_error'></span></label>
                                            <input type="text" name="year" id="year" class="form-control input-md floatlabel number_class" placeholder="year" title="year" maxlength="4" autocomplete="off" value="<?php echo $pro_res->year;?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Size<sup>*</sup><span id="size_error"></span></label>
                                            <select class="selectpicker form-control input-md" name="size" id="size">
                                                <option value="">--Choose Size--</option>
                                                <?php
                                                $size_req = json_decode($size_details);
                                                if ($size_req->code == SUCCESS_CODE) {
                                                    foreach ($size_req->size_result as $size_response) {
                                                        ?>
                                                        <option value="<?php echo $size_response->id; ?>" <?php if($size==$size_response->id){ echo "selected";}?>><?php echo fetch_ucwords($size_response->title); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Quantity<sup>*</sup><span id="quantity_error"></span></label>
                                            <input type="text" name="quantity" id="quantity" class="form-control input-md floatlabel number_class" placeholder="Available quantity" title="Enter available quantity" autocomplete="off" maxlength="5" value="<?php echo $pro_res->quantity;?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Price<sup>*</sup><span id="mrp_error"></span></label>
                                            <input type="text" name="mrp" id="mrp" class="form-control input-md floatlabel price_class" placeholder="Price" title="Enter Price" autocomplete="off" maxlength="10" value="<?php echo $pro_res->mrp;?>"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Offer Price<sup>*</sup><span id="sellingprice_error"></span></label>
                                            <input type="text" name="sellingprice" id="sellingprice" class="form-control input-md floatlabel price_class" placeholder="Offer price" title="Enter Offer Price" autocomplete="off" maxlength="10" value="<?php echo $pro_res->sellingprice;?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Frame Price<sup>*</sup><span id="frameprice_error"></span></label>
                                            <input type="text" name="frameprice" id="frameprice" class="form-control input-md floatlabel price_class" placeholder="Frame price" title="Enter Frame Price" autocomplete="off" maxlength="10" value="<?php echo $pro_res->frameprice;?>"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Total Price<sup>*</sup></label>
                                            <input readonly type="text"  id="totalprice" class="form-control input-md floatlabel price_class" placeholder="Total price" />
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Description<sup>*</sup><span id="description_error"></span></label>
                                            <textarea name="description" id="description" class="form-control input-md floatlabel" placeholder="Description :: " title="Enter Description" ><?php echo $pro_res->description;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Search Keywords (Enter with comma separated)<sup></sup></label>
                                            <textarea name="search_keywords" id="search_keywords" class="form-control input-md floatlabel" placeholder="Search keywords (Enter with , separated) " title="Enter Search keywords (Enter with , separated)" ><?php echo $pro_res->keywords;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Product Promotion<sup></sup></label>
                                            <select class="selectpicker form-control input-md" name="product_promotion" id="product_promotion">
                                                <option value="0">--Choose Promotion--</option>
                                                <?php
                                                $promotion_req = json_decode($promotion_details);
                                                if ($promotion_req->code == SUCCESS_CODE) {
                                                    foreach ($promotion_req->promotion_result as $promotion_response) {
                                                        ?>
                                                        <option value="<?php echo $promotion_response->id; ?>" <?php if($promotionstatus==($promotion_response->id)){ echo "selected";}?>><?php echo fetch_ucwords($promotion_response->title); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Product Status<sup></sup></label>
                                            <select class="selectpicker form-control input-md" name="product_status" id="product_status">
                                                <option value="0">--Choose Product Status--</option>
                                                <?php
                                                $status_req = json_decode($prostatus_details);
                                                if ($status_req->code == SUCCESS_CODE) {
                                                    foreach ($status_req->productstatus_result as $status_response) {
                                                        ?>
                                                        <option value="<?php echo $status_response->id; ?>" <?php if($prodstatus==($status_response->id)){ echo "selected";}?>><?php echo fetch_ucwords($status_response->title); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Upload Image (Size : _ _ * _ _)<sup>*</sup><span id="productimage_error"></span></label>
                                            <input type="file" name="productimage" id="productimage" class="form-control input-md floatlabel" accept="image/*"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Upload Multiple Image (Size : _ _ * _ _)<sup></sup><span id="productimage_multiple_error"></span></label>
                                            <input type="file" name="productimage_multiple[]" id="productimage_multiple" class="form-control input-md floatlabel" accept="image/*" multiple/>
                                        </div>
                                    </div>
                                </div>
                              <div class="row">
                                  <div class="col-xs-6 col-sm-6 col-md-6" id="disp_main_imgae">
                                            
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6" id="disp_multiple_image">
                                        
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                      
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <span class="form_loading_show" style="display:none;color:blue;font-weight:bold;"><img src="<?php echo SUPERADMIN_LOADING_IMAGE; ?>"/> Please wait uploading...</span>
                                            <span class="form_loading_hide">
                                            <button type="reset" class="btn btn-default  btn-md pull-right">Reset</button>
                                            <button type="submit" class="btn btn-danger btn-md pull-right">Update</button>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" id="updateid" name="updateid" value="<?php echo $pro_res->id;?>">
                                    <input type="hidden" id="old_mainimage" name="old_mainimage" value="<?php echo $pro_res->mainimage;?>">
                                </div>
                            <h4>Product Images</h4>
                        <div class="row">
                            
                            <div class='list-group gallery'>
                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                    <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo $pro_res->mainimage; ?>" />
                                        <img class="img-responsive" alt="" src="<?php echo $pro_res->mainimage; ?>" style="height:280px;width:320px;"/>
                                        <div class='text-right'>
                                            <i class="fa fa-trash" style="color:red;font-size:20px;"></i>
                                            
                                        </div> <!-- text-right / end -->
                                    </a>
                                </div> <!-- col-6 / end -->
                                <?php
                                $multi_images_res=$pro_res->otherimages;
                                $res_array=explode(",",$multi_images_res);
                                $count=count($res_array);
                                if($count > 0){ 
                                    for($i=0;$i<$count;$i++){
                                    ?>
                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                    <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo $res_array[$i];?>">
                                        <img class="img-responsive" alt="" src="<?php echo $res_array[$i];?>" style="height:280px;width:320px;"/>
                                        <div class='text-right'>
                                           <i class="fa fa-trash" style="color:red;font-size:20px;"></i>
                                        </div> <!-- text-right / end -->
                                    </a>
                                </div> 
                                <!-- col-6 / end -->
                                <?php } }  ?>
                                
                                
                               
                            </div> <!-- list-group / end -->
                        </div> <!-- row / end -->
                                <?php } else { ?>
                                <div style="color:red;font-size: 12px;text-align: center;">No data found</div>
                                <?php } ?>
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
    $('#mrp').on('keyup',function(){ $('#sellingprice').val($(this).val()); });
    $('#mrp,#frameprice,#sellingprice').on('keyup',function(){
        var frameprice=parseInt($('#frameprice').val());
        var offerprice=parseInt($('#sellingprice').val());
        frameprice=(frameprice > 0)?frameprice:0;
        offerprice=(offerprice > 0)?offerprice:0;
        var totalprice='';
            if((frameprice > 0) && (offerprice > 0))
            {
                totalprice=(frameprice+offerprice);
                $('#totalprice').val(totalprice);
            } else {
                $('#totalprice').val('');
            }
    });
</script>
 <script language="javascript" type="text/javascript">
     $("#productimage").change(function () {
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
            $("#productimage_multiple").change(function () {
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
    $('#product_form').on('submit', function (p) {
        p.preventDefault();
        str=true;
        $('#artist,#product_code,#listsubmenu,#product_name,#medium,#year,#size,#quantity,#mrp,#sellingprice,#frameprice,#description,#productimage,#productimage_multiple').css('border','');
        $('#artist_error,#product_code_error,#listsubmenu_error,#product_name_error,#medium_error,#year_error,#size_error,#quantity_error,#mrp_error,#sellingprice_error,#frameprice_error,#description_error,#productimage_error').text('');
        var artist=$('#artist').val().trim();
        var productcode=$('#product_code').val().trim();
        var listsubmenu=$('#listsubmenu').val().trim();
        var product_name=$('#product_name').val().trim();
        var medium=$('#medium').val().trim();
        var year=$('#year').val().trim();
        var size=$('#size').val().trim();
        var quantity=$('#quantity').val().trim();
        var mrp=$('#mrp').val().trim();
        var sellingprice=$('#sellingprice').val().trim();
        var frameprice=$('#frameprice').val().trim();
        var description=$('#description').val().trim();
        var productimage=$('#productimage').val().trim();
        
        if(artist=='' || artist==0){$('#artist').css('border','1px solid red').focus();$('#artist_error').html('Please choose artist');str=false;}
        if(productcode=='' || productcode==0){$('#product_code').css('border','1px solid red').focus();$('#product_code_error').html('Please enter product code');str=false;}
        if(listsubmenu=='' || listsubmenu=='0'){$('#listsubmenu').css('border','1px solid red').focus();$('#listsubmenu_error').html('Please choose list sub menu');str=false;}
        if(product_name=='' || product_name=='0'){$('#product_name').css('border','1px solid red').focus();$('#product_name_error').html('Please enter product name');str=false;}
        if(medium=='' || medium=='0'){$('#medium').css('border','1px solid red').focus();$('#medium_error').html('Please medium details');str=false;}
        if(year=='' || year=='0'){$('#year').css('border','1px solid red').focus();$('#year_error').html('Please enter year');str=false;}
        if(size=='' || size=='0'){$('#size').css('border','1px solid red').focus();$('#size_error').html('Please choose size');str=false;}
        if(quantity==''){$('#quantity').css('border','1px solid red').focus();$('#quantity_error').html('Please enter product qty');str=false;}
        if(mrp=='' || mrp=='0'){$('#mrp').css('border','1px solid red').focus();$('#mrp_error').html('Please enter price');str=false;}
        if(sellingprice=='' || sellingprice=='0'){$('#sellingprice').css('border','1px solid red').focus();$('#sellingprice_error').html('Please enter offer price');str=false;}
        if(frameprice=='' || frameprice=='0'){$('#frameprice').css('border','1px solid red').focus();$('#frameprice_error').html('Please enter frame price');str=false;}
        if(description=='' || description=='0'){$('#description').css('border','1px solid red').focus();$('#description_error').html('Please enter product description');str=false;}
        // if(productimage=='' || productimage=='0'){$('#productimage').css('border','1px solid red').focus();$('#productimage_error').html('Please upload product image');str=false;}
        // if(productimage!='' && image_validate(productimage)==0){$('#productimage').css('border','1px solid red');$('#productimage_error').html('It allows Jpeg,jpg,png files only');str=false;}
        if(str==true){
             $('.form_loading_hide').hide();
                    $('.form_loading_show').show();
      $.ajax({
                    dataType:'JSON',
                   method:'POST',
                   data:new FormData(this),
                   url:"<?php echo SITE_ADMIN_LINK; ?>Product/updateProductData",
                   contentType: false,
                    cache: false,
                    processData: false,
                   success:function(data){
                       console.log(data);
                        switch(data.code)
                    {
                        case 200:
                            $('.form_loading_show').hide();
                         $('.display_message_class').html(data.description).addClass('alert alert-success fade in');
                            setTimeout(function(){window.location='<?php echo $link_url; ?>'; },3000);
                         break;
                        case 204:
                        case 301:
                        case 422:
                        case 575:
                            $('.display_message_class').html(data.description).addClass('alert alert-danger fade in');
                            $('.form_loading_hide').show();
                            $('.form_loading_show').hide();
                       break;
                    }
                    },
                   error:function(e){console.log(e);}

                });
   }
        return str;
    });
</script>