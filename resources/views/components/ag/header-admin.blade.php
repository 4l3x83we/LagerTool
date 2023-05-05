{{--@props([$currentPage => '', $currentText => '', $currentRoute => '', $pages => ''])--}}
<div class="px-5 mx-auto grid">
    <div class="w-full overflow-hidden">
        <div class="w-full overflow-x-auto px-1">
            <x-ag.error.errorMessages/>
            @isset($var)
                {!! $var !!}
            @else
                {!! Breadcrumbs::render($render) !!}
            @endisset
                {!! isset($headline)
                    ? '<div class="flex items-center justify-between flex-wrap my-4">' . $headline . '</div>'
                    : ''
                !!}

            <h4 {!! $attributes->merge(['class' => 'mb-4 text-2xl font-bold leading-none tracking-tight text-gray-900 md:text-3xl dark:text-white']) !!}>{{ __($currentText) }}</h4>

            {{ $slot }}

        </div>
    </div>
</div>
