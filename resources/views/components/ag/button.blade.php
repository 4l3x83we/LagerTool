<button {{ $attributes->merge(['type' => $buttonType = 'button', 'class' => '']) }}>
    @if(!empty($icon))
        <em class="fa-solid {{ $icon }} mr-5"></em>
    @else
        {{ $buttonText }}
    @endif
</button>
