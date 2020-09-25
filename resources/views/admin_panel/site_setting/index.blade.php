@extends('admin_panel.layouts.layout')


@section('title')
    كل الإعدادات
@endsection

@section('header')
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">إدارة الإعدادات</h3>

            <div class="table-data__tool">

                <div class="table-data__tool-right">
                    <a href="{{route('site_setting.create')}}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>إضافة إعداد جديد</button>
                    </a>

                    <form action="{{route('site_setting.update',0)}}" method="post" class="">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="card">
                            <div class="card-header">Example Form</div>
                            <div class="card-body card-block">

                                @foreach($site_settings as $site_setting)
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">{{$site_setting->lable_name}}</div>
                                        <input id="{{$site_setting->name}}" type="text" class="form-control @error('$site_setting->name') is-invalid @enderror" name="{{$site_setting->name}}" value="{{$site_setting->value}}" required autocomplete="{{$site_setting->name}}" autofocus>


                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror

                                    </div>
                                </div>
                                @endforeach


                            </div>
                        </div>

                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">حفظ</button>
                        </div>

                    </form>


                </div>
            </div>

        </div>
    </div>



    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">

        </div>
    </div>
@endsection


@section('footer')


@endsection
