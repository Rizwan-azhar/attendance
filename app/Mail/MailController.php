<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailController extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message in ance.
     *
     * @return void
     */
    public function __construct($view, $data, $emailtitle)
    {
        $this->view = $view;
        $this->data = $data;
        $this->emailtitle =$emailtitle;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('mrazhar014@gmail.com')->subject($this->emailtitle)
        ->view($this->view)->with(['data' => $this->data]);
    }
}
