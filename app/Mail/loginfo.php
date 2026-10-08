<?php
namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class loginfo extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $id;
    public $user;
    public $browser;
    public $browserVersion;
    public $platform;
    public $platformVersion;
    public $ip;
    public $city;
    public $region;
    public $country;

    public function __construct(
        $id,
        User $user,
        $browser,
        $browserVersion,
        $platform,
        $platformVersion,
        $ip,
        $city,
        $region,
        $country
    ) {
        $this->id = $id;
        $this->user = $user;
        $this->browser = $browser;
        $this->browserVersion = $browserVersion;
        $this->platform = $platform;
        $this->platformVersion = $platformVersion;
        $this->ip = $ip;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
    }

    public function build()
    {
        return $this->view('Email.info')
                    ->subject($this->id);
    }
}