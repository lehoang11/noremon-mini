<script src="{{asset('public/static/js/cms/category.js') }}"></script>
<!-- upload css+js -->
<link rel="stylesheet" type="text/css" href="{{asset('public/static/css/upload/upload.css') }}">
<script src="{{asset('public/static/js/upload/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{asset('public/static/js/upload/jquery.fileupload.js') }}"></script>
<script src="{{asset('public/static/js/upload/upload-image.js') }}"></script>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Tên</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Chi tiết</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab"> 	
	    <h3>Danh mục</h3>
	    {{ csrf_field() }}
		@if($category->id)
	    <div class="form-group">
	        <label for="Type"> Loại danh mục <span class="required">*</span></label>
	        <select class="form-control" name="type" id="type">
	            <option value="{{$category->type}}" selected>
	            	@if($category->type ==1)  Danh mục Sản phẩm @else Danh mục bài post  @endif </option>
	        </select>
	    </div>

	    <div class="form-group">
	        <label for="parent_id">Danh mục Cha <span class="required">*</span></label>
	        <select id="parent_id" name="parent_id" class="form-control">
	        <option value="0" @if($category->parent_id == 0) selected @endif>Root</option>
	        @if($categoryList)
	        @foreach($categoryList as $item)
	        <option value="{{$item['id']}}" class="text-warning" @if($item['id'] == $category->parent_id) selected @endif >--{{$item['name']}}</option>
	            @if($item['child'])
	            @foreach($item['child'] as $value)
	            <option value="{{$value['id']}}" class="text-primary" @if($value['id'] ==$category->parent_id) selected @endif>&nbsp; --|--{{$value['name']}}</option>
	            @endforeach
	            @endif
	        @endforeach
	        @endif
	        </select>
	    </div>
	    @else
	    <div class="form-group type-select">
	        <label for="Type"> Loại danh mục <span class="required">*</span></label>
	        <select class="form-control" name="type" id="type">
	            <option value="">Loại danh mục</option>
	            <option value="1" @if($category->type ==1) selected @endif> Danh mục Sản phẩm</option>
	            <option value="2" @if($category->type ==2) selected @endif>Danh mục bài post</option>
	        </select>
	    </div>
	    <div class="form-group">
	        <label for="parent_id">Danh mục Cha <span class="required">*</span></label>
	        <select id="parent_id" name="parent_id" class="form-control">
	      	<option value="0">Root</option>
	        </select>
	    </div>
	    @endif
	    <div class="form-group">
		    <label for="Name">Tên danh mục <span class="required">*</span></label>
	        <input type="text" class="form-control" id="name" name="name" value="{{old('name', $category->name)}}" placeholder="Tên danh mục">
	    </div>
	    <div class="form-group">
	      <label for="sort_order">Vị trí</label>
	      <input type="text" name="sort_order" class="form-control" id="sort_order" value="{{old('sort_order', $category->sort_order)}}" placeholder="Vị trí">
	    </div>
    </div>
    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
        <h3>Chi tiết</h3>
	    <div class="form-group">
		    <label for="description">Mô tả</label>
		    <textarea class="form-control" id="description" name="description" placeholder="Mô tả">{{old('description', $category->description)}}</textarea>
	    </div>
	    
		<div class="row">			
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">						
			    <div class="upload-image-one">
			    	<div id="show-imgbox-one" class="show-image-one">			    		
						@if($category->image)
						<img src="{{BASE_URL}}{{$category->image}}" alt="">
						<input type="hidden" name="image" value="{{$category->image}}">
						@else
						<img src="{{asset('public/static/images/upload-demo.png')}}">
						@endif			
			    	</div>
		            <div class="upload-form-one">
		            	<div class="upload_box">
		            		<button class="btn_upload_image btn btn-info" type="button">Upload ảnh đại điện </button>
			                <input type="file" id="hidden_file"
			                data-url="{{BASE_URL}}upload/upload_image" style="display: none;" />
			                <input type="hidden" name="use_path" value="{{DIR_UPLOAD_PRODUCT}}">
		            	</div>    
		            </div>
		        </div>					
            </div>
        </div>

	</div>
</div>


	<div class=" form-group form-check">
		<label class="form-check-label">
		<input type="checkbox" id="status" name="status" class="form-check-input" @if($category->status == 1) checked @endif >Kích hoạt</label>
	</div>

    <div class="form-group">
    <button id="category_submit" type="submit" class="btn btn-primary">Lưu</button>
    </div>