@component('mail::message')
<img src="{{url('https://uswa-app.herokuapp.com/images/logo.svg')}}" style="width:90px; float:right" alt="menuthy Logo">
<br>
# Congratulations {{$tutor->first_name}},

Your account on Uswa has been approved. You can now start accepting requests from students and offer lessons.
Visit your dashboard to see whats happening.

@component('mail::button', ['url' => url('home')] )
Dashboard
@endcomponent

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
