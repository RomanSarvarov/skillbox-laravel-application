<?php

namespace App\Http\View\Composers;

use App\Services\TagService;
use Illuminate\View\View;

class TagsCloudComposer
{
    private TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function compose(View $view): void
    {
        $view->with('tagsCloud', $this->tagService->getTagsForCloud());
    }
}
