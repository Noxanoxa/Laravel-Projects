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
            <form method="post" action="{{route('admin.supervisors.store')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="name">{{ __('Backend/supervisors.name') }}</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="{{ __('Backend/supervisors.ur_name') }}">
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                    <label for="username">{{ __('Backend/supervisors.username') }}</label>
                    <input type="text" name="username" value="{{old('username')}}" class="form-control" placeholder="{{ __('Backend/supervisors.ur_username') }}">
                        @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="email">{{ __('Backend/supervisors.email') }}</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="{{ __('Backend/supervisors.ur_email') }}">
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="mobile">{{ __('Backend/supervisors.mobile') }}</label>
                        <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" placeholder="{{ __('Backend/supervisors.ur_mobile') }}">
                        @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="password">{{ __('Backend/supervisors.password') }}</label>
                        <input type="password" name="password" class="form-control" placeholder="{{ __('Backend/supervisors.ur_password') }}">
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="status">{{ __('Backend/supervisors.status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1" {{old('status') == '1' ? 'selected' : ''}}>{{ __('Backend/supervisors.active') }}</option>
                            <option value="0" {{old('status') == '0' ? 'selected' : ''}}>{{ __('Backend/supervisors.inactive') }}</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="receive_email">{{ __('Backend/supervisors.receive_email') }}</label>
                        <select name="receive_email" class="form-control">
                            <option value="1" {{old('receive_email') == '1' ? 'selected' : ''}}>{{ __('Backend/supervisors.yes') }}</option>
                            <option value="0" {{old('receive_email') == '0' ? 'selected' : ''}}>{{ __('Backend/supervisors.no') }}</option>
                        </select>
                        @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="bio">{{ __('Backend/supervisors.bio') }}</label>
                        <textarea name="bio" class="form-control" placeholder="{{ __('Backend/supervisors.ur_bio') }}">{{old('bio')}}</textarea>
                        @error('bio')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="permissions">{{ __('Backend/supervisors.permissions') }}</label>
                        <select name="permissions[]" class="form-control select-multiple-tags" multiple>
                            @foreach($permissions as $permission)
                                <option value="{{$permission->name}}">{{$permission->name}}</option>
                            @endforeach
                        </select>
                        @error('permissions')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-12">
                    <label for="user_image">{{ __('Backend/supervisors.image') }}</label>
                    <br>
                    <div class="file-loading">
                        <input type="file" name="images" id="user-image" class="file">
                        <span class="form-text text-muted">{{__('Backend/supervisors.image_note')}}</span>
                        @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="form-group pt-4">
                <button type="submit" class="btn btn-primary">{{__('Backend/supervisors.create')}}</button>
            </div>
            </form>
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
