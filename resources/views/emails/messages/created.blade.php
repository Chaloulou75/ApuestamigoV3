@component('mail::message')

<ul>
	<li>{{$name}}</li>
	<li>{{$email}}</li>
</ul>



@component('mail::panel')
{{ $msg}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
