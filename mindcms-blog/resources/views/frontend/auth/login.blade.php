@extends('layouts.app')

@section('content')
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Login</h3>
                        <form method="post" action="{{route('frontend.login')}}" enctype="multipart/form-data">
                            @csrf
                                 <div class="account__form">
                                    <div class="input__box">
                                        <label for="username">{{ __('auth.username') }}  *</label>
                                        <input type="text" name="username" value="{{old('username')}}">
                                        @error('username')
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
                                <div class="form__btn">
                                    <button type="submit">Login</button>
                                    <label class="label-for-checkbox">
                                        <input class="input-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>{{ __('auth.remember_me') }}</span>
                                    </label>
                                </div>
                                <a class="forget_pass" href="{{ route('password.request') }}">{{ __('auth.forgot_password') }}</a>

                                     <div class="form__btn">
                                         <a href="{{ route('frontend.social_login', 'facebook') }}" class="btn btn-block" style="background-color:#1877F2; color: #ffffff">{{ __('auth.login_with_facebook') }}</a>
                                         <a href="{{ route('frontend.social_login', 'twitter') }}" class="btn btn-block" style="background-color:#1DA1F2; color: #ffffff">{{ __('auth.login_with_twitter') }}</a>
                                         <a href="{{ route('frontend.social_login', 'google') }}" class="btn btn-block">{{ __('auth.login_with_google') }}</a>
                                     </div>

                                 </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
