@component('mail::message')
    # Новая заявка №{{ $c->id }}

    **Имя:** {{ $c->name }}
    **Телефон:** {{ $c->phone }}

    @isset($c->email)
        **Email:** {{ $c->email }}
    @endisset

    @isset($c->message)
        **Сообщение:** {{ $c->message }}
    @endisset

    @isset($c->source_page)
        **Источник:** {{ $c->source_page }}
    @endisset

    @isset($c->meta)
        @component('mail::panel')
            Meta: {{ json_encode($c->meta, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) }}
        @endcomponent
    @endisset

    Спасибо,
    {{ config('app.name') }}
@endcomponent
