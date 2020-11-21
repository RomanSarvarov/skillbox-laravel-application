<?php

namespace App\Models;

use App\Contracts\Models\HasTags as HasTagsConcern;
use App\Contracts\Models\HasUrl as HasUrlConcern;
use App\Contracts\Models\Historable;
use App\Events\Post\PostCreated;
use App\Events\Post\PostDeleted;
use App\Events\Post\PostUpdated;
use App\Events\Post\PostUpdating;
use App\Traits\Models\Commentable;
use App\Contracts\Models\Commentable as CommentableContract;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use App\Models\Concerns\HasTags;
use App\Models\Concerns\HasUrl;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $content
 * @property int $is_posted
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @method static Builder|Post whereContent($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereDescription($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereIsPosted($value)
 * @method static Builder|Post whereSlug($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|Tag[] $tag
 * @property-read int|null $tags_count
 * @property-read Collection|Tag[] $tags
 * @property-read string $url
 * @property int $author_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereAuthorId($value)
 * @property-read \App\Models\User|null $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ChangeHistory[] $history
 * @property-read int|null $history_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post posted()
 * @property-read Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 */
class Post extends AbstractModel implements HasUrlConcern, HasTagsConcern, Historable, CommentableContract
{
    use HasUrl, HasTags, Commentable;

	/**
	 * @var array
	 */
    protected $guarded = ['id', 'created_at', 'updated_at', 'author_id'];

	/**
	 * @var array
	 */
    protected $casts = [
        'is_posted' => 'boolean',
    ];

    /**
     * @var string
     */
    protected static $cacheSlug = 'posts';

	/**
	 * @var array
	 */
    protected $dispatchesEvents = [
        'created' => PostCreated::class,
        'updated' => PostUpdated::class,
        'updating' => PostUpdating::class,
        'deleted' => PostDeleted::class,
    ];

    /**
     * @return void
     */
    protected static function booted()
    {
        $flushCache = function () {
            cache()->tags(static::$cacheSlug)->flush();
        };

        static::saved(function (self $post) use ($flushCache) {
            $flushCache();
        });

        static::deleted(function (self $post) use ($flushCache) {
            $flushCache();
        });
    }

    /**
	 * @return string
	 */
    public function getRouteKeyName()
    {
        return 'slug';
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function history()
    {
        return $this->morphMany(ChangeHistory::class, 'historable');
    }

	/**
	 * @param Builder $query
	 *
	 * @return Builder
	 */
    public function scopePosted(Builder $query)
    {
    	return $query->where('is_posted', true);
    }
}
