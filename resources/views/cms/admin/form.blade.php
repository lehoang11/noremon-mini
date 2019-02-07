@if(!$roleUser->id)
<!-- BEGIN CSS for this page -->
<link href="{{asset('public/static/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- END CSS for this page -->
@endif
{{ csrf_field() }}

    @if($roleUser->id)
    <div class="form-group">
      <label for="parent_id">Chon vai trò <span class="required">*</span></label>
      <select id="role_id" name="role_id" class="form-control">
        @if($roleList)
        @foreach($roleList as $item)
        <option value="{{$item['id']}}" @if($item['id'] == $roleUser->role_id) selected @endif >{{$item['name']}}</option>
        @endforeach
        @endif
      </select>
    </div>
    @else
    <div class="form-group">
        <label for="example2">
         Tìm và chọn user vào danh sách Admin <span class="required">*</span> </label>
        <select class="form-control select2" id="user_id" name="user_id">
        @if($userList)
            @foreach($userList as $item)
            <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}} |{{$item->email}}</option>
            @endforeach
        @endif
        </select>
    </div>
    <div class="form-group">
      <label for="role_id">Chon vai trò <span class="required">*</span></label>
      <select id="role_id" name="role_id" class="form-control">
        @if($roleList)
        @foreach($roleList as $item)
        <option value="{{$item['id']}}">{{$item['name']}}</option>
        @endforeach
        @endif
      </select>
    </div>
    @endif

    <div class="form-group">
        <button id="admin_submit" type="submit" class="btn btn-primary">Lưu</button>
    </div>
@if(!$roleUser->id)
<!-- BEGIN Java Script for this page -->
<script src="{{asset('public/static/plugins/select2/js/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
<!-- END Java Script for this page -->

<script>
$(document).on("click", "#admin_submit", function() {
    var user_id = $("#user_id").val();
    var role_id = $("#role_id").val();

    if(user_id == '')
    {
        $("#user_id").focus();
        showMsg('Vui lòng chọn user!');
        return false;
    }
    else{
        $("#message_show").html('');
    }

    if(role_id == '')
    {
        $("#role_id").focus();
        showMsg('Vui lòng nhập tên role!');
        return false;
    }
    else{
        $("#message_show").html('');
    }


});

</script>

@endif


