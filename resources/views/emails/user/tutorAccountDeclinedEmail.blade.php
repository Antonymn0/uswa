@component('mail::message')
# Dear {{$tutor->first_name}},

Your Uswa tutor account has failed the approval process due to: <br>  {{$tutor->revert_reason}}. <br>
Please correct the said issues for the process to continue

@component('mail::button', ['url' => url('home')] )
Profile
@endcomponent

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
