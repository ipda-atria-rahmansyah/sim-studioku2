<?php

class Auth extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';

        $this->view('auth/login', $data);
    }

    public function register()
    {
        $data['title'] = 'Register';

        $this->view('auth/register', $data);
    }

    // PROSES REGISTER
    public function registerProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userModel = $this->model('UserModel');

            // cek email sudah digunakan
            if ($userModel->getUserByEmail($_POST['email'])) {

                $_SESSION['error'] = 'Email sudah digunakan';

                header('Location: ' . BASEURL . '/auth/register');
                exit;
            }

            $data = [
                'nama'     => $_POST['nama'],
                'email'    => $_POST['email'],
                'no_hp'    => $_POST['no_hp'],
                'password' => password_hash(
                    $_POST['password'],
                    PASSWORD_DEFAULT
                )
            ];

            if ($userModel->tambahUser($data)) {

                $_SESSION['success'] =
                    'Registrasi berhasil, silakan login';

                header('Location: ' . BASEURL . '/auth');
                exit;
            }
        }
    }

    // PROSES LOGIN
    public function loginProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userModel = $this->model('UserModel');

            $user = $userModel->getUserByEmail(
                $_POST['email']
            );
            /*var_dump($user);
            die;*/

            // EMAIL TIDAK DITEMUKAN
            if (!$user) {

                $_SESSION['error'] =
                    'Email tidak ditemukan';

                header('Location: ' . BASEURL . '/auth');
                exit;
            }

            // PASSWORD BENAR
            if (
                password_verify(
                    $_POST['password'],
                    $user['password']
                )
            ) {

                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];

                $_SESSION['success'] = 'Login berhasil';

                header('Location: ' . BASEURL . '/dashboard');
                exit;
            }

            // PASSWORD SALAH
            $_SESSION['error'] =
                'Password salah';

            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function logout()
    {
        session_destroy();

        header('Location: ' . BASEURL . '/auth');
        exit;
    }

    public function forgot()
    {
        $data['title'] = 'Lupa Password';
        $this->view('auth/forgot', $data);
    }

    public function sendOtp()
    {
        $userModel = $this->model('UserModel');
        $otpModel = $this->model('OtpModel');

        $user = $userModel->getUserByEmail($_POST['email']);

        if (!$user) {
            $_SESSION['error'] = "Email tidak ditemukan";
            header("Location: " . BASEURL . "/auth/forgot");
            exit;
        }

        $otp = rand(100000, 999999);

        // simpan OTP ke DB
        $otpModel->createOtp($user['id_user'], $otp);

        // kirim email
        require_once __DIR__ . '/../core/Mail.php';

        $send = Mail::sendOtp($user['email'], $otp);

        if ($send) {
            $_SESSION['id_user_reset'] = $user['id_user'];

            header("Location: " . BASEURL . "/auth/formOtp");
            exit;
        } else {
            die("Gagal kirim email OTP");
        }
    }

    public function formOtp()
    {
        $this->view('auth/otp');
    }

    public function verifyOtp()
    {
        $otpModel = $this->model('OtpModel');

        $id_user = $_SESSION['id_user_reset'];
        $kode = $_POST['otp'];

        $dataOtp = $otpModel->checkOtp($id_user, $kode);

        if (!$dataOtp) {
            $_SESSION['error'] = "OTP salah / expired";
            header("Location: " . BASEURL . "/auth/formOtp");
            exit;
        }

        // OTP benar
        $otpModel->markUsed($dataOtp['id_otp']);

        $_SESSION['otp_valid'] = true;

        header("Location: " . BASEURL . "/auth/resetPassword");
    }

    public function resetPassword()
    {
        if (!isset($_SESSION['otp_valid'])) {
            header("Location: " . BASEURL . "/auth");
            exit;
        }

        $this->view('auth/reset');
    }

    public function updatePassword()
    {
        $userModel = $this->model('UserModel');

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $userModel->updatePassword($_SESSION['id_user_reset'], $password);

        session_destroy();

        header("Location: " . BASEURL . "/auth");
    }
}