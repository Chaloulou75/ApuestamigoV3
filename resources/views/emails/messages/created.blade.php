@component('mail::message')

# Hey Carlito

-Tu as reçu un mail de {{$name}}

- tu peux lui répondre à cette adresse: {{$email}}

-Son message est le suivant:

@component('mail::panel')
{{ $msg}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
