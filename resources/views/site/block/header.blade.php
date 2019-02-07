
<header>
    <!-- mobile header -->
    <div class="header-mobile d-block d-sm-none d-md-none d-lg-none">
        
        <!-- mb header top -->
        <div class="mb-header-top">
            <div class="container">
                <nav class="sidenav" data-sidenav data-sidenav-toggle="#sidenav-toggle">
                    <div class="sidenav-brand">
                        NOREMON
                    </div>

                    <div class="sidenav-header">
                      Đăng nhập
                      <small>Tài khoản</small>
                    </div>

                    <ul class="sidenav-menu">
                      <li>
                        <a href="javascript:;" data-sidenav-dropdown-toggle class="active">
                          <span class="sidenav-link-icon">
                            <i class="material-icons">store</i>
                          </span>
                          <span class="sidenav-link-title">Lorem ipsum</span>
                          <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
                            <i class="material-icons">arrow_drop_down</i>
                          </span>
                          <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
                            <i class="material-icons">arrow_drop_up</i>
                          </span>
                        </a>

                        <ul class="sidenav-dropdown" data-sidenav-dropdown>
                          <li><a href="javascript:;">Dolor sit amet</a></li>
                          <li><a href="javascript:;">Consectetur adipisicing</a></li>
                          <li><a href="javascript:;">Elit</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="javascript:;" data-sidenav-dropdown-toggle>
                          <span class="sidenav-link-icon">
                            <i class="material-icons">payment</i>
                          </span>
                          <span class="sidenav-link-title">Sed do eiusmod</span>
                          <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
                            <i class="material-icons">arrow_drop_down</i>
                          </span>
                          <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
                            <i class="material-icons">arrow_drop_up</i>
                          </span>
                        </a>

                        <ul class="sidenav-dropdown" data-sidenav-dropdown>
                          <li><a href="javascript:;">Tempor incididunt</a></li>
                          <li><a href="javascript:;">Labore</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="javascript:;" data-sidenav-dropdown-toggle>
                          <span class="sidenav-link-icon">
                            <i class="material-icons">shopping_cart</i>
                          </span>
                          <span class="sidenav-link-title">Dolore magna</span>
                          <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
                            <i class="material-icons">arrow_drop_down</i>
                          </span>
                          <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
                            <i class="material-icons">arrow_drop_up</i>
                          </span>
                        </a>

                        <ul class="sidenav-dropdown" data-sidenav-dropdown>
                          <li><a href="javascript:;">Aliqua</a></li>
                          <li><a href="javascript:;">Exercitation</a></li>
                          <li><a href="javascript:;">Minim veniam</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="javascript:;">
                          <span class="sidenav-link-icon">
                            <i class="material-icons">assignment_ind</i>
                          </span>
                          <span class="sidenav-link-title">Nostrud ullamco</span>
                        </a>
                      </li>
                      <li>
                        <a href="javascript:;">
                          <span class="sidenav-link-icon">
                            <i class="material-icons">alarm</i>
                          </span>
                          <span class="sidenav-link-title">Commodo</span>
                        </a>
                      </li>
                    </ul>

                    <div class="sidenav-header">
                      Another Section Header
                    </div>

                    <ul class="sidenav-menu">
                      <li>
                        <a href="javascript:;" data-sidenav-dropdown-toggle>
                          <span class="sidenav-link-icon">
                            <i class="material-icons">date_range</i>
                          </span>
                          <span class="sidenav-link-title">Reprehenderit</span>
                          <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
                            <i class="material-icons">arrow_drop_down</i>
                          </span>
                          <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
                            <i class="material-icons">arrow_drop_up</i>
                          </span>
                        </a>

                        <ul class="sidenav-dropdown" data-sidenav-dropdown>
                          <li><a href="javascript:;">Voluptate</a></li>
                          <li><a href="javascript:;">Excepteur</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="javascript:;">
                          <span class="sidenav-link-icon">
                            <i class="material-icons">backup</i>
                          </span>
                          <span class="sidenav-link-title">Occaecat</span>
                        </a>
                      </li>
                      <li>
                        <a href="javascript:;">
                          <span class="sidenav-link-icon">
                            <i class="material-icons">settings</i>
                          </span>
                          <span class="sidenav-link-title">Deserunt</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                   <a href="javascript:;" class="toggle" id="sidenav-toggle">
                        <i class="material-icons">menu</i>
                    </a>
                    <a href="{{BASE_URL}}" class="mb-logo">NOREMON</a>
                    <a href="{{action('CartController@index')}}" class="mb-cart">
                        <span class="mb-cart-icon">
                            <i class="material-icons">shopping_cart</i>
                            @php $totalCart = Cart::content()->count(); @endphp
                            @if($totalCart) <sup>{{$totalCart}}</sup>@endif
                        </span>
                    </a>
                </div>
            </div>
                <!-- /mb header top -->
              <!-- /mb header form search -->
              <div class="mb-header-form">
                  <div class="container">
                    <form action="{{action('SearchController@index')}}" method="GET" class="form-inline">
                        <input type="text" name="q" class="mb-input-search form-control" placeholder="Tìm kiếm">
                        <button type="submit" class="btn mb-btn-search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
              </div>
                <!-- /mb header form search -->
            </div>
        
    
    <script>$('[data-sidenav]').sidenav();</script>
    <!-- mobile header -->

    <!-- desktop header -->
    <div id="main-header" class="main-header d-none d-sm-block min-w1270">
        <div class="header-wrap">	
    			<a href="{{BASE_URL}}" class="logo">
            <span class="logo-text">NOREMON</span>   
          </a>
    			<div class="form-search">
    				<form action="{{action('SearchController@index')}}" class="navbar-form form-inline" method="GET">
    					<input type="text" name="q" class="input-search form-control" placeholder="Tìm kiếm">
    					<button type="submit" class="btn btn-search-form">
    						<i class="fa fa-search" aria-hidden="true"></i>
    					</button>
    				</form>
    			</div>
    			<div class="col-lg-4 col-md-4 col-sm-4 header-link">
    				<div class="user-profile item">
    					<div>
    						<div>
    							<i class="fa fa-user-o bigfonts" aria-hidden="true"></i>
    							<b>Đăng nhập</b><br>
    							<small>Tài khoản</small>
    						</div>
    					</div>
    				</div>
    				<div id="header-cart">
    					<a href="{{action('CartController@index')}}" class="header-cart item">
    						<i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i>
    						 Giỏ hàng
                @php $totalCart = Cart::content()->count(); @endphp
    						@if($totalCart) <span class="cart-count"> {{$totalCart}}</span>@endif                
    					</a>
    				</div>
    			</div>
        </div>
    	</div>
</header>


<!-- nav desktop -->
<div class="main-navbar cate-wrap d-none d-sm-block min-w1270">
    <div class="navbar-wrap">
        <div class="cate-nav ">
            <ul>
                <li class="nav-item">
                  <a href="{{BASE_URL}}" style="color: #189eff;">NOREMON<span style="color: #555;;">vn</span></a>
                </li>
                <li class="cate-sub nav-item">
                    <a href="#" style="background: #eaeef1;">
                        <i class="fa fa-bars bigfonts" aria-hidden="true"></i>
                        <span class="text-title">Danh mục </span>
                        <span class="cate-logo"></span>
                    </a>
                    <div class="sub-menu animated fadeIn">
                        <ul> 
                          @if($global_cate) 
                          @foreach($global_cate as $item)               
                            <li class="cat-item">
                                <a href="{{action('ProductController@productCate',['slug'=>$item->slug,'cate_id'=>$item->id])}}">
                                    {{$item->name}}                                    
                                    <i class="brand-ico "></i>
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                <div class="sub-menu-2">
                                    <div class="cat-sub-menu cat-box">
                                      <div class="left">
                                        <div class="title-box">
                                            <div class="title">{{$item->name}}
                                            </div>
                                            <div class="desc"></div>
                                        </div>
                                        <div class="row">
                                          @if($item['child'])
                                          @foreach($item['child'] as $value)
                                            <div class="col-md-6">
                                                <div class="item">
                                                    <div class="title">{{$value->name}}</div>
                                                    <ul>
                                                      @if($value['min'])
                                                        @foreach($value['min'] as $vmin)
                                                        <li>
                                                            <a href="{{action('ProductController@productCate',['slug'=>$vmin->slug,'cate_id'=>$vmin->id])}}">{{$vmin->name}}</a>
                                                        </li>
                                                        @endforeach
                                                      @endif

                                                        <li>
                                                            <a href="{{action('ProductController@productCate',['slug'=>$value->slug,'cate_id'=>$value->id])}}">Xem tất cả &gt;&gt;</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endforeach
                                          @endif
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="banner-sub">
                                            <a href="/ebay/category/dong-ho-trang-suc-281.html">
                                                <img src="https://static-v3.weshop.com.vn/upload/cms/17/12/21/w/l/d/b/1/2-min.png" alt="Đồng hồ, trang sức" title="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        @endif
                        <li class="cat-item">
                                <a href="/ebay/category/dong-ho-trang-suc-281.html">
                                    Điện tử, công nghệ                                    
                                    <i class="brand-ico "></i>
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                <div class="sub-menu-2">
                                    <div class="cat-sub-menu cat-box">
                                        <div class="left">
                                        <div class="title-box">
                                            <div class="title">Đồng hồ, trang sức
                                            </div>
                                            <div class="desc"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="item">
                                                    <div class="title">Đồng hồ</div>
                                                    <ul>
                                                        <li>
                                                            <a href="/ebay/category/dong-ho-14324.html?keyword=mens">Đồng hồ nam</a>
                                                        </li>
                                                        <li>
                                                            <a href="/ebay/category/dong-ho-14324.html?keyword=womens">Đồng hồ nữ</a>
                                                        </li>
                                                        <li>
                                                            <a href="/ebay/category/day-deo-dong-ho-98624.html">Dây đồng hồ</a>
                                                        </li>
                                                        <li>
                                                            <a href="/ebay/category/dong-ho-14324.html">Xem tất cả &gt;&gt;</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="item">
                                                    <div class="title">Kim cương &amp; Đá quý</div>
                                                    <ul>
                                                        <li>
                                                            <a href="/ebay/category/natural-diamonds-3824.html">Kim cương</a>
                                                        </li>
                                                        <li>
                                                            <a href="/ebay/category/kim-cuong-nhan-tao-152823.html">Kim cương nhân tạo</a>
                                                        </li>
                                                        <li>
                                                            <a href="/ebay/category/loose-gemstones-181077.html">Đá quý</a>
                                                        </li>
                                                        <li>
                                                            <a href="/ebay/category/kim-cuong-da-quy-491.html">Xem tất cả &gt;&gt;</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="item">
                                                    <div class="title">Kim cương &amp; Đá quý</div>
                                                    <ul>
                                                        <li>
                                                            <a href="#">Kim cương</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Kim cương nhân tạo</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Đá quý</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Xem tất cả &gt;&gt;</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="item">
                                                    <div class="title">Kim cương &amp; Đá quý</div>
                                                    <ul>
                                                        <li>
                                                            <a href="#">Kim cương</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Kim cương nhân tạo</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Đá quý</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Xem tất cả &gt;&gt;</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="banner-sub">
                                            <a href="/ebay/category/dong-ho-trang-suc-281.html">
                                                <img src="https://static-v3.weshop.com.vn/upload/cms/17/12/21/i/y/i/t/r/3-min.png" alt="Điện tử, công nghệ" title="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>                                                
                    </ul>
                    
                </div>
            </li>
            <li class="nav-item">
                <a href="#">Tốp sản phẩm hot</a>
            </li>
            <li class="nav-item">
                <a href="#">Khuyến mãi</a>
            </li>
        </ul>
    </div>
    <script>
        $('.cate-nav ul li.cate-sub').mouseenter(function () {
            $(this).addClass('open');
        });
        $('.cate-nav ul li.cate-sub').mouseleave(function () {
            $(this).removeClass('open');
        });
    </script>


    </div>
</div>
<!--/ nav desktop -->