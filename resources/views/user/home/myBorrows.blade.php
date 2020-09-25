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
                <h4 class="text-light header_name p-4 rounded">استعاراتي</h4>
                <div class="container" style="color: white" >
                    @if($borrows != null)
                        <table class="table text-center">
                            <thead class="text-light">
                                <tr>
                                    <th>العنوان</th>
                                    <th>الايام المتبقية للاستعارة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody class="bg-primary text-white myBorrowsBody">
                            @foreach($borrows as $borrow)

                                <tr>
                                    <td>{{$borrow->getItem->name}}</td>
                                    <!-- <td id="borrowDay">{{  (int) ( strtotime( $borrow->return_date ) - strtotime( \Carbon\Carbon::now() )  ) / ( 60*60*24 ) }} يوم</td> -->

                                    <td id="idIntDay1"></td>
                                    <script>
                                      var borrownDay = {{  (int) ( strtotime( $borrow->return_date ) - strtotime( \Carbon\Carbon::now() )  ) / ( 60*60*24 ) }};
                                      var borrowDay = Math.floor(borrownDay);
                                      $("#idIntDay1").text("  يوم  "+borrowDay );
                                     </script>
                                    <td>

                                        @if(Auth::user()->hasExtend_Borrowing_on_borrow($borrow->id))
                                                <button type="button" class="btn btn-success" disabled>طلب تمديد الاستعارة</button>
                                        @else
                                            <a href="{{route('user.extend.borrow.show',$borrow->id)}}">
                                                <button type="button" class="btn btn-success">طلب تمديد الاستعارة</button>
                                            </a>
                                        @endif

                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>

                    @else
                        لا يوجد استعارات
                    @endif
                </div>


            </div>
            <br>
            <div class="col-12 ">
                <h4 class="text-light header_name p-4 rounded">حجوزاتي</h4>
                <div class="container" style="color: white" >
                    @if($reservations != null)
 
                    <table class="table text-center">
                            <thead class="text-light">
                                <tr>
                                    <th>العنوان</th>
                                    <th>الايام المتبقية للاستعارة</th>
                                </tr>
                            </thead>
                            <tbody class="bg-primary text-white myBorrowsBody">
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{$reservation->getItem->name}}</td>
                                     
                                    <td id="idIntDay2"></td>
                                    <script>
                                      var reservationDay = {{  (int) ( strtotime( $reservation->return_date ) - strtotime( \Carbon\Carbon::now() )  ) / ( 60*60*24 ) }};
                                      var intReservationDay = Math.floor(reservationDay);
                                      $("#idIntDay2").text("  يوم  "+intReservationDay );
                                     </script>
                                </tr>

                            @endforeach

                            </tbody>
                        </table> 
                    @else
                    <div class="alert success"> asda</div>
                    @endif
                </div>


            </div>

        </div>
    </div>



@endsection

@section('footer')
@endsection
