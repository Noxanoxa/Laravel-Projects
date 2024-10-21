@extends('layouts.admin-auth')
@section('content')
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">
                                        {{ __('Backend/auth.welcome_back') }}
                                    </h1>
                                </div>
                                <form method="post" action="{{route('admin.show_login_form')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username"
                                               value="{{old('username', request('username'))}}"
                                               class="form-control form-control-user"
                                               placeholder="{{ __('Backend/auth.enter_username')}}">
                                        @error('username') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                               placeholder="{{ __('Backend/auth.enter_password')}}">
                                        @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input class="custom-control-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">
                                                {{ __('Backend/auth.remember_me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Backend/auth.login') }}
                                    </button>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small"
                                           href="{{ route('password.request') }}">{{ __('Backend/auth.forgot_password') }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
