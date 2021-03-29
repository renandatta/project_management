<div
    class="form-check form-check-flat form-check-primary">
    <label
        class="form-check-label"
        for="{{ $prefix.$name }}">
        <input
            type="checkbox"
            name="{{ $name }}"
            class="form-check-input"
            id="{{ $prefix.$name }}" {{ $attributes }}>
        {{ $caption }}
        <i class="input-frame"></i>
    </label>
</div>
