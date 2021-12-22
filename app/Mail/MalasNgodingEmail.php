<?php

namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
class MalasngodingEmail extends Mailable
{
    use Queueable, SerializesModels;

    var $user;
 
 
    /**
     * Create a new message instance.
     *
     * @return void    
     */   
    public function __construct($user)
    {
        $this->user = $user;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->from('ssobanjarmasin@gmail.com')
                   ->view('emailku')
                   ->with(
                    [
                        'user' => $this->user,
                        'verfication_kode' => substr(md5(uniqid(rand(), true)), 6, 6),
                        'website' => 'https://sso.banjarmasinkota.go.id/',
                    ]);
    }
}