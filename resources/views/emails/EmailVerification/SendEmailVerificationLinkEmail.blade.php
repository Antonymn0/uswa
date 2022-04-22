@component('mail::message')
<img src="{{url('/images/logo.svg')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h1> 
    Verify your email <br>
    Hello {{$user->first_name}},
</h1>

We are excited that you are here to try our platform.

Please verify your email address by clicking the button below.

@component('mail::button', ['url' => url('/verify-email/'.$user->email)] )
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
