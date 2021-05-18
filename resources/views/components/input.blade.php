<input
    type="{{ $type }}"
    class="form-control {{ $class }}"
    name="{{ $name }}"
    id="{{ $prefix.str_replace(['[',']'], '', $name) }}"
    placeholder="{{ $caption }}"
    value="{{ $value }}"
    {{ $attributes }}
/>
