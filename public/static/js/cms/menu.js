$(document).ready(function(){
    $(".module-select #module").change(function(){
        var module = $(this).val();
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: CURRENT_PATH + 'menu_get/ajax_menu?module='+module,
            data: "ajax",
            async: true,
            success: function(data){
                if (data.success == true) {
                    $("#parent_id").html(data.html);
                }else{
                    alert(data.error);
                }
            }
        })
    });
});


$(document).on("click", "#menu_submit", function() {
    var module = $("#module").val();
    var parent_id = $("#parent_id").val();
    var name = $("#name").val();
    var permission = $("#permission").val();
    var link = $("#link").val();

    if(module == '')
    {
        $("#module").focus();
        showMsg('Vui lòng chọn module!');
        return false;
    }
    else{
        $("#message_show").html('');
    }

    if(parent_id == '')
    {
        $("#parent_id").focus();
        showMsg('Vui lòng chọn danh mục cha !');
        return false;
    }
    else{
        $("#message_show").html('');
    }
    if(name == '')
    {
        $("#name").focus();
        showMsg('Vui lòng nhập tên menu!');
        return false;
    }
    else{
        $("#message_show").html('');
    }
    if(permission == '')
    {
        $("#permission").focus();
        showMsg('Vui lòng nhập permission menu!');
        return false;
    }
    else{
        $("#message_show").html('');
    }
    if(link == '')
    {
        $("#link").focus();
        showMsg('Vui lòng nhập link menu!');
        return false;
    }
    else{
        $("#message_show").html('');
    }

});
