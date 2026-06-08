<?php

class Pengaturan extends Controller
{
    public function index()
    {
        AuthMiddleware::admin();

        $pengaturanModel =
            $this->model('PengaturanModel');

        $data['title'] =
            'Pengaturan Sistem';

        $data['pengaturan'] =
            $pengaturanModel->getPengaturan();

        $this->view(
            'pengaturan/index',
            $data
        );
    }

    public function update()
    {
        AuthMiddleware::admin();

        $pengaturanModel =
            $this->model('PengaturanModel');

        $pengaturanModel->updateBatasPembayaran(
            $_POST['batas_pembayaran_default']
        );

        $_SESSION['success'] =
            'Pengaturan berhasil disimpan';

        header(
            'Location: ' .
            BASEURL .
            '/pengaturan'
        );
        exit;
    }
}