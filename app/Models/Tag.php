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
 */
class Tag extends AbstractModel implements HasUrlConcern
{
    use HasUrl;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
