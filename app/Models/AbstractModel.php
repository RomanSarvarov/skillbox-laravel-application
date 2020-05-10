<?php

namespace App\Models;

use App\Helpers\RouteHelper;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getRouteName()
    {
        return RouteHelper::getNameByClassName(static::class, 'Model');
    }
}
