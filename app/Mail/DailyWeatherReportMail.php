<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class DailyWeatherReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $weather;

    /**
     * Create a new message instance.
     *
     * @param array $weather
     */
    public function __construct(User $user, $weather)
    {
        $this->user = $user;
        $this->weather = $weather;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Passing the weather data to the email view
        return $this->subject('Daily Weather Report')
            ->view('emails.daily_weather')
            ->with('weather', $this->weather);  // Pass weather data to the view
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
