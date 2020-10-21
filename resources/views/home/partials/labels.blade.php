<x-form-group label="Labels">
    <div class="mt-2">
        <div>
            <label class="inline-flex items-start">
                <input type="radio" class="form-radio mt-1" name="radio" value="2" checked>
                <span class="ml-2">Only add new labels to the destination repo.</span>
            </label>
        </div>
        <div>
            <label class="inline-flex items-start">
                <input type="radio" class="form-radio mt-1" name="radio" value="1">
                <span class="ml-2">Ignore labels.</span>
            </label>
        </div>
        <div>
            <label class="inline-flex items-start">
                <input type="radio" class="form-radio mt-1" name="radio" value="3">
                <span class="ml-2">
                                Delete all existing labels of the destination repo and replace them with labels from the source.
                                <div class="text-gray-500 text-sm">
                                    CAUTION: This will remove your labels from all your existing issues in the destination repo.
                                </div>
                            </span>
            </label>
        </div>
    </div>
</x-form-group>
