@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h2> Dear {{$student->first_name}},</h2> 

We regret to inform you that your request for {{$trial_lesson->lesson_type}} trial lessons  has been declined. The tutor declined the request due to:  {{$trial_lesson->decline_reason}}.

We have numerous other high rating {{$trial_lesson->lesson_type}} tutors that you can consider and get your lessons going. <br>
Please browse the list and find another tutor.

@component('mail::button', ['url' => url('home')] )
{{$trial_lesson->lesson_type}} tutors
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
