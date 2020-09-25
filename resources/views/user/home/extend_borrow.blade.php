@extends('user.layouts.layout')

@section('title')
استعاراتي
@endsection

@section('header')
@endsection

@section('content')



    <div class="container" style="margin-top: 75px">
        <div class="row">
            <div class="col-12 ">
                <h4 class="text-light header_name p-4 rounded">طلب تمديد الاستعارة</h4>
                <div class="row col-12 text-center text-light extend_borrow ">
                <div class="container ">
                       <div class="row">
                           <div class="col-6"><label>عنوان العنصر</label></div>
                           <div class="col-6 item-name"><label>{{$borrow->getItem->name}}</label></div>
                        </div>
                            <form method="POST" action="{{route('user.extend.borrow.store')}}">
                                @csrf
                                    <div class="row">
                                        <div  class="col-6">
                                                <label> عدد ايام التمديد</label>
                                        </div>
                                        <div class="col-6">
                                                <input type="number" value="10" min="0" max="10"name="day" required>
                                         </div>
                                        <input type="hidden" value="{{$borrow->id}}" name="borrow_id">
                                    </div>

                                    <div class="row d-flex justify-content-center m-2">
                                        <!-- <input type="submit" value="ارسال الطلب" > -->
                                        <button type="submit" class="btn btn-success">ارسال الطلب</button>
                                    </div>
                            </form>
                        </div>
            
        </div>
    </div>



@endsection

@section('footer')
@endsection
