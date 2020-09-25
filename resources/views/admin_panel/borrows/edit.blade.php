@extends('admin_panel.layouts.layout')


@section('title')
    تعديل الاستعارة
@endsection

@section('header')
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">تعديل الاستعارة</h3>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">



            <div class="card-header">Example Form</div>
            <div class="card-body card-block">

                <form action="{{route('borrow.update',$borrow->id)}}" method="post" class="">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">


                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Item Name</div>
                            <input type="text" class="form-control" value="{{ $borrow->getItem->name }}" disabled>

                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>

                            @error('return_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">User Name</div>
                            <input type="text" class="form-control" value="{{ $borrow->getUser->first_name }} {{ $borrow->getUser->last_name }}" disabled>

                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>

                            @error('return_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Borrow State</div>
                            <input type="text" class="form-control" value="{{ $borrow->getBorrow_State->name }}" disabled>

                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>

                            @error('return_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>



                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Return Date</div>

                            <input id="return_date" type="date" name="return_date"  class="form-control @error('return_date') is-invalid @enderror" value="{{ $borrow->return_date }}" required autocomplete="return_date" autofocus>

                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>

                            @error('return_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="alert alert-danger" id="message" style="display: none">
                            <span >يجب أن يكون تاريخ الإرجاع الجديد أحدث من تاريخ الحجز السابق !</span>
                        </div>

                    </div>


                    <div class="form-actions form-group">
                        <button id="btn" type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>

                @if($borrow->borrow_state_id == 1)
                    {!! Form::open(array(
                                    'method'=>'PUT',
                                    'route'=>['borrow.canselreservation'],
                                    'onsubmit'=>"return confirm('هل تريد فعلاً إلفاء الحجز ؟')"
                                    )) !!}
                    <input type="hidden" name="borrow_id" value="{{$borrow->id}}">
                    <div class="form-actions form-group">
                        <button id="btn" type="submit" class="btn btn-primary btn-sm">إلغاء الحجز</button>
                    </div>
                    {!! Form::close() !!}
                @endif






            </div>
        </div>
    </div>

@endsection


@section('footer')

    <script>
        var r = document.getElementById('return_date');
        var message = document.getElementById('message');
        var old_return_date = r.value.toString().split('-');
        var old_retuerned = new Date(old_return_date[0],old_return_date[1],old_return_date[2]);

        // if(now.getDate() >= retuerned.getDate() )
        // {
        //     $("#btn").attr("disabled", true);
        //     message.style.display = "block";
        // }
        // else
        // {
        //     $("#btn").attr("disabled", false);
        //     message.style.display = "none";
        // }

        r.onchange = function ()
        {
            r = document.getElementById('return_date');
            new_return_date = r.value.toString().split('-');
            new_retuerned = new Date(new_return_date[0],new_return_date[1],new_return_date[2]);

            if(new_retuerned.getDate() < old_retuerned.getDate() )
            {
                $("#btn").attr("disabled", true);
                message.style.display = "block";
            }
            else
            {
                $("#btn").attr("disabled", false);
                message.style.display = "none";
            }
        }
    </script>

@endsection
