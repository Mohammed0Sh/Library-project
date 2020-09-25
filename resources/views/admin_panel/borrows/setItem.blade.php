@extends('admin_panel.layouts.layout')


@section('title')
تحديد العنصر
@endsection

@section('header')
@endsection


@section('content')


    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">
                تحديد العنصر</h3>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-body card-block">

                <form action="{{route('borrow.setuser')}}" method="post" class="">
                    @csrf
                    <div class="col-lg-12">
                        <div class="table-responsive table--no-card m-b-30">
                            <table id="table" class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="text-center">cheked</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Maintainer</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">State</th>
                                    <th class="text-center">Added Date</th>

                                </tr>

                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    @if($item->item_state_id == 1 || $item->item_state_id == 4)
                                    <tr>

                                        <td class="text-center">
                                            <input name="item_id" type="radio" value="{{$item->id}}" required autocomplete="item_id" autofocus >
                                        </td>
                                        <td class="text-center">{{$item->name}}</td>
                                        <td class="text-center">{{$item->getItem_Type->name}}</td>
                                        <td class="text-center">{{$item->getMaintainer->first_name}}</td>
                                        <td class="text-center">{{$item->getSubject->name}}</td>
                                        <td class="text-center">

                                            @php
                                                switch($item->getItem_State->id ):
                                                    case 4 :
                                                    case 3 :
                                            @endphp
                                            <span class="role " style="background-color: #c69500">{{$item->getItem_State->name}}</span>
                                            @php
                                                break;

                                            case 2:
                                            @endphp
                                            <span class="role " style="background-color: darkred">{{$item->getItem_State->name}}</span>
                                            @php
                                                break;
                                            case 1:
                                            @endphp
                                            <span class="role " style="background-color: green">{{$item->getItem_State->name}}</span>
                                            @php
                                                break;
                                        endswitch;
                                            @endphp


                                        </td>
                                        <td class="text-center">{{$item->created_at}}</td>


                                    </tr>
                                    @endif
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
