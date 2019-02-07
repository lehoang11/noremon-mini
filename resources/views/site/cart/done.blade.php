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
<div class="container-fluid page-cart-done min-w1270">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h2>Đặt hàng thành công</h2>
			<p>Cám ơn bạn đã mua hàng tại Noremon, Chúng tôi sẽ kiểm tra, và xác nhận lại trong vòng 2h tới.</p>
			<p>Xin trận trọng cám ơn, Đội ngũ bán hàng Noremon</p>
		</div>
	</div>
</div>
<!-- /DESKTOP -->
<!-- MOBILE -->
<!-- /MOBILE -->
@endsection

@push('js')
<!-- BEGIN Java Script for this page -->

<!-- END Java Script for this page -->
@endpush