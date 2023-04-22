<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Barryvdh\DomPDF\Facade\Pdf;

class mailController extends Controller
{
    private $mail;
    private $userName;
    private $recipientEmail;
    private $hasAttachment;
    private $pdf;
    private $subject;
    private $body;

    public function __construct($recipientEmail, $subject, $body, $hasAttachment, $pdf)
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;
        $this->userName = 'testrrdms@gmail.com';
        $this->mail->Username   = $this->userName;
        $this->mail->Password   = 'clitpgplsdizbstt';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
        $this->recipientEmail = $recipientEmail;
        $this->subject  = $subject;
        $this->body     = $body;
        $this->pdf      = $pdf;
        $this->hasAttachment = $hasAttachment;
    }

    public function sendEmail(){
        $this->mail->setFrom($this->userName, 'RRDMS UNC');
        $this->mail->addReplyTo($this->userName);
        $this->mail->addAddress($this->recipientEmail);

        $this->mail->isHTML(true);
        $this->mail->Subject = $this->subject;
        $this->mail->Body    = $this->body;

        if($this->hasAttachment){
            $this->mail->addStringAttachment($this->pdf->output(), 'Request.pdf');
        }

        $this->mail->Send();
    }
}
