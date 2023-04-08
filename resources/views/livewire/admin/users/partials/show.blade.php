<div>
    <div class="relative overflow-x-auto">
         <div class="w-full max-w-full bg-white border border-gray-200 rounded shadow dark:bg-gray-800 dark:border-gray-700">
             <div class="flex flex-col items-center py-10">
                 @if($user->profile_photo_path)
                    <img class="w-24 h-24 mb-3 rounded-full shadow-sm object-cover object-center" src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="{{ $user->name }}">
                 @else
                     <x-ag.initials class="mb-3" initials="{{ $user->initials() }}"/>
                 @endif
                 <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
                 <span class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                     @foreach($user->roles as $role)
                         <x-ag.badge text="{{ $role->name }}" />
                     @endforeach
                 </span>
                 <x-ag.link class="mt-2" link="mailto:{{ $user->email }}" link-text="{{ $user->email }}" />
                 <div class="flex mt-4 space-x-3 md:mt-6">
                     <x-ag.button wire:click="updateModeClose()" class="px-3 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-600 text-xs" icon-left="fa-rotate-left" button-text="{{ __('Back') }}" />
                     <x-ag.buttonLink wire:click='edit({{ $user->id }})' text="{{ __('Edit') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700" />
                 </div>
             </div>
         </div>
    </div>
</div>
