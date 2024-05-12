<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
$mail = new PHPMailer(true);

class Mailer
{
    public function __construct($subject, $link, $nama, $lama, $start, $end, $keterangan, $type)
    {
        $body = "<!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Pengajuan Cuti / Izin Eprass</title>
        </head>
        
        <body>
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <div style='background-color: #f4f4f4; padding: 20px;'>
                    <h2 style='color: #333;'>Pemberitahuan Pengajuan Cuti / Izin</h2>
                    <p style='color: #666;'>Pengajuan ini menunggu persetujuan anda.</p>
                    <hr>
                    <h3 style='color: #333;'>Detail Pengajuan:</h3>
                    <ul>
                        <li>Nama: $nama</li>
                        <li>Tanggal Mulai: $start</li>
                        <li>Tanggal Akhir: $end</li>
                        <li>Lama Cuti: $lama hari</li>
                        <li>Alasan: $type</li>
                        <li>Keterangan: $keterangan</li>
                    </ul>
                    <p style='color: #666;'>Silakan konfirmasi pengajuan cuti / izin pada aplikasi.</p>
                    <a href='$link' style='display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;'>Konfirmasi</a>
                </div>
            </div>
        </body>
        </html>
        ";

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.pt-prasasti.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'absen@pt-prasasti.com';                     //SMTP username
            $mail->Password   = 'absensi123';                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          //Enable implicit TLS encryption
            $mail->Port       = 587;              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('absen@pt-prasasti.com', 'Absen Eprass');
            $mail->addAddress('rifan@pt-prasasti.com', 'HOD & Manager');
        
            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo '<pre>';
            var_dump($e);
            echo '</pre>';
            die;
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}