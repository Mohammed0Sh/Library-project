@extends('admin_panel.layouts.layout')


@section('title')
تفاصيل المادة الدراسية
@endsection

@section('header')
@endsection


@section('content')


    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">تفاصيل المادة الدراسية
            </h3>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Example Form</div>
            <div class="card-body card-block">

                <form action="{{route('subject.update',$subject->id)}}" method="post" class="">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Name</div>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $subject->name }}" required autocomplete="name" autofocus>


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



                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Academic Year</div>

                            {{Form::select('academic_year',$academic_years,$subject->getAcademic_Year->id,['id'=>'academic_year', 'class'=>'form-control' ])}}

                            Choose Academic Year...



                            @error('academic_year')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Specialize</div>

                            {{Form::select('specialize',$specializes,$subject->getSpecialize->id,['id'=>'specialize', 'class'=>'form-control' ])}}
                            Choose Specialize...

                            {{--                            ,'disabled'=>''--}}

                            @error('specialize')
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

    <script>
        var academic_year =  document.getElementById('academic_year');
        var specialize =  document.getElementById('specialize');

        academic_year.onchange = function () {
            var value = academic_year.value;
            if(value < 4)
            {
                specialize.value = 1;
                specialize.disabled = true;
            }
            else
            {
                specialize.value = 1;
                specialize.disabled = false;
            }
            console.log(value);
        };



    </script>
@endsection
