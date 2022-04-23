@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h2>Dear {{$user->first_name}}  </h2>

A payment of USD {{$transaction->amount_transacted}} has been transfered to your paypal account. <br>
Please check your account to confirm.


@component('mail::button', ['url' => url('/home')])
Uswa
@endcomponent

Regards,<br>
{{ env('APP_NAME') }}
@endcomponent
