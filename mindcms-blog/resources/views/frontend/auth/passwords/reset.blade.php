@extends('layouts.app')
@section('content')

    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Reset Password</h3>
                        <form method="post" action="{{route('password.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                        <div class="account__form">
                            <div class="input__box">
                                <label for="email">Email  *</label>
                              <input type="email" name="email" value="{{old('email')}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input__box">
                                <label for="password">Password *</label>
                                <input type="password" name="password">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input__box">
                                <label for="password_confirmation">Re-Password *</label>
                                <input type="password" name="password_confirmation">
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form__btn">
                                {!! Form::button('Reset Password', ['type' => 'submit']) !!}
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
