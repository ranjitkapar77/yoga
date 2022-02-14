@component('mail::message')
New Test Prepration have booked from your website.<br>
Email:{{ $new_booking['email'] }}<br>
Name: {{ $new_booking['name'] }}<br>
phone: {{ $new_booking['phone'] }}<br>
{{-- Test Prepration Title: {{ $new_booking->getTestPrepration['title']}}<br>
Destination Title: {{ $new_booking->getDestination['title']}} --}}
@endcomponent
