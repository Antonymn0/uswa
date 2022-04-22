@component('mail::message')
<img src="{{url('https://uswa-app.herokuapp.com/images/logo.svg')}}" style="width:90px; float:right" alt="menuthy Logo">
<br>
#Dear {{$user->first_name}} {{$user->last_name}}

You have authorised a payment of USD {{$transaction->amount_transacted}} from your Paypal account towards USWA leaning platform.
This amount will be held in your account until the lesson is delivered.

@component('mail::button', ['url' => url('/home')])
Uswa
@endcomponent


With regards,<br>
{{ env('APP_NAME') }}
@endcomponent
