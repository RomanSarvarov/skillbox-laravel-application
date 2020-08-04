<?php

namespace App\Models\Concerns;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Throwable;

trait HasTags
{
    /**
     * Создает (если ещё этого тега нет) и сохраняет теги, беря за основу их название.
     *
     * @param  Collection|array  $tags
     * @return bool
     * @throws Throwable
     */
    public function syncTagsByTagNames($tags): bool
    {
        throw_unless(
            Arr::accessible($tags),
            new \Exception('Tags must be an Array or Collection!')
        );

        if (is_array($tags)) {
            $tags = collect($tags);
        }

        if ($tags->isNotEmpty()) {
            $tagIdsToSync = [];

            $tags->map(
                function ($tagName) use (&$tagIdsToSync) {
                    $tag = tap(
                        Tag::firstOrCreate(
                            ['name' => $tagName],
                            ['slug' => Str::slug($tagName)]/**/
                        )
                    )->save();

                    $tagIdsToSync[] = $tag->id;
                }
            );

            return (bool)$this->tags()->sync($tagIdsToSync);
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
