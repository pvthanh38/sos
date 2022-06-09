<?php

namespace VNCore\Horicon\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use VNCore\Horicon\Presenters\SosContractPresenter;
use VNCore\Horicon\Urls\SosContractUrl;
use VNCore\Spirit\Media\Fileable;
use VNCore\Spirit\Presenter\PresentableTrait;
use VNCore\Spirit\Url\UrlableTrait;

class SosContract extends Model implements HasMedia
{
    use PresentableTrait;
    protected $presenter = SosContractPresenter::class;

    use UrlableTrait;
    protected $urler = SosContractUrl::class;

    use Fileable;
    public $fileField = 'file';

    protected $fillable = ['company_id', 'code'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(SosCompany::class, 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany(SosContractLocation::class, 'contract_id');
    }

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
        return $query->where('id', 'like', $value);
    }
}
