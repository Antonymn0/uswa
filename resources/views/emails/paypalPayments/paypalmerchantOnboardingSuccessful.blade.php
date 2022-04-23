@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h2>Congratulations {{$user->first_name}}, </h2> 

Your  onboarding process is successful.
You will now be able to accept paymets from your students on Uswa through paypal.


Regards,<br>
{{ env('APP_NAME') }}
@endcomponent
