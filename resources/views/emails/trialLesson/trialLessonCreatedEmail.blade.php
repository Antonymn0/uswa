@component('mail::message')
<img src="{{url('https://uswa-app.herokuapp.com/images/logo.svg')}}" style="width:90px; float:right" alt="menuthy Logo">
<br>
# Dear {{$tutor->first_name}}

You have recieved a new trial lesson request. Please login  into your  dashboard to view the request and respond.

@component('mail::button', ['url' => url('home')] )
Dashboard
@endcomponent

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
