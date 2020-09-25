@extends('user.layouts.layout')

@section('content')


    <div class="Login d-flex">
        <div class="container  align-self-center loginContainer">
            <div class="row">

                <form method="POST" action="{{ route('login') }}" class="Login-form">
                    @csrf
                    <div class="col-12 mt-4 mb-4">
                        <span class="Login-title" >تسجيل الدخول</span>
                    </div>
                    <div class="col-12 Login-span">
                        <span>الايميل</span>
                    </div>
                    <div class="col-12">
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
                    <div class="col-12">
                        <input id="password" class="Login-input form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    </div>

                    <div class="col-12 mb-4">
                        <button type="submit" class="btn btn-primary Login-submit">
                            تسجيل الدخول
                        </button>

                    </div>
                    <div class="col-12">
                        <a href="{{route('register')}}" class="btn Login-create-Acc btn-primary" > إنشاء حساب </a>

                        @if (Route::has('password.request'))
                            <a class="btn Login-send-pass btn-primary" href="{{ route('password.request') }}">
                                هل نسيت كلمة السر ؟
                            </a>
                        @endif

                    </div>


                </form>
            </div>

        </div>
    </div>



@endsection
