@component('mail::message')
<img src="{{url('https://uswa-app.herokuapp.com/images/logo.svg')}}" style="width:90px; float:right" alt="menuthy Logo">
<br>
# Dear {{$student->first_name}}, <br>
Your {{$trial_lesson->lesson_type}} trial lesson has been accepted and a meeting scheduled on the specified date. 
Login to your dashboard to view the response. <br>
Happy learning.

@component('mail::button', ['url' => url('home')] )
Dashboard
@endcomponent

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
