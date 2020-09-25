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
                        <input name="text_search" type="search" value="{{ $text_search}}" class="form-control" placeholder="بحث">
                    </div>

                    <div>
                        <div class="form-group form-filter">
                            <label for="typeBook" class="bg-primary label-filter">نوع العنصر</label>
                            <select name="item_type_id"  class="" id="typeBook">
                                <option value="0">الكل</option>
                                @foreach($item_types as $item_type)
                                    @if($item_type_id != null && $item_type_id == $item_type->id)
                                        <option selected value="{{$item_type->id}}">{{$item_type->name}}</option>
                                    @else
                                        <option value="{{$item_type->id}}">{{$item_type->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-filter">
                            <label for="" class="bg-primary label-filter">المادة</label>
                            <select name="subject_id"  class="" id="">
                                <option value="0">الكل</option>
                                @foreach($subjects as $subject)

                                    @if($subject_id != null && $subject_id == $subject->id)
                                        <option selected value="{{$subject->id}}">{{$subject->name}}</option>
                                    @else
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endif


                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-filter">
                            <label for="" class="bg-primary label-filter">الدكتور المشرف</label>
                            <select name="maintainer_id" class="" id="">
                                <option value="0">الكل</option>
                                @foreach($maintainers as $maintainer)

                                    @if($maintainer_id != null && $maintainer_id == $maintainer->id)
                                        <option selected value="{{$maintainer->id}}">{{$maintainer->first_name}} {{$maintainer->last_name}} </option>
                                    @else
                                        <option value="{{$maintainer->id}}">{{$maintainer->first_name}} {{$maintainer->last_name}} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-filter">
                            <label for="" class="bg-primary label-filter">حالة العنصر</label>
                            <select name="item_state_id" class="" id="">
                                <option value="0">الكل</option>
                                @foreach($item_states as $item_state)
                                    @if($item_state_id != null && $item_state_id == $item_state->id)
                                        <option selected value="{{$item_state->id}}">{{$item_state->name}}</option>
                                    @else
                                        <option value="{{$item_state->id}}">{{$item_state->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
