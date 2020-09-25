@component('mail::message')
Dear {{$data['name']}}

You get {{$data['day']}} days left to return the item with title : {{$data['title']}}


Thanks,<br>
{{ config('app.name') }}

@endcomponent
