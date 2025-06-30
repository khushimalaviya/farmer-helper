<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CropRecommendationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recommendedCrops;
    public $farm;
    public $user;

    public function __construct($recommendedCrops, $farm, $user)
    {
        $this->recommendedCrops = $recommendedCrops;
        $this->farm = $farm;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Your Crop Recommendation Report')
                    ->view('emails.crop_recommendation');
    }
}
