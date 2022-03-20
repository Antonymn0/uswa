@component('mail::message')
# Dear {{$user->first_name}} {{$user->last_name}}

You have authorised a payment of USD {{$transaction->amount_transacted}} in your Paypal account towards USWA leaning platform.
This amount will be held in your account untill the lesson is delivered.
After which it will be transfered to the tutor. 
If you do not take the lesson this amount will remain in your account.
We highly recommend you take the lesson within 3 days for efficient and smooth transactions.

@component('mail::button', ['url' => url('/home')])
Uswa
@endcomponent


With regards,<br>
{{ env('APP_NAME') }}
@endcomponent
