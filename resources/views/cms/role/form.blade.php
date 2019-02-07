<script src="{{asset('public/static/js/cms/role.js') }}"></script>
<style type="text/css">

ul.checktree li:before {
  height: 1em;
  width: 12px;
  border-bottom: 1px dashed;
  content: "";
  display: inline-block;
  top: -0.3em;
}

ul.checktree li { border-left: 1px dashed; }

ul.checktree li:last-child:before { border-left: 1px dashed; }

ul.checktree li:last-child { border-left: none; }
</style>
<script>
    (function($){
    $.fn.checktree = function(){
        $(':checkbox').on('click', function (event){
            event.stopPropagation();
            var clk_checkbox = $(this),
            chk_state = clk_checkbox.is(':checked'),
            parent_li = clk_checkbox.closest('li'),
            parent_uls = parent_li.parents('ul');
            parent_li.find(':checkbox').prop('checked', chk_state);
            parent_uls.each(function(){
                parent_ul = $(this);
                parent_state = (parent_ul.find(':checkbox').length == parent_ul.find(':checked').length);
                parent_ul.siblings(':checkbox').prop('checked', parent_state);
            });
         });
    };
}(jQuery));
</script>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-role-tab" data-toggle="tab" href="#nav-role" role="tab" aria-controls="nav-role" aria-selected="true">Role</a>
    <a class="nav-item nav-link" id="nav-permission-tab" data-toggle="tab" href="#nav-permission" role="tab" aria-controls="nav-permission" aria-selected="false">Permission</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-role" role="tabpanel" aria-labelledby="nav-role-tab">
        <h3>Vai trò</h3>
          {{ csrf_field() }}
        <div class="form-group">
            <label for="Module">Module <span class="required">*</span></label>
            @if($role->id)
            <select class="form-control" name="module" id="module">
                <option value="{{$role->module }}" selected>@if($role->module ==1) CMS module  @elseif($role->module ==2)CMS developer @endif </option>
            </select>
            @else
            <select id="module" onchange="location.href=this.value" class="form-control">
                <option value="{{ action('Cms\RoleController@create',1) }} " @if($module ==1)selected @endif >CMS module</option>
                <option value="{{ action('Cms\RoleController@create',2) }}" @if($module ==2)selected @endif >CMS developer</option>
            </select>
          @endif
        </div>
        <div class="form-group">
            <label for="Name">Tên vai trò <span class="required">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name', $role->name)}}" placeholder="Tên Vai trò">
        </div>
        <div class="form-group">
            <label for="Name">Mô tả <span class="required">*</span></label>
            <textarea class="form-control" id="description" name="description" placeholder="Mô tả">{{old('description', $role->description)}}</textarea>
        </div>
        <div class=" form-group form-check">
            <label class="form-check-label">
            <input type="checkbox" id="status" name="status" class="form-check-input" @if($role->status == 1) checked @endif >
            Kích hoạt
            </label>
        </div>
    </div>

    <div class="tab-pane fade" id="nav-permission" role="tabpanel" aria-labelledby="nav-permission-tab">
        <h3>Cấp quyền</h3>
        @if($menuList)
            <ul class="checktree">
                    <li>
                    <input id="administration" type="checkbox" /><label>Root</label>
                    <ul>
                        @foreach($menuList as $mItem)
                        <li>
                            <input id="pre_{{$mItem['id']}}" name="menu_ids[]" type="checkbox" / value="{{$mItem['id']}}" @if(in_array($mItem['id'], $menuIdArray))checked @endif ><label>{{$mItem['name']}}</label>
                            @if($mItem['child'])
                            <ul>
                                @foreach($mItem['child'] as $value)
                                <li>
                                    <input id="pre_{{$value['id']}}" name="menu_ids[]" value="{{$value['id']}}" type="checkbox" @if(in_array($value['id'], $menuIdArray))checked @endif /><label>{{$value['name']}}</label>
                                    @if($value['minLevel'])
                                    <ul>
                                        @foreach($value['minLevel'] as $min)
                                        <li><input id="pre_{{$min['id']}}" name="menu_ids[]" value="{{$min['id']}}" type="checkbox" @if(in_array($min['id'], $menuIdArray))checked @endif /><label>{{$min['name']}}</label></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        @else
        Vui lòng tạo quyền để tiếp tục <a href="{{ action('Cms\MenuController@create',$module) }}">Tạo quyền</a>
        @endif
    </div>
</div>

<div class="form-group">
    <button id="role_submit" type="submit" class="btn btn-primary">Lưu</button>
    </div>

<script>
    $(function(){
        $("ul.checktree").checktree();
    });
</script>
