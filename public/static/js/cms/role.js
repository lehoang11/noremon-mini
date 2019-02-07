$(document).on("click", "#role_submit", function() {
    var module = $("#module").val();
    var name = $("#name").val();

    if(module == '')
    {
        $("#module").focus();
        showMsg('Vui lòng chọn module!');
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


});
