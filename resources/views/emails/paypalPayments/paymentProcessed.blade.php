@component('mail::message')
# Dear so and so,

Your student john has payed you. A payment of USD 10 has been transfered into your paypal account. <br>
Please check your account to confirm.


@component('mail::button', ['url' => url('/home')])
Uswa
@endcomponent

Regards,<br>
{{ env('APP_NAME') }}
@endcomponent
