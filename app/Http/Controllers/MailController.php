<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('PHPMailer/PHPMailer.php');
require_once('PHPMailer/Exception.php');
require_once('PHPMailer/SMTP.php');

class MailController extends Controller
{
    public function sendEmailAlert($username) {
        $mail = new PHPMailer(true);

        //Enable SMTP debugging.
        $mail->SMTPDebug = 3;   
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();            
        //Set SMTP host name                          
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;                          
        //Provide username and password     
        $mail->Username = "smartbicyclecorporation@gmail.com";                 
        $mail->Password = "corporacionSmartBicycle";                           
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";        
        //Set TCP port to connect to
        $mail->Port = 587;                                   


        $contact =  User::where('username', $username)->get();
        $mensaje ="<h3>Esta es una alerta de emergencia</h3>
                <p>Estimado ".$contact[0]->email_contact.":</p>
                <p>Hemos recibido una alerta por parte del ciclista <strong>".$contact[0]->name."</strong>.<br>
                   asegurate de que se encuentra bien. Por recomendacion, sigue los siguientes pasos:
                </p>
            <p>
                <ol>
                    <li>Llama al numero de ".$contact[0]->name." al <strong>".$contact[0]->number_phone."</strong></li>
                    <li>Llama a otra persona que pueda estar cerca de ".$contact[0]->name.".</li>
                    <li>Ingresa al sitio web de SmartBicycle/login con tu usuario y verifica su ubicaci&oacute;n.</li>
                    <li>Contacta en el sitio donde se le vio por ultima vez.</li>
                </ol>
            <h4>Importante!</h4>
            <p>Si no has recibido respuesta por parte de 
                <strong>".$contact[0]->name."</strong> y sigues recibiendo
                este correo <br>contantemente, es importante que llames a alg&uacute;n numero de emergencias y 
                localicen a <br><strong>".$contact[0]->name."</strong> para asegurar su bienestar en 
                su recorrido. De lo contrario, puedes ignorar este mensaje.
            </p><br><br><br>
            <h3> This is an emergency alert </h3>
                <p> Dear ". $contact[0]->email_contact.": </p>
                <p> We have received an alert from the cyclist <strong> ". $contact[0]->name." </strong>. <br>
                   make sure he's okay. By recommendation, follow the following steps:
                </p>
            <p>
                <ol>
                    <li> Call to ".$contact[0]->name." with the number </strong>".$contact[0]->number_phone."</strong></li>
                    <li> Call another person who may be near ". $contact[0]->name." </li>
                    <li> Enter the website www.SmartBicycle/login with your username and verify its location </li>
                    <li> Contact the site where he/she was last seen </li>
                </ol>
            <h4> Important! </h4>
            <p> If you have not received a response from
                <strong> ". $contact[0]->name." </strong> and you keep getting
                this mail <br> constantly, it is important that you call an emergency number and
                locate <strong> ". $contact[0]->name." </strong><br> to ensure the well-being in
                her/his route. Otherwise, you can ignore this message.
            </p>";


        $mail->From = "smartbicyclecorporation@gmail.com";
        $mail->FromName = "TEAM SMART BICYCLE";
        $mail->addAddress($contact[0]->email_contact);

        $mail->isHTML(true);
        $mail->Subject = "ALERTA DE SEGURIDAD!!! (SECURITY ALERT)";
        $mail->Body = $mensaje;
        $mail->AltBody = "This is the plain text version of the email content";

        try {
            $mail->send();
            echo "Message has been sent successfully";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }          
    }
}
