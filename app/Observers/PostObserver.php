<?php

namespace App\Observers;

use App\Models\Post;
use App\Traits\Observers\Historable;

class PostObserver
{
    use Historable;

    /**
     * @param Post $post
     */
    public function updating(Post $post)
    {
        $this->touchHistory($post);
    }
}
