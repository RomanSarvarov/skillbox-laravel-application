<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function create()
    {
        return view('pages.base.feedback');
    }

	/**
	 * @param FeedbackRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(FeedbackRequest $request)
    {
        Feedback::create($request->input());

        return redirect()->back()
            ->with('success', 'Message was sent!');
    }
}
