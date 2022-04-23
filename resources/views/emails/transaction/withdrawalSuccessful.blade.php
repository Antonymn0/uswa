@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h2>Dear {{$user->first_name}}, </h2>
</h2> 
Your {{$transaction->transaction_type }} transaction of USD {{$transaction->amount_transacted }} has been processed. <br>
 Funds have been moved into your paypal account. Please check your paypal account to confirm.

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
