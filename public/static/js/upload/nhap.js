$(document).ready(function(){

    $('.btn_upload_image').click(function(){
        var img_count =  $("#show_image_box img").length;
        if (img_count >=5) {
            showMsg("Chỉ được tải lên tối đa 5 hình ảnh cho mỗi sản phẩm!");
            return false;
        }
        $('#hidden_file').click();

    });

  $('#hidden_file').fileupload({
    dataType: 'json',
    sequentialUploads: true,
    start: function (e) {
      $("#modal-progress").modal("show");
    },

    stop: function (e) {
      $("#modal-progress").modal("hide");
    },

    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      var strProgress = progress + "%";
      $(".progress-bar").css({"width": strProgress});
      $(".progress-bar").text(strProgress);
    },
    done: function (e, data) {
        if (data.result.success) {
            //$('.show_image_box').append(data.result.images);
            var img_count =  $("#show_image_box img").length;
            //alert(img_count);
            if (img_count >= 5) {
                $('#show_image_box').append('<div class="img-hidden-box">'+data.result.images+'</div>');
            }else{
                $('#show_image_box').append(data.result.images);
                 $('#show_image_box').first().removeClass('img-hidden-box');
                 $('.layshow-im12').first().removeClass('img-ubox-hidden');
            }
            if (img_count >= 0) {
                $('.layshow-im12').first().removeClass('img-ubox-mas');
                $('.layshow-im12').first().addClass('img-ubox-active');
            }
      }else{
          showMsg(data.result.message);
      }
    }
  });

});


 $(document).ready(function(){
    $('#show_image_box').on('click', '.btn-imgdel', function() {
        var url = $(this).attr('data-url');
        var rfile = $(this).attr('data-id');
        $.ajax({
            url : url,
            type : 'POST',
            dataType :'json',
            cache : false,
            data: {'rfile':rfile},
            success:function(res){
                //alert(res.idImage);
                $("."+res.idImage).remove();
                var img_count =  $("#show_image_box img").length;
                if (img_count > 0) {
                    $('.layshow-im12').first().removeClass('img-ubox-mas');
                    $('.layshow-im12').first().addClass('img-ubox-active');
                    if (img_count <= 4) {
                        $('#show_image_box').removeClass('img-hidden-box');
                        $('.layshow-im12').first().removeClass('img-ubox-hidden');
                    }
                }

            },
            error:function(res){
                alert(res.rmessage);
            }
        });

    });
});





