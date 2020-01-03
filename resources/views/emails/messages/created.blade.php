@component('mail::message')

# Hey admin

-{{$name}}

-{{$email}}




@component('mail::panel')
{{ $msg}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
