@component('mail::message')
<img src="{{url('https://uswa-app.herokuapp.com/images/logo.svg')}}" style="width:90px; float:right" alt="menuthy Logo">
<br>
# Dear Tutor,

Your student john has payed you. A payment of USD 10 has been transfered to your paypal account. <br>
Please check your account to confirm.


@component('mail::button', ['url' => url('/home')])
Uswa
@endcomponent

Regards,<br>
{{ env('APP_NAME') }}
@endcomponent
