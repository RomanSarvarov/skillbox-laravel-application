<?php

namespace App\Models;

use App\Contracts\Models\HasUrl as HasUrlConcern;
use App\Models\Concerns\HasUrl;
use Illuminate\Database\Eloquent\Builder;


/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $slug
 * @property-read string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @method static Builder|Tag newModelQuery()
 * @method static Builder|Tag newQuery()
 * @method static Builder|Tag query()
 * @method static Builder|Tag whereCreatedAt($value)
 * @method static Builder|Tag whereId($value)
 * @method static Builder|Tag whereName($value)
 * @method static Builder|Tag whereSlug($value)
 * @method static Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Support\Collection $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\News[] $news
 * @property-read int|null $news_count
 */
class Tag extends AbstractModel implements HasUrlConcern
{
    use HasUrl;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    /**
     * Объединяет новости и статьи.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getArticlesAttribute()
    {
        return collect([
            $this->posts,
            $this->news,
        ])->flatten();
    }
}
