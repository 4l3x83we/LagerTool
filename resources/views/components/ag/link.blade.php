<a {!! $attributes->merge(['href' => $link, 'class' => 'inline-flex items-center font-medium text-white rounded text-sm px-5 py-2.5 text-center duration-300']) !!}>
    @if(!empty($iconLeft))
        <em class="fa-solid {{ $iconLeft }} mr-2"></em> {{ __($text) }}
    @elseif(!empty($iconRight))
        {{ __($text) }} <em class="fa-solid {{ $iconRight }} ml-2"></em>
    @elseif(!empty($icon))
        <em class="fa-solid {{ $icon }}"></em>
    @else
        {{ __($text) }}
    @endif
</a>
