var basepath;
basepath=$('#siteurl').val();
var emailpattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
var namepattern = /^[a-zA-Z]+[a-zA-Z_., ]+$/;
var mobilepattern = /^[6-9]+[0-9]{9}$/;
function addToWishList(id)
{
    if(!isNaN(id)){
        $.ajax({
            type:"POST",
            dataType:"JSON",
            data:{'id':id},
            url:basepath+'Welcome/addToWishList',
            success:function(s)
            {
                /*console.log(s);*/
              $('#common_footer_popup').modal('show');
                $('.dynamic_title').html('Wishlist');
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
                   break;
                }
                setTimeout(function(){$('#common_footer_popup').modal('hide');},4000);
            },
            error:function(e){console.log(e);}
        });
    }else{alert('invalid');}
}
$('#newsletter_form').on('submit',function(nl){
    nl.preventDefault(); str=true;
    $('#newletter_error').html('');
    $('#newsletter').css('border','');
    var newsletter=$('#newsletter').val();
    if(newsletter=='' || (newsletter.length < 13)){$('#newsletter').focus();$('#newletter_error').html('<br/>Please enter  email').css({'color':'red'});str=false;}
    if(newsletter!='' && email_check(newsletter)==0){$('#newsletter').focus();$('#newletter_error').html('<br/>Please enter valid email').css({'color':'red'});str=false;}
    if(str==true)
    {
            $.ajax({
            type:"POST",
            dataType:"JSON",
            data:{'newsletter':newsletter},
            url:basepath+'Welcome/newsLetter',
            success:function(s)
            {
                    $('#common_footer_popup').modal('show');
                    $('.dynamic_title').html('Newsletter');
                    switch(s.code)
                    {  
                        case 200:
                            $('#newsletter').val('');
                            $('.dynamic_message').html(s.description).css({'color':'green','font-height':'14px;'});
                         break;
                        case 204:
                        case 301:
                        case 422:
                        case 575:
                            $('.dynamic_message').html(s.description).css({'color':'#c92c33','font-height':'14px;'});
                       break;
                    }
                    //setTimeout(function(){$('#common_footer_popup').modal('hide');},4000);
            },
            error:function(e){console.log(e);}
        });
    }
    return str;
});
function addToCart(artid,buystatus)
{
   if(!isNaN(artid))
   {
      if(buystatus==1)
      {
          $.ajax({
            type:"POST",
            dataType:"JSON",
            data:JSON.stringify({'artid':artid,}),
            url:basepath+'Cart/addToCart',
            success:function(s)
            {
                console.log(s);
                    $('#common_footer_popup').modal('show');
                    $('.dynamic_title').html('Checkout');
                    switch(s.code)
                    {  
                        case 200:
                            $('#newsletter').val('');
                            $('.dynamic_message').html(s.description).css({'color':'green','font-height':'14px;'});
                         break;
                        case 204:
                        case 301:
                        case 422:
                        case 575:
                            $('.dynamic_message').html(s.description).css({'color':'#c92c33','font-height':'14px;'});
                       break;
                    }
                    $('#btn_checkout').show();
            },
            error:function(e){console.log(e);}
        });
      }
      else
      {
          alert('This art is not available for sale');
      }
   }
}
//increment cart qty
function incCart(cartid)
{
    var new_qty=$('#quantity'+cartid).val();
    new_qty=parseInt(new_qty)+1;
    changeCartCount(new_qty,cartid)
}
//decrement cart qty
function decCart(cartid)
{
    var new_qty=$('#quantity'+cartid).val();
    new_qty=parseInt(new_qty)-1;
    changeCartCount(new_qty,cartid)
}
function changeCartCount(count,cartid){
    if(!isNaN(count) && count > 0)
    {
        if(cartid >  0 && !isNaN(cartid))
        {
            $.ajax({
            type:"POST",
            dataType:"JSON",
            data:JSON.stringify({'cartid':cartid,'cartqty':count}),
            url:basepath+'Cart/updateCart',
            success:function(s)
            {
                console.log(s);
                  switch(s.code)
                  {
                      case 200:
                            $('#upd_cart_price'+cartid).html(s.new_cartprice);
                            $('#quantity'+cartid).val(s.new_cartcount);
                         break;
                       case 204:
                        case 301:
                        case 422:
                        case 575:
                             $('#common_footer_popup').modal('show');
                            $('.dynamic_title').html('Cart Update');
                            $('.dynamic_message').html(s.description).css({'color':'#c92c33','font-height':'14px;'});
                             setTimeout(function(){$('#common_footer_popup').modal('hide');},4000);
                       break;
                  }
            },
            error:function(e){console.log(e);}
        });
        }
    }
    else
    {
        alert('Cart quantity cannot be zero..');
    }
}
function getArtDetails(id)
{
    $('#pop2').simplePopup();
    $.ajax({
        type: "POST",
        dataType: "html",
        data: {'id': id},
        url:basepath+'Product/artPopup',
        success: function (s) {
            console.log(s);
            $('.dev_art_popup_disp').html(s);
            var ajax_art_image=$('#ajax_popup_image').val();
            $('#footer_ajax_image').attr('src',ajax_art_image);
            $('.magnify-large').css('background-image', 'url(' + ajax_art_image + ')');
        },
        error: function (e) {
            console.log(e);
        }
    });
}
/*Add Enquiry Pop up*/
function artEnquiry(id,title)
{
   $('#enquire_art_id').val(id);
   $('#enquire_art_title').html(title);
   $('#pop1').simplePopup();
    $('#enquire_name,#enquire_email,#enquire_mobile,#enquire_description').css('border','');
}
/*Send Enquiry*/
$('#enquiry_art_form').on('submit',function(e){
    e.preventDefault();
    str=true;
    $('#enquire_name_error,#enquire_email_error,#enquire_mobile_error,#enquire_description_error').html('');
    $('#enquire_name,#enquire_email,#enquire_mobile,#enquire_description').css('border','');
        var enq_name=$('#enquire_name').val().trim();
        var enq_email=$('#enquire_email').val().trim();
        var enq_mobile=$('#enquire_mobile').val().trim();
        var enq_message=$('#enquire_description').val().trim();
        var enq_id=$('#enquire_art_id').val();
        if(enq_name=='' || enq_name=='0'){$('#enquire_name').css('border','1px solid red').focus();$('#enquire_name_error').html('Please enter name');str=false;}
        if(enq_email=='' || enq_email=='0'){$('#enquire_email').css('border','1px solid red').focus();$('#enquire_email_error').html('Please enter email');str=false;}
        if (enq_email != '' && !emailpattern.test(enq_email))
        {
            $('#enquire_email').css('border', '1px solid red');
            $('#enquire_email_error').html('Please enter valid email');
            str = false;
        }
          if(enq_mobile=='' || enq_mobile=='0'){$('#enquire_mobile').css('border','1px solid red').focus();$('#enquire_mobile_error').html('Please enter mobile number');str=false;}
        if (enq_mobile != '' && !mobilepattern.test(enq_mobile))
        {
            $('#enquire_mobile').css('border', '1px solid red');
          $('#enquire_mobile_error').html('Enter 10 digit valid mobile number');
            str = false;
        }
        if(enq_message=='' || enq_message=='0'){$('#enquire_description').css('border','1px solid red').focus();$('#enquire_description_error').html('Please enter description');str=false;}
        if(enq_id=='' || enq_id=='0'){alert('Invalid');str=false;}
        if(str==true)
        {
             $('#enq_product_message').html('Please wait...').css({'color':'blue','font-weight':'bold','text-align':'center'});
             $('#enquiry_btn').hide();
                $.ajax({
                                type: "POST",
                                 dataType: "JSON",
                                data: JSON.stringify({'name': enq_name,'email':enq_email,'mobile':enq_mobile,'message':enq_message,'id':enq_id}),
                                url:basepath+'Product/sendArtEnquiry',
                                success: function (s) {
                                    console.log(s);
                                switch(s.code)
                                {
                                            case 200:
                                                 $('#enq_product_message').html(s.description).css({'color':'green','font-weight':'bold','text-align':'center'});
                                               break;
                                             case 204:
                                              case 301:
                                              case 422:
                                              case 575:
                                                  $('#enquiry_btn').show();
                                                    $('#enq_product_message').html(s.description).css({'color':'red','font-weight':'bold','text-align':'center'});
                                             break;
                                   }
                                        if(s.code=='200'){
                                        setTimeout(function(){window.location=location.href;},4000);
                                        }else{
                                        setTimeout(function(){ $('#enq_product_message').html('');$('#enquiry_art_form')[0].reset();},4000);
                                        }
                                },error:function(e){console.log(e);}
                     });
        }
        return str;
});
/*contact us form submission*/
$('#contactus_form').on('submit',function(e){
    e.preventDefault();
     $('#name,#email,#mobile,#city,#message').css('border','');
        $('#name_error,#email_error,#mobile_error,#city_error,#message_error,#c_disp_msg').text('');
        str=true;
        var name=$('#name').val().trim();
        var email=$('#email').val().trim();
        var mobile=$('#mobile').val().trim();
        var city=$('#city').val().trim();
        var message=$('#message').val().trim();
        if(name=='' || name=='0'){$('#name').css('border','1px solid red').focus();$('#name_error').html('Please enter your name');str=false;}
        if(email=='' || email=='0'){$('#email').css('border','1px solid red').focus();$('#email_error').html('Please enter your email');str=false;}
        if (email != '' && !emailpattern.test(email))
        {
            $('#email').css('border', '1px solid red');
            $('#email_error').html('Please enter valid email');
            str = false;
        }
        if(mobile=='' || mobile=='0'){$('#mobile').css('border','1px solid red').focus();$('#mobile_error').html('Please enter your mobile');str=false;}
        if (mobile != '' && !mobilepattern.test(mobile))
        {
            $('#mobile').css('border', '1px solid red');
            $('#mobile_error').text('Enter valid mobile number');
            str = false;
        }
        if (city=='')
        {
            $('#city').css('border', '1px solid red');
            $('#city_error').text('Enter your city');
            str = false;
        }
        if(message=='' || message=='0'){$('#message').css('border','1px solid red').focus();$('#message_error').html('Please enter the purpose you want to contact');str=false;}
        if(str==true)
            {  
                $('.c_submit').hide();
                $('#c_disp_msg').html('Please wait..').css({'color':'blue','font-weight':'bold'});
                    $.ajax({
                    type:"POST",
                    dataType:"JSON",
                    data:new FormData(this),
                    url:basepath+'Welcome/insertContact',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(s)
                    {
                        console.log(s);
                      //   $('#common_footer_popup').modal('show');
                        // $('.dynamic_title').html('Contactus');
                          $('#c_disp_msg').html('');
                         switch(s.code)
                         {  
                             case 200:
                                 $('#c_disp_msg').html(s.description).css({'color':'green','font-height':'14px;'});
                              break;
                             case 204:
                             case 301:
                             case 422:
                             case 575:
                                $('#c_disp_msg').html(s.description).css({'color':'#c92c33','font-height':'14px;'});
                            break;
                         }
                         setTimeout(function(){window.location=location.href;},4000);
                    },
                    error:function(e){console.log(e);}
                });
            }
            return str;
        });
        
        /*Search With artist name */
        $('#search_artist').on('change',function(){
           var artistname=$("#search_artist option:selected").text(); 
           var artistid=$("#search_artist").val(); 
           if(artistid!='' && artistname!='')
           {
                window.location=basepath+'artist/'+artistname+'/'+artistid;
            }
        });
        
      $('#search_arttype').on('change',function(){
                var arttype=$(this).val();
              if(arttype!='')
              {
                    window.location=basepath+'arttype/'+arttype;
              }
      });
      /*Shipping Form  Code */
      $('#continue_to_payment').click(function(){$('#shipping_submit').click(); });
      $('#shipping_address_form').on('submit',function(ss){
          ss.preventDefault();
          str=true;
          $('#shipping_name_error,#shipping_email_error,#shipping_mobile_error,#shipping_alt_number_error,#shipping_landmark_error,#shipping_city_error,#shipping_pincode_error,#shipping_country_error,#shipping_address_error,#payment_error').html('');
          $('#shipping_name,#shipping_email,#shipping_mobile,#shipping_alt_number,#shipping_landmark,#shipping_city,#shipping_pincode,#shipping_country,#shipping_address').css('border','');
          var shipping_name=$('#shipping_name').val().trim();
          var shipping_email=$('#shipping_email').val().trim();
          var shipping_mobile=$('#shipping_mobile').val().trim();
          var shipping_alt_number=$('#shipping_alt_number').val().trim();
          var shipping_landmark=$('#shipping_landmark').val().trim();
          var shipping_city=$('#shipping_city').val().trim();
          var shipping_pincode=$('#shipping_pincode').val().trim();
          var shipping_country=$('#shipping_country').val().trim();
          var shipping_address=$('#shipping_address').val().trim();
          var payment_selection=$('#payment_option').val().trim();
          if(payment_selection==''){$('#payment_error').html('Please choose payment options');str=false;}
          if(shipping_name==''){$('#shipping_name').focus().css('border','1px solid red');$('#shipping_name_error').html('Please enter full name');str=false;}
          if(shipping_email==''){$('#shipping_email').focus().css('border','1px solid red');$('#shipping_email_error').html('Please enter email');str=false;}
          if(shipping_mobile==''){$('#shipping_mobile').focus().css('border','1px solid red');$('#shipping_mobile_error').html('Please enter 10 digit mobile number');str=false;}
           if(shipping_landmark==''){$('#shipping_landmark').focus().css('border','1px solid red');$('#shipping_landmark_error').html('Please enter nearest landmark');str=false;}
           if(shipping_city==''){$('#shipping_city').focus().css('border','1px solid red');$('#shipping_city_error').html('Please enter city');str=false;}
           if(shipping_pincode==''){$('#shipping_pincode').focus().css('border','1px solid red');$('#shipping_pincode_error').html('Please enter pincode');str=false;}
            if(shipping_country==''){$('#shipping_country').focus().css('border','1px solid red'); $('#shipping_country_error').html('Please enter country');str=false;}
            if(shipping_address==''){$('#shipping_address').focus().css('border','1px solid red');$('#shipping_address_error').html('Please enter address');str=false;}
            if(shipping_name!='' && alphabets_check(shipping_name)==0){$('#shipping_name').focus().css('border','1px solid red');$('#shipping_name_error').html('Please valid name');str=false;}
            if(shipping_email!='' && email_check(shipping_email)==0){$('#shipping_email').focus().css('border','1px solid red');$('#shipping_email_error').html('Please enter valid email');str=false;}
            if(shipping_mobile!='' && country_std_pattern(shipping_mobile)==0){$('#shipping_mobile').focus().css('border','1px solid red');$('#shipping_mobile_error').html('Please enter valid +91-(0-9) 10 digit mobile number');str=false;}
           if(shipping_landmark!='' && alphabets_check(shipping_landmark)==0 ){$('#shipping_landmark').focus().css('border','1px solid red');$('#shipping_landmark_error').html('It allows alphabets only');str=false;}
           if(shipping_city!='' && alphabets_check(shipping_city)==0 ){$('#shipping_city').focus().css('border','1px solid red');$('#shipping_city_error').html('It allows alphabets only');str=false;}
           if(shipping_pincode==''){$('#shipping_pincode').focus().css('border','1px solid red');$('#shipping_pincode_error').html('Please enter pincode');str=false;}
           if(shipping_country!='' && alphabets_check(shipping_country)==0 ){$('#shipping_country').focus().css('border','1px solid red'); $('#shipping_country_error').html('It allows alphabets only');str=false;}
          if(str==true)
          {
              $('.hiding_button').hide();
              $('#page_submitting').show();
                   $.ajax({
                    type:"POST",
                    dataType:"JSON",
                    data:new FormData(this),
                    url:basepath+'Cart/createOrder',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(s)
                    {
                        console.log(s);
                         $('#common_footer_popup').modal('show');
                         $('.dynamic_title').html('Order');
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
                                  $('.hiding_button').show();
                                    $('#page_submitting').hide();
                                 //setTimeout(function(){$('#common_footer_popup').modal('hide');},4000);
                            break;
                         }
                         if(s.code==200)
                         {
                             window.location=s.redirection;
                         }
                    },
                    error:function(er){console.log(er);}
                    });
        }
          return str;
      });