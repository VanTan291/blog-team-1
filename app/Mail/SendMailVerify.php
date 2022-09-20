<?php
/**
 * This is the send mail verify code.
 *
 * @package App\Mail
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * This is the send mail verify class.
 */
class SendMailVerify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The code instance.
     *
     * @var string $code
     */
    public $code;

    /**
     * Create a new message instance.
     *
     * @param string $code This is code verify email.
     */
    public function __construct(string $code = null)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.verifyEmail');
            // ->subject(__('auth.verify_mail_subject'));
    }
}
