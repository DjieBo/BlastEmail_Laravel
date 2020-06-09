<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $mail, $subject, $message, $data)
    {
        $this->data = $data;
        $this->nama = $name;
        $this->email = $mail;
        $this->subject = $subject;
        $this->pesan = $message;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('djiebo@agmtech.co.id')->subject($this->subject)->view('temp_mail')->with('data', $this->data);
    }
}
