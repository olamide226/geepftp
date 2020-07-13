@component('mail::message')
Good Day **All**,  {{-- use double space for line break --}}

@component('mail::panel')
A New file({{$file_name}}) was recently uploaded by {{$name}}
@endcomponent


@component('mail::button', ['url' => $link"])
Go To Site
@endcomponent
Warmest Regards,<br>
EBIS Team.
@endcomponent
