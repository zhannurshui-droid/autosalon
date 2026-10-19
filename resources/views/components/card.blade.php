@props(['title', 'url', 'badge' => null, 'image' => null, 'alt' => ''])

<div class="card">
    @if ($image)
        <img src="{{ $image }}" alt="{{ $title }}" class="card-img">
    @endif

    <div class="card-body">
        <h3>{{ $title }}</h3>
        {{ $slot }}
    </div>
</div>

<article {{ $attributes->merge(['class' => 'card']) }}>
    @if ($image)
        <a href="{{ $url }}">
            <img src="{{ $image }}" alt="{{ $alt ?: $title }}" class="card-img">
        </a>
    @endif

    <h3>
        <a href="{{ $url }}">{{ $title }}</a>
        @if ($badge)
            <x-badge>{{ $badge }}</x-badge>
        @endif
    </h3>
    <p>{{ $slot }}</p>
</article>