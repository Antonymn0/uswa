@component('mail::message')
<img src="{{url('https://uswa-app.herokuapp.com/images/logo.svg')}}" style="width:90px; float:right" alt="menuthy Logo">
<br>
#Congratulations {{$user->first_name}},

Your  onboarding process is successful.
You will now be able to accept paymets from your students on Uswa through paypal.


Regards,<br>
{{ env('APP_NAME') }}
@endcomponent
