@extends('admin_panel.layouts.layout')


@section('title')
    كل المؤلفون
@endsection

@section('header')
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">    كل المؤلفون
            </h3>

            <div class="table-data__tool">

                <div class="table-data__tool-right">
                    <a href="{{route('author.create')}}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>إضافة مؤلف جديد</button>
                    </a>

                </div>
            </div>

        </div>
    </div>



    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
            <table id="table" class="table table-borderless table-striped table-earning">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>
                    <th class="text-center">Mobile</th>
                    <th class="text-center">Controller</th>

                </tr>

                </thead>
                <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td class="text-center">{{$author->id}}</td>
                        <td class="text-center">{{$author->first_name}}</td>
                        <td class="text-center">{{$author->last_name}}</td>
                        <td class="text-center">{{$author->mobile}}</td>
                        <td class="text-center">
                            <div class="table-data-feature">
                                <a href="{{route('author.edit',$author->id)}}">
                                    <button href="" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <i class="zmdi zmdi-edit " style="color:#007bff"></i>
                                    </button>
                                </a>



{{--                                @if($user->id!= 1)--}}
{{--                                    {!! Form::open(array(--}}
{{--                                        'route'=>['user.destroy',$user->id],--}}
{{--                                        'method'=>'DELETE',--}}
{{--                                        'onsubmit'=>"return confirm('هل تريد فعلاً حذف المستخدم ؟')"--}}
{{--                                                    ))!!}--}}

{{--                                    <button type="submit" class="item" data-toggle="modal" data-target="#smallmodal" data-placement="top" title="" data-original-title="Delete">--}}
{{--                                        <i class="zmdi zmdi-delete" style="color:#dc3545"></i>--}}
{{--                                    </button>--}}

{{--                                    {!! Form::close() !!}--}}


{{--                                @endif--}}



                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('footer')



    <!-- modal small -->
    <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Small Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        There are three species of zebras: the plains zebra, the mountain zebra and the Grévy's zebra. The plains zebra and the mountain
                        zebra belong to the subgenus Hippotigris, but Grévy's zebra is the sole species of subgenus Dolichohippus. The latter
                        resembles an ass, to which it is closely related, while the former two are more horse-like. All three belong to the
                        genus Equus, along with other living equids.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal small -->



    {!! Html::script('admin/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('admin/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script type="text/javascript">

        $('#table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
    </script>

@endsection
