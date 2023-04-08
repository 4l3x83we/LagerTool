<div>
    <div class="relative overflow-x-auto">
        <div class="w-full max-w-full bg-white border border-gray-200 rounded shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col items-center py-10">
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ ucfirst($role->name) }} {{ __('Role') }}</h5>
                <h6 class="mb-2">{{ __('Assigned permissions') }}</h6>
                <table class="w-2/4 text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">{{ __('Name') }}</th>
                        <th scope="col" class="px-4 py-2">{{ __('Guard') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($rolePermissions as $permission)
                        @if($loop->iteration % 2 == 0)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th class="px-4 py-2">{{ $permission->name }}</th>
                                <th class="px-4 py-2">{{ $permission->guard_name }}</th>
                            </tr>
                        @else
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                <th class="px-4 py-2">{{ $permission->name }}</th>
                                <th class="px-4 py-2">{{ $permission->guard_name }}</th>
                            </tr>
                        @endif
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th colspan="2">{{ __('No permissions found.') }}</th>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="flex mt-4 space-x-3 md:mt-6">
                    <x-ag.button wire:click="updateModeClose()" class="px-3 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-600 text-xs" icon-left="fa-rotate-left" button-text="{{ __('Back') }}" />
                    <x-ag.buttonLink wire:click='edit({{ $role->id }})' text="{{ __('Edit') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700" />
                </div>
            </div>
        </div>
    </div>
</div>
