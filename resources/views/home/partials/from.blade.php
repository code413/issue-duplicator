<x-form-group label="From">
    <select
        name="from" id="from"
        class="js-select-repo"
        data-options='@json($repositories ?? [['full_name' => 'One repository']])'
    ></select>
</x-form-group>
