<x-form-group>
    <select
        name="from" id="from"
        class="js-select-repo"
        data-options='@json($repositories ?? [['full_name' => 'One repository']])'
    ></select>

    <x-slot name="label">
        <div class="flex">
            From

            <a href="https://github.com/apps/issue-duplicator/installations/new" class="ml-auto text-blue-500 text-sm">
                Can't find a repo?
            </a>
        </div>
    </x-slot>
</x-form-group>
