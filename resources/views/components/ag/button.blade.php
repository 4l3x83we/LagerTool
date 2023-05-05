<button {{ $attributes->merge(['type' => $buttonType = 'button', 'class' => 'px-3 py-2 text-xs mt-1 font-medium text-center text-white bg-orange-700 rounded hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 duration-300']) }}>
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
