@extends('site.layouts.master')

@push('css')
<!-- cart js -->
<script src="{{asset('public/static/js/frontend/cart.js')}}"></script>
    <!-- BEGIN CSS for this page -->
<link type="text/css" rel="stylesheet" href="{{asset('public/static/lightslider/css/lightslider.css') }}" />

</style>
    <!-- END CSS for this page -->
@endpush('css')

@section('content')
<!-- DESKTOP -->
<div class="breadcrumb-wrap d-none d-sm-block">
	<div class="container-fluid min-w1270">
		<nav class="base-breadcrumb">
			<li><a href="#">Trang chủ</a></li>
			<li><a href="#">{{$category->name}}</a></li>
			<li class="current"><em>{{$product->name}}</em></li>
		</nav>
	</div>
</div>
<div class="container-fluid page-detail d-none d-sm-block min-w1270">
	<div class="row">
		<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 col-xl-5">
			<div class="thumbnail-slider">
			    <ul id="lightSlider">
        <li data-thumb="{{$product->image}}">
            <img src="{{$product->image}}" />
        </li>
        @if($productPhoto)
        @foreach($productPhoto as $item)
	        <li data-thumb="{{$item->photo}}">
	            <img src="{{$item->photo}}" />
	        </li>
        @endforeach
        @endif
    </ul>
			</div>
		</div>
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 col-xl-7">
			<div class="product-info js-cart">
				<div class="top1">
					<div class="name">
						{{$product->name}} thoi trang hang hieu la tat ca cac giai phap tam hoi ma toi 
					</div>
					<div class="rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<span><a href="#">25 danh gia</a></span>
					</div>
				</div>
				<div class="price-box">
					<strong>{{$product->price_sale}} VND</strong>
					<div class="price-delete">
						<span class="price-del">{{$product->price}} VND</span>
						<span class="sale-tag">-34%</span>
					</div>
				</div>
				<div class="option-group">
					<div class="option-list">
						<div class="option-item">
							<p class="option-header">Chon size</p>
							<ul>
								<li class="active"><a href="#">M</a></li>
								<li><a href="#" class="">XM</a></li>
								<li><a href="#" class="">L</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="cart-wrap">
					<input type="hidden" id="product_id"  value="{{$product->id}}">
					<div class="quantity">
						<input type="number" id="quantity" value="1" min="1" max="5" class="form-control" >
					</div>
					<div class="add-cart">
						<button class="btn add-to-cart js-add-to-cart" id="js-add-to-cart" type="button">
							<span class="text">Thêm vào giỏ hàng</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="product-desc">
				<div class="header-title">
					THÔNG TIN CHI TIẾT
				</div>
				<div class="content">{{$product->content}}</div>
				<div class="description">
					{{$product->description}}
					<img src="{{$product->image}}" style="float: left;max-width: 100%;">
					        @if($productPhoto)
				        @foreach($productPhoto as $item)
					        <img src="{{$item->photo}}" style="float: left;max-width: 100%;">
				        @endforeach
				        @endif
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="comment-wrap">
				<div class="header-title">Đánh giá và nhận xét của {{$product->name}} </div>
				<div class="comment">
					comment
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="product-re product-base">
				<div class="header-title">Sản phẩm liên quan </div>
				<div class="product-inner">
				@if($productRe)
					@foreach($productRe as $item)
					<div class="item">
						<div class="thumb">
							<a href="{{action('ProductController@productshow',['slug'=>$item->slug,'id'=>$item->id])}}">
								<img src="{{asset($item->image)}}" alt="{{$item->name}}" title="{{$item->name}}">
							</a>
							<span class="sale-tag">-18 %</span>
						</div>
						<div class="info">
							<div class="name">
								<a href="{{action('ProductController@productshow',['slug'=>$item->slug,'id'=>$item->id])}}">{{$item->name}}</a>
							</div>
							<div class="price-box">
								<strong>{{$item->price_sale}} VNĐ</strong>
								<span>{{$item->price}} VNĐ</span>
							</div>
						</div>
					</div>
					@endforeach
				@endif
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /DESKTOP -->
<!-- MOBILE -->
<div class="mobile-wrap d-block d-sm-none d-md-none d-lg-none">
	<div class="mb-container">
		<nav class="mb-breadcrumb">
			<li><a href="#">Trang chủ</a></li>
			<li class="current"><em>Chi tiết sản phẩm</em></li>
		</nav>
	</div>
	<div class="mb-container page-mb-master page-detail mb">
		<div class="header-box">
			<h3 class="header-title">
				Thông tin chi tiết
			</h3>
		</div>
		<div class="inner">
			<div class="mb-imgdetail-pro">
				<div class="mb-thumbnail-slider">
				    <ul id="mb-lightSlider">
				        <li data-thumb="{{$product->image}}">
				            <img src="{{$product->image}}" />
				        </li>
				        @if($productPhoto)
				        @foreach($productPhoto as $item)
					        <li data-thumb="{{$item->photo}}">
					            <img src="{{$item->photo}}" />
					        </li>
				        @endforeach
				        @endif
				    </ul>
				</div>
			</div>
			<div class="mb-pro-info-wrap">
				<div class="product-name">
					{{$product->name}} VNĐ
				</div>
				<div class="product-price">
					<strong>{{$product->price_sale}} VNĐ</strong>
					<p class="tag-wrap"><span class="price-tag">{{$product->price}}</span><span class="sale-tag">-18%</span></p>
				</div>
				<div class="product-cart">
					<div class="option-list">
						<div class="option"></div>
					</div>
					<div class="cart-wrap">
						<button class="btn add-to-cart js-add-to-cart"  type="button">
							<span class="text">Thêm vào giỏ hàng</span>
						</button>
					</div>
				</div>
			</div>
			<div class="product-desc-wrap">
				<div class="product-content">
					{{$product->content}}
				</div>
				<div class="product-desc" id="product-more" style="display: none;">
					{{$product->description}}
				</div>
				@if($product->description)
				<button onclick="readMorePFunction()" class="btn btn-info">Xem thêm mô tả</button>
				@endif
			</div>
		</div>
	</div>
</div>
<!-- /MOBILE -->
@endsection

@push('js')
<!-- BEGIN Java Script for this page -->
<!-- lightslider -->
<script src="{{asset('public/static/lightslider/js/lightslider.js')}}"></script>
<script>
$(document).ready(function() {
    $('#lightSlider').lightSlider({
	    gallery: true,
	    item: 1,
	    loop: true,
	    slideMargin: 0,
	    thumbItem: 9
	});
    $('#mb-lightSlider').lightSlider({
	    gallery: true,
	    item: 1,
	    loop: true,
	    slideMargin: 0,
	    thumbItem: 9
	});
});
</script>
<script>
function readMorePFunction() {
    var x = document.getElementById("product-more");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
<!-- END Java Script for this page -->
@endpush