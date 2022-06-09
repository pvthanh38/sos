<?php

namespace VNCore\Horicon\Presenters;

use VNCore\Horicon\Models\SosConversation;
use VNCore\Horicon\Models\SosConversationAdmin;
use VNCore\Spirit\Presenter\Presenter;

class SosConversationPresenter extends Presenter
{
    public function image()
    {
        /** @var SosConversation $conversation */
        $conversation = $this->getEntity();
        $media = $conversation->getImage();
        if ($media) {
            return $media->getFullUrl();
        }

        return null;
        //return asset('vendor/vncore/images/default.jpg');
    }
}
