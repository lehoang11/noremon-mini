@extends('site.layouts.master')

@push('css')
    <!-- BEGIN CSS for this page -->

    <!-- END CSS for this page -->
@endpush('css')

@section('content')
<!-- DESKTOP -->
<div class="breadcrumb-wrap d-none d-sm-block">
	<div class="container-fluid min-w1270">
		<nav class="base-breadcrumb">
			<li><a href="#">Trang chủ</a></li>
			<li><a href="#">Tìm kiếm</a></li>
			<li class="current"><em>{{$q}}</em></li>
		</nav>
	</div>
</div>
<div class="container-fluid page-search d-none d-sm-block min-w1270">
	<div class="row">
		<aside class="col-md-2 col-lg-2 col-xl-2">
			<div class="search-sidebar">
				<div class="panel-group box-left">
				    <div class="panel panel-default">
					    <div class="panel-heading">
					    	<h4 class="panel-title">
					    		<a href="#">Danh mục liên quan</a>
					    	</h4>
				        </div>
					    <div class="panel-body">
					    	<div class="list-group">
					    		@if($cateList)
					    		@foreach($cateList as $item)
							    <div class="list-group-item"><a href="{{action('ProductController@productCate',['slug'=>$item->slug,'cate_id'=>$item->id])}}?q={{str_replace(' ','+', $q)}}">{{$item->name}}</a></div>
							    @endforeach
							    @endif
						    </div>
					    </div>
				    </div>
			    </div>
			</div>
		</aside>
		<section class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
			<div class="search-wrap">
				<div class="header-box">
					<h3> Kết quả tìm kiếm cho '{{$q}}':{{count($products)}} kết quả </h3>
				</div>
				@if($products)
				<div class="inbox-search">
					@foreach($products as $item)
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
				</div>
				@endif
				<div class="pagin-wrap">
					<ul class="pagination">
						@if($products->currentpage() != 1)
						<li><a href="{{action('SearchController@index')}}?q={{str_replace(' ','+', $q)}}&page={{$products->currentpage() -1 }}">&laquo;</a></li>
						@endif
						@for ($i =1; $i<= $products->lastpage(); $i= $i +1)
						<li class="{!!($products->currentpage()==$i) ? 'active':''!!}">
						<a href="{{action('SearchController@index')}}?q={{str_replace(' ','+', $q)}}&page={{$i}}">{!!$i!!}</a></li>
						@endfor
						@if($products->currentpage() !=$products->lastpage())
						<li><a href="{{action('SearchController@index')}}?q={{str_replace(' ','+', $q)}}&page={{$products->currentpage() + 1 }}">&raquo;</a></li>
						@endif
					</ul>
				</div>
			</div>						
		</section>
	</div>
</div>
<!-- /DESKTOP -->
<!-- MOBILE -->
<div class="mobile-wrap d-block d-sm-none d-md-none d-lg-none">
		<div class="mb-container">
		<nav class="mb-breadcrumb">
			<li><a href="#">Trang chủ</a></li>
			<li class="current"><em>Tìm kiếm</em></li>
		</nav>
	</div>
	<div class="mb-container page-mb-master">
		<div class="header-box">
			<h3 class="header-title">
				Kết quả tìm kiếm cho '{{$q}}':{{count($products)}} kết quả 
			</h3>
		</div>
		<div class="inner">
			@if($products)
				@foreach($products as $item)
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
<!-- /MOBILE -->
@endsection

@push('js')
<!-- BEGIN Java Script for this page -->
<!-- END Java Script for this page -->
@endpush