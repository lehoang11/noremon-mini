<script src="{{asset('public/static/js/cms/menu.js') }}"></script>
    {{ csrf_field() }}
    <div class="form-group">
      <label for="Module">Module <span class="required">*</span></label>
      @if($menu->id)
      <select class="form-control" name="module" id="module">
          <option value="{{$menu->module }}" selected>@if($menu->module ==1) CMS module  @elseif($menu->module ==2)CMS developer @endif </option>
      </select>
      @else
      <select id="module" onchange="location.href=this.value" class="form-control">
        <option value="{{ action('Cms\MenuController@create',1) }} " @if($module ==1)selected @endif >CMS module</option>
        <option value="{{ action('Cms\MenuController@create',2) }}" @if($module ==2)selected @endif >CMS developer</option>
      </select>
      <small id="root" class="form-text text-muted">Chọn root nếu là danh mục cha</small>
      @endif
    </div>
    <div class="form-group">
      <label for="parent_id">Menu Cha <span class="required">*</span></label>
      <select id="parent_id" name="parent_id" class="form-control">
        <option value="0" @if($menu->parent_id == 0) selected @endif>Root</option>
        @if($menuList)
        @foreach($menuList as $item)
        <option value="{{$item['id']}}" class="text-warning" @if($item['id'] == $menu->parent_id) selected @endif >--{{$item['name']}}</option>
            @if($item['child'])
            @foreach($item['child'] as $value)
            <option value="{{$value['id']}}" class="text-primary" @if($value['id'] ==$menu->parent_id) selected @endif>&nbsp; --|--{{$value['name']}}</option>
            @endforeach
            @endif
        @endforeach
        @endif
      </select>
      <small class="form-text text-muted">Chọn root nếu là danh mục cha</small>
    </div>
    <div class="form-group">
      <label for="Name">Tên Menu <span class="required">*</span></label>
      <input type="text" class="form-control" id="name" name="name" value="{{old('name', $menu->name)}}" placeholder="Tên menu">
    </div>
    <div class="form-group">
      <label for="Permission">Permission <span class="required">*</span></label>
      <input type="text" name="permission" class="form-control" id="permission" value="{{old('permission', $menu->permission)}}" placeholder="Permission">
      <small id="Permission" class="form-text text-muted">Ví dụ: menu.view hoặc menu.create</small>
    </div>
    <div class="form-group">
      <label for="Link">Link <span class="required">*</span></label>
      <input type="text" name="link" class="form-control" id="link" value="{{old('link', $menu->link)}}" placeholder="Link">
    </div>
    <div class="form-group">
      <label for="sort_order">Vị trí</label>
      <input type="text" name="sort_order" class="form-control" id="sort_order" value="{{old('sort_order', $menu->sort_order)}}" placeholder="Vị trí">
    </div>
    <div class="form-group">
      <label for="icon">Icon</label>
      <input type="text" name="icon" class="form-control" id="icon" value="{{old('icon', $menu->icon)}}" placeholder="Icon">
    </div>
    <div class=" form-group form-check">
      <label class="form-check-label">
        <input type="checkbox" id="status" name="status" class="form-check-input" @if($menu->status == 1) checked @endif >
        Kích hoạt
      </label>
    </div>
    <div class="form-group">
    <button id="menu_submit" type="submit" class="btn btn-primary">Lưu</button>
    </div>
