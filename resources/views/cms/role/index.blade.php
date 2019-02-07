
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
                        <h3><i class="fa fa-table"></i> Danh sách Vai trò</h3>
                        <a role="button" class="btn btn-primary btn-sm" href="{{ action('Cms\RoleController@create',$module) }}">Thêm mới</a>
                    </div>
                    <div class="card-body">
                    @if($roleList)
                        @php $statusArray = array('0'=>'Đã ẩn','1'=>'Đang dùng','99'=>'Đã xóa'); @endphp
                        <table class="table table-responsive-xl">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Module</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roleList as $item)
                                <tr>
                                    <td>{{$item['id']}}</td>
                                    <td><a href="{{ action('Cms\RoleController@edit',['module' => $item['module'],'id'=>$item['id']]) }}"> {{$item['name']}}</a></td>
                                    <td>{{$item['description']}}</td>
                                    <td>{{$item['module']}}</td>
                                    <td>{{$statusArray[$item['status']]}}</td>
                                    <td>{{$item['created_at']}}</td>
                                </tr>
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
