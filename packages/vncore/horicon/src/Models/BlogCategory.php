<?php

namespace VNCore\Horicon\Models;

use Illuminate\Database\Eloquent\Model;
use VNCore\Horicon\Presenters\BlogCategoryPresenter;
use VNCore\Horicon\Urls\BlogCategoryUrl;
use VNCore\Spirit\Presenter\PresentableTrait;
use VNCore\Spirit\Url\UrlableTrait;

class BlogCategory extends Model
{
    use PresentableTrait;
    protected $presenter = BlogCategoryPresenter::class;

    use UrlableTrait;
    protected $urler = BlogCategoryUrl::class;

    protected $fillable = ['title', 'slug', 'content', 'status', 'meta_description', 'layout'];

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

    public function isActive()
    {
        return $this->status == TRUE;
    }
}
