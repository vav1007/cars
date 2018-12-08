var basepath = $('#siteurl').val();
var emailpattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
var namepattern = /^[a-zA-Z]+[a-zA-Z_., ]+$/;
var mobilepattern = /^[6-9]+[0-9]{9}$/;
$('#artist_registration_form').on('submit',function(p){
      p.preventDefault();
        str=true;
        $('#name,#email,#mobile,#city,#pro_pic,#address,#artist_works,#about_artist,#description,#artist_password').css('border','');
        $('#name_error,#email_error,#mobile_error,#city_error,#pro_pic_error,#address_error,#artist_works_error,#description_error').text('');
        var name=$('#name').val().trim();
        var email=$('#email').val().trim();
        var mobile=$('#mobile').val().trim();
        var city=$('#city').val().trim();
        var pro_pic=$('#pro_pic').val().trim();
        var address=$('#address').val().trim();
        var artist_works=$('#artist_works').val().trim();
        var description=$('#description').val().trim();
        if(name=='' || name=='0'){$('#name').css('border','1px solid red').focus();$('#name_error').html('Please enter artist name');str=false;}
        if(email=='' || email=='0'){$('#email').css('border','1px solid red').focus();$('#email_error').html('Please enter email');str=false;}
        if (email != '' && !emailpattern.test(email))
    {
        $('#email').css('border', '1px solid red');
        $('#email_error').html('Please enter valid email');
        str = false;
    }
        if(mobile=='' || mobile=='0'){$('#mobile').css('border','1px solid red').focus();$('#mobile_error').html('Please enter mobile');str=false;}
        if (mobile != '' && !mobilepattern.test(mobile))
    {
        $('#mobile').css('border', '1px solid red');
        $('#mobile_error').text('Enter valid mobile number');
        str = false;
    }
      if (city=='')
    {
        $('#city').css('border', '1px solid red');
        $('#city_error').text('Enter city');
        str = false;
    }
     if (pro_pic=='')
    {
        $('#pro_pic').css('border', '1px solid red');
        $('#pro_pic_error').text('Upload profile picture');
        str = false;
    }
     if(pro_pic!='')
    { 
        var ext = pro_pic.match(/\.(.+)$/)[1];
        validformat='';
        switch(ext)
             {
                 case 'jpg':
                 case 'jpeg':
                 case 'bmp':
                 case 'png':
                 case 'tif':
                 validformat=true;
                    break;
                 default:
                  validformat=false;
             }
        if(validformat==false)
        {
            $('#pro_pic').css('border','1px solid red');
            $('#pro_pic_error').text('Upload valid jpeg,jpg,png,bmp,tif images only');
            str=false;
        }
    }
     if (artist_works=='')
    {
        $('#artist_works').css('border', '1px solid red');
        $('#artist_works_error').text('Upload works');
        str = false;
    }
        if(address==''){$('#address').css('border','1px solid red').focus();$('#address_error').html('Please enter address');str=false;}
        if(description==''){$('#description').css('border','1px solid red').focus();$('#description_error').html('Please describe yourself');str=false;}
    if(str==true){
        $('#artist_submit').hide();
        $('#loading_message').text('Please wait while uploading..').css({'color':'green','font-size':'20px'});
        $.ajax({
                    dataType:'JSON',
                   method:'POST',
                   data:new FormData(this),
                   url:basepath+'register',
                   contentType: false,
                    cache: false,
                    processData: false,
                   success:function(s){
                        $('#common_footer_popup').modal('show');
                        $('.dynamic_title').html('Artist');
                        switch(s.code)
                        {  
                            case 200:
                                $('.dynamic_message').html(s.description).css({'color':'green','font-height':'14px;'});
                             break;
                            case 204:
                            case 301:
                            case 422:
                            case 575:
                                $('.dynamic_message').html(s.description).css({'color':'#c92c33','font-height':'14px;'});
                                 $('#artist_submit').show();
                           break;
                        }
                        setTimeout(function(){window.location=location.href;},5000);
                    },
                   error:function(e){console.log(e);}

                });
   }
        return str;
    });
$('#artist_works').on('change',function(){
    if(this.files.length>5)
        {
            $('#artist_works').css('border','1px solid red');
            $('#artist_works_error').text('You Can Upload 5 Images only');
            str=false;
        }
});
  