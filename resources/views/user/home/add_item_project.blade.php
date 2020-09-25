@extends('user.layouts.layout')

@section('title')
    إضافة عنصر
@endsection

@section('header')

@endsection

@section('content')
{{--    <div style="height: 75px"></div>--}}
    <div class="container " style="margin-top: 75px">

            <div class="col-12">
                

                <div class="col-lg-12">
                    <div class="card card-add-item">
                        <div class="card-header text-center">
                            <strong>طلب إضافة عنصر جديد للمكتبة</strong>
                        </div>

                        <div class="card-body card-block">





                            <form action="{{route('user.item.store')}}" method="post"  class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div id="step1">
                                    <div class="card-header">
                                        <strong>البيانات الرئيسية</strong>
                                    </div>
                                    <hr>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">العنوان</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="name" placeholder="العنوان" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>


                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror


                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="textarea-input" class=" form-control-label">الوصف</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <textarea name="desc" id="textarea-input" rows="9" placeholder="الوصف....." class="form-control @error('desc') is-invalid @enderror"  autocomplete="desc" required autofocus >{{ old('desc') }}</textarea>
                                        </div>


                                        @error('desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">المادة</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="subject_id" id="select" class="form-control">
                                                @foreach($subjects as $subject)
                                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">الدكتور المشرف</label>
                                        </div>
                                        <div id="" class="col-12 col-md-9">
                                            <select id="maintainer_id" name="maintainer_id" id="select" class="form-control">
                                                @foreach($maintainers as $maintainer)
                                                    <option value="{{$maintainer->id}}">{{$maintainer->first_name}} {{$maintainer->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group ">
                                        <div class="col col-md-3">
                                            <label for="file-multiple-input" class=" form-control-label"> الملفات المرافقة للعنصر</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" name="myfiles[]" multiple=""  class="form-control-file" accept="image/*,application/pdf" />
                                        </div>
                                    </div>
                                </div>

                                <div id="step2" style="display: none">
                                    <div  class="table-responsive table-data">
                                        <table id="maintainer_table" class="table text-center">
                                            <thead>
                                            <tr>
                                                <td>#</td>
                                                <td><h5>Tag Name</h5></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {{--<input value="{{$tags}}" name="tags[]" type="hidden">--}}

                                            @foreach($tags as $tag)
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input value="{{$tag->id}}" name="tag_id[]" type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td name="tags">{{$tag->name}}</td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="step3" style="display: none">
                                  <!--  <h4>step 3</h4> -->
                                </div>


                                <div style="overflow:auto;">
                                 
                                
                                    <button type="button" id="prevBtn" onclick="show_page(-1)" style="display: none;" class="btn btn-danger" >السابق</button>
                                    <button type="button" id="nextBtn" onclick="show_page(1)" class="btn btn-danger">التالي</button>
                                    <button type="submit" id="subBtn" style="display: none" class="btn btn-danger">حفظ</button>

                                        <!--<button  id="prevBtn" onclick="show_page(-1)">السابق</button>
                                        <button type="button" id="nextBtn" onclick="show_page(1)">التالي</button>
                                        <button type="submit" id="subBtn" style="display: none">حفظ</button>-->
                                    
                                </div>


                            </form>



                        </div>




                    </div>
                </div>



        </div>
    </div>

@endsection

@section('footer')



    <script>

        var curr_index_page = 1;

        var prevBtn = document.getElementById('prevBtn');
        var nextBtn = document.getElementById('nextBtn');
        var subBtn = document.getElementById('subBtn');
       // prevBtn.disabled = true;
        prevBtn.style.display = "none";


        function show_page(index)
        {
            var curr_page = document.getElementById('step'+curr_index_page);
            curr_page.style.display = "none";
            
            curr_index_page = curr_index_page + index;
            var curr_page = document.getElementById('step'+curr_index_page);
            curr_page.style.display = "block";

            if(curr_index_page > 1)
            {
                prevBtn.style.display = "inline-block";
                nextBtn.style.display = "inline-block";
               // prevBtn.disabled = false;
            }
            else
            {
                prevBtn.style.display = "none";
               // prevBtn.disabled = true;
            }

            if(curr_index_page == 3 )
            {
                nextBtn.style.display = "none";

                subBtn.style.display = "inline-block";
            
            }
            else
            {
                nextBtn.disabled = false;

                nextBtn.style.display = "inline-block";

                subBtn.style.display = "none";

            }

            console.log(curr_index_page);
        }








    </script>
@endsection
