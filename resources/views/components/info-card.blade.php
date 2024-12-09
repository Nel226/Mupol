@props([
    'label' => 'Label', 
    'value' => '0 FCFA', 
    'bgColor' => 'blue', 
    'textColor' => 'primary1', 
    'borderColor' => 'blue', 
    'extraClasses' => '' 
])

<div class="flex flex-col sm:flex-row items-center justify-between p-3 sm:p-4 rounded-md bg-gray-100 border {{ $extraClasses }}">
    <span class="text-left text-sm sm:text-sm capitalize">{{ $label }}:</span>
    <span class="bg-{{ $bgColor }}-100 text-{{ $textColor }} text-xs sm:text-xs font-medium inline-flex items-center px-2 py-1 sm:px-3 sm:py-2 rounded border border-{{ $borderColor }}-400">
        {{ $value }}
    </span>
</div>
