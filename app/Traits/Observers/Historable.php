<?php

namespace App\Traits\Observers;

use App\Contracts\Models\Historable as HistorableContract;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait Historable
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Traits\Observers
 * @ctime 02.08.2020 11:51
 */
trait Historable
{
    /**
     * Записывает историю изменений, если изменения были.
     *
     * @param HistorableContract $model
     */
    protected function touchHistory(HistorableContract $model)
    {
        /** @var Model $model */
        if ($model->isDirty()) {
            /** @var Model $originalModel */
            $originalModel = $model->fresh();

            $changes = [];
            $dirty = $model->getDirty();

            foreach (array_keys($dirty) as $changedKey) {
                $changes[$changedKey] = [
                    $originalModel->$changedKey,
                    $dirty[$changedKey],
                ];
            }

            $model->history()->create([
                'user_id' => auth()->id(),
                'changes' => $changes,
            ]);
        }
    }
}
