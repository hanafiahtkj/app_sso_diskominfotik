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

    var $verification_kode;
 
 
    /**
     * Create a new message instance.
     *
     * @return void    
     */   
    public function __construct($user, $verification_kode)
    {
        $this->user = $user;

        $this->verification_kode = $verification_kode;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->subject('BANJARMASIN PINTAR')
                   ->from('ssobanjarmasin@gmail.com', 'Verifikasi Email')
                   ->view('emailku')
                   ->with(
                    [
                        'user' => $this->user,
                        'verification_kode' => $this->verification_kode,
                        'website' => 'https://sso.banjarmasinkota.go.id/',
                    ]);
    }
}