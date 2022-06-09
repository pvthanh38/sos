<?php
$result = str_contains($classGroup, 'row');
?>

<div class="{{ $classGroup }}">
    <div class="{{ $classField }} {{ $result ? 'offset-sm-2' : '' }}">
        {{ Form::checkbox($name, 1, $value, ['id' => $name]) }}
        {{ Form::label($name, $label, ['class' => 'form-check-label']) }}

        <div class="invalid-feedback">{{ $message }}</div>
        <small class="text-muted">{{ $attributes['help'] ?? '' }}</small>
    </div>
</div>