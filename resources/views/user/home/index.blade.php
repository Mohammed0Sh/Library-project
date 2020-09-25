@extends('user.layouts.layout')

@section('title')
    الصفحة الرئيسية
@endsection

@section('header')
@endsection

@section('content')

    @include('user.layouts.search')


    <div class="container">
        <div class="row">
        <div class="col-sm-3">
               
            </div>
            <div class="col-sm-3">
                {{$items->links()}}
            </div>
            <div class="col-sm-3">
               
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <h4 class="text-light header_name p-4 rounded">العناصر</h4>

                <div class="row">
                    @foreach($items as $item)
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 card-style">
                            <div class="card_item">
                                <img class="card-img-top" src="{{asset('user/image/header2.jpg')}}" alt="Card image">
                                <div class="card-body">
                                    <h4 class="card-title"> {{$item->name}}  </h4>

                                   <div> <span> الحالة :</span>  <span class="card-text"> {{$item->getItem_State->name}} </span> </div>
                                    <div> <span> اسم المشرف :</span>  <span class="card-text"> {{$item->getMaintainer->first_name}} {{$item->getMaintainer->last_name}} </span> </div>
                                    <div> <span> النوع :</span>  <span class="card-text"> {{$item->getItem_Type->name}} </span> </div>
                                    <div> <span> اسم الكتاب :</span>  <span class="card-text">  {{$item->getSubject->name}} </span>  </div>
<!--
                                    <p class="card-text">
                                        {{$item->getItem_State->name}}
                                    </p>
                                    <p class="card-text">
                                        {{$item->getMaintainer->name}}
                                    </p>
                                    <p class="card-text">
                                        {{$item->getItem_Type->name}}
                                    </p>
                                    <p class="card-text">
                                        {{$item->getSubject->name}}
                                    </p>
-->
                                   <!-- <a href="{{route('user.item.show',$item->id)}}" class="btn btn-primary d-flex">معلومات اضافية</a> -->
                                </div>
                                <div class="card-footer">
                                   <a href="{{route('user.item.show',$item->id)}}" class="btn btn-primary d-flex">معلومات اضافية</a>
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>





            </div>
        </div>
    </div>



@endsection

@section('footer')
@endsection
