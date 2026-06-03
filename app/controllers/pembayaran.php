<?php

class Pembayaran extends Controller
{
    public function upload($idBooking)
    {
        AuthMiddleware::customer();

        $data['title'] = 'Upload Pembayaran';

        $data['id_booking'] = $idBooking;

        $this->view(
            'pembayaran/upload',
            $data
        );

       
    }

    public function store()
    {
        AuthMiddleware::customer();

        $pembayaranModel =
            $this->model(
                'PembayaranModel'
            );

        $file =
            time()
            .
            '_'
            .
            $_FILES['bukti']['name'];

        move_uploaded_file(

            $_FILES['bukti']['tmp_name'],

            '../public/uploads/pembayaran/'
            .
            $file
        );

        $data = [

            'id_booking' =>
                $_POST['id_booking'],

            'bukti' =>
                $file

        ];

        $pembayaranModel
            ->tambahPembayaran(
                $data
            );

         $bookingModel =
        $this->model(
            'BookingModel'
        );

        $bookingModel->updateStatus(
            $_POST['id_booking'],
            'menunggu_verifikasi'
        );

        header(
            'Location: '
            .
            BASEURL
            .
            '/booking/history'
        );

    }

    public function index()
    {
        AuthMiddleware::admin();

        $pembayaranModel =
            $this->model(
                'PembayaranModel'
            );

        $data['title'] =
            'Verifikasi Pembayaran';

        $data['pembayaran'] =
            $pembayaranModel
                ->getAllPembayaran();

        $this->view(
            'pembayaran/index',
            $data
        );
    }

    public function verifikasi(
        $idPembayaran
    )
    {
        AuthMiddleware::admin();

        $pembayaranModel =
            $this->model(
                'PembayaranModel'
            );

        $bookingModel =
            $this->model(
                'BookingModel'
            );

        $pembayaran =
            $pembayaranModel
                ->getPembayaranById(
                    $idPembayaran
                );

        $pembayaranModel
            ->updateStatusVerifikasi(
                $idPembayaran,
                'diterima'
            );

        $bookingModel
            ->updateStatus(
                $pembayaran['id_booking'],
                'dikonfirmasi'
            );

        header(
            'Location: '
            .
            BASEURL
            .
            '/pembayaran'
        );
    }

    public function tolak(
        $idPembayaran
    )
    {
        AuthMiddleware::admin();

        $pembayaranModel =
            $this->model(
                'PembayaranModel'
            );

        $bookingModel =
            $this->model(
                'BookingModel'
            );

        $pembayaran =
            $pembayaranModel
                ->getPembayaranById(
                    $idPembayaran
                );

        $pembayaranModel
            ->updateStatusVerifikasi(
                $idPembayaran,
                'ditolak'
            );

        $bookingModel
            ->updateStatus(
                $pembayaran['id_booking'],
                'menunggu_pembayaran'
            );

        header(
            'Location: '
            .
            BASEURL
            .
            '/pembayaran'
        );
    }
}