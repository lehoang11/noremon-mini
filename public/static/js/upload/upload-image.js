$(document).ready(function(){

    $('.btn_upload_image').click(function(){
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
            $('#show-imgbox-one').html(data.result.image);
        }else{
              showMsg(data.result.message);
        }
    }
  });

// upload photo
    $('.btn_upload_photo').click(function(){
        $('#hidden_pic').click();

    });

  $('#hidden_pic').fileupload({
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
            $('#show-photo').append(data.result.images);
        }else{
              showMsg(data.result.message);
        }
    }
  });


});


 $(document).ready(function(){
    $('#show-photo').on('click', '.btn-del-photo', function() {
        var file = $(this).attr('data-id');
        $.ajax({
            url : BASE_URL + 'photo/photo_delete',
            type : 'POST',
            dataType :'json',
            cache : false,
            data: {'file':file},
            success:function(res){
                //alert(res.idImage);
                $("."+res.file).remove();
            },
            error:function(res){
                alert(res.message);
            }
        });

    });
});

  $(document).ready(function(){
    $('#show-photo').on('click', '.btn-del-photo-product', function() {
        var photo_id = $(this).attr('photo-id');
        $.ajax({
            url : CURRENT_PATH + 'product-photo-delete',
            type : 'POST',
            dataType :'json',
            cache : false,
            data: {'photo_id':photo_id},
            success:function(res){
                $(".pic-"+res.photo_id).remove();
            },
            error:function(res){
                alert(res.message);
            }
        });

    });
});