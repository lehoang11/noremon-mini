@extends('site.layouts.master')

@push('css')
    <!-- BEGIN CSS for this page -->

    <!-- END CSS for this page -->
@endpush('css')

@section('content')
<!-- DESKTOP -->
<div class="breadcrumb-wrap">
	<div class="container-fluid min-w1270">
		<nav class="base-breadcrumb">
			<li><a href="#">Trang chủ</a></li>
			<li class="current"><em>Đặt hàng</em></li>
		</nav>
	</div>
</div>
<div class="container-fluid page-checkout min-w1270">
	<form class="form-ship row" action="{{ action('CartController@checkout_store') }}" method="POST">
		@include('site.block.info')
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h3 class="header-check">Hình thức thanh toán</h3>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 main-cart">	 		
	 	    <div class="form-check">
			    <label class="form-check-label">
				<input class="form-check-input" type="radio" name="pay_method" id="pay_method" value="1" checked="">
				Thanh toán khi nhận hàng
			    </label>
			</div>
	 		{{ csrf_field() }}   
	    </div>
	    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 right">
	    	<div class="cart-check-ri">
	    		<div class="header-title">Thông tin đơn hàng</div>
	    		<div class="cart-total-sub">
	    			<span>Tạm tính ({{$countCart}} sản phẩm)</span>
	    			<strong><?php echo Cart::subtotal(); ?></strong>
	    		</div>
	    		<div class="cart-payfee">
	    			<span>Phí giao hàng</span>
	    			<strong>Miễn phí</strong>
	    		</div>
	    		<div class="cart-total">
	    			<span>Tổng cộng</span>
	    			<strong>{{$total}}</strong>
	    		</div>
	    		<p class="tax">Đã bao gồm VAT (nếu có)</p>
	    		<div class="btn-checkout">
	    			<button class="btn" type="submit"><span class="text">Đặt hàng</span> </button>
	    		</div>
	    	</div>
	    </div>
	</form>
</div>
<!-- /DESKTOP -->
<!-- MOBILE -->
<!-- /MOBILE -->
@endsection

@push('js')
<!-- BEGIN Java Script for this page -->

<script src="{{asset('public/static/js/frontend/cart.js')}}"></script>

<!-- END Java Script for this page -->
@endpush