@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h2>Dear {{$user->first_name}}, </h2>

Your {{$transaction->transaction_type }} transaction of USD {{$transaction->amount_transacted }} has been processed.

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
