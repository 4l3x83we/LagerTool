{{--@props([$currentPage => '', $currentText => '', $currentRoute => '', $pages => ''])--}}
<div class="px-6 mx-auto grid">
    <div class="w-full overflow-hidden">
        <div class="w-full overflow-x-auto">
            <x-ag.error.errorMessages/>
            <x-ag.breadcrumb home="Dashboard" page="{{ __($currentPage) }}" route="{{ $currentRoute }}" text="{{ __($currentText) }}">
                @if(!empty($pages))
                    @foreach($pages as $page)
                        @for($i = 0; $i <= count($page) - 1; $i++)
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{!! __($page[$i]['text']) !!}</span>
                            </div>
                        </li>
                        @endfor
                    @endforeach
                @endif
            </x-ag.breadcrumb>
            <div class="flex items-center justify-between flex-wrap my-4">
                {{ isset($headline) ? $headline : '' }}
            </div>

            {{ $slot }}

        </div>
    </div>
</div>
