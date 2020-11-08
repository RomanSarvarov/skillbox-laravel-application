<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Post;
use App\Services\ReportService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @param ReportService $reportService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function dashboard(ReportService $reportService)
	{
		$feedbacks = Feedback::latest()->get();
		$posts = Post::latest()->get();
		$reportSelectOptions = $reportService->getLabelBind();

		return view(
		    'pages.admin.feedbacks',
            compact('feedbacks', 'posts', 'reportSelectOptions')
        );
	}

    /**
     * @param Request $request
     * @param ReportService $reportService
     * @return \Illuminate\Http\RedirectResponse
     */
	public function report(Request $request, ReportService $reportService)
    {
        $request->validate([
            'report' => 'required|array',
        ]);

        $reportService->dispatch(
            $request->input('report')
        );

        return back()->with('success', 'Отчёт был успешно отправлен на Email.');
    }

}
