@extends('user.layouts.layout')

@section('title')
    تفاصيل العنصر
@endsection

@section('header')
@endsection

@section('content')

    <div class="container " style="margin-top: 75px">

        <div class="col-12">
          

            <div class="col-lg-12">
                <div class="card bg-primary text-white"">
                    <div class="card-header text-right">
                        <strong>تفاصيل العنصر</strong>
                    </div>

                    <div class="card-body card-block item-detile">

                        <div class="row">
                            <div class="col-lg-3">
                                <label>Title :</label>
                            </div>

                            <div class="col-lg-9 text-left">
                                <label>{{$item->name}}</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label>Description :</label>
                            </div>

                            <div class="col-lg-9 text-left">
                                <label>{{$item->desc}}</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label>Item State :</label>
                            </div>

                            <div class="col-lg-9 text-left">
                                <label>{{$item->getItem_State->name}}</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label>Maintainer :</label>
                            </div>

                            <div class="col-lg-9 text-left">
                                <label>{{$item->getMaintainer->first_name}} {{$item->getMaintainer->last_name}}</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label>Item Type :</label>
                            </div>

                            <div class="col-lg-9 text-left">
                                <label>{{$item->getItem_Type->name}}</label>
                            </div>
                        </div>

                        <div class="row">
                            @if($authors != null)
                                <div class="col-lg-3">
                                    <label>Authos :</label>
                                </div>
                                <div class="col-lg-9 text-left">
                                    @foreach($authors as $author)
                                        <div class="row">
                                            <label>{{$author->first_name}} {{$author->last_name}}</label>
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                        </div>


                        <div class="row">
                            @if($tags != null)
                                <div class="col-lg-3">
                                    <label>Tags :</label>
                                </div>
                                <div class="col-lg-9 text-left">
                                    @foreach($tags as $tag)
                                        <div class="row">
                                            <label>{{$tag->name}}</label>
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                        </div>


                        <div class="row">
                            @if(count($files) != 0)
                                <div class="col-lg-3">
                                    <label>Files</label>
                                </div>
                                <div class="col-lg-9">
                                    @foreach($files as $file)
                                        <div class="row">
                                            <a href="{{route('download',$file->id)}}" class="btn  btn-dark m-2" role="button">{{$file->name}} للتحميل انقر هنا</a>
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                        </div>
             <div class="row">
                <div class="col-lg-3"></div>
                            
                <div class="col-lg-3">
                        <form method="POST" action="{{route('user.favorite.add',$item->id)}}">
                            @csrf

                            @auth
                                @if(Auth::user()->isFavorite($item->id))
                                <button type="submit" class="btn btn-danger">remove from Favorite</button>
                                @else
                                <button type="submit" class="btn btn-danger">add to Favorite</button>
                                @endif
                            @else
                                <button type="submit" class="btn btn-danger" disabled>add to Favorite</button>
                            @endauth

                        </form>
                </div>
                <div class="col-lg-3">

                        <form method="POST" action="{{route('user.reservation.add',$item->id)}}">
                            @csrf


                            @auth

                                @if($item-> item_state_id != 1 )
                                    @if($item-> item_state_id == 4)
                                        @if(Auth::user()->isReservation($item->id))
                                            <button type="submit" class="btn btn-danger">remove from Reservation</button>
                                        @else
                                            <button type="submit" class="btn btn-danger" disabled>add to Reservation</button>
                                        @endif
                                    @else
                                    <button type="submit" class="btn btn-danger" disabled>add to Reservation</button>
                                    @endif

                                @else
                                        <button type="submit" class="btn btn-danger">add to Reservation</button>

                                @endif

                            @else
                                <button type="submit" class="btn btn-danger" disabled>add to Reservation</button>
                            @endauth

                        </form>
                </div>
                <div class="col-lg-3"></div>
            </div>

                <div class="d-flex justify-content-center p-3">
                        @if(Session::has('message'))
                                        {{Session::get('message')}}
                                    @endif
                </div>
            

             </div>




                </div>
            </div>



        </div>
    </div>

@endsection

@section('footer')
@endsection
