$(document).ready(function(){
    $(".type-select #type").change(function(){
        var type = $(this).val();
        if (type == '') {
            return false;
        }
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: CURRENT_PATH + 'ajax_getcategory?type='+type,
            data: "ajax",
            async: true,
            success: function(data){
                if (data.success == true) {
                    $("#parent_id").html(data.html);
                }else{
                    alert(error)
                }
            }
        })
    });
});

$(document).on("click", "#category_submit", function() {
    var type = $("#type").val();
    var parent_id = $("#parent_id").val();
    var name = $("#name").val();

    if(type == '')
    {
        $("#type").focus();
        showMsg('Vui lòng chọn loại danh mục!');
        return false;
    }
    else{
        $("#message_show").html('');
    }

    if(name == '')
    {
        $("#name").focus();
        showMsg('Vui lòng nhập tên danh mục!');
        return false;
    }
    else{
        $("#message_show").html('');
    }


});
