<label class="block mb-3">
    @if(isset($label))
        <span class="block text-gray-700 mb-1">
            {{ $label }}
        </span>
    @endif

    {{ $slot }}
</label>
