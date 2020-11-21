<?php

namespace App\Traits\Models;

use Illuminate\Support\Stringable;

/**
 * Trait FlushCacheOnModelChange
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Traits\Models
 * @ctime 21.11.2020 16:03
 */
trait FlushCacheOnModelChange
{
    /**
     * @return void
     */
    public static function bootFlushCacheOnModelChange()
    {
        static::saved(function (self $model) {
            static::clearCache($model);
        });

        static::deleted(function (self $model) {
            static::clearCache($model);
        });
    }

    /**
     * @throws \Exception
     */
    protected static function clearCache($model)
    {
        cache()->tags(
            static::getCacheSlug()
        )->flush();
    }

    /**
     * Возвращает название ключа кеширования.
     *
     * @return Stringable
     */
    public static function getCacheSlug()
    {
        if (property_exists(static::class, 'cacheSlug')) {
            return static::$cacheSlug;
        }

        return static::guessCacheSlug();
    }

    /**
     * Пытается угадать название ключа кеширования.
     *
     * Например:
     * Модель Post -> posts
     * Модель CoolPost -> cool_posts
     *
     * @return Stringable
     */
    protected static function guessCacheSlug()
    {
        $class = class_basename(static::class);

        return \Str::of($class)->plural()->snake();
    }
}