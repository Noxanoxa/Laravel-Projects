@extends('layouts.app')

@section('content')
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">{{ __('auth.register') }}</h3>
                        <form method="post" action="{{route('frontend.register')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="account__form">
                            <div class="input__box">
                                <label for="name">{{ __('auth.name') }}  *</label>
                                <input type="text" name="name" value="{{old('name')}}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input__box">
                                <label for="username">{{ __('auth.username') }}  *</label>
                                <input type="text" name="username" value="{{old('username')}}">
                                @error('username')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input__box">
                                <label for="email">{{ __('auth.email') }}  *</label>
                                <input type="email" name="email" value="{{old('email')}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input__box">
                                <label for="mobile">{{ __('auth.mobile') }}  *</label>
                                <input type="text" name="mobile" value="{{old('mobile')}}">
                                @error('mobile')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input__box">
                                <label for="password">{{ __('auth.password') }}  *</label>
                                <input type="password" name="password">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input__box">
                                <label for="password_confirmation">{{__('auth.re_password ')}} *</label>
                                <input type="password" name="password_confirmation">
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input__box">
                                <label for="user_image">{{ __('auth.user_image') }}</label>
                                <input type="file" name="user_image" class="custom-file">
                                @error('user_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form__btn">
                                <button type="submit">
                                    {{ __('auth.create_account') }}
                                </button>
                            </div>
                            <a class="forget_pass" href="{{ route('frontend.show_login_form') }}">
                                {{ __('auth.login') }}
                            </a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
