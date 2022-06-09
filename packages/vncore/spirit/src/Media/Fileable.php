<?php

namespace VNCore\Spirit\Media;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

trait Fileable
{
    use HasMediaTrait;

    //protected $fileField = NULL;

    public function registerMediaCollections()
    {
        $this->addMediaCollection($this->fileField)
            ->useDisk('private')
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