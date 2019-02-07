
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
                                <h3><i class="fa fa-check-square-o"></i> Sửa danh mục</h3>
                                <a href="{{ action('Cms\CategoryController@index') }}">Trở lại danh sách danh mục </a>
                            </div>
                            <div class="card-body">
                                <form action="{{ action('Cms\CategoryController@update',$category->id) }}"  enctype="multipart/form-data" method="POST">
                                
                                @include('cms.category.form')
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
