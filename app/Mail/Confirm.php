<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Confirm extends Mailable
{
    use Queueable, SerializesModels;
    public $confirm;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirm)
    {
        $this->confirm = $confirm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@g-academy.net')
                    ->view('backend.mail.confirm')
                    ->text('backend.mail.plain')
                    ->with([
                        'testVarOne' => 1,
                        'testVarTwo' => 2,
                    ])
                    ->attach(public_path('/img').'/banner_class.png', [
                        'as' => 'G-Academy',
                        'mime' => 'image/png',
                    ]);
    }
}
