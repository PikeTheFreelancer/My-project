<?php

namespace App\Mail;

use App\Models\ReportReason;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserReport extends Mailable
{
    use Queueable, SerializesModels;

    protected $report;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report)
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
        $reason = ReportReason::findOrFail($this->report->reason)->reason_translate;
        $content = $this->report->content;
        $url = $this->report->url;
        $user = $this->report->user;
        return $this->view('emails.report')->with(['reason'=>$reason, 'content'=>$content, 'url'=>$url, 'user'=>$user]);
    }
}
