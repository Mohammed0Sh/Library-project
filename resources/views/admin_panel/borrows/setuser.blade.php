@extends('admin_panel.layouts.layout')


@section('title')
تحديد المستخدم
@endsection

@section('header')
@endsection


@section('content')


    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">
                تحديد المستخدم</h3>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-body card-block">

                <form action="{{route('borrow.store')}}" method="post" class="">
                    @csrf
                    <input type="hidden" name="item_id" value="{{$item_id}}">
                    <div class="col-lg-12">
                        <div class="table-responsive table--no-card m-b-30">
                            <table id="table" class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="text-center">cheked</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Privilege</th>
                                    <th class="text-center">E-Mail</th>

                                </tr>

                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center">
                                            <input name="user_id" type="radio" value="{{$user->id}}" required autocomplete="user_id" autofocus >

                                        </td>
                                        <td class="text-center">{{$user->first_name}}</td>
                                        <td class="text-center">{{$user->last_name}}</td>
                                        <td class="text-center">{!!   ($user->getRole->id == 1)?  '<span class="role admin">'.$user->getRole->name.'</span>' :  '<span class="role user">'.$user->getRole->name.'</span>' !!}</td>
                                        <td class="text-center">{{$user->email}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
