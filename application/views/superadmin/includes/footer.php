<footer>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="container-fluid">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-left ft-left">
                    <a href="<?php echo base_url(); ?>"><?php echo SITE_DOMAIN; ?></a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right ft-right text-right">
                    <p>Developed By&nbsp;:&nbsp;<a href="<?php echo DEVELOPED_LINK;  ?>" target="_new"><?php echo DEVELOPED_BY;  ?></a></p>
                </div>
            </div>
             <div class="clearfix"></div>
        </div>
         <div class="clearfix"></div>
    </footer>
<!--successfull message-->
<!-- jQuery -->
<script src="<?php echo ADMIN_JS_PATH; ?>jquery.js"></script>
<script src="<?php echo ADMIN_JS_PATH; ?>jquery.min.js"></script>
 <!-- Bootstrap Core JavaScript -->
<script src="<?php echo ADMIN_JS_PATH; ?>bootstrap.js"></script>
<script src="<?php echo PROJECT_COMMON_JS_PATH; ?>"></script>
<script src="<?php echo COMMON_VALIDATION_JS_PATH; ?>"></script>

<script type="text/javascript" src="<?php echo ADMIN_JS_PATH; ?>jquery.smartmenus.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS_PATH; ?>jquery.smartmenus.bootstrap.js"></script>
<script type="text/javascript">
$.fn.serializeObject = function() { var o = {}; var a = this.serializeArray();
$.each(a, function() { if (o[this.name] !== undefined) { if (!o[this.name].push) { o[this.name] = [o[this.name]]; }
o[this.name].push(this.value || ''); } else { o[this.name] = this.value || ''; } }); return o;
};
/*For removing the input values validations on change condition*/
$('.input-md').on('blur', function () { var entrydata = $(this).val().trim(); var id = $(this).attr('id'); if (entrydata != '') { $(this).css('border', ''); $('#' + id + '_error').html(''); } });
</script>
<script type="text/javascript">
$('.multi_select').click(function () { if ($('.multi_select').is(':checked')) { $('.multi_select').prop('checked', true);  $('[name="multiple[]"]').prop('checked', true);  } else {  $('.multi_select').prop('checked', false); $('[name="multiple[]"]').prop('checked', false);   }  });
function activateData(s,t){updateStatus(s,t);}
function deActivateData(s,t){updateStatus(s,t);}
function deleteData(s,t){ if(confirm('confirm to delete')){ updateStatus(s,t);}}
function updateStatus(s,t)
{
    var data_array=new Array();
    $('input[name="multiple[]"]:checked').each(function(){data_array.push($(this).val());});
    var checklist=""+data_array;
    if(!isNaN(s) && (s=='1' || s=='0' || s=='5') && checklist!='')
    {
        $('.statusDisable').prop('disabled',true);
         $.ajax({
             dataType:'JSON',
             method:'POST',
             data:JSON.stringify({'table':t,'status':s,'inputdata':checklist}),
             url:'<?php echo SITE_ADMIN_LINK;?>Welcome/dataActivationStatus',
             success:function(w){
                 console.log(w);
                    switch(w.code)
                    {
                        case 200:
                            $('.display_message_class').html(w.description).addClass('alert alert-success fade in');
                            break;
                        case 204:
                        case 301:
                        case 422:
                        case 575:
                         $('.display_message_class').html(w.description).addClass('alert alert-danger fade in');
                            break;
                    }
                 setTimeout(function(){window.location=location.href;},3000);
             },
              error:function(e){console.log(e);$('.display_message_class').html(e).addClass('alert alert-warning fade in');}
         });
    }
    else
      {
            $('.display_message_class').html('* Please choose atleast one checkbox').addClass('alert alert-warning fade in');
            setTimeout(function(){$('.display_message_class').html('').removeClass('alert alert-warning fade in');},2000);
       }
}
/*Submenu List with Menu in ajax*/
$('#menu').on('change',function(){
    var menu=$(this).val();
    if(menu > 0 && !isNaN(menu)) {
        $('#submenu').html('');
        $.ajax({
            dataType:'html',
            method:'POST',
            data:{'menu':menu},
            url:'<?php echo SITE_ADMIN_LINK; ?>Welcome/submenuWithMenu',
            success:function(ss){
                $('#submenu').html(ss);
            },
            error:function(se){
                console.log(se);
            }
        });
    }
});
</script>