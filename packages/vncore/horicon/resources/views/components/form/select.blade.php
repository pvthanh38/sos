<?php
$select = [];
if (isset($attributes['select'])) {
    $select = $attributes['select'];
    unset($attributes['select']);
}
?>

<div class="{{ $classGroup }}">
    {{ Form::label($name, $label, ['class' => $classLabel]) }}

    <div class="{{ $classField }}">
        {{ Form::select($name, $select, $value, $attributes) }}

        <div class="invalid-feedback">{{ $message }}</div>
        <small class="text-muted">{{ $attributes['help'] ?? '' }}</small>
    </div>
</div>