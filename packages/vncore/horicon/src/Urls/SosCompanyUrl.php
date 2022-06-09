<?php

namespace VNCore\Horicon\Urls;

use VNCore\Spirit\Url\Url;

class SosCompanyUrl extends Url
{
    public function store()
    {
        return route('horicon.cms.sos.companies.store');
    }

    public function edit()
    {
        return route('horicon.cms.sos.companies.edit', $this->entity);
    }

    public function update()
    {
        return route('horicon.cms.sos.companies.update', $this->entity);
    }

    public function destroy()
    {
        return route('horicon.cms.sos.companies.destroy', $this->entity);
    }
}