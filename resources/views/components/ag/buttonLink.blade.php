<button {!! $attributes->merge(['class' => 'inline-flex items-center font-medium duration-300']) !!}>
    @if(!empty($iconLeft))
        <em class="fa-solid {{ $iconLeft }} mr-2"></em> {{ __($text) }}
    @elseif(!empty($iconRight))
        {{ __($text) }} <em class="fa-solid {{ $iconRight }} ml-2"></em>
    @elseif(!empty($icon))
        <em class="fa-solid {{ $icon }}"></em>
    @else
        {{ $slot ?? __($text) }}
    @endif
</button>
