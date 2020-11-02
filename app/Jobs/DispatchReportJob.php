<?php

namespace App\Jobs;

use App\Mail\DispatchReportMail;
use App\Models\User;
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
    protected array $report = [];

    /**
     * @var User
     */
    protected User $receiver;

    /**
     * Create a new job instance.
     *
     * @param array $report
     * @param User $receiver
     */
    public function __construct(array $report, User $receiver)
    {
        $this->report = $report;
        $this->receiver = $receiver;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->receiver->email)->send(
            new DispatchReportMail($this->report)
        );
    }
}
