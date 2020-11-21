<?php

namespace App\Models;

use App\Traits\Models\FlushCacheOnModelChange;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Feedback
 *
 * @method static Builder|Feedback newModelQuery()
 * @method static Builder|Feedback newQuery()
 * @method static Builder|Feedback query()
 * @mixin Eloquent
 * @property int $id
 * @property string $email
 * @property string $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Feedback whereCreatedAt($value)
 * @method static Builder|Feedback whereEmail($value)
 * @method static Builder|Feedback whereId($value)
 * @method static Builder|Feedback whereMessage($value)
 * @method static Builder|Feedback whereUpdatedAt($value)
 */
class Feedback extends AbstractModel
{
    use FlushCacheOnModelChange;

    /**
     * @var string
     */
    protected $table = 'feedbacks';
}
