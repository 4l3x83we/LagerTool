@php $dash .= '-- '; @endphp
<x-ag.tr>
    <td colspan="2" class="p-1">
        <x-ag.table>
            <x-slot:tbody>
                @foreach($subWarengruppes as $subWarengruppe)
                    <x-ag.tr>
                        <td class="px-6 py-2">{{ $dash . $subWarengruppe->wg_name }}</td>
                        <td class="px-6 py-2">
                            <div class="flex justify-end items-center">
                                <x-ag.buttonLink wire:click="edit({{$subWarengruppe->id}})" class="text-blue-500 hover:text-blue-700 mr-8" icon="fa-pen" />
                                <x-ag.buttonLink wire:click="destroy({{$subWarengruppe->id}})" class="text-red-500 hover:text-red-700 mr-2" icon="fa-trash" />
                            </div>
                        </td>
                        @if(count($subWarengruppe->subWarengruppe))
                            @include('livewire.admin.settings.warengruppe.subWrengruppeList-table', ['subWarengruppes' => $subWarengruppe->subWarengruppe])
                        @endif
                    </x-ag.tr>
                @endforeach
            </x-slot:tbody>
        </x-ag.table>
    </td>
</x-ag.tr>

