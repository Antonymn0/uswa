@component('mail::message')
<img src='{{ $message->embed(asset('/storage/images/logo.svg')) }}' style="width:90px; float:right" alt="menuthy Logo">
<br>
<h2>Dear user, </h2> 

Your {{$transaction->transaction_type }} transaction of USD {{$transaction->amount_transacted }} has been processed.

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
