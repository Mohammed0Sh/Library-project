@extends('user.layouts.layout')


@section('title')
طلب تسجيل عضوية جديدة
@endsection

@section('header')
@endsection


@section('content')


    <div class="Login d-flex">
        <div class="container  align-self-center createAccount">
            <div class="row">

                <form method="POST" action="{{ route('user.store_user_request') }}" class="Login-form">
                    @csrf
                    <div class="col-12 mt-3 mb-3 text-center">
                        <span class="Login-title" >تسجيل حساب جديد</span>
                    </div>


                    <div class="col-12 Login-span">
                        <span>الاسم الاول</span>
                    </div>
                    <div class="col-12 dis">
                        <input id="name" class="Login-input form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    </div>

                    <div class="col-12 Login-span">
                        <span>الاسم الاخير</span>
                    </div>
                    <div class="col-12 dis">
                        <input id="name" class="Login-input form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    </div>


                    <div class="col-12 Login-span">
                        <span>الايميل</span>
                    </div>
                    <div class="col-12 dis">
                        <input id="email" class="Login-input form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    </div>

                    <div class="col-12 Login-span">
                        <span>كلمة السر</span>
                    </div>
                    <div class="col-12 dis">
                        <input id="password" class="Login-input form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>


                    <div class="col-12 Login-span">
                        <span>تكرار كلمة السر</span>
                    </div>
                    <div class="col-12 dis">
                        <input id="password-confirm" type="password" class="Login-input form-control" name="password_confirmation" required autocomplete="new-password">


                    </div>



                    <div class="col-12 mb-3 dis">
                        <button type="submit" class="btn btn-primary Login-submit">
                             التسجيل
                        </button>

                    </div>


                </form>
            </div>

        </div>
    </div>

@endsection


@section('footer')
@endsection
