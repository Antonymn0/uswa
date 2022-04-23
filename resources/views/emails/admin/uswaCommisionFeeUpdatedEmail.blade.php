@component('mail::message')
<img src="{{url('/images/email_logo.png')}}" style="width:90px; float:right" alt="uswa Logo">
<br>
<h1> Uswa commission fee revised </h1>

<h3> Dear {{$tutor->first_name}} {{$tutor->last_name}} ,</h3>

This is to notify you that Uswa commison fee has been revised from {{$old_account}}% to {{$account}}%. 
This fee will be applied to all payments recieved from students on Uswa effective immediately. <br>
For more information, please do not hesistate to contact us at info@uswa.com. Our friendly customer care team will be happy to assist you with any queries regarding Uswa fees and commisions.


@component('mail::button', ['url' => url('/')] )
Home
@endcomponent

Regards,<br>
{{ env('APP_NAME') }}
@endcomponent