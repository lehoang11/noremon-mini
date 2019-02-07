
@extends('cms.layouts.master')

@push('css')
@endpush('css')

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            @include('cms.block.info')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3><i class="fa fa-check-square-o"></i> Thêm mới vai trò</h3>
                                <a href="{{ action('Cms\RoleController@index',$module) }}">Trở lại danh sách vai trò</a>
                            </div>
                            <div class="card-body">
                                <form action="{{ action('Cms\RoleController@store',$module) }}" method="POST">
                                  @include('cms.role.form')
                                </form>
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
