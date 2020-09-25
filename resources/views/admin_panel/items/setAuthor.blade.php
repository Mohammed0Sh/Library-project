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

                <form action="{{route('item.tosetTag')}}" method="post" class="">
                    @csrf

                    @foreach($item as $key => $value)
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                    @endforeach

                    <div class="row" >

                        <div class="col-lg-6">
                            <div class="user-data m-b-30">
                                <h3 class="title-3 m-b-30">
                                    <i class="zmdi zmdi-account-calendar"></i>
                                    Authors
                                </h3>


                                <div  class="table-responsive table-data">
                                    <table id="maintainer_table" class="table">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>First Name</td>
                                            <td>Last Name</td>
                                            <td>Mobile</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($authors as $author)
                                            <tr>
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input value="{{$author->id}}" name="author_id[]" type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$author->first_name}}</td>
                                                <td>{{$author->last_name}}</td>
                                                <td>{{$author->mobile}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- END USER DATA-->
                        </div>


                        <div class="col-lg-6">
                            <div class="au-card au-card--bg-blue au-card-top-countries m-b-30">
                                <div class="au-card-inner">
                                    <div class="table-responsive">
                                        <table id="team_table" class="table table-top-countries">
                                            <thead>
                                            <tr>
                                                <td style="color: white;font-style: italic;font-weight: bold">First Name</td>
                                                <td style="color: white;font-style: italic;font-weight: bold">Last Name</td>
                                                <td style="color: white;font-style: italic;font-weight: bold">Mobile</td>
                                                <td style="color: white;font-style: italic;font-weight: bold">Controller</td>
                                            </tr>
                                            </thead>
                                            <tbody id="authors_body">

                                            </tbody>
                                        </table>
                                        <button onclick="deleterow(tr_id);" type="button" class="btn btn-warning">Roll Back</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Next</button>
                    </div>
                </form>

                    <div class="row" >

                        <div class="col-lg-6">
                            <div class="user-data m-b-30">
                                <h3 class="title-3 m-b-30">
                                    <i class="zmdi zmdi-account-calendar"></i>
                                    Add Authors
                                </h3>

                                <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">First Name</div>
                                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="" required autocomplete="first_name" autofocus>


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
                                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="" required autocomplete="last_name" autofocus>


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
                                            <div class="input-group-addon">Mobile</div>
                                            <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="" required autocomplete="mobile">


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
                                    <button id="add_button" type="button" class="btn btn-primary btn-sm">Add Author</button>
                                </div>




                            </div>
                        </div>


                    </div>







            </div>
        </div>
    </div>
@endsection

maintainer_table
@section('footer')

    <script>
        var passedArray = <?php echo json_encode($authors); ?>
        console.log("start");
        for(var i = 0; i < passedArray.length; i++)
        {
            console.log(passedArray[i].value);
        }
        console.log("end");
    </script>




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

        var add_button = document.getElementById('add_button');
        var authors_body = document.getElementById('authors_body');
        var first_name = document.getElementById('first_name');
        var last_name = document.getElementById('last_name');
        var mobile = document.getElementById('mobile');

        // $(function () {
        //     $("#add_button").onclick(function () {
        //
        //                 authors_body.innerHTML += '<tr>\n' +
        //                     '                                                <td>'+ first_name +'</td>\n' +
        //                     '                                                <td>'+ last_name +'</td>\n' +
        //                     '                                                <td>'+ mobile +'</td>\n' +
        //                     '                                            </tr>';
        //                 first_name =last_name= mobile= '';
        //     });
        // })

        var tr_id = 0;
        add_button.onclick = function () {
            if(first_name.value === '' || last_name.value === '' || mobile.value === '')
            {

            }else{
                authors_body.innerHTML += '<tr name="m" id="'+tr_id+'">\n' +
                    '                               <td>'+ first_name.value +'</td>\n' +
                    '                               <td>'+ last_name.value +'</td>\n' +
                    '                               <td>'+ mobile.value +'</td>\n' +
                    '<input type="hidden" name="first_name[]" value="'+ first_name.value +'">' +
                    '<input type="hidden" name="last_name[]" value="'+ last_name.value +'">' +
                    '<input type="hidden" name="mobile[]" value="'+ mobile.value +'">'
                    '                     </tr>' ;

                first_name.value =last_name.value= mobile.value= '';
                console.log(tr_id);
                tr_id++;
                console.log(tr_id);
            }
        }

        function deleterow(idrow) {
            if(idrow === 0)
            {

            }
            else{
                console.log(idrow);
                tr_id--;
                console.log(tr_id);
                document.getElementById("team_table").deleteRow(idrow);
            }

        }





    </script>

@endsection
