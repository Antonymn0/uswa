@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h2> Dear {{$tutor->first_name}}</h2> 

You have recieved a new trial lesson request. Please login  into your  dashboard to view the request and respond.

@component('mail::button', ['url' => url('home')] )
Dashboard
@endcomponent

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
