$(document).ready(function(){
    $('.products-loader').hide();
    //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
});

$('.panel-body').on('click','.page-item > a.page-link',function(e){
    e.preventDefault();
    url = $(this).attr('href');
    per_page = $('#js_per_page').val();
    search = $('#js_search_value').val();
    sort_field = $('#sort_field').val();
    sort_type = $('#sort_type').val();
    $('.products-loader').show();
    $.get(url,{'per_page':per_page, 'search':search,'sort_field':sort_field,'sort_type':sort_type}, function(data){
        $("#js_tbody").html(data.html);
        $('.products-loader').hide();
    });
});

$('.panel-body').on('click','#js_search_button',function(e){
    e.preventDefault();
    url = $("#my_form").attr('action');
    per_page = $('#js_per_page').val();
    search = $('#js_search_value').val();
    sort_field = $('#sort_field').val();
    sort_type = $('#sort_type').val();
    $('.products-loader').show();
    $.get(url,{'per_page':per_page, 'search':search,'sort_field':sort_field,'sort_type':sort_type}, function(data){
        $("#js_tbody").html(data.html);
        $('.products-loader').hide();
    });
});

$('.panel-body').on('change','#js_per_page',function(e){
    e.preventDefault();
    $("#js_search_button").trigger("click");
});

$('.panel-body').on('click','.js_sort',function(e){
    e.preventDefault();
    var t = $(this);
    sort_field  = $(this).attr('field_name');
    sort_type   = $(this).attr('type');

    $('#sort_field').val(sort_field);
    $('#sort_type').val(sort_type);
    if(sort_type == 'asc'){
        t.attr('type','desc');
    }else{
        t.attr('type','asc');
    }
    $("#js_search_button").trigger("click");
});
