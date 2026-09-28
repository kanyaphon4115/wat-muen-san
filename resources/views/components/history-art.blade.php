@props(['file', 'alt' => ''])
@if(is_file(public_path('images/history/'.$file)))
    <img {{ $attributes->class(['history-art']) }} src="{{ asset('images/history/'.$file) }}" alt="{{ $alt }}" loading="lazy" decoding="async">
@else
    <div {{ $attributes->class(['history-art', 'history-art-pending']) }} aria-hidden="true"></div>
@endif
