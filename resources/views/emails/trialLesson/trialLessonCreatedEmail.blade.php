@component('mail::message')
# Dear {{$tutor->first_name}}

You have recieved a new trial lesson request. Please login  into your account dashboard to view the request and respond.

@component('mail::button', ['url' => url('home')] )
Dashboard
@endcomponent

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
