<label class="block mb-3">
    @if(isset($label))
        <span class="text-gray-700">{{ $label }}</span>
    @endif
    {{ $slot }}
</label>
