<?php

require "PHPMailer/PHPMailerAutoload.php";

class mailsenderclass
{

    public function mailsenderclass($to, $from, $from_name, $subject, $body){

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;

        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'closer.cm';
        $mail->Port= '465';
        $mail->Username = 'infomail@closer.cm';
        $mail->Password = 'g_6+Dh~Ixmd2';

        $mail->isHTML(TRUE);
        $mail->From="infomail@closer.cm";
        $mail->FromName=$from_name;
        $mail->Sender=$from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
            $result= "Essayez encore s'il vous plait";
            return $result;
        }else{
            $result="Notification envoyée avec succès!!";
            return $result;
        }
    }

    /**
     * mailsenderclass constructor.
     */
    public function __construct()
    {
    }
}