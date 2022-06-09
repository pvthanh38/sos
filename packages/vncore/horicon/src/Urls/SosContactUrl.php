<?php

namespace VNCore\Horicon\Urls;

use VNCore\Spirit\Url\Url;

class SosContactUrl extends Url
{
    public function edit()
    {
        return route('horicon.cms.sos.contacts.edit', $this->entity);
    }

    public function update()
    {
        return route('horicon.cms.sos.contacts.update', $this->entity);
    }

    public function destroy()
    {
        return route('horicon.cms.sos.contacts.destroy', $this->entity);
    }
}