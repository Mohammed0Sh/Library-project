<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-compatible" content="IE=edge" >
    <!--First Mobile Meta-->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>
        المكتبة
        |
        @yield('title')
    </title>

    {!! Html::style('user/css/bootstrap.css') !!}
    {!! Html::style('user/css/style.css') !!}

    {!! Html::script('user/js/html5shiv.min.js') !!}
    {!! Html::script('user/js/respond.min.js') !!}
    {!! Html::script('user/js/jquery-3.4.1.min.js') !!}
    {!! Html::script('user/js/bootstrap.min.js') !!}


    @yield('header')

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#">المكتبة</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item active"><a class="nav-link" href="{{route('home')}}"> الصفحة الرئيسية <span class="sr-only">(current)</span></a> </li>

                @guest
                    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">تسجيل الدخول</a></li>

                    @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{route('register')}}">التسجيل</a></li>
                    @endif
                @else
                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                        <li class="nav-item"><a class="nav-link" href="{{url('admin/index')}}">لوحة التحكم</a></li>
                    @endif

                        <li class="nav-item"><p class="nav-link">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</p></li>

                        <li class="nav-item"><a class="nav-link" href="{{route('user.item.add')}}">إضافة عنصر</a></li>

                        <li class="nav-item"><a class="nav-link" href="{{route('user.borrows.show')}}">استعاراتي</a></li>

                    <li class="nav-item">


                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            تسجيل الخروج
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </li>


                @endguest


            </ul>
        </div>
    </nav>

    @if(Session::has('error_alert'))
    <div class="modal" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel"  aria-hidden="false">
    
        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title " id="smallmodalLabel" >خطأ</h5>
                                <button id="close_div" type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body text-right">
                                <p>
                                {{Session::get('error_alert')}}
                                </p>
                            </div>
                        </div>
                    </div>
                        
        </div> 
    </div>
    @endif
    

    @yield('content')


    @yield('footer')

    <script>
        $('#close_div').on('click',function(){
            $('#smallmodal').fadeToggle();
        });
    </script>
</body>
</html>
