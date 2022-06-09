<?php

namespace VNCore\Horicon\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class HoriconService
{
    /**
     * @param string $path
     * @return bool
     */
    protected function deleteFileInPublic(string $path)
    {
        return Storage::disk('public')->delete($path);
    }

    /**
     * @param UploadedFile $file
     * @param string $folder
     * @return false|string
     */
    protected function uploadFileToPublic(UploadedFile $file, string $folder)
    {
        return $file->store($folder, 'public');
    }
}
