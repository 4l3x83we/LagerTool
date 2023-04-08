<div class="relative overflow-x-auto">
    <div class="w-full max-w-full bg-white border border-gray-200 rounded shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col py-4 px-4">
            <form wire:loading.remove wire:submit.prevent="update">
                <input type="hidden" wire:model="selected_id">
                <div class="relative z-0 w-full mb-6 group">
                    <input wire:model.lazy="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="roleName" type="text" placeholder=" ">
                    <label for="roleName" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Name') }}</label>
                    @error('name') <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="relative overflow-x-auto mb-6">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">{{ __('Name') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Guard') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($permissions as $permission)
                            @if($loop->iteration % 2 == 0)
                                <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-1 cursor-pointer" wire:click="show({{ $permission->id }})">{{ $permission->id }}</th>
                                    <td class="px-6 py-1 cursor-pointer" wire:click="show({{ $permission->id }})">{{ $permission->name }}</td>
                                    <td class="px-6 py-1 cursor-pointer" wire:click="show({{ $permission->id }})">{{ $permission->guard_name }}</td>
                                </tr>
                            @else
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-1 cursor-pointer" wire:click="show({{ $permission->id }})">{{ $permission->id }}</th>
                                    <td class="px-6 py-1 cursor-pointer" wire:click="show({{ $permission->id }})">{{ $permission->name }}</td>
                                    <td class="px-6 py-1 cursor-pointer" wire:click="show({{ $permission->id }})">{{ $permission->guard_name }}</td>
                                </tr>
                            @endif
                        @empty
                            <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800">
                                <td colspan="3">{{ __('No permissions found.') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <label for="permission" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Permissions') }}</label>
                    @foreach($permissions as $item)
                        <div class="flex items-center mb-2">
                            <input id="role-{{ $item->id }}" wire:model="permission" value="{{ $item->name }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="role-{{ $item->id }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-end">
                    <x-ag.buttonLink type="submit" class="px-3 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded text-xs" text="Speichern"/>
                </div>
            </form>
            <div wire:loading wire:target="update">
                <div class="text-center">
                    <div role="status">
                        <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
