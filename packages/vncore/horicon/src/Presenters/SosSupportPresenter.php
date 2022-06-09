<?php

namespace VNCore\Horicon\Presenters;

use VNCore\Horicon\Models\SosContract;
use VNCore\Horicon\Models\SosSupport;
use VNCore\Spirit\Presenter\Presenter;

class SosSupportPresenter extends Presenter
{
    public function position() {
        /** @var SosSupport $support */
        $support = $this->getEntity();
        return $support->lat . ', ' . $support->lng;
    }
}