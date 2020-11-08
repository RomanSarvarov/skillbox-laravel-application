<?php

namespace App\Jobs;

use App\Mail\DispatchReportMail;
use App\Models\User;
use App\Services\ReportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class DispatchReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected array $reportData = [];

    /**
     * @var User
     */
    protected User $receiver;

    /**
     * @var ReportService
     */
    protected ReportService $reportService;

    /**
     * Create a new job instance.
     *
     * @param array $reportData
     * @param User $receiver
     * @param ReportService $reportService
     */
    public function __construct(array $reportData, User $receiver, ReportService $reportService)
    {
        $this->receiver = $receiver;
        $this->reportData = $reportData;
        $this->reportService = $reportService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $report = $this->reportService->generateReport(
            $this->reportData
        );

        if (! $report) {
            return;
        }

        Mail::to($this->receiver->email)->send(
            new DispatchReportMail($report)
        );
    }
}
