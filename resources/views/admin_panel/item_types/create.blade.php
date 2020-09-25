@extends('admin_panel.layouts.layout')


@section('title')
إضافة نوع عنصر جديد
@endsection

@section('header')
@endsection


@section('content')


    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">
                إضافة نوع عنصر جديد
            </h3>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Example Form</div>
            <div class="card-body card-block">

                <form action="{{route('item_type.store')}}" method="post" class="">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Type Name</div>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>


                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>

                            @error('name')
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

