@props(['title','url','badge'=>null])

<article {{ $attributes->merge(['class'=>'card']) }}>
    <h3>
        <a href="{{ $url }}">{{ $title }}</a>
        @if($badge)
          <x-badge>{{ $badge }}</x-badge>
        @endif
    </h3>
    <p>{{ $slot }}</p>
</article>