<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;

        view()->share('tagCloud', $tagService->getTagCloud());
    }
}
