@component('mail::message')
<img src="{{url('https://uswa-app.herokuapp.com/images/logo.svg')}}" style="width:90px; float:right" alt="menuthy Logo">
<br>
<h2>Dear {{$tutor->first_name}}, </h2> 

Your Uswa account has failed the approval process due to: <br>  {{$tutor->revert_reason}}. <br>
Please correct the said issues and submit again. Your account will not be publicly visible until it is approved.

@component('mail::button', ['url' => url('home')] )
Profile
@endcomponent

Regards,<br>
{{ env('APP_NAME') }}
@endcomponent
