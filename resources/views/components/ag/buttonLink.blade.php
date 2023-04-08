<button {!! $attributes->merge(['class' => 'inline-flex items-center font-medium']) !!}>
    @if(!empty($iconLeft))
        <em class="fa-solid {{ $iconLeft }} mr-2"></em> {{ $text }}
    @elseif(!empty($iconRight))
        {{ $text }} <em class="fa-solid {{ $iconRight }} ml-2"></em>
    @elseif(!empty($icon))
        <em class="fa-solid {{ $icon }}"></em>
    @else
        {{ ($slot) ?: $text }}
    @endif
</button>
