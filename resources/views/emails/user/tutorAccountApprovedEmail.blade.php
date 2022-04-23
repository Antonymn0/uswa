@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h2> Congratulations {{$tutor->first_name}},</h2> 

Your account on Uswa has been approved. You can now start accepting requests from students and offer lessons.
Visit your dashboard to see whats happening.

@component('mail::button', ['url' => url('home')] )
Dashboard
@endcomponent

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
