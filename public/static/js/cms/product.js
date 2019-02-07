$(document).on("click", "#product_submit", function() {
    var category_id = $("#category_id").val();
    var parent_id = $("#parent_id").val();
    var name = $("#name").val();
    var price = $("#price").val();
    var price_sale = $("#price_sale").val();


    if(category_id == '')
    {
        $("#category_id").focus();
        showMsg('Vui lòng chọn danh mục!');
        return false;
    }
    else{
        $("#message_show").html('');
    }

    if(name == '')
    {
        $("#name").focus();
        showMsg('Vui lòng nhập tên sản phẩm!');
        return false;
    }
    else{
        $("#message_show").html('');
    }
    if(price == '')
    {
        $("#price").focus();
        showMsg('Vui lòng nhập giá sản phẩm!');
        return false;
    }
    else{
        $("#message_show").html('');
    }
        if(price_sale == '')
    {
        $("#price_sale").focus();
        showMsg('Vui lòng nhập giá bán sản phẩm!');
        return false;
    }
    else{
        $("#message_show").html('');
    }

});