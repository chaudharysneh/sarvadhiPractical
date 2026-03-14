<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonthlySessionReport extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Student $student,
        public $sessions,
        public $month
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Monthly Session Report - ' . $this->student->full_name . ' - ' . $this->month->format('F Y'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.monthly-session-report',
        );
    }
}
