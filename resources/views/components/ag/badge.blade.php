@props(['color' => 'green', 'text' => ''])
<span {!! $attributes->merge(['class' => 'bg-'.$color.'-100 text-'.$color.'-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-'.$color.'-900 dark:text-'.$color.'-300']) !!}>
    {{ $text }}
</span>
