<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Jenssegers\Agent\Agent;

class loginfo extends Mailable
{
    use Queueable, SerializesModels;
  
    public $loginTime;
    public $user;
    public $os;
    public $osVersion;
    public $browser;
    public $browserVersion;
    public $location;

    public function __construct($user, $loginTime, $location)
    {
        $this->user = $user;
        $this->loginTime = $loginTime;

        // Detect Agent info
        $agent = new Agent();
        $this->os = $agent->platform();
        $this->osVersion = $agent->version($this->os);
        $this->browser = $agent->browser();
        $this->browserVersion = $agent->version($this->browser);

        $this->location = $location; // you can pass array: ['city' => ..., 'region' => ..., 'country' => ...]
    }

    public function build()
    {
        return $this->view('Email.info')
                    ->subject('User Login Information')
                    ->with([
                        'user' => $this->user,
                        'loginTime' => $this->loginTime,
                        'os' => $this->os,
                        'osVersion' => $this->osVersion,
                        'browser' => $this->browser,
                        'browserVersion' => $this->browserVersion,
                        'location' => $this->location,
                    ]);
    }
}
