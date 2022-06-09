<?php

namespace VNCore\Horicon\Presenters;

use VNCore\Horicon\Models\SosNotification;
use VNCore\Spirit\Presenter\Presenter;

class SosNotificationPresenter extends Presenter
{
    /**
     * @return string
     */
    public function document()
    {
        /** @var SosNotification $post */
        $notification = $this->getEntity();
        $media = $notification->getFile();
        if ($media) {
            return $media->getFullUrl();
        }

        return NULL;
    }

    /**
     * @return string
     */
    public function documentName()
    {
        /** @var SosNotification $post */
        $notification = $this->getEntity();
        $media = $notification->getFile();
        if ($media) {
            return $media->file_name;
        }

        return NULL;
    }
}