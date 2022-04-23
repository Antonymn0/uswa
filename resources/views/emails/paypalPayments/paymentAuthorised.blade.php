@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h2>Dear {{$user->first_name}} {{$user->last_name}} </h2> 

You have authorised a payment of USD {{$transaction->amount_transacted}} from your Paypal account towards USWA leaning platform.
This amount will be held in your account until the lesson is delivered.

@component('mail::button', ['url' => url('/home')])
Uswa
@endcomponent


With regards,<br>
{{ env('APP_NAME') }}
@endcomponent
