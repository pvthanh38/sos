<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use VNCore\Horicon\Models\SosSupport;

class SupportCreated extends Mailable
{
    //use Queueable, SerializesModels;

    protected $subject2;
    protected $support;
    protected $user;

    /**
     * SupportCreated constructor.
     *
     * @param            $subject
     * @param SosSupport $support
     * @param User       $user
     */
    public function __construct($subject, SosSupport $support, User $user)
    {
        $this->subject2 = $subject;
        $this->support = $support;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject2)
            ->view('emails.supports.created')->with([
                'support' => $this->support,
                'user' => $this->user,
            ]);
    }
}
