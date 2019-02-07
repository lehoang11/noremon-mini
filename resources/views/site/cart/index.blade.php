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
			<li class="current"><em>Cart</em></li>
		</nav>
	</div>
</div>
<div class="container-fluid page-cart min-w1270">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 main-cart">
		    @if($content)
			<div class="table-responsive">
	            <table class="table ">
	            	<thead>
			            <tr>
			            	<td class="text-center">{{$countCart}} Sản phẩm</td>
			                <td class="text-left"> Giá</td>              
			                <td class="text-left">Số lượng</td>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($content as $item)
	                    <tr class="cart-item cart-item-{{$item->rowId}}">
			                <td style="position: relative;">
			                	<img src="{{asset($item->options['img'])}}" style="width: 120px;">
			                	
			                	<div>{{$item->name}}</div>
			                	
			                	<a href="javascript:void(0)" class="btn btn-default btn-del-cart" cartId ="{{$item->rowId }}"><i class="fa fa-trash-o bigfonts" aria-hidden="true"></i></a>
			                </td>
			                <td class="text-left td-price">
			                	<strong>{{$item->price}}VNĐ</strong>
			                	<span></span>
			                	<div class="sale-tag">-19%</div>
			                </td>
			                <td class="quantity-item">
								<div class="input-group product-qty">
									<span class="input-group-btn">
										<button class="btn btn-default btn-update-cart" data-dir="min" data-id="{{$item->rowId}}">-</button>
									</span>
									<input type="text" class="form-control text-center" value="{{$item->qty}}" disabled="">
									<span class="input-group-btn">
										<button class="btn btn-default btn-update-cart" data-dir="plus" data-id="{{$item->rowId}}" >+</button>
									</span>
								</div>
			                </td>
			            </tr>
			            @endforeach
			        </tbody>
	            </table>
	        </div>
	        @endif
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
	    			<a href="{{action('ShippingController@form_create')}}" class="btn" type="button"><span class="text">Mua hàng không cần đăng ký</span></a>
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


<!-- END Java Script for this page -->
@endpush