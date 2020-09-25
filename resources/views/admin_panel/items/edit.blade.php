@extends('admin_panel.layouts.layout')


@section('title')
    تفاصيل العنصر
@endsection

@section('header')
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">
                تفاصيل العنصر
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">    <b>{{$item->name}}</b>  </h3>
                </div>
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <form action="{{route('item.update',$item->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">

                            <div class="panel box box-primary ">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                                        وصف العنصر
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                    <div class="card">

                                        <div class="card-body card-block">

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Title</div>
                                                    <input id="name" type="text" name="name" class="form-control text-right" value="{{$item->name}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon ">Description</div>
                                                    <textarea id="desc" type="text" name="desc" class="form-control text-right">{{$item->desc}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon ">Type</div>

                                                        <select class="form-control" id="type" name="type">
                                                            @foreach($item_types as $item_type)
                                                                @if($item_type->id == $item->item_type_id)
                                                                    <option selected value="{{$item_type->id}}">{{$item_type->name}}</option>
                                                                @else
                                                                    <option value="{{$item_type->id}}">{{$item_type->name}}</option>
                                                                @endif

                                                            @endforeach
                                                        </select>




                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon ">Subject</div>

                                                    <select class="form-control" id="subject" name="subject">
                                                        @foreach($subjects as $subject)
                                                            @if($subject->id == $item->subject_id)
                                                                <option selected value="{{$subject->id}}">{{$subject->name}}</option>
                                                            @else
                                                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon ">State</div>

                                                    <select class="form-control" id="state" name="state" >
                                                        @foreach($item_states as $item_state)
                                                            @if($item_state->id == $item->item_state_id)
                                                                <option selected value="{{$item_state->id}}">{{$item_state->name}}</option>
                                                            @else
                                                                <option value="{{$item_state->id}}">{{$item_state->name}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon ">Maintainer</div>

                                                    <select class="form-control" id="maintainer" name="maintainer">
                                                        @foreach($maintainers as $maintainer)
                                                            @if($maintainer->id == $item->maintainer_id)
                                                                <option selected value="{{$maintainer->id}}">{{$maintainer->first_name}} @if($maintainer->id != 1) {{$maintainer->last_name}} @else @endif</option>
                                                            @else
                                                                <option value="{{$maintainer->id}}">{{$maintainer->first_name}} @if($maintainer->id != 1) {{$maintainer->last_name}} @else @endif</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="panel box box-danger">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                                        المؤلفون
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">


                                    <div class="form-group">
                                        @foreach($authors as $key => $author)
                                            <span class="role user">{{$author->first_name }} {{$author-> last_name }}</span>
                                        @endforeach
                                    </div>


                                </div>
                            </div>
                        </div>
                            <div class="panel box box-success">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                                        التاغات
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">

                                    <div class="form-group">
                                    @foreach($tags as $key => $tag)
                                            <span class="role user">{{$tag->name }}</span>
                                    @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>

                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection


@section('footer')

@endsection
