<?php

namespace VNCore\Horicon\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use VNCore\Horicon\Presenters\SosContactPresenter;
use VNCore\Horicon\Urls\SosContactUrl;
use VNCore\Spirit\Presenter\PresentableTrait;
use VNCore\Spirit\Url\UrlableTrait;

class SosContact extends Model
{
    use PresentableTrait;
    protected $presenter = SosContactPresenter::class;

    use UrlableTrait;
    protected $urler = SosContactUrl::class;

    protected $fillable = ['title', 'content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
        return $query->where('title', 'like', $value)
            ->orWhere('content', 'like', $value);
    }
}
