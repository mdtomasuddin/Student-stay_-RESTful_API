<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use FFMpeg; // You will use PHP-FFMpeg library for video metadata

class VideoDuration implements Rule
{
    protected $min;
    protected $max;
    protected $errorMessage;

    public function __construct($minSeconds, $maxSeconds)
    {
        $this->min = $minSeconds;
        $this->max = $maxSeconds;
        $this->errorMessage = "The video duration must be between {$minSeconds} and {$maxSeconds} seconds.";
    }

    public function passes($attribute, $value)
    {
        try {
            // Get the video duration using FFmpeg (in seconds)
            $ffprobe = \FFMpeg\FFProbe::create();
            $duration = $ffprobe->format($value->getPathname())->get('duration');

            return $duration >= $this->min && $duration <= $this->max;
        } catch (\Exception $e) {
            $this->errorMessage = "Failed to read video duration.";
            return false;
        }
    }

    public function message()
    {
        return $this->errorMessage;
    }
}
