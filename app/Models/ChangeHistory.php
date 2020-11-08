<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChangeHistory
 *
 * @property int $id
 * @property mixed $changes
 * @property string $historable_type
 * @property int $historable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $historable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChangeHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChangeHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChangeHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChangeHistory whereChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChangeHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChangeHistory whereHistorableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChangeHistory whereHistorableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChangeHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChangeHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $user_id
 * @property-read \App\Models\User|null $user
 * @method static Builder|ChangeHistory whereUserId($value)
 */
class ChangeHistory extends Model
{
    protected $guarded = [];

    protected $casts = [
        'changes' => 'array',
    ];

    /**
     * @inheritDoc
     */
    protected static function boot()
    {
        parent::boot();

        /*
         * Показывать последние изменения.
         */
        static::addGlobalScope(
            'latest',
            fn(Builder $builder) => $builder->latest()
        );
    }

    /**
     * Get the owning historable model.
     */
    public function historable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
