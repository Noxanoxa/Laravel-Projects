@extends('layouts.admin')
@section('style')
    <link href="{{asset('backend/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Supervisor ({{ $user->name }})</h6>
            <div class="ml-auto">
                <a href="{{route('admin.supervisors.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Users</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::model($user, ['route' => ['admin.supervisors.update', $user->id], 'method' => 'patch', 'files' => true]) !!}
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('name', "Name") !!}
                        {!! Form::text('name', old('name', $user->name), ['class' => 'form-control', 'placeholder' => 'Your Name' ]) !!}
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('username', "Username") !!}
                        {!! Form::text('username', old('username', $user->usrname), ['class' => 'form-control', 'placeholder' => 'Your Username' ]) !!}
                        @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('email', "Email") !!}
                        {!! Form::text('email', old('email', $user->email), ['class' => 'form-control', 'placeholder' => 'Your Email' ]) !!}
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('mobile', "Mobile") !!}
                        {!! Form::text('mobile', old('mobile', $user->mobile), ['class' => 'form-control', 'placeholder' => 'Your Mobile' ]) !!}
                        @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('password', "Password") !!}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Your Password' ]) !!}
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('status', "Status") !!}
                        {!! Form::select('status',['' => '---', '1' => 'Active', '0' => 'Inactive'], old('status', $user->status), ['class' => 'form-control']) !!}
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('receive_email', "Receive email") !!}
                        {!! Form::select('receive_email',['' => '---', '1' => 'Yes', '0' => 'No'], old('receive_email', $user->receive_email), ['class' => 'form-control']) !!}
                        @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('bio', "Description") !!}
                        {!! Form::textarea('bio', old('bio', $user->bio), ['class' => 'form-control', 'placeholder' => 'Your Bio' ]) !!}
                        @error('bio')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('permissions', "Permissions") !!}
                        {!! Form::select('permissions[]', [] + $permissions->toArray(), old('permissions', $userPermissions), ['class' => 'form-control select-multiple-tags', 'multiple' => 'multiple']) !!}
                        @error('permissions')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row pt-4">
                @if($user->user_image != '')
                    <div class="col-12 text-center">
                        <div class="imgArea">
                            <img src="{{ asset('assets/users/' . $user->user_image) }}" width="300" height="300" class="img-thumbnail">
                            <button type="button" class="btn btn-danger remove-image">Remove Image</button>
                        </div>
                    </div>
                @endif
                <div class="col-12">
                    {!! Form::label('user_image', "Supervisor Image") !!}
                    <br>
                    <div class="file-loading">
                        {!! Form::file('user_image', ['id' => 'user-image', 'class' => 'file-input-overview']) !!}
                        <span class="form-text text-muted">Image width should be 300px x 300px</span>
                        @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="form-group pt-4">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
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
            $('.remove-image').click(function () {
                $.post('{{ route('admin.supervisors.remove_image') }}', {user_id: '{{ $user->id }}', _token: '{{ csrf_token() }}'}, function (data){
                        if(data == 'true') {
                            window.location.href = window.location;
                        }
                })
            });
        });
    </script>
@endsection