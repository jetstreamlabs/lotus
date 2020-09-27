@component('mail::message')
## Hi {{ $name }},

Thanks for your interest in {{ config('app.name') }}.

Please confirm your email address by clicking on the button below.

@component('mail::button', ['url' => $url, 'color' => 'green'])
Confirm
@endcomponent

Cheers,<br>
Team {{ config('app.name') }}
@endcomponent
