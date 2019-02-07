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
			<li class="current"><em>shipping</em></li>
		</nav>
	</div>
</div>
<div class="container-fluid page-shipping min-w1270">
	<div class="row">
		@include('site.block.info')
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 main-cart">
		 <div class="form-shipping">
		 	<form class="form-ship row" action="{{ action('ShippingController@store') }}" method="POST">
		 		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		 			<label>Địa chỉ email</label>
		 			<input type="text" name="email" id="email" value="{{old('email', $shipping->email)}}" class="form-control" placeholder="Địa chỉ email">
		 		</div>
		 		{{ csrf_field() }}
		 		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		 			<label>Tên</label>
		 			<input type="text" name="full_name" id="full_name" value="{{old('name', $shipping->full_name)}}" class="form-control" placeholder="Họ tên">
		 		</div>
		 		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		 			<label>Số điện thoại</label>
		 			<input type="text" name="phone" id="phone" value="{{old('phone', $shipping->phone)}}" class="form-control" placeholder="Số điện thoại">
		 		</div>
		 		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		 			<label>Mã số thuế</label>
		 			<input type="text" name="code_tax" id="code_tax" value="{{old('code_tax', $shipping->code_tax)}}" class="form-control" placeholder="Mã số thuế">
		 		</div>
		 		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		 			<label>Địa chỉ nhận hàng</label>
		 			<input type="text" name="address" id="address" value="{{old('address', $shipping->address)}}" class="form-control" placeholder="Vui lòng nhập địa chỉ của bạn">
		 		</div>
		 		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		 			<label>Tỉnh/Thành phố</label>
		 			<input type="text" name="city" id="city" value="{{old('city', $shipping->city)}}" class="form-control" placeholder="Tỉnh/Thành phố">
		 		</div>
		 		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		 			<label>Quận/Huyện</label>
		 			<input type="text" name="district" id="district" value="{{old('district', $shipping->district)}}" class="form-control" placeholder="Quận/Huyện">
		 		</div>
		 		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		 			<label>Phường/Xã</label>
		 			<input type="text" name="wards" id="wards" value="{{old('wards', $shipping->wards)}}" class="form-control" placeholder="Phường/Xã">
		 		</div>
		 		<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		 			<button class="btn form-submit" id="shipping-submit" type="submit">
						<span class="text">Lưu</span>
					</button>
		 		</div>

		 	</form>
		 </div>   
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
	    			<a href="{{action('CartController@checkout')}}" class="btn" type="submit"><span class="text">Mua hàng không cần đăng ký</span></a>
	    		</div>
	    	</div>
	    </div>
	</div>
</div>
<!-- /DESKTOP -->
<!-- MOBILE -->
<!-- /MOBILE -->
@endsection

@push('js')
<!-- BEGIN Java Script for this page -->

<script src="{{asset('public/static/js/frontend/cart.js')}}"></script>
<script>
	$(document).on("click", "#shipping-submit", function() {
    var email = $("#email").val();
    var full_name = $("#full_name").val();
    var phone = $("#phone").val();
    var address = $("#address").val();
    var city = $("#city").val();
    var district = $("#district").val();
    var city = $("#city").val();

    if(email == '')
    {
        $("#email").focus();
        showMsg('Vui lòng nhập email!');
        return false;
    }
    else{
        $("#message_show").html('');
    }

    if(full_name == '')
    {
        $("#full_name").focus();
        showMsg('Vui lòng nhập họ tên !');
        return false;
    }
    else{
        $("#message_show").html('');
    }
    if(phone == '')
    {
        $("#phone").focus();
        showMsg('Vui lòng nhập tên số điện thoại!');
        return false;
    }
    else{
        $("#message_show").html('');
    }
    if(address == '')
    {
        $("#address").focus();
        showMsg('Vui lòng nhập địa chỉ nhận hàng!');
        return false;
    }
    else{
        $("#message_show").html('');
    }
    if(city == '')
    {
        $("#city").focus();
        showMsg('Vui lòng nhập Tỉnh/thành phố!');
        return false;
    }
    else{
        $("#message_show").html('');
    }
    if(district == '')
    {
        $("#district").focus();
        showMsg('Vui lòng nhập nhập Quận/Huyện!');
        return false;
    }
    else{
        $("#message_show").html('');
    }
    if(wards == '')
    {
        $("#wards").focus();
        showMsg('Vui lòng nhập phường xã!');
        return false;
    }
    else{
        $("#message_show").html('');
    }

});

</script>

<!-- END Java Script for this page -->
@endpush