@props(['route', 'field', 'currentSort', 'currentDirection', 'label'])

@php
    $isActive = $currentSort === $field;
    $nextDirection = $isActive && $currentDirection === 'asc' ? 'desc' : 'asc';
@endphp

<th {{ $attributes->merge(['class' => 'px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest']) }}>
    <a href="{{ route($route, ['sort' => $field, 'direction' => $nextDirection]) }}" 
       class="flex items-center hover:text-indigo-600 transition-colors group">
        <span class="transition-colors duration-200 {{ $isActive ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}">
            {{ $label }}
        </span>
        
        <span class="ms-2 flex-none transition-colors duration-200">
            @if($isActive && $currentDirection === 'desc')
                {{-- Active arrow down --}}
                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            @elseif($isActive && $currentDirection === 'asc')
                {{-- Active arrow up --}}
                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
            @else
                {{-- Inactive arrow --}}
                <svg class="w-4 h-4 text-gray-300 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5-5 5 5M7 14l5 5 5-5"/></svg>
            @endif
        </span>
    </a>
</th>