@extends('layouts.admin')
@section('style')
    <link href="{{asset('backend/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Backend/supervisors.edit_supervisor') }} {{ $user->name }}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.supervisors.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{ __('Backend/supervisors.supervisors') }}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.supervisors.update', $user->id) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="name">{{ __('Backend/supervisors.name') }}</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ old('name', $user->name) }}">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="username">{{ __('Backend/supervisors.username') }}</label>
                            <input type="text" name="username" id="username" class="form-control"
                                   value="{{ old('username', $user->username) }}">
                            @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="email">{{ __('Backend/supervisors.email') }}</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="{{ old('email', $user->email) }}">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="mobile">{{ __('Backend/supervisors.mobile') }}</label>
                            <input type="text" name="mobile" id="mobile" class="form-control"
                                   value="{{ old('mobile', $user->mobile) }}">
                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="password">{{ __('Backend/supervisors.password') }}</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="status">{{ __('Backend/supervisors.status') }}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">---</option>
                                <option
                                    value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>{{ __('Backend/supervisors.active') }}</option>
                                <option
                                    value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>{{ __('Backend/supervisors.inactive') }}</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="receive_email">{{ __('Backend/supervisors.receive_email') }}</label>
                            <select name="receive_email" id="receive_email" class="form-control">
                                <option value="">---</option>
                                <option
                                    value="1" {{ old('receive_email', $user->receive_email) == '1' ? 'selected' : '' }}>{{ __('Backend/supervisors.yes') }}</option>
                                <option
                                    value="0" {{ old('receive_email', $user->receive_email) == '0' ? 'selected' : '' }}>{{ __('Backend/supervisors.no') }}</option>
                            </select>
                            @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="bio">{{ __('Backend/supervisors.bio') }}</label>
                            <textarea name="bio" id="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="permissions">{{ __('Backend/supervisors.permissions') }}</label>
                            <select name="permissions[]" id="permissions" class="form-control select-multiple-tags"
                                    multiple>
                                @foreach($permissions as $permission)
                                    <option
                                        value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions[]', $userPermissions)) ? 'selected' : '' }}>{{ $permission->display_name() }}</option>
                                @endforeach
                            </select>
                            @error('permissions')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    @if($user->user_image != '')
                        <div class="col-12 text-center">
                            <div class="imgArea">
                                <img src="{{ asset('assets/users/' . $user->user_image) }}" width="300" height="300"
                                     class="img-thumbnail">
                                <button type="button"
                                        class="btn btn-danger remove-image">{{ __('Backend/supervisors.remove_image') }}</button>
                            </div>
                        </div>
                    @endif
                    <div class="col-12">
                        <label for="user_image">{{ __('Backend/supervisors.image') }}</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="user_image" id="user-image" class="file-input-overview">
                            <span class="form-text text-muted">{{__('Backend/supervisors.image_note')}}</span>
                            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{__('Backend/supervisors.update')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('backend/vendor/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            $('.select-multiple-tags').select2({
                minimumResultsForSearch: Infinity,
                tags: true,
                closeOnSelect: false,
            });

            $('#user-image').fileinput({
                theme: 'fas',
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
            $('.remove-image').click(function () {
                $.post('{{ route('admin.supervisors.remove_image') }}', { user_id: '{{ $user->id }}', _token: '{{ csrf_token() }}' }, function (data) {
                    if (data == 'true') {
                        window.location.href = window.location;
                    }
                });
            });
        });
    </script>
@endsection
