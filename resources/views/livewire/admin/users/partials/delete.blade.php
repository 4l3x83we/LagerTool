<x-ag.dialog-modal wire:model="destroyUserModal">
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="content">
        <span class="font-bold">{{ __('messages.deleteUser', ['name' => $this->name]) }}</span>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('destroyUserModal', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ml-3" wire:click="delete({{ $destroyUserModal }})" wire:loading.attr="disabled">
            {{ __('Delete Account') }}
        </x-danger-button>
    </x-slot>
</x-ag.dialog-modal>
