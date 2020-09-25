@extends('admin_panel.layouts.layout')


@section('title')
إضافة عنصر جديد
@endsection

@section('header')
@endsection


@section('content')


    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">
                إضافة عنصر جديد
            </h3>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Example Form</div>
            <div class="card-body card-block">

                <form action="{{route('item.tosetAuthor')}}" method="post" class="">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Title</div>
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

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Description</div>
                            <textarea id="desc" type="text_area" placeholder="write the description here" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" required autocomplete="desc" autofocus></textarea>

                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>

                            @error('desc')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>

                    {{--                    --}}

                    <div class="row" >

                        <div class="col-lg-6" >
                            <!-- USER DATA-->
                            <div class="user-data m-b-30">
                                <h3 class="title-3 m-b-30">
                                    <i class="zmdi zmdi-account-calendar"></i>
                                    Subjects
                                </h3>


                                <div class="table-responsive table-data">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Subject Name</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subjects as $subject)
                                            <tr>
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input value="{{$subject->id}}" name="subject_id" type="radio">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$subject->name}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END USER DATA-->
                        </div>

                        <div  class="col-lg-6">
                            <!-- USER DATA-->
                            <div class="user-data m-b-30">
                                <h3 class="title-3 m-b-30">
                                    <i class="zmdi zmdi-account-calendar"></i>
                                    Item States
                                </h3>


                                <div  class="table-responsive table-data">
                                    <table  class="table">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Item State</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($item_states as $item_state)
                                            <tr>
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input value="{{$item_state->id}}" name="item_state_id" type="radio">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$item_state->name}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END USER DATA-->
                        </div>

                    </div>

                    <div class="row" >

                        <div class="col-lg-6" >
                            <!-- USER DATA-->
                            <div class="user-data m-b-30">
                                <h3 class="title-3 m-b-30">
                                    <i class="zmdi zmdi-account-calendar"></i>
                                    Item Type
                                </h3>


                                <div class="table-responsive table-data">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Type Name</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($item_types as $item_type)
                                            <tr>
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input id="item_type_id" value="{{$item_type->id}}" name="item_type_id" type="radio">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$item_type->name}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END USER DATA-->
                        </div>

                        <div id="Maintainers_div"  class="col-lg-6">
                            <!-- USER DATA-->
                            <div class="user-data m-b-30">
                                <h3 class="title-3 m-b-30">
                                    <i class="zmdi zmdi-account-calendar"></i>
                                    Maintainers
                                </h3>


                                <div  class="table-responsive table-data">
                                    <table id="maintainer_table" class="table">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>First Name</td>
                                            <td>Last Name</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($maintainers as $maintainer)
                                        <tr>
                                            <td>
                                                <label class="au-checkbox">
                                                    <input value="{{$maintainer->id}}" name="maintainer_id" type="radio">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>{{$maintainer->first_name}}</td>
                                            <td>{{$maintainer->last_name}}</td>

                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END USER DATA-->
                        </div>

                    </div>



                    {{--                    --}}

                    <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Next</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
@endsection

maintainer_table
@section('footer')





    {!! Html::script('admin/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('admin/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script type="text/javascript">

        $('#maintainer_table').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });

        // $(function () {
        //     var v = $("#item_type_id").val();
        //     console.log(v);
        // });


        // var Maintainers_div = document.getElementById('Maintainers_div');
        // var myType = document.getElementById('item_type_id');
        // myType.onchange = function () {
        //     var typeValue = myType.value;
        //     console.log(typeValue);
        // }

    </script>

@endsection
