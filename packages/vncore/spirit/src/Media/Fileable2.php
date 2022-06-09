<?php

namespace VNCore\Spirit\Media;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

trait Fileable2
{
    use HasMediaTrait;

    //protected $fileField = NULL;

    public function registerMediaCollections()
    {
        $this->addMediaCollection($this->fileField)
            ->singleFile();
    }

    public function addFileFromRequest()
    {
        $field = $this->fileField;
        if (request()->hasFile($field)) {
            $this->addMediaFromRequest($field)->toMediaCollection($field);
        }
    }

    public function getFile() {
        $field = $this->fileField;
        return $this->getFirstMedia($field);
    }
}