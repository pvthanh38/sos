<?php
$classGroup = ['form-group'];
$classLabel = ['col-form-label text-right'];
$classField = [];
$classInput = ['form-control'];

if (!isset($attributes['horizontal']) || $attributes['horizontal']) {
    $classGroup[] = 'row';
    $classLabel[] = 'col-sm-2';
    $classField[] = 'col-sm-10';
    unset($attributes['horizontal']);
}

//$errors->has('title')
//$errors->first('url')
$message = $errors->getBag('default')->first($name);
if ($message) {
    $classInput[] = 'is-invalid';
}

$classGroup = implode(' ', $classGroup);
$classLabel = implode(' ', $classLabel);
$classField = implode(' ', $classField);
$classInput = implode(' ', $classInput);
$attributes['class'] = $classInput;
?>

@switch($type)
    @case('file')
        @include('horicon::components.form.file')
    @break

    @case('password')
        @include('horicon::components.form.password')
    @break

    @case('select')
        @include('horicon::components.form.select')
    @break

    @case('area')
        @include('horicon::components.form.area')
    @break

    @case('checkbox')
        @include('horicon::components.form.checkbox')
    @break

    @case('wysiwyg')
        @include('horicon::components.form.wysiwyg')
    @break

    @default
        @include('horicon::components.form.text')
@endswitch


