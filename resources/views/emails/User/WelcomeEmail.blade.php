@component('mail::message')
<img src="{{url('https://uswa-app.herokuapp.com/images/logo.svg')}}" style="width:90px; float:right" alt="menuthy Logo"> <br>

<h2>{{$user->first_name}}, Welcome to Uswa </h2> 


Thankyou for registering with us. <br>
We help our clients learn new languages virtually with ease.
We have a pool of highly Experienced tutors that will help you speak a new language in a matter of days. <br>
Click the button below to find a tutor and begin your lessons.

@component('mail::button', ['url' => url('dashboard/student')] )
Find a tutor
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
