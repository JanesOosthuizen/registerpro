<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterExportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $className;
    public $filePath;

    public function __construct($className, $filePath)
    {
        $this->className = $className;
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->subject("Register Export: {$this->className}")
                    ->view('emails.register_export') // Ensure this matches your view file
                    ->attach($this->filePath, [
                        'as' => "{$this->className}_register.pdf",
                        'mime' => 'application/pdf',
                    ]);
    }
}
