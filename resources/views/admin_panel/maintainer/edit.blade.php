@extends('admin_panel.layouts.layout')


@section('title')
تفاصيل المشرف
@endsection

@section('header')
@endsection


@section('content')


    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">تفاصيل المشرف
            </h3>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Example Form</div>
            <div class="card-body card-block">

                <form action="{{route('maintainer.update',$maintainer->id)}}" method="post" class="">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">First Name</div>
                            <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $maintainer->first_name }}" required autocomplete="first_name" autofocus>


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
                            <input id="name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $maintainer->last_name }}" required autocomplete="last_name" autofocus>


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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$maintainer->email }}" required autocomplete="email">


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
                            <div class="input-group-addon">Mobile</div>
                            <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $maintainer->mobile }}" required autocomplete="mobile">


                            <div class="input-group-addon">
                                <i class="fa fa-mobile"></i>
                            </div>

                            @error('mobile')
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
