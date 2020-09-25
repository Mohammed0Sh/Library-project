@extends('admin_panel.layouts.layout')


@section('title')
    كل المستخدمون
@endsection

@section('header')
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">إدارة المستخدمون</h3>

            <div class="table-data__tool">

                <div class="table-data__tool-right">
                    <a href="{{route('user.create')}}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>إضافة مستخدم جديد</button>
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
                    <th class="text-center">Privilege</th>
                    <th class="text-center">E-Mail</th>
                    <th class="text-center">Controller</th>

                </tr>

                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="text-center">{{$user->id}}</td>
                    <td class="text-center">{{$user->first_name}}</td>
                    <td class="text-center">{{$user->last_name}}</td>
                    <td class="text-center">{!!   ($user->getRole->id == 1)?  '<span class="role admin">'.$user->getRole->name.'</span>' :  '<span class="role user">'.$user->getRole->name.'</span>' !!}</td>
                    <td class="text-center">{{$user->email}}</td>
                    <td class="text-center">
                        <div class="table-data-feature">
                            <a href="{{route('user.edit',$user->id)}}">
                                <button href="" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                    <i class="zmdi zmdi-edit " style="color:#007bff"></i>
                                </button>
                            </a>



                            @if($user->id!= 1)
                                {!! Form::open(array(
                                    'route'=>['user.destroy',$user->id],
                                    'method'=>'DELETE',
                                    'onsubmit'=>"return confirm('هل تريد فعلاً حذف المستخدم ؟')"
                                                ))!!}

                                <button type="submit" class="item"  data-placement="top" title="" data-original-title="Delete">
                                    <i class="zmdi zmdi-delete" style="color:#dc3545;"></i>
                                </button>

                                {!! Form::close() !!}


                            @endif



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
