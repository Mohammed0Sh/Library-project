@component('mail::message')
    Dear {{$data['name']}}

    You have exceeded the period specified for checking out the item item with title : {{$data['title']}}  by {{$data['day']}} days

Thanks,<br>
{{ config('app.name') }}
@endcomponent
