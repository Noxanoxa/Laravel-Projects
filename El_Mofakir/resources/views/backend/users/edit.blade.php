@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{__('Backend/users.edit_author')}}({{ $user->name }})</h6>
            <div class="ml-auto">
                <a href="{{route('admin.users.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{__('Backend/users.authors')}}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.users.update', $user->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="name">{{__('Backend/users.name')}}</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="username">{{__('Backend/users.username')}}</label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                   class="form-control">
                            @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="email">{{__('Backend/users.email')}}</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="form-control">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="mobile">{{__('Backend/users.mobile')}}</label>
                            <input type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}"
                                   class="form-control">
                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="password">{{__('Backend/users.password')}}</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="status">{{__('Backend/users.status')}}</label>
                            <select name="status" class="form-control">
                                <option value="">---</option>
                                <option
                                    value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>{{__('Backend/users.inactive')}}</option>
                                <option
                                    value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>{{__('Backend/users.active')}}</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="receive_email">{{__('Backend/users.receive_email')}}</label>
                            <select name="receive_email" class="form-control">
                                <option
                                    value="1" {{ old('receive_email', $user->receive_email) == '1' ? 'selected' : '' }}>{{__('Backend/users.yes')}}</option>
                                <option
                                    value="0" {{ old('receive_email', $user->receive_email) == '0' ? 'selected' : '' }}>{{__('Backend/users.no')}}</option>
                            </select>
                            @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="bio">{{__('Backend/users.bio')}}</label>
                            <textarea name="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')<span class="text-danger">{{ $message }}</span>@enderror
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
                                        class="btn btn-danger remove-image">{{__('Backend/users.remove_image')}}</button>
                            </div>
                        </div>
                    @endif
                    <div class="col-12">
                        <label for="user_image">{{__('Backend/users.author_image')}}</label>
                        <br>
                        <div class="file-loading">
                            <input id="user-image" type="file" name="user_image" class="file-input-overview">
                            <span class="form-text text-muted">{{__('Backend/users.image_note')}}</span>
                            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{__('Backend/users.update')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function () {
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
                $.post('{{ route('admin.users.remove_image') }}', { user_id: '{{ $user->id }}', _token: '{{ csrf_token() }}' }, function (data) {
                    if (data == 'true') {
                        window.location.href = window.location;
                    }
                });
            });
        });
    </script>
@endsection
