@extends('admin_panel.layouts.layout')


@section('title')
إضافة مستخدم
@endsection

@section('header')
@endsection


@section('content')


    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">
                إضافة مستخدم</h3>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Example Form</div>
            <div class="card-body card-block">

                <form action="{{route('user.store')}}" method="post" class="">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">First Name</div>
                            <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>


                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Last Name</div>
                            <input id="name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>


                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Email</div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">


                            <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </div>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Password</div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            <div class="input-group-addon">
                                <i class="fa fa-asterisk"></i>
                            </div>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">RePassword</div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <div class="input-group-addon">
                                <i class="fa fa-asterisk"></i>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Privilege</div>

                            {{Form::select('role_id',$roles,2,['id'=>'role_id', 'class'=>'form-control'])}}

                            Choose Privilege...

                            @error('role_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>




                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
@endsection


@section('footer')
@endsection
