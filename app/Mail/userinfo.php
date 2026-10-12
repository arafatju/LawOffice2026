<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userinfo  extends Mailable
{
    use Queueable, SerializesModels;

    public $user;        // ✅ NEW — name & email live here
    public $transaction;
    public $products;
    public $total;

    public function __construct($user, $transaction, $products)
    {
        $this->user        = $user;
        $this->transaction = $transaction;
        $this->products    = $products;

        $this->total = $products->sum(fn ($p) => ($p->quantity ?? 1) * ($p->price ?? 0));
    }

    public function build()
    {
        return $this->subject('লেনদেন বিজ্ঞপ্তি – ' . $this->transaction->trid)
                    ->view('Email.user');
    }
}