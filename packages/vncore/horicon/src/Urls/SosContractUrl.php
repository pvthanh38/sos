<?php

namespace VNCore\Horicon\Urls;

use VNCore\Spirit\Url\Url;

class SosContractUrl extends Url
{
    public function store()
    {
        return route('horicon.cms.sos.contracts.store');
    }

    public function edit()
    {
        return route('horicon.cms.sos.contracts.edit', $this->entity);
    }

    public function update()
    {
        return route('horicon.cms.sos.contracts.update', $this->entity);
    }

    public function destroy()
    {
        return route('horicon.cms.sos.contracts.destroy', $this->entity);
    }

    public function download()
    {
        return route('horicon.cms.sos.contracts.download', $this->entity);
    }
}