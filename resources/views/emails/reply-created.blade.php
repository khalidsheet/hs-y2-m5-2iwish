@component('mail::message')
    {{ __('Your wish got a new reply!') }}

    {{ __('Click on the button below to check it') }}

    @component('mail::button', ['url' => route('show-wish', ['wish' => $wish])])
        {{ __('View Reply') }}
    @endcomponent

    {{ __('If you did not expect to receive this email, you may discard it.') }}
@endcomponent
