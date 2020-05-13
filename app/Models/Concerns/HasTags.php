<?php

namespace App\Models\Concerns;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait HasTags
{
    /**
     * Создает (если ещё этого тега нет) и сохраняет теги, беря за основу их название.
     *
     * @param  $tags
     * @return bool
     * @throws \Throwable
     */
    public function syncTags($tags): bool
    {
        throw_unless(
            Arr::accessible($tags),
            new \Exception('Tags must be accessible!')
        );

        $tags = collect($tags)
            ->map(
                function ($val) {
                    return Str::of($val)->trim();
                }
            )
            ->reject(
                function ($val) {
                    return Str::of($val)->isEmpty();
                }
            );

        if ($tags->isNotEmpty()) {
            $tagsToAttach = [];

            $tags->map(
                function ($tag) use (&$tagsToAttach) {
                    $tag = tap(
                        Tag::firstOrCreate(
                            ['name' => $tag],
                            ['slug' => Str::slug($tag)]
                        )
                    )->save();

                    $tagsToAttach[] = $tag->id;
                }
            );

            return (bool)$this->tags()->sync($tagsToAttach);
        }

        return true;
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

}
