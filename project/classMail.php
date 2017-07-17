<?php

require 'PHPMailer/PHPMailerAutoload.php';

class SendEmail {

    private $name;
    private $email;
    private $values;

    function __construct($e, $v, $n) {
        $this->name = $n;
        $this->email = $e;
        $this->values = $v;
    }

    public function sendPWemail() {

        $mail = new PHPMailer;

        $mail->SMTPDebug = 0;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = '	smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '29335@ufp.edu.pt';                 // SMTP username
        $mail->Password = '14586428';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('29335@ufp.edu.pt', 'Employee Managment');
        $mail->addAddress($this->email, $this->name);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
        //$mail->addAttachment('/home/luis/Imagens/showInterfaceBrief.png');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'EmployeeManagment';
        $mail->Body = "This is your password " . "<strong> $this->values </strong>";
        $mail->AltBody = "This is your password " . $this->values;

        if($mail->send()){
            
        }
        else{
            "Error: email not sent";
        }
    }

}
