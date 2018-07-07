<?php  include '../Mailer/PHPMailerAutoload.php'; ?>
<?php  include '../Mailer/class.phpmailer.php'; ?>
<?php  include '../Mailer/class.smtp.php'; ?>

<?php
function sendDS($mail_nhan,$ten_nhan,$chu_de,$noi_dung,$bcc){
        // PHPMailer Modify By DuySexy
        $mail = new PHPMailer(); // declare object PHPMailer
        $mail->SMTPDebug = 0;                // not debug                 
        $mail->isSMTP();                       // smtp connection             
        $mail->Host = 'smtp.gmail.com';   //smtp gmail
        $mail->SMTPAuth = true;                              // auth smtp 
        $mail->Username = '@gmail.com';         // user gmail         
        $mail->Password = '';                      // pass  gmail   
        $mail->SMTPSecure = 'tls';                           //tls protocol
        $mail->Port = 587;                                   // port
        $mail->setFrom('duysexy98tb@gmail.com', $bcc); // address from
        $mail->addAddress($mail_nhan, $ten_nhan);     // address email receive
        $mail->addReplyTo('duysexy98tb@gmail.com', $bcc); // address and bcc from reply
        $mail->isHTML(true);   // set body with HTML
        $mail->Subject = "$ten_nhan, $chu_de"; // subject
        $mail->Body    = $noi_dung;
        $mail->CharSet = 'UTF-8';  // set unicode charset
        $send = $mail->send();
        return $send;
    }
?>