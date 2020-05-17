<?php

namespace App\Models;

use App\Contracts\Models\HasTags as HasTagsConcern;
use App\Contracts\Models\HasUrl as HasUrlConcern;
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
 */
class Post extends AbstractModel implements HasUrlConcern, HasTagsConcern
{
    use HasUrl, HasTags;

    protected $guarded = ['id', 'created_at', 'updated_at', 'author_id'];

    protected $casts = [
        'is_posted' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
