use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

class Mail
{
    public static function sendOtp($toEmail, $otp)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            // 🔥 GANTI INI
            $mail->Username = 'yourgmail@gmail.com';
            $mail->Password = 'app_password_gmail';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('yourgmail@gmail.com', 'Booking Studio');
            $mail->addAddress($toEmail);

            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Reset Password';

            $mail->Body = "
                <h2>Kode OTP Anda</h2>
                <h1 style='color:blue;'>$otp</h1>
                <p>OTP berlaku 5 menit.</p>
            ";

            $mail->send();
            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}