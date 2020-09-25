
@extends('user.layouts.layout')

@section('title')
    تفاصيل العنصر
@endsection

@section('header')
@endsection

@section('content')

    <div class="header d-flex">
        <div class="container filterDiv align-self-center rounded">
            <div class="row">

                <form action="{{route('search_result')}}" method="POST" class=" mr-auto ml-auto">
                    @csrf
                    <div class="col-12">

                        <h3 class="title-search">البحث عن عنصر معين</h3>

                        <div class="input-group mb-3 parent_search ">
                            <div class="input-group-append ">
                                <button class="btn btn-success" type="submit">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                    </svg>
                                </button>
                            </div>
                            <input name="text_search" type="search" value="" class="form-control" placeholder="بحث">
                        </div>

                        <div>
                            <div class="form-group form-filter">
                                <label for="typeBook" class="bg-primary label-filter">نوع العنصر</label>
                                <select name="item_type_id"  class="" id="typeBook">
                                    <option value="0">الكل</option>

                                </select>
                            </div>
                            <div class="form-group form-filter">
                                <label for="" class="bg-primary label-filter">المادة</label>
                                <select name="subject_id"  class="" id="">
                                    <option value="0">الكل</option>

                                </select>
                            </div>
                            <div class="form-group form-filter">
                                <label for="" class="bg-primary label-filter">الدكتور المشرف</label>
                                <select name="maintainer_id" class="" id="">
                                    <option value="0">الكل</option>

                                </select>
                            </div>
                            <div class="form-group form-filter">
                                <label for="" class="bg-primary label-filter">حالة العنصر</label>
                                <select name="item_state_id" class="" id="">
                                    <option value="0">الكل</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

<br>
    <br><br><br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-12 ">

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="carousel-item active " >
                            <tr>
                                <td>
                                    <div class="card " >
                                        <img class="card-img-top" src="image/header2.jpg" alt="Card image">
                                        <div class="card-body">
                                            <h4 class="card-title">اسم الكتاب</h4>
                                            <p class="card-text">بعض المعلومات  عن الكتاب</p>
                                            <a href="#" class="btn btn-primary d-flex">معلومات اضافية</a>
                                        </div>
                                        <div class="card-footer">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card " >
                                        <img class="card-img-top" src="image/header2.jpg" alt="Card image">
                                        <div class="card-body">
                                            <h4 class="card-title">اسم الكتاب</h4>
                                            <p class="card-text">بعض المعلومات  عن الكتاب</p>
                                            <a href="#" class="btn btn-primary d-flex">معلومات اضافية</a>
                                        </div>
                                        <div class="card-footer">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card " >
                                        <img class="card-img-top" src="image/header2.jpg" alt="Card image">
                                        <div class="card-body">
                                            <h4 class="card-title">اسم الكتاب</h4>
                                            <p class="card-text">بعض المعلومات  عن الكتاب</p>
                                            <a href="#" class="btn btn-primary d-flex">معلومات اضافية</a>
                                        </div>
                                        <div class="card-footer">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </td>

                            </tr>




                        </div>

                        <div class="carousel-item">
                            <img class="d-block w-100" src="..." alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="..." alt="Third slide">
                        </div>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>


            </div>
        </div>
    </div>




@endsection

    @section('footer')
    @endsection

