@extends('admin_panel.layouts.layout')


@section('title')
    طلبات تمديد الاستعارة
@endsection

@section('header')
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">طلبات تمديد الاستعارات</h3>

            <div class="table-data__tool">

                <div class="table-data__tool-right">
                    <a href="{{route('borrow.setitem')}}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>إضافة استعارة جديدة</button>
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
                    <th class="text-center">Item Name</th>
                    <th class="text-center">User Name</th>
                    <th class="text-center">days</th>
                    <th class="text-center">Controller</th>


                </tr>

                </thead>
                <tbody>
                @foreach($extend_borrows as $extend_borrow)
                    <tr>
                        <td class="text-center">{{$extend_borrow->getBorrow->getItem->name}}</td>
                        <td class="text-center">{{$extend_borrow->getUser->first_name}} {{$extend_borrow->getUser->last_name}}</td>
                        <td class="text-center">{{$extend_borrow->day}}</td>
                        <td class="text-center">
                            <div class="table-data-feature">

                                {!! Form::open(array(
                                        'route'=>['borrow.rejection_extend_borrow',$extend_borrow->id],
                                        'method'=>'DELETE',
                                        'onsubmit'=>"return confirm('هل تريد فعلاً حذف طلب تمديد الاستعارة هذا ؟')"
                                                    ))!!}

                                <button type="submit" class="item"  data-placement="top" title="" data-original-title="Delete">
                                    <i class="zmdi zmdi-delete" style="color:red;"></i>
                                </button>

                                {!! Form::close() !!}

                                {!! Form::open(array(
                                        'route'=>['borrow.accept_extend_borrow',$extend_borrow->id],
                                        'method'=>'POST',
                                        'onsubmit'=>"return confirm('هل تريد فعلاً تأكيد طلب تمديد الاستعارة هذا  ؟')"
                                                    ))!!}

                                <button type="submit" class="item"  data-placement="top" title="" data-original-title="Delete">
                                    <i class="zmdi zmdi-save" style="color:green;"></i>
                                </button>

                                {!! Form::close() !!}

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
