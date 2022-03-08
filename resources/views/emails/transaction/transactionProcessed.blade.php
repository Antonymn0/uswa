@component('mail::message')
# Dear user,

Your {{$transaction->transaction_type }} transaction of USD {{$transaction->amount_transacted }} has been processed.

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
