@component('mail::message')
<img src="{{url('https://uswa-app.herokuapp.com/images/logo.svg')}}" style="width:90px; float:right" alt="menuthy Logo">
<br>
# Dear user,

Your {{$transaction->transaction_type }} transaction of USD {{$transaction->amount_transacted }} has been processed.

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
