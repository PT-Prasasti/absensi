<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
$mail = new PHPMailer(true);

class Mailer
{
    public function __construct($subject, $link, $nama, $lama, $start, $end, $keterangan, $type, $context, $emailTo)
    {
        $body = "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Pengajuan $context Eprass</title>
        </head>

        <body>
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <div style='background-color: #f4f4f4; padding: 20px;'>
                    <h2 style='color: #333; text-align: center;'>Pemberitahuan Pengajuan $context</h2>
                    <p style='color: #666; text-align: center;'>Pengajuan ini menunggu persetujuan anda.</p>
                    <hr>
                    <h3 style='color: #333;'>Detail Pengajuan:</h3>
                    <ul>
                        <li>Nama: $nama</li>
                        <li>Tanggal Mulai: $start</li>
                        <li>Tanggal Akhir: $end</li>
                        <li>Lama $context: $lama hari</li>
                        <li>Alasan: $type</li>
                        <li>Keterangan: $keterangan</li>
                    </ul>
                    <p style='color: #666;'>Silakan konfirmasi pengajuan $context pada aplikasi.</p>
                    <p style='color: #666;'>Jika data pada sistem tidak muncul, dimohon untuk logout dan silakan login kembali.</p>
                    <a href='$link' style='display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;'>Konfirmasi</a>
                </div>
            </div>
        </body>
        </html>
        ";

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_CLIENT;
            $mail->isSMTP();
            $mail->Host       = 'mail.pt-prasasti.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'absen@pt-prasasti.com';
            $mail->Password   = 'absensi123';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('absen@pt-prasasti.com', 'Absen Eprass');
            $mail->addAddress($emailTo, 'HOD & Manager');
            $mail->addAddress('widi@pt-prasasti.com', 'HRD');

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
        
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