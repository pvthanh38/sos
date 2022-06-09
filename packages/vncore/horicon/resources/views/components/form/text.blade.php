<div class="{{ $classGroup }}">
    {{ Form::label($name, $label, ['class' => $classLabel]) }}

    <div class="{{ $classField }}">
        {{ Form::text($name, $value, $attributes) }}

        <div class="invalid-feedback">{{ $message }}</div>
        <small class="text-muted">{{ $attributes['help'] ?? '' }}</small>
    </div>
</div>