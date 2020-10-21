<x-form-group label="To">
    <select name="to"
            class="js-select-repo"
            data-options='@json($repositories ?? [['full_name' => 'Another repository']])'
    ></select>
</x-form-group>
