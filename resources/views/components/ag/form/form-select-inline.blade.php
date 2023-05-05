@props(['stern' => null, 'id' => null, 'text' => null, 'classLabel' => null, 'classSelect' => null])
    <x-ag.form.flex>
        <x-ag.form.label-inline {{ $attributes->merge(['class' => $classLabel, 'id' => $id]) }} text="{{ $text }}" stern="{{ $stern }}"/>
        <x-ag.form.select-inline {{ $attributes->merge(['class' => $classSelect, 'id' => $id]) }} text="{{ $text }}" value="{{ old($id) }}" >
            {{ $slot }}
        </x-ag.form.select-inline>
        {{ $inlineFlex ?? '' }}
    </x-ag.form.flex>
    <x-ag.form.error id="{{ $id }}" />
