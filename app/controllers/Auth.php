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

    //proses register 
    public function registerProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userModel = $this->model('UserModel');

            if ($userModel->getUserByEmail($_POST['email'])) {

                echo "Email sudah digunakan";
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

                header('Location: ' . BASEURL . '/auth');
                exit;
            }
        }
    }

        public function loginProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userModel = $this->model('UserModel');

            $user = $userModel->getUserByEmail(
                $_POST['email']
            );

            if (!$user) {

                die('Email tidak ditemukan');
            }

            if (
                password_verify(
                    $_POST['password'],
                    $user['password']
                )
            ) {

                session_start();

                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];

                header('Location: ' . BASEURL . '/dashboard');

                exit;
            }

            die('Password salah');
        }
    }

        public function logout()
    {
        session_start();

        session_destroy();

        header('Location: ' . BASEURL . '/auth');

        exit;
    }
}

