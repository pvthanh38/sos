<?php

namespace VNCore\Horicon\Urls;

use VNCore\Spirit\Url\Url;

class SosNotificationUrl extends Url
{
    public function store()
    {
        return route('horicon.cms.sos.notifications.store');
    }

    public function edit()
    {
        return route('horicon.cms.sos.notifications.edit', $this->entity);
    }

    public function update()
    {
        return route('horicon.cms.sos.notifications.update', $this->entity);
    }

    public function destroy()
    {
        return route('horicon.cms.sos.notifications.destroy', $this->entity);
    }
}