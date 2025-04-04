<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Composer autoload dosyasını dahil et

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $book = $_POST['book'];

    // PHPMailer nesnesini oluştur
    $mail = new PHPMailer(true);
    
    try {
        // Sunucu ayarları
        $mail->isSMTP(); // SMTP kullanımı
        $mail->Host = 'smtp.gmail.com'; // SMTP sunucusunun adresi
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Gönderen e-posta adresi
        $mail->Password = 'your-email-password'; // E-posta şifreniz
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Gönderilen e-posta bilgileri
        $mail->setFrom($email, $name); // Gönderen
        $mail->addAddress('yildirima19@itu.edu.tr'); // Alıcı adresi
        $mail->addReplyTo($email, $name); // Yanıt için

        // İçerik
        $mail->isHTML(true);
        $mail->Subject = 'Yeni Kitap Geri Bildirimi';
        $mail->Body    = "Yeni bir kitap geri bildirimi alındı:<br><br>
                          <b>Adı:</b> $name<br>
                          <b>E-Mail:</b> $email<br>
                          <b>Kitap:</b> $book<br>";

        // E-posta gönderme
        $mail->send();
        echo 'Mesajınız başarıyla gönderildi!';
    } catch (Exception $e) {
        echo "Mesaj gönderilemedi. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
