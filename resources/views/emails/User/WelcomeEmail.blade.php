@component('mail::message')
<img src="{{url('/images/menuthy_logo_i.png')}}" style="width:90px; float:right" alt="menuthy Logo"> <br>

# {{$user->first_name}}, Welcome to Uswa


Thankyou for registering with us. <br>
We help our clients learn new languages with ease.
We have highly Experienced tutors that will help you speak a new language in a matter of days. <br>
Click the button below to find a tutor.

@component('mail::button', ['url' => url('dashboard/student')] )
Find a tutor
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
