
@extends('cms.layouts.master')

@push('css')
    <!-- BEGIN CSS for this page -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>    
    <style> 
    td.details-control {
    background: url('public/static/plugins/datatables/img/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
    background: url('public/static/plugins/datatables/img/details_close.png') no-repeat center center;
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
                        <h3><i class="fa fa-table"></i> Danh sách menu</h3>
                        <a role="button" class="btn btn-primary btn-sm" href="{{ action('Cms\CategoryController@create') }}">Thêm mới</a>
                    </div>
                    <div class="card-body">
                        @if($categoryList)
                        @php $statusArray = array('0'=>'Đã ẩn','1'=>'Đang dùng','99'=>'Đã xóa'); @endphp
                        
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>type</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>sort_order</th>
                                        <th>status</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>                                        
                                <tbody>
                                    @foreach($categoryList as $mItem)
                                <tr style="color: red;">
                                    <td>{{$mItem['id']}}</td>
                                    <td>{{$mItem['type']}}</td>
                                    <td><a style="color: red;" href="{{ action('Cms\CategoryController@edit',$mItem['id']) }}">{{$mItem['name']}}</a></td>
                                    <td>
                                        @if($mItem['image'])
                                        <img src="{{BASE_URL}}{{$mItem['image']}}" style="width: 100px;">
                                        @endif
                                    </td>
                                    <td>{{$mItem['sort_order']}}</td>
                                    <td>
                                        <select>
                                            <option value="{{$mItem['status']}}" selected>{{$statusArray[$mItem['status']]}} </option>
                                            <option value="0"> Đã ẩn</option>
                                            <option value="1"> Đang dùng</option>
                                            <option value="99"> Đã xóa</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a role="button" class="btn btn-danger btn-sm" href="{{ action('Cms\CategoryController@destroy',$mItem['id']) }}">Xóa </a>
                                    </td>
                                </tr>
                                @if($mItem['child'])
                                    @foreach($mItem['child'] as $value)
                                    <tr style="color: #0ca4ca;">
                                        <td>{{$value['id']}}</td>
                                        <td>{{$value['type']}}</td>
                                        <td>|--<a style="color: #0ca4ca;" href="{{ action('Cms\CategoryController@edit',$value['id']) }}">{{$value['name']}}</a></td>
                                        <td>@if($value['image'])
                                            <img src="{{BASE_URL}}{{$value['image']}}" style="width: 100px;">
                                            @endif
                                        </td>
                                        <td>{{$value['sort_order']}}</td>
                                        <td>
                                        <select>
                                            <option value="{{$value['status']}}" selected>{{$statusArray[$value['status']]}} </option>
                                            <option value="0"> Đã ẩn</option>
                                            <option value="1"> Đang dùng</option>
                                            <option value="99"> Đã xóa</option>
                                        </select>
                                        </td>
                                        <td>
                                            <a role="button" class="btn btn-danger btn-sm" href="{{ action('Cms\CategoryController@destroy',$value['id']) }}">Xóa</a>
                                        </td>
                                    </tr>
                                         @if($value['minLevel'])
                                            @foreach($value['minLevel'] as $min)
                                            <tr>
                                                <td>{{$min['id']}}</td>
                                                <td>{{$min['type']}}</td>
                                                <td>&nbsp; &nbsp;|--<a href="{{ action('Cms\CategoryController@edit',$min['id']) }}">{{$min['name']}}</a></td>
                                                <td>@if($min['image'])
                                                    <img src="{{BASE_URL}}{{$min['image']}}" style="width: 100px;">
                                                    @endif
                                                </td>
                                                <td>{{$min['sort_order']}}</td>
                                                <td>
                                                <select >
                                                    <option value="{{$min['status']}}" selected>{{$statusArray[$min['status']] }}</option>
                                                    <option value="0"> Đã ẩn</option>
                                                    <option value="1"> Đang dùng</option>
                                                    <option value="99"> Đã xóa</option>
                                                </select>
                                                </td>
                                                <td><a role="button" class="btn btn-danger btn-sm" href="{{ action('Cms\CategoryController@destroy',$min['id']) }}">Xóa</a></td>
                                            </tr>
                                            @endforeach
                                        @endif

                                    @endforeach
                                @endif
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
    
    
    // START CODE FOR Child rows (show extra / detailed information) DATA TABLE 
    function format ( d ) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>Full name:</td>'+
                '<td>'+d.name+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Extension number:</td>'+
                '<td>'+d.extn+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Extra info:</td>'+
                '<td>And any further details here (images etc)...</td>'+
            '</tr>'+
        '</table>';
    }
 
        $(document).ready(function() {
            var table = $('#example2').DataTable( {
                "ajax": "assets/data/dataTablesObjects.txt",
                "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "name" },
                    { "data": "position" },
                    { "data": "office" },
                    { "data": "salary" }
                ],
                "order": [[1, 'asc']]
            } );
             
            // Add event listener for opening and closing details
            $('#example2 tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );
        } );
        // END CODE FOR Child rows (show extra / detailed information) DATA TABLE       
        
                
        
        // START CODE Show / hide columns dynamically DATA TABLE        
        $(document).ready(function() {
            var table = $('#example3').DataTable( {
                "scrollY": "350px",
                "paging": false
            } );
         
            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();
         
                // Get the column API object
                var column = table.column( $(this).attr('data-column') );
         
                // Toggle the visibility
                column.visible( ! column.visible() );
            } );
        } );
        // END CODE Show / hide columns dynamically DATA TABLE  
        
        
        // START CODE Individual column searching (text inputs) DATA TABLE      
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example4 thead th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );
         
            // DataTable
            var table = $('#example4').DataTable();
         
            // Apply the search
            table.columns().every( function () {
                var that = this;
         
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        } );
        // END CODE Individual column searching (text inputs) DATA TABLE        
    </script>   
<!-- END Java Script for this page -->
@endpush
@endsection
