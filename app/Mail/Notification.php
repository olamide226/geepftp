<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $file_name;
    public function __construct($name,$fileName)
    {
        $this->name = $name;
        $this->file_name = $fileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
          return $this->subject('File Drop Notification on GEEP FTP')
                      ->markdown('emails.notif')
                      ->with([
                          'name' => $this->name,
                          'file_name' => $this->file_name,
                          'link' => 'http://196.200.119.205/geepftp/public'
                      ]);
    }
}
