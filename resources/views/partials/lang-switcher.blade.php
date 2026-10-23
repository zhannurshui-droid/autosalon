<div class="lang">
    @foreach (['ru' => 'RU', 'kk' => 'ҚАЗ', 'en' => 'EN'] as $code => $label)
        <a href="{{ route('locale', $code) }}" @class(['active' => app()->getLocale() === $code])>{{ $label }}</a>
        @if (! $loop->last) | @endif
    @endforeach
</div>