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

                <form action="{{route('item.store')}}" method="post" class="">
                    @csrf


                    @foreach($item as $key => $value)
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                    @endforeach

                    @foreach($newauthors as $newauthor)
                        <input value="{{$newauthor['first_name']}}" name="first_name[]" type="hidden">
                        <input value="{{$newauthor['last_name']}}" name="last_name[]" type="hidden">
                        <input value="{{$newauthor['mobile']}}" name="mobile[]" type="hidden">
                    @endforeach
                    @if($oldauthors != null)
                    @foreach($oldauthors as $oldauthor)
                        <input value="{{$oldauthor}}" name="oldauthor[]" type="hidden">
                    @endforeach
                    @endif


                    <div class="row" >

                        <div class="col-lg-6">
                            <div class="user-data m-b-30">
                                <h3 class="title-3 m-b-30">
                                    <i class="zmdi zmdi-account-calendar"></i>
                                    Tags
                                </h3>


                                <div  class="table-responsive table-data">
                                    <table id="maintainer_table" class="table">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Tag Name</td>
                                        </tr>
                                        </thead>
                                        <tbody>
{{--                                        <input value="{{$tags}}" name="tags[]" type="hidden">--}}

                                        @foreach($tags as $tag)
                                            <tr>
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input value="{{$tag->id}}" name="tag_id[]" type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td name="tags">{{$tag->name}}</td>

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
                                        <table id="tag_table" class="table table-top-countries">
                                            <thead>
                                            <tr>
                                                <td style="color: white;font-style: italic;font-weight: bold">Tage Name</td>
                                            </tr>
                                            </thead>
                                            <tbody id="tags_body">

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
                                    Add Tag
                                </h3>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Tag Name</div>
                                        <input id="tag_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autocomplete="name" autofocus>

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
                                    <button id="add_button" type="button" class="btn btn-primary btn-sm">Add Tag</button>
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
        var tags_body = document.getElementById('tags_body');
        var tag_name = document.getElementById('tag_name');
        var tags = document.getElementsByName('tags');
        var array_tags = [];
        // $(function () {
        //     $("#add_button").onclick(function () {
        //
        //                 tags_body.innerHTML += '<tr>\n' +
        //                     '                                                <td>'+ first_name +'</td>\n' +
        //                     '                                                <td>'+ last_name +'</td>\n' +
        //                     '                                                <td>'+ mobile +'</td>\n' +
        //                     '                                            </tr>';
        //                 first_name =last_name= mobile= '';
        //     });
        // })

        var tr_id = 0;
        var ch=false;
        add_button.onclick = function () {
            if(tag_name.value === '')
            {

            }
            else
            {
                var i = 0;
                for(var tag in tags)
                {
                    if(  (tags[i].innerText.toUpperCase() === tag_name.value.toUpperCase()) )
                    {
                        alert('tag is defind');
                        break;
                    }
                    else if( i == tags.length-1  && tags[i].innerText.toUpperCase() != tag_name.value.toUpperCase())
                    {
                        ch=false;
                        tags_body.innerHTML += '<tr>\n' +
                            '                               <td>'+ tag_name.value +'</td>\n' +
                            '<input type="hidden" name="tag_name[]" value="'+ tag_name.value +'">' +
                            '                     </tr>' ;
                        tag_name.value = '';
                        console.log(tr_id);
                        tr_id++;
                        console.log(tr_id);

                    }
                    console.log(tag_name.value);
                    i++;
                }
                //
                // if(!ch){
                //     tags_body.innerHTML += '<tr name="m" id="'+tr_id+'">\n' +
                //         '                               <td>'+ tag_name.value +'</td>\n' +
                //         '<input type="hidden" name="tag_name[]" value="'+ tag_name.value +'">' +
                //         '                     </tr>' ;
                //     tag_name.value = '';
                //     console.log(tr_id);
                //     tr_id++;
                //     console.log(tr_id);
                //     ch=false;
                // }
                //






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
                document.getElementById("tag_table").deleteRow(idrow);
            }

        }





    </script>

@endsection
