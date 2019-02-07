
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
                        <h3><i class="fa fa-table"></i> Danh sách Admin</h3>
                        <a role="button" class="btn btn-primary btn-sm" href="{{ action('Cms\AdminController@create',$module) }}">Thêm mới</a>
                    </div>
                    <div class="card-body">
                    @if($adminList)
                        @php $statusArray = array('0'=>'Đã ẩn','1'=>'Đang dùng','99'=>'Đã xóa'); @endphp
                        <table class="table table-responsive-xl">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Full name</th>
                                    <th scope="col">Vai trò</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1 ; @endphp
                                @foreach($adminList as $item)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td> {{$item->first_name}}&nbsp;{{$item->last_name}}<br>{{$item->email}}</td>
                                    <td>{{$item->name}}<br>
                                        <a href="{{ action('Cms\AdminController@edit',['module' => $module,'user_id'=>$item->user_id,'role_id'=>$item->role_id]) }}">Thay đổi vai trò</a>
                                    </td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$statusArray[$item->status]}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td><a role="button" class="btn btn-danger btn-sm" href="{{ action('Cms\AdminController@destroy',['user_id'=>$item->user_id,'role_id'=>$item->role_id]) }}">Xóa Admin</a></td>
                                </tr>
                                @php $count++ ; @endphp
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
