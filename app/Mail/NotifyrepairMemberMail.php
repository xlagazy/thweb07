<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyrepairMemberMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $details)
    {
        $this->name = $name;
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Mail notification repair from '.$this->name;
        return $this->subject($subject)
                    ->view('notifyrepair.mailnotirepairmember');
    }
}
?>