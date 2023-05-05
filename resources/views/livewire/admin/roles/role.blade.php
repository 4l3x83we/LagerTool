<div>
    <x-ag.header-admin current-text="Rollen" render="rollen">
        {{--<x-slot:headline>
        </x-slot:headline>--}}

        <div class="flex items-center justify-between flex-wrap my-4">
            @can(['show', 'create', 'update'])
                @if($updateMode)
                    @can('update')
                        <span class="text-lg text-gray-500 md:text-xl dark:text-gray-400">{{ $role->name }}</span>
                        <x-ag.button wire:click="updateModeClose()" class="px-3 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-600 text-xs" icon-left="fa-rotate-left" button-text="{{ __('Back') }}"/>
                    @endcan
                @elseif($createMode)
                    @can('create')
                        <span class="text-lg text-gray-500 md:text-xl dark:text-gray-400">{{ __('Add new role and assign permissions.') }}</span>
                        <x-ag.button wire:click="updateModeClose()" class="px-3 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-600 text-xs" icon-left="fa-rotate-left" button-text="{{ __('Back') }}"/>
                    @endcan
                @elseif($showMode)
                    @can('show')
                        <span class="text-lg text-gray-500 md:text-xl dark:text-gray-400">{{ $role->name }}</span>
                    @endcan
                @else
                    <span class="text-lg text-gray-500 md:text-xl dark:text-gray-400">{{ __('Manage your roles here.') }}</span>
                    @can('show')
                        <x-ag.button wire:click="create()" class="px-3 py-2 text-xs" icon-left="fa-plus" button-text="{{ __('Add New Role') }}"/>
                    @endcan
                @endif
            @endcan
        </div>

        @can(['show', 'create', 'update'])
            @if($updateMode)
                @can('update')
                    @include('livewire.admin.roles.partials.edit')
                @endcan
            @elseif($createMode)
                @can('create')
                    @include('livewire.admin.roles.partials.create')
                @endcan
            @elseif($showMode)
                @can('show')
                    @include('livewire.admin.roles.partials.show')
                @endcan
            @else
                @can('show')
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Name') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Permissions') }}
                                </th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($roles as $role)
                                @if($loop->iteration % 2 == 0)
                                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-1 cursor-pointer" wire:click="show({{ $role->id }})">{{ $role->id }}</th>
                                        <td class="px-6 py-1 cursor-pointer" wire:click="show({{ $role->id }})">{{ $role->name }}</td>
                                        <td class="px-6 py-1 cursor-pointer" wire:click="show({{ $role->id }})">
                                            @foreach($role->permissions as $permission)
                                                <div class="inline-flex mb-2 xl:mb-0"><x-ag.badge color="blue" class="" text="{{ $permission->name }}"/></div>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-1 text-right">
                                            <x-ag.buttonLink wire:click="edit({{ $role->id }})" class="px-3 py-2 text-blue-500 hover:text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                </svg>
                                            </x-ag.buttonLink>
                                            @if($confirming === $role->id)
                                                <x-ag.button-link-group>
                                                    <x-ag.buttonLink wire:loading.remove wire:click="delete({{ $role->id }})" class="px-3 py-2 text-red-500 hover:text-red-600" title="{{ __('Delete') }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                                        </svg>
                                                    </x-ag.buttonLink>
                                                    <x-ag.buttonLink wire:loading wire:target="delete" class="px-3 py-2 text-red-500 hover:text-red-600" title="{{ __('Delete') }}">
                                                        <div role="status">
                                                            <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                            </svg>
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </x-ag.buttonLink>
                                                    <x-ag.buttonLink wire:click="confirmDelete(false)" class="px-3 py-2 text-green-500 hover:text-green-600" title="{{ __('Oh no.') }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                    </x-ag.buttonLink>
                                                </x-ag.button-link-group>
                                            @else
                                                <x-ag.buttonLink wire:click="confirmDelete({{ $role->id }})" class="px-3 py-2 text-red-500 hover:text-red-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                    </svg>
                                                </x-ag.buttonLink>
                                            @endif
                                        </td>
                                    </tr>
                                @else
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-1 cursor-pointer" wire:click="show({{ $role->id }})">{{ $role->id }}</th>
                                        <td class="px-6 py-1 cursor-pointer" wire:click="show({{ $role->id }})">{{ $role->name }}</td>
                                        <td class="px-6 py-1 cursor-pointer" wire:click="show({{ $role->id }})">
                                            @foreach($role->permissions as $permission)
                                                <div class="inline-flex mb-2 xl:mb-0"><x-ag.badge color="blue" class="" text="{{ $permission->name }}"/></div>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-1 text-right">
                                            <x-ag.buttonLink wire:click="edit({{ $role->id }})" class="px-3 py-2 text-blue-500 hover:text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                </svg>
                                            </x-ag.buttonLink>
                                            @if($confirming === $role->id)
                                                <x-ag.button-link-group>
                                                    <x-ag.buttonLink wire:loading.remove wire:click="delete({{ $role->id }})" class="px-3 py-2 text-red-500 hover:text-red-600" title="{{ __('Delete') }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                                        </svg>
                                                    </x-ag.buttonLink>
                                                    <x-ag.buttonLink wire:loading wire:target="delete" class="px-3 py-2 text-red-500 hover:text-red-600" title="{{ __('Delete') }}">
                                                        <div role="status">
                                                            <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                            </svg>
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </x-ag.buttonLink>
                                                    <x-ag.buttonLink wire:click="confirmDelete(false)" class="px-3 py-2 text-green-500 hover:text-green-600" title="{{ __('Oh no.') }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                    </x-ag.buttonLink>
                                                </x-ag.button-link-group>
                                            @else
                                                <x-ag.buttonLink wire:click="confirmDelete({{ $role->id }})" class="px-3 py-2 text-red-500 hover:text-red-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                    </svg>
                                                </x-ag.buttonLink>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800">
                                    <td colspan="5">{{ __('No roles found.') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <nav class="py-4" aria-label="Table Navigation">
                            {{--{{ $roles->links() }}--}}
                        </nav>
                    </div>
                @endcan
            @endif
        @endcan
    </x-ag.header-admin>
</div>
