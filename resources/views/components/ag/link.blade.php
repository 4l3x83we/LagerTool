<a {!! $attributes->merge(['href' => $link, 'class' => 'inline-flex items-center font-medium']) !!}>
    @if(!empty($linkText))
        {{ $linkText }}
    @else
        <em class="fa-solid {{ $icon }}"></em>
    @endif
</a>
