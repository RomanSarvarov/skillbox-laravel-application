<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('pages.admin.feedbacks')
            ->with('feedbacks', Feedback::latest()->get());
    }

    public function create()
    {
        return view('pages.base.feedback');
    }

    public function store(FeedbackRequest $request)
    {
        Feedback::create($request->input());

        return redirect()->back()
            ->with('success', 'Message was sent!');
    }
}
