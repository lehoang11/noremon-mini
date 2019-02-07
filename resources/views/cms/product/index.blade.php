
@extends('cms.layouts.master')

@push('css')
    <!-- BEGIN CSS for this page -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>    
    <style> 
    td.details-control {
    background: url('../static/plugins/datatables/img/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
    background: url('../static/plugins/datatables/img/details_close.png') no-repeat center center;
    }
    </style>        
    <!-- END CSS for this page -->
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
                        <h3><i class="fa fa-table"></i> Danh sách sản phẩm</h3>
                        <a role="button" class="btn btn-primary btn-sm" href="{{ action('Cms\ProductController@create') }}">Thêm mới</a>
                    </div>
                    <div class="card-body">
                        @if($productList)
                        @php $statusArray = array('0'=>'Đã ẩn','1'=>'Đang bán','99'=>'Đã xóa'); @endphp
                        
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Danh mục</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Price Sale</th>
                                        <th>Status</th>
                                        <th>View</th>
                                        <th>Created_at</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>                                        
                                <tbody>
                                @foreach($productList as $mItem)
                                <tr>
                                    <td>{{$mItem->id}}</td>
                                    <td>                                       
                                        @foreach($categoryList as $value)
                                            @if($value['id'] == $mItem->category_id)
                                            {{$value['name']}}
                                            @endif
                                        @endforeach
                                        
                                    </td>
                                    <td><a href="{{ action('Cms\ProductController@edit',$mItem->id) }}">{{$mItem->name}}</a></td>
                                    <td>@if($mItem->image)
                                        <img src="{{BASE_URL}}{{$mItem->image}}" style="width: 100px;">
                                        @endif
                                    </td>
                                    <td>{{$mItem->price}}</td>
                                    <td>{{$mItem->price_sale}}</td>
                                    <td>
                                        <select>
                                            <option value="{{$mItem['status']}}" selected>{{$statusArray[$mItem->status]}} </option>
                                            <option value="0"> Đã ẩn</option>
                                            <option value="1"> Đang dùng</option>
                                            <option value="99"> Đã xóa</option>
                                        </select>
                                    </td>
                                    <td>{{$mItem->view}}</td>
                                    <td>{{$mItem->created_at}}</td>
                                    <td><a href="{{ action('Cms\ProductController@destroy',$mItem->id) }}">Xóa </a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <h3>Không có danh mục nào</h3>
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
<!-- BEGIN Java Script for this page -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <script>
    // START CODE FOR BASIC DATA TABLE 
    $(document).ready(function() {
        $('#example1').DataTable();
    } );
    // END CODE FOR BASIC DATA TABLE 
          
    </script>   
<!-- END Java Script for this page -->
@endpush
@endsection
