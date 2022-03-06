@component('mail::message')
# Congratulations {{$tutor->first_name}},

Your tutor account on Uswa has been approved. You can now start accepting requests from students and offer lessons.
Visit your dashboard to see whats happening.

@component('mail::button', ['url' => url('home')] )
Dashboard
@endcomponent

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
