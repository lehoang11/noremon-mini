<script src="{{asset('public/static/js/cms/product.js') }}"></script>
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
	<li class="nav-item">
		<a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Hình ảnh</a>
	</li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab"> 	
	    <h3>Danh mục</h3>
	    {{ csrf_field() }}
	    <div class="form-group">
	        <label for="category_id">Danh mục <span class="required">*</span></label>
	        <select id="category_id" name="category_id" class="form-control">
	        	<option value="">Danh mục sản phẩm</option>
	        @if($categoryList)
	        @foreach($categoryList as $item)
	        <option value="{{$item['id']}}" class="text-warning" @if($item['id'] == $product->category_id) selected @endif >--{{$item['name']}}</option>
	            @if($item['child'])
	            @foreach($item['child'] as $value)
	            <option value="{{$value['id']}}" class="text-primary" @if($value['id'] ==$product->category_id) selected @endif>&nbsp; --|--{{$value['name']}}</option>
	            @endforeach
	            @endif
	        @endforeach
	        @endif
	        </select>
	    </div>

	    <div class="form-group">
		    <label for="Name">Tên Sản phẩm <span class="required">*</span></label>
	        <input type="text" class="form-control" id="name" name="name" value="{{old('name', $product->name)}}" placeholder="Tên Sản phẩm">
	    </div>
	    <div class="form-group">
	      <label for="price">Giá <span class="required">*</span></label>
	      <input type="text" name="price" class="form-control" id="price" value="{{old('price', $product->price)}}" placeholder="Giá">
	    </div>
	    <div class="form-group">
	      <label for="price_sale">Giá bán <span class="required">*</span></label>
	      <input type="text" name="price_sale" class="form-control" id="price_sale" value="{{old('price_sale', $product->price_sale)}}" placeholder="Giá">
	    </div>
    </div>

    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
        <h3>Chi tiết</h3>
	    <div class="form-group">
		    <label for="content">Mô tả ngắn</label>
		    <textarea class="form-control" id="content" name="content" placeholder="Mô tả ngắn">{{old('content', $product->content)}}</textarea>
	    </div>
	    <div class="form-group">
		    <label for="description">Mô tả</label>
		    <textarea class="form-control" id="description" name="description" placeholder="Mô tả">{{old('description', $product->description)}}</textarea>
	    </div>
	</div>

	<div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
        <h3> Hình ảnh </h3>
		<div class="row">			
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">						
			    <div class="upload-image-one">
			    	<div id="show-imgbox-one" class="show-image-one">			    		
						@if($product->image)
						<img src="{{BASE_URL}}{{$product->image}}" alt="">
						<input type="hidden" name="image" value="{{$product->image}}">
						@else
						<img src="{{asset('public/static/images/upload-demo.png')}}">
						@endif			
			    	</div>
		            <div class="upload-form-one">
		            	<div class="upload_box">
		            		<button class="btn_upload_image btn btn-info" type="button">Upload ảnh đại điện </button>
			                <input type="file" id="hidden_file"
			                data-url="{{BASE_URL}}upload/upload_image" style="display: none;" />
		            	</div>    
		            </div>
		        </div>					
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
	            <div class="upload-photo-btn">	
	            	<div class="upload-photo-box">
	            		<button class="btn_upload_photo btn btn-info" type="button">Thêm nhiều hình ảnh </button>
		                <input type="file" id="hidden_pic" multiple
				                data-url="{{BASE_URL}}upload/upload_photos" style="display: none;" />
	            	</div>
	            	<input type="hidden" name="use_path" value="{{DIR_UPLOAD_PRODUCT}}">
	            </div>
			</div>			
		</div> 
		<div id="show-photo" class="row">
			@if($product->id)
				@if($productPhotos)
				@foreach($productPhotos as $item)
				<div class="col-sm-3 pic-{{$item->id}}">
					<div class="upload-photo-layout">
						<img src="{{BASE_URL}}{{$item->photo}}">
						<a href="javascript:void(0)" photo-id ="{{$item->id}}" class="btn-del-photo-product"><i class="fa fa-trash-o bigfonts" aria-hidden="true"></i></a>
					</div>
				</div>
				@endforeach
				@endif
			@endif
		</div>
	</div>

</div>


	<div class=" form-group form-check" style="margin-top: 20px;">
		<label class="form-check-label">
		<input type="checkbox" id="status" name="status" class="form-check-input" @if($product->status == 1) checked @endif >Kích hoạt</label>
	</div>

    <div class="form-group">
    <button id="product_submit" type="submit" class="btn btn-primary">Lưu</button>
    </div>