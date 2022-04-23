@component('mail::message')
<img src="https://uswa-app.herokuapp.com/images/cover.png" style="width:90px; float:right" alt="uswa Logo">
<br>  
<h1>  Verify your email </h1>
    
<h3> Hello {{$user->first_name}},</h3> 


We are excited that you are here to try our platform.

Please verify your email address by clicking the button below.

@component('mail::button', ['url' => url('/verify-email/'.$user->email)] )
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
