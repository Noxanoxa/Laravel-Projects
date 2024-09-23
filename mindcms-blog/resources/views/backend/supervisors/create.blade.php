@extends('layouts.admin')
@section('style')
    <link href="{{asset('backend/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/supervisors.create_supervisor')}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.supervisors.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/supervisors.supervisors')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'admin.supervisors.store', 'method' => 'post', 'files' => true]) !!}
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('name', __('Backend/supervisors.name')) !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => __('Backend/supervisors.ur_name') ]) !!}
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('username', __('Backend/supervisors.username')) !!}
                        {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => __('Backend/supervisors.ur_username') ]) !!}
                        @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('email', __('Backend/supervisors.email')) !!}
                        {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => __('Backend/supervisors.ur_email') ]) !!}
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('mobile', __('Backend/supervisors.mobile')) !!}
                        {!! Form::text('mobile', old('mobile'), ['class' => 'form-control', 'placeholder' => __('Backend/supervisors.ur_mobile') ]) !!}
                        @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('password', __('Backend/supervisors.password')) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('Backend/supervisors.ur_password') ]) !!}
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('status', __('Backend/supervisors.status')) !!}
                        {!! Form::select('status',['' => '---', '1' => __('Backend/supervisors.active'), '0' => __('Backend/supervisors.inactive')], old('status'), ['class' => 'form-control']) !!}
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('receive_email', __('Backend/supervisors.receive_email')) !!}
                        {!! Form::select('receive_email',['' => '---', '1' => __('Backend/supervisors.yes'), '0' => __('Backend/supervisors.no')], old('receive_email'), ['class' => 'form-control']) !!}
                        @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('bio', __('Backend/supervisors.bio')) !!}
                        {!! Form::textarea('bio', old('bio'), ['class' => 'form-control', 'placeholder' => __('Backend/supervisors.ur_bio') ]) !!}
                        @error('bio')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('permissions', __('Backend/supervisors.permissions')) !!}
                        {!! Form::select('permissions[]', [] + $permissions->toArray(), old('permissions'), ['class' => 'form-control select-multiple-tags', 'multiple' => 'multiple']) !!}
                        @error('permissions')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-12">
                    {!! Form::label('user_image', __('Backend/supervisors.supervisor_image')) !!}
                    <br>
                    <div class="file-loading">
                        {!! Form::file('user_image', ['id' => 'user-image', 'class' => 'file-input-overview']) !!}
                        <span class="form-text text-muted">{{__('Backend/supervisors.image_note')}}</span>
                        @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="form-group pt-4">
                {!! Form::submit(__('Backend/supervisors.submit'), ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection
@section('script')
    <script src="{{asset('backend/vendor/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function() {
            $('.select-multiple-tags').select2({
                minimumResultsForSearch: Infinity,
                tags: true,
                closeOnSelect: false
            });

            $('#user-image').fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });
    </script>
@endsection
