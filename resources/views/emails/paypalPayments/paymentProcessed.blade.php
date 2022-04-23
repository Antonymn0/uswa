@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h2> Dear Tutor,</h2> 

Your student john has payed you. A payment of USD 10 has been transfered to your paypal account. <br>
Please check your account to confirm.


@component('mail::button', ['url' => url('/home')])
Uswa
@endcomponent

Regards,<br>
{{ env('APP_NAME') }}
@endcomponent
