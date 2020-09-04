@component('mail::message')
# Welcome, {{ $user->first_name }}

Your account has been created successfully! Please verify your registration.

@component('mail::button', ['url' => $url])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
