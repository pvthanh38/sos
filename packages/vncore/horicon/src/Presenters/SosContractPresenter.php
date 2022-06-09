<?php

namespace VNCore\Horicon\Presenters;

use VNCore\Horicon\Models\SosContract;
use VNCore\Spirit\Presenter\Presenter;

class SosContractPresenter extends Presenter
{
    /**
     * @return string
     */
    public function file()
    {
        /** @var SosContract $post */
        $contract = $this->getEntity();
        $media = $contract->getFile();
        if ($media) {
            return $media->file_name;
        }

        return null;
    }

    public function location() {
        /** @var SosContract $post */
        $contract = $this->getEntity();
        $locations = $contract->locations;

        $tmp = [];
        foreach ($locations as $location) {
            $tmp[] = $location->lat . ', ' . $location->lng;
        }
        return implode(' - ', $tmp);
    }
}