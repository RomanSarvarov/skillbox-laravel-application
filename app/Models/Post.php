<?php

namespace App\Models;

use App\Interfaces\Models\HasTagsInterface;
use App\Interfaces\Models\HasUrlInterface;
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
 */
class Post extends AbstractModel implements HasUrlInterface, HasTagsInterface
{
    use HasUrl, HasTags;

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
