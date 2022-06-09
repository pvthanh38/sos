<?php

namespace VNCore\Horicon\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use VNCore\Horicon\Presenters\FaqPresenter;
use VNCore\Horicon\Urls\FaqUrl;
use VNCore\Spirit\Presenter\PresentableTrait;
use VNCore\Spirit\Url\UrlableTrait;

class Faq extends Model
{
    use PresentableTrait;
    protected $presenter = FaqPresenter::class;

    use UrlableTrait;
    protected $urler = FaqUrl::class;

    protected $fillable = ['title', 'content', 'status', 'replay'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'None']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(FaqComment::class, 'faq_id');
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
        return $query->where('content', 'like', $value)->orWhere('title', 'like', $value);
    }
}
