@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset('') }}uploads/settings/{{ $setting->site_logo}}" alt="{{ $setting->site_name}}" height="35" width="35">
            {{$setting->site_name}}
        @endcomponent
    @endslot

    Thank you for Test Prepration submission to us.<br>
    Stay tuned for new updates.<br>
    Thanks,<br>
    {{ config('app.name') }}

    @slot('footer')
        @component('mail::footer')
            {{$setting->site_name}}
        @endcomponent
    @endslot
@endcomponent
