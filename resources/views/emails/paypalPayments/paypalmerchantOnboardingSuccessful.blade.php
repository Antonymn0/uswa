@component('mail::message')
# Congratulations {{$user->first_name}},

Your  onboarding process is successful.
You will now be able to accept paymets from your students on Uswa through paypal.


Regards,<br>
{{ env('APP_NAME') }}
@endcomponent
