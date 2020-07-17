<?php

namespace App\Services\ThirdParty;

use App\Contracts\Services\PushAll;
use GuzzleHttp\Client;

/**
 * Class PushAllService
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Services\ThirdParty
 * @ctime 08.07.2020 0:07
 */
class PushAllService implements PushAll
{
    /**
     * @var string
     */
    private string $pushType = 'self';

    /**
     * @var string
     */
    private $key;

    /**
     * PushAllService constructor.
     *
     * @param $key
     */
    public function __construct($key = null)
    {
        $this->key = $key ?: config('services.pushall.key');
    }

    /**
     * @param $title
     * @param $text
     * @param string $url
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($title, $text, $url = null)
    {
        return (new Client())->post(
            $this->url,
            [
                'form_params' => [
                    'type' => $this->pushType,
                    'id' => 100435, // Задаю явно своего юзера (для теста). В реальности бы отправляли всем юзерам.
                    'key' => $this->key,
                    'title' => $title,
                    'text' => $text,
                    'url' => $url,
                ],
            ]
        );
    }
}
