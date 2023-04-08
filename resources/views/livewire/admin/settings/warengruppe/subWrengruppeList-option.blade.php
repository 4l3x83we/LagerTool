@php $dash .= '-- '; @endphp
@foreach($subWarengruppes as $subWarengruppe)
    <option value="{{ $subWarengruppe->id }}">{{ $dash . $subWarengruppe->wg_name }}</option>
    @if(count($subWarengruppe->subWarengruppe))
        @include('livewire.admin.settings.warengruppe.subWrengruppeList-option', ['subWarengruppes' => $subWarengruppe->subWarengruppe])
    @endif
@endforeach

