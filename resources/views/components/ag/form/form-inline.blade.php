@props(['stern' => null, 'id' => null, 'text' => null, 'classLabel' => null, 'classInput' => null, 'type' => 'text', 'error' => null, 'classInputRelative' => 'relative ' . $classInput, 'count' => null, 'limit' => 255])

@if($count)
    <div x-data="{ content: '', limit: $el.dataset.limit, get characterCount() { return this.limit - this.content.length } }" data-limit="{{ $limit }}">
        <x-ag.form.flex>
            <x-ag.form.label-inline {{ $attributes->merge(['class' => $classLabel, 'id' => $id]) }} text="{{ $text }}" stern="{{ $stern }}"/>
            <div {{ $attributes->merge(['class' => $classInputRelative])  }}>
                <x-ag.form.input-inline {{ $attributes->merge(['class' => $classInput, 'id' => $id]) }} type="{{ $type }}" text="{{ $text }}" value="{{ old($id) }}" maxlength="{{ $limit }}" x-ref="content" x-model="content" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-xs" :class="{ 'text-red-500 dark:text-red-600' : characterCount, 'text-green-500 dark:text-green-600' : !characterCount  }" x-ref="characterCount">
                    <span x-text="characterCount"></span>
                </div>
            </div>
            {{ $formInlineSlot ?? '' }}
        </x-ag.form.flex>
        <x-ag.form.error id="{{ $id }}" />
    </div>
@else
    <x-ag.form.flex>
        <x-ag.form.label-inline {{ $attributes->merge(['class' => $classLabel, 'id' => $id]) }} text="{{ $text }}" stern="{{ $stern }}"/>
        <x-ag.form.input-inline {{ $attributes->merge(['class' => $classInput, 'id' => $id]) }} type="{{ $type }}" text="{{ $text }}" value="{{ old($id) }}" />
        {{ $formInlineSlot ?? '' }}
    </x-ag.form.flex>
    <x-ag.form.error id="{{ $id }}" />
@endif
