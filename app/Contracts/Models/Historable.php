<?php

namespace App\Contracts\Models;

/**
 * Interface Historable
 *
 * @todo sarv Дополнить описание интерфейса.
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Contracts\Models
 * @ctime 17.07.2020 22:22
 */
interface Historable
{
    public function history();
}