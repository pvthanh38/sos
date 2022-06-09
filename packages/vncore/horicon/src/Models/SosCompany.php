<?php

namespace VNCore\Horicon\Models;

use Illuminate\Database\Eloquent\Model;
use VNCore\Horicon\Presenters\SosCompanyPresenter;
use VNCore\Horicon\Urls\SosCompanyUrl;
use VNCore\Spirit\Presenter\PresentableTrait;
use VNCore\Spirit\Url\UrlableTrait;

class SosCompany extends Model
{
    use PresentableTrait;
    protected $presenter = SosCompanyPresenter::class;

    use UrlableTrait;
    protected $urler = SosCompanyUrl::class;

    protected $fillable = ['code', 'name', 'desc'];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $direction
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderUpdated($query, $direction = 'desc')
    {
        return $query->orderBy('updated_at', $direction);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $q
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $q)
    {
        $value = '%' . $q . '%';
        return $query->where('name', 'like', $value);
    }
}
