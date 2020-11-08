<?php

namespace App\Helpers;

use App\Models\Post;

class ModalMessageHelper
{
    private function __construct()
    {

    }

    public static function postUpdatingModal(Post $post, array $dirtyData)
    {
        $originalData = $post->getOriginal();

        $dirtyMessage = '<ul>';

        foreach ($dirtyData as $dirtyKey => $dirtyValue) {
            $originalValue = $originalData[$dirtyKey] ?? '---';

            $dirtyMessage .= "<li>$dirtyKey (<del>$originalValue</del> -> $dirtyValue)</li>";
        }

        $dirtyMessage .= '</ul>';

        $message = sprintf(
            '%s<div><a href="%s" class="btn btn-primary btn-lg">Перейти</a></div>',
            $dirtyMessage,
            $post->url
        );

        return [
            'title' => 'Запись была изменена',
            'message' => $message,
        ];
    }
}
