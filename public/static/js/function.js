
function showMsg(msg, alert_type = 'danger') {
    $("#message_show").html('<div class="alert alert-'+alert_type+'" role="alert">' +
        '<button type="button" class="close" data-dismiss="alert">' +
            '<i class="ace-icon fa fa-times"></i>'+
        '</button>'+ msg +'</div>');
}
