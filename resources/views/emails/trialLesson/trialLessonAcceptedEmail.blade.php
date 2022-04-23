@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h2>Dear {{$student->first_name}}, </h2>  <br>
Your {{$trial_lesson->lesson_type}} trial lesson has been accepted and a meeting scheduled on the specified date. 
Login to your dashboard to view the response. <br>
Happy learning.

@component('mail::button', ['url' => url('home')] )
Dashboard
@endcomponent

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
