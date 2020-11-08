<?php

namespace App\Contracts\Services;

/**
 * Class Pushall
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Contracts\Services
 * @ctime 08.07.2020 0:08
 */
interface PushAll
{
    public function send($title, $text, $url = null);
}
