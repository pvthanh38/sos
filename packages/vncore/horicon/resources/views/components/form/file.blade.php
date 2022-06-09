<?php
$classInput = explode(' ', $attributes['class']);
$classInput[] = 'custom-file-input';
unset($classInput['form-control']);

$classInput = implode(' ', $classInput);
$attributes['class'] = $classInput;
?>

<div class="{{ $classGroup }}">
    {{ Form::label($name, $label, ['class' => $classLabel]) }}

    <div class="{{ $classField }}">
        <div class="custom-file">
            {{ Form::file($name, $attributes) }}
            <label class="custom-file-label">@lang('Choose file...')</label>
            <div class="invalid-feedback">{{ $message }}</div>
        </div>

        <small class="text-muted">{{ $attributes['help'] ?? '' }}</small>
    </div>
</div>