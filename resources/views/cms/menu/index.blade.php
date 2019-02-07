
@extends('cms.layouts.master')

@push('css')
@endpush('css')

@section('content')

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        @include('cms.block.info')
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3><i class="fa fa-table"></i> Danh sách menu</h3>
                        <a role="button" class="btn btn-primary btn-sm" href="{{ action('Cms\MenuController@create',$module) }}">Thêm mới</a>
                    </div>
                    <div class="card-body">
                        @if($menuList)
                        @php $statusArray = array('0'=>'Đã ẩn','1'=>'Đang dùng','99'=>'Đã xóa'); @endphp
                        <table class="table table-responsive-xl">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Module</th>
                                    <th scope="col">link</th>
                                    <th scope="col">Permission</th>
                                    <th scope="col">Vị trí</th>
                                    <th scope="col">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menuList as $mItem)
                                <tr style="color: red;">
                                    <th scope="row">{{$mItem['id']}}</th>
                                    <td><a style="color: red;" href="{{ action('Cms\MenuController@edit',['module' => $mItem['module'],'id'=>$mItem['id']]) }}">{{$mItem['name']}}</a></td>
                                    <td>{{$mItem['module']}}</td>
                                    <td>{{$mItem['link']}}</td>
                                    <td>{{$mItem['permission']}}</td>
                                    <td>{{$mItem['sort_order']}}</td>
                                    <td>
                                        <select>
                                            <option value="{{$mItem['status']}}" selected>{{$statusArray[$mItem['status']]}} </option>
                                            <option value="0"> Đã ẩn</option>
                                            <option value="1"> Đang dùng</option>
                                            <option value="99"> Đã xóa</option>
                                        </select>
                                    </td>
                                </tr>
                                @if($mItem['child'])
                                    @foreach($mItem['child'] as $value)
                                    <tr style="color: #0ca4ca;">
                                        <th scope="row">{{$value['id']}}</th>
                                        <td>|--<a style="color: #0ca4ca;" href="{{ action('Cms\MenuController@edit',['module' => $value['module'],'id'=>$value['id']]) }}">{{$value['name']}}</a></td>
                                        <td>{{$value['module']}}</td>
                                        <td>{{$value['link']}}</td>
                                        <td>{{$value['permission']}}</td>
                                        <td>{{$value['sort_order']}}</td>
                                        <td>
                                        <select>
                                            <option value="{{$value['status']}}" selected>{{$statusArray[$value['status']]}} </option>
                                            <option value="0"> Đã ẩn</option>
                                            <option value="1"> Đang dùng</option>
                                            <option value="99"> Đã xóa</option>
                                        </select>
                                        </td>
                                    </tr>
                                         @if($value['minLevel'])
                                            @foreach($value['minLevel'] as $min)
                                            <tr>
                                                <th scope="row">{{$min['id']}}</th>
                                                <td>&nbsp; &nbsp;|--<a href="{{ action('Cms\MenuController@edit',['module' => $min['module'],'id'=>$min['id']]) }}">{{$min['name']}}</a></td>
                                                <td>{{$min['module']}}</td>
                                                <td>{{$min['link']}}</td>
                                                <td>{{$min['permission']}}</td>
                                                <td>{{$min['sort_order']}}</td>
                                                <td>
                                                <select >
                                                    <option value="{{$min['status']}}" selected>{{$statusArray[$min['status']] }}</option>
                                                    <option value="0"> Đã ẩn</option>
                                                    <option value="1"> Đang dùng</option>
                                                    <option value="99"> Đã xóa</option>
                                                </select>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif

                                    @endforeach
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div><!-- end card-->
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- END container-fluid -->
</div>
<!-- END content -->

@push('js')

@endpush
@endsection
