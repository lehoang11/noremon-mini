    <!-- Left Sidebar -->
    <div class="left main-sidebar">

        <div class="sidebar-inner leftscroll">

            <div id="sidebar-menu">

            <ul>
                @if($hasMenu) 
                <li><a href="#">ai la ai</a></li>
                    @foreach($hasMenu as $item)
                        <li class="submenu">
                            <a class="" href="@if($item['child']) # @else {{url('/')}}/{{ADMIN_PATH}}{{$item['link']}}@endif"> {!! $item['icon']!!}<span> {{$item['name']}} </span> @if($item['child']) <span class="menu-arrow"></span> @endif </a>
                        @if($item['child'])
                        <ul class="list-unstyled">
                            @foreach($item['child'] as $value)
                                <li><a href="{{url('/')}}/{{ADMIN_PATH}}{{$value['link']}}@if($value['link'] =='menu' || $value['link'] =='role')/1 @endif">{{$value['name']}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                        </li>
                    @endforeach
                @endif

            </ul>

            <div class="clearfix"></div>

            </div>
            <div class="clearfix"></div>

        </div>

    </div>
    <!-- End Sidebar -->
