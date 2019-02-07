
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
                                <h3><i class="fa fa-check-square-o"></i> Sửa Admin </h3>
                                Thay đổi vai trò của <strong>{{$userProfile->first_name}}&nbsp;{{$userProfile->last_name}}</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ action('Cms\AdminController@update',['module' => $module,'user_id'=>$userProfile->user_id,'role_id'=>$role_id]) }}" method="POST">
                                  @include('cms.admin.form')
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
