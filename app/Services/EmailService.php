<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//use App\Mail\CustomEmail; // Assurez-vous que vous avez créé une classe Mailable

class EmailService
{

    private $host = 'sandbox.smtp.mailtrap.io';
    private $port = 587;
    private $username = 'fbf23f8dbaa638';
    private $password = '13b9808b858b5e';
    private $app_name = 'MyApp';

    public function resetPassword($subject, $emailUser, $nameUser, $isHtml, $activation_token ){

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug =0;
        $mail->Host = $this->host;
        $mail->Port = $this->port;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPAuth = true;
        $mail->Subject = $subject;
        $mail->setFrom($this->app_name, $this->app_name);
        $mail->addReplyTo($this->app_name, $this->app_name);
        $mail->addAddress($emailUser, $nameUser);
        $mail->isHTML($isHtml);
        $mail->Body = $this->viewResetPassword($nameUser,$activation_token);
        $mail->send();
    
    }


    public function viewResetPassword($name,$activation_token){

        return view('mail.reset_password')
        ->with([
            'nomFournisseur'=>$name,
            'activation_token'=>$activation_token
        ]);

    }




}




