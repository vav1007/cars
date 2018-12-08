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
                            <h4 class="text-left">Create Product</h4>
                            <form role="form" name="product_form" id="product_form" method="post">
                            <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Sub Menu<sup>*</sup><span id="submenu_error"></span></label>
                                            <select class="selectpicker form-control input-md" name="submenu" id="submenu">
                                                <option value="">--Choose Sub Menu--</option>
                                                <?php
                                                $submenu_req = json_decode($submenu_details);
                                                if ($submenu_req->code == SUCCESS_CODE) {
                                                    foreach ($submenu_req->menu_result as $submenu_response) {
                                                        ?>
                                                        <optgroup label="<?php echo $submenu_response->menu; ?>">
                                                            <?php foreach ($submenu_response->submenu_result as $sm_response) { ?>
                                                                <option value="<?php echo $sm_response->id; ?>"><?php echo fetch_ucwords($sm_response->title); ?></option>
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
                                            <label>List Sub Menu<sup></sup><span id="listsubmenu_error"></span></label>
                                            <select class="selectpicker form-control input-md" name="listsubmenu" id="listsubmenu">
                                                <option value="">--Choose--</option>
                                           
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Title<sup>*</sup><span id="product_name_error"></span></label>
                                            <input type="text" name="product_name" id="product_name" class="form-control input-md floatlabel" placeholder="Title" title="Enter Product Name" autocomplete="off" maxlength="80"/>
                                        </div>
                                    </div>
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Product Code<sup>*</sup><span id="product_code_error"></span></label>
                                            <input type="text" name="product_code" id="product_code" class="form-control input-md floatlabel" placeholder="Product Code" title="Enter Product Code" autocomplete="off" maxlength="30"/>
                                        </div>
                                    </div>
                                    
                                </div>
                                 
                              
                                <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Brand<sup>*</sup><span id='brand_error'></span></label>
                                            <select class="selectpicker form-control input-md" name="brand" id="brand">
                                                <option value="0">Choose Brand</option>
                                                <?php 
                                                $brand_req=json_decode($brand_details);
                                                if($brand_req->code == 200){
                                                    foreach($brand_req->brands as $brand_res){ ?>
                                                        <option value="<?php echo $brand_res->brandid; ?>"><?php echo ucfirst($brand_res->brand); ?></option>
                                                   <?php  }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Type<sup>*</sup><span id='productype_error'></span></label>
                                            <select class="selectpicker form-control input-md" name="productype" id="productype">
                                            <option value="0">Choose Type</option>
                                                <?php 
                                                $type_req=json_decode($type_details);
                                                if($type_req->code == 200){
                                                    foreach($type_req->producttypes as $type_res){ ?>
                                                        <option value="<?php echo $type_res->typeid; ?>"><?php echo ucfirst($type_res->producttype); ?></option>
                                                   <?php  }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Model<sup>*</sup><span id='model_error'></span></label>
                                            <select class="selectpicker form-control input-md" name="model" id="model">
                                                <option value="0">Choose Model</option>
                                                <?php 
                                                $model_req=json_decode($model_details);
                                                if($model_req->code == 200){
                                                    foreach($model_req->models as $model_res){ ?>
                                                        <option value="<?php echo $model_res->modelid; ?>"><?php echo ucfirst($model_res->model); ?></option>
                                                   <?php  }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Color<sup>*</sup><span id='color_error'></span></label>
                                            <select class="selectpicker form-control input-md" name="color" id="color">
                                            <option value="0">Choose Color</option>
                                                <?php 
                                                $color_req=json_decode($color_details);
                                                if($color_req->code == 200){
                                                    foreach($color_req->colors as $color_res){ ?>
                                                        <option value="<?php echo $color_res->colorid; ?>"><?php echo ucfirst($color_res->color); ?></option>
                                                   <?php  }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Shape<sup>*</sup><span id='shape_error'></span></label>
                                            <select class="selectpicker form-control input-md" name="shape" id="shape">
                                            <option value="0">Choose Shape</option>
                                                <?php 
                                                $shape_req=json_decode($shape_details);
                                                if($shape_req->code == 200){
                                                    foreach($shape_req->shapes as $shape_res){ ?>
                                                        <option value="<?php echo $shape_res->shapeid; ?>"><?php echo ucfirst($shape_res->shape); ?></option>
                                                   <?php  }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>MRP<sup>*</sup><span id="mrp_error"></span></label>
                                            <input type="text" name="mrp" id="mrp" class="form-control input-md floatlabel price_class" placeholder="Price" title="Enter Price" autocomplete="off" maxlength="10"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Selling Price<sup>*</sup><span id="sellingprice_error"></span></label>
                                            <input type="text" name="sellingprice" id="sellingprice" class="form-control input-md floatlabel price_class" placeholder="Offer price" title="Enter Offer Price" autocomplete="off" maxlength="10"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Stock<sup>*</sup><span id="stock_error"></span></label>
                                            <input type="text" name="stock" id="stock" class="form-control input-md floatlabel price_class" placeholder="Available Stock" title="Enter available stock" autocomplete="off" maxlength="5"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Deliver Days<sup>*</sup><span id="deliverdays_error"></span></label>
                                            <input type="text" name="deliverdays" id="deliverdays" class="form-control input-md floatlabel price_class" placeholder="Deliver days (2 days)" title="Enter Deliver days" autocomplete="off" maxlength="2"/>
                                        </div>
                                    </div>
                                   
                                    
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Description<sup>*</sup><span id="description_error"></span></label>
                                            <textarea name="description" id="description" class="form-control input-md floatlabel" placeholder="Description :: " title="Enter Description" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Search Keywords (Enter with comma separated)<sup></sup></label>
                                            <textarea name="search_keywords" id="search_keywords" class="form-control input-md floatlabel" placeholder="Search keywords (Enter with , separated) " title="Enter Search keywords (Enter with , separated)" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Product Status<sup></sup></label>
                                            <select class="selectpicker form-control input-md" name="product_status" id="product_status">
                                                <option value="1">Active</option>
                                                <option value="0">In-Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Customisation<sup></sup></label>
                                            <select class="selectpicker form-control input-md" name="customisation" id="customisation">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
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
                                            <button type="submit" class="btn btn-danger btn-md pull-right">Submit</button>
                                            </span>
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
        $('#product_code,#submenu,#product_name,#mrp,#sellingprice,#description,#productimage,#productimage_multiple').css('border','');
        $('#productype,#brand,#model,#color,#shape').css('border','');
        $('#product_code_error,#submenu_error,#product_name_error,#productype_error,#brand_error,#model_error,#color_error,#shape_error,#mrp_error,#sellingprice_error,#description_error,#productimage_error').text('');
       
        var productcode=$('#product_code').val().trim();
        var submenu=$('#submenu').val().trim();
        var product_name=$('#product_name').val().trim();
        var productype=$('#productype').val().trim();
        var brand=$('#brand').val().trim();
        var model=$('#model').val().trim();
        var color=$('#color').val().trim();
        var shape=$('#shape').val().trim();
        var mrp=$('#mrp').val().trim();
        var sellingprice=$('#sellingprice').val().trim();
        var description=$('#description').val().trim();
        var productimage=$('#productimage').val().trim();
        
        
        if(productcode=='' || productcode==0){$('#product_code').css('border','1px solid red').focus();$('#product_code_error').html('Please enter product code');str=false;}
        if(submenu=='' || submenu=='0'){$('#submenu').css('border','1px solid red').focus();$('#submenu_error').html('Please choose sub menu');str=false;}
        //if(listsubmenu=='' || listsubmenu=='0'){$('#listsubmenu').css('border','1px solid red').focus();$('#listsubmenu_error').html('Please choose list sub menu');str=false;}
        if(product_name=='' || product_name=='0'){$('#product_name').css('border','1px solid red').focus();$('#product_name_error').html('Please enter product name');str=false;}
        if(productype=='' || productype=='0'){$('#productype').css('border','1px solid red').focus();$('#productype_error').html('Please choose product type');str=false;}
        if(brand=='' || brand=='0'){$('#brand').css('border','1px solid red').focus();$('#brand_error').html('Please choose brand');str=false;}
        if(model=='' || model=='0'){$('#model').css('border','1px solid red').focus();$('#model_error').html('Please choose model');str=false;}
        if(color=='' || color=='0'){$('#color').css('border','1px solid red').focus();$('#color_error').html('Please choose color');str=false;}
       // if(shape=='' || shape=='0'){$('#shape').css('border','1px solid red').focus();$('#shape_error').html('Please choose shape');str=false;}
        if(mrp=='' || mrp=='0'){$('#mrp').css('border','1px solid red').focus();$('#mrp_error').html('Please enter price');str=false;}
         if(sellingprice=='' || sellingprice=='0'){$('#sellingprice').css('border','1px solid red').focus();$('#sellingprice_error').html('Please enter offer price');str=false;}
        
        if(description=='' || description=='0'){$('#description').css('border','1px solid red').focus();$('#description_error').html('Please enter product description');str=false;}
        if(productimage=='' || productimage=='0'){$('#productimage').css('border','1px solid red').focus();$('#productimage_error').html('Please upload product image');str=false;}
        if(productimage!='' && image_validate(productimage)==0){$('#productimage').css('border','1px solid red');$('#productimage_error').html('It allows Jpeg,jpg,png files only');str=false;}
        if(str==true){
                  $('.form_loading_hide').hide();
                  $('.form_loading_show').show();
      $.ajax({
                    dataType:'JSON',
                   method:'POST',
                   data:new FormData(this),
                   url:"<?php echo SITE_ADMIN_LINK; ?>Product/insertProduct",
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
/*getting list sub menu based on sub menu on change*/
$('#submenu').on('change',function(e){
e.preventDefault();
var submenu=$(this).val();
    if(!isNaN(submenu))
    {
        $.ajax({
                    dataType:'html',
                   method:'POST',
                   data:{'submenu':submenu},
                   url:"<?php echo SITE_ADMIN_LINK; ?>Product/subListmenuDetails",
                   success:function(data){
                       console.log(data);
                    $('#listsubmenu').html(data);
                    },
                   error:function(e){console.log(e);}

                });
    }
});
</script>