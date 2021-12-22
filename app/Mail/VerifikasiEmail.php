<?php

namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
class VerifikasiEmail extends Mailable
{
    use Queueable, SerializesModels;

    var $user;

    var $verfication_kode;
 
 
    /**
     * Create a new message instance.
     *
     * @return void    
     */   
    public function __construct($user, $verfication_kode)
    {
        $this->user = $user;

        $this->verfication_kode = $verfication_kode;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->subject('BANJARMASIN-DALAM-GENGGAMAN')
                   ->from('ssobanjarmasin@gmail.com', 'BANJARMASIN-DALAM-GENGGAMAN')
                   ->view('emailku')
                   ->with(
                    [
                        'user' => $this->user,
                        'verfication_kode' => $this->verfication_kode,
                        'website' => 'https://sso.banjarmasinkota.go.id/',
                    ]);
    }
}