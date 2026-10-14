<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userinfo extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $transaction;
    public $transaction12;   // ✅ must be a public property to reach the view

    public function __construct($user, $transaction, $transaction12)
    {
        $this->user          = $user;
        $this->transaction   = $transaction;
        $this->transaction12 = $transaction12;
    }

    public function build()
    {
        return $this->subject('লেনদেন বিজ্ঞপ্তি – ' . $this->transaction->trid)
                    ->view('Email.user');
    }
}