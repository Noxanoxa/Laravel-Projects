@extends('layouts.app')

@section('content')
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Reset Password</h3>
                        {!! Form::open(['route' => 'password.email', 'method' => 'post' ]) !!}
                        <div class="account__form">
                            <div class="input__box">
                                {!! Form::label('email', 'Email  *') !!}
                                {!! Form::email('email', old('email')) !!}
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form__btn">
                                {!! Form::button('Send Password Reset Link', ['type' => 'submit']) !!}
                            </div>
                            <a class="forget_pass" href="{{ route('frontend.show_login_form') }}">Login</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
