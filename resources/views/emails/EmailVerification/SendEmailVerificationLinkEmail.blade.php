@component('mail::message')
<img src="{{asset('images/logo.svg')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
#Verify your email <br>
Hello {{$user->first_name}},

We are excited that you are here to try our platform.

Please verify your email address by clicking the button below.

@component('mail::button', ['url' => url('/verify-email/'.$user->email)] )
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
