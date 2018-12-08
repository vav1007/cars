var basepath,steps_loading_image;
var name_alpha_pattern=/^[a-zA-Z]+[a-zA-Z ]+$/;
var namepattern = /^[a-zA-Z]+[a-zA-Z_., ]+$/;
var name_num_pattern=/^[a-zA-Z0-9 ]+$/;
var name_spl_pattern=/^[a-zA-Z]+[a-zA-Z_.,@&! ]+$/;
var emailpattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
var passwordpattern=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
var mobilepattern = /^[6-9]+[0-9]{9}$/;
var pincodepatteren=/^[0-9]{6}$/;
var numberpattern=/^[0-9]+$/;
var landlinepattern=/^[0-9]\d{2,4}-\d{6,8}$/;
var national_std_pattern=/^[+0-9]+-[6-9]+[0-9]{9}$/;
function ucFirst(string) { return string.substring(0, 1).toUpperCase() + string.substring(1).toLowerCase(); }
function email_check(inputdata) { if(inputdata==''){ return 0; } if(inputdata!='' && !emailpattern.test(inputdata)) { return 0; } }
function mobile_check(inputdata) { if(inputdata==''){return 0;} if(inputdata!='' && !mobilepattern.test(inputdata)) { return 0;}}
function country_std_pattern(inputdata) { if(inputdata==''){return 0;} if(inputdata!='' && !national_std_pattern.test(inputdata)) { return 0;}}
function pincode_check(inputdata) { if(inputdata==''){return 0;} if(inputdata!='' && !pincodepatteren.test(inputdata)) { return 0; }  }
function empty_check(inputdata){ if(inputdata==''){return 0;}  }
function name_check(inputdata){ if(inputdata==''){return 0;}  }
function alphabets_check(inputdata){ if(inputdata==''){ return 0; } if(inputdata!='' && !name_alpha_pattern.test(inputdata)) { return 0; } }
function alphanumeric_check(inputdata){ if(inputdata==''){ return 0; } if(inputdata!='' && !name_num_pattern.test(inputdata)) { return 0; } }
function alpha_splchars_check(inputdata){ if(inputdata==''){ return 0; } if(inputdata!='' && !name_spl_pattern.test(inputdata)) { return 0; } }
function number_check(inputdata){ if(inputdata==''){ return 0; } if(inputdata!='' && !numberpattern.test(inputdata)) { return 0; } }
function landline_check(inputdata){ if(inputdata==''){ return 0; } if(inputdata!='' && !landlinepattern.test(inputdata)) { return 0; } }
$('.number_class').on('keyup',function(){(isNaN($(this).val()))?$(this).val(''):'';});
$('.mobile_class').on('keyup',function(){ var mobile=$(this).val(); (isNaN(mobile) && (mobile[0] > 6))?$(this).val(''):''; });
$('.price_class').on('keyup',function(){ var price=$(this).val(); (isNaN(price))?$(this).val(''):''; });
function image_validate(image)
{
    var ext = image.match(/\.(.+)$/)[1];
    ext=ext.toLowerCase();
    validformat='';
    switch(ext) 
    {
        case 'jpg': case 'jpeg': case 'bmp': case 'png': case 'tif': case 'gif':
        validformat=1; break;
        default: validformat=0; 
    }
    return validformat;
}



 


