<button {{ $attributes->merge(['type' => $buttonType = 'button', 'class' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700']) }}>
    @if(!empty($iconLeft))
        <em class="fa-solid {{ $iconLeft }} mr-2"></em> {{ $buttonText }}
    @elseif(!empty($iconRight))
        {{ $buttonText }} <em class="fa-solid {{ $iconRight }} ml-2"></em>
    @elseif(!empty($icon))
        <em class="fa-solid {{ $icon }}"></em>
    @else
        {{ $buttonText }}
    @endif
</button>
