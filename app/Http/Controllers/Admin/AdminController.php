<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function dashboard()
	{
		$feedbacks = Feedback::latest()->get();
		$posts = Post::latest()->get();

		return view('pages.admin.feedbacks', compact('feedbacks', 'posts'));
	}
}
