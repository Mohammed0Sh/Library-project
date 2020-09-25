@extends('admin_panel.layouts.layout')


@section('title')
    طلبات إضافة العناصر
@endsection

@section('header')
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">
                طلبات إضافة العناصر
            </h3>

        </div>
    </div>



    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
            <table id="table" class="table table-borderless table-striped table-earning">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Maintainer</th>
                    <th class="text-center">Subject</th>
                    <th class="text-center">Added Date</th>
                    <th class="text-center">Controller</th>

                </tr>

                </thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td class="text-center">{{$item->id}}</td>
                    <td class="text-center">{{$item->name}}</td>
                    <td class="text-center">{{$item->getItem_Type->name}}</td>
                    <td class="text-center">{{$item->getMaintainer->first_name}} {{$item->getMaintainer->last_name}}</td>
                    <td class="text-center">{{$item->getSubject->name}}</td>
                    <td class="text-center">{{$item->created_at}}</td>


                    <td class="text-center">
                        <div class="table-data-feature">



                            {!! Form::open(array(
                                    'route'=>['item.rejection_add_item_request',$item->id],
                                    'method'=>'DELETE',
                                    'onsubmit'=>"return confirm('هل تريد فعلاً حذف طلب إضافة هذا العنصر ؟')"
                                                ))!!}

                            <button type="submit" class="item" data-toggle="modal" data-target="#smallmodal" data-placement="top" title="" data-original-title="Delete">
                                <i class="zmdi zmdi-delete" style="color:red"></i>
                            </button>

                            {!! Form::close() !!}



                            {!! Form::open(array(
                                    'route'=>['item.accept_add_item_request',$item->id],
                                    'method'=>'POST',
                                    'onsubmit'=>"return confirm('هل تريد فعلاً قبول طلب إضافة هذا العنصر ؟')"
                                                ))!!}

                            <button type="submit" class="item" data-toggle="modal" data-target="#smallmodal" data-placement="top" title="" data-original-title="Delete">
                                <i class="zmdi zmdi-save" style="color:green"></i>
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
