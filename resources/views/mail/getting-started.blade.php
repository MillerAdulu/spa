@component('mail::message')
# Hello!,

Thanks for signing up. Please login below to get started.

@component('mail::button', ['url' => $url])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
