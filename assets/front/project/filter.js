var basepath = $('#siteurl').val();
$('.hagfilter').on('change',function(){
    frontfilters();
});
$('.filter_hag').on('click',function(){
    frontfilters();
});
$('.well').on('click',function(){
     frontfilters();
});
function frontfilters()
{
    str=true;
    var sortprice=$('#sortprice').val();
    /*artists*/
    var artists_array=new Array();
    $('input[name="artists"]:checked').each(function(){artists_array.push($(this).val());});
    var artists_list=''+artists_array;
    /*artists end*/
    /*price*/
    var price=$('#sl2').val();
    /*price end*/
     searchData = {
          "sortprice": sortprice,
          "artists": artists_list,
          "price":price,
          "url":location.href,
    };
    if (str == true)
        {
            $.ajax({
                dataType: 'html',
                type: 'post',
                data: searchData,
                url: basepath + 'Product/productfilters',
                success: function (data) {
                    $('#ajax_view').html('');
                    $('#ajax_view').html(data);
                    console.log(data);
                },
                error: function (error) {
                    console.log(error)
                }
            });
        }

}