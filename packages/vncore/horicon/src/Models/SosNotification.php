<?php

namespace VNCore\Horicon\Models;

use Illuminate\Database\Eloquent\Model;
use VNCore\Horicon\Presenters\SosNotificationPresenter;
use VNCore\Horicon\Urls\SosNotificationUrl;
use VNCore\Spirit\Media\Fileable2;
use VNCore\Spirit\Presenter\PresentableTrait;
use VNCore\Spirit\Url\UrlableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class SosNotification extends Model implements HasMedia
{
    use PresentableTrait;
    protected $presenter = SosNotificationPresenter::class;

    use UrlableTrait;
    protected $urler = SosNotificationUrl::class;

    use Fileable2;
    public $fileField = 'document';

    protected $fillable = ['title', 'text', 'link'];

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
        return $query->where('text', 'like', $value)->orWhere('title', 'like', $value);
    }
}
