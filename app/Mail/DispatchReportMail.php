<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DispatchReportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    protected array $report = [];

    /**
     * Create a new message instance.
     *
     * @param array $report
     */
    public function __construct(array $report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown(
                'emails.dispatch-report',
                ['report' => $this->report]
            );
    }
}
