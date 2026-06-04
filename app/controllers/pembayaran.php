<?php

class Pembayaran extends Controller
{
    // =====================
    // CUSTOMER UPLOAD FORM
    // =====================
    public function upload($idBooking)
    {
        AuthMiddleware::customer();

        $bookingModel = $this->model('BookingModel');

        $booking = $bookingModel->getBookingById($idBooking);

        // 🔥 CEK EXPIRED
        /*if ($booking['status'] == 'kadaluarsa' || strtotime($booking['batas_bayar_sampai']) < time()) {
            die('Waktu pembayaran sudah habis');
        }*/

        $data['booking'] = $booking;
        $data['id_booking'] = $idBooking;

        $this->view('pembayaran/upload', $data);
    }

    // =====================
    // CUSTOMER STORE UPLOAD
    // =====================
    public function store()
    {
        AuthMiddleware::customer();

        $pembayaranModel = $this->model('PembayaranModel');

        $file = time() . '_' . $_FILES['bukti']['name'];

        move_uploaded_file(
            $_FILES['bukti']['tmp_name'],
            '../public/uploads/pembayaran/' . $file
        );

        $data = [
            'id_booking' => $_POST['id_booking'],
            'bukti' => $file
        ];

        $pembayaranModel->tambahPembayaran($data);

        $bookingModel = $this->model('BookingModel');

        $bookingModel->updateStatus(
            $_POST['id_booking'],
            'menunggu_verifikasi'
        );

        header('Location: ' . BASEURL . '/booking/history');
    }

    // =====================
    // ADMIN LIST
    // =====================
    public function index()
    {
        AuthMiddleware::admin();

        $pembayaranModel = $this->model('PembayaranModel');

        $data['title'] = 'Verifikasi Pembayaran';
        $data['pembayaran'] = $pembayaranModel->getAllPembayaran();

            /*debug
            -var_dump($data['pembayaran']);
                die;
            -echo '<pre>';
                print_r($data['pembayaran']);
                echo '</pre>';
                die;*/

        $this->view('pembayaran/index', $data);
    }

    // =====================
    // ADMIN VERIFIKASI
    // =====================
    public function verifikasi($idPembayaran)
    {
        AuthMiddleware::admin();

        $pembayaranModel = $this->model('PembayaranModel');
        $bookingModel = $this->model('BookingModel');

        $pembayaran = $pembayaranModel->getPembayaranById($idPembayaran);

        $pembayaranModel->updateStatusVerifikasi(
            $idPembayaran,
            'disetujui'
        );

        $bookingModel->updateStatus(
            $pembayaran['id_booking'],
            'dikonfirmasi'
        );

        header('Location: ' . BASEURL . '/pembayaran');
    }

    // =====================
    // ADMIN TOLAK
    // =====================
    public function tolak($idPembayaran)
    {
        AuthMiddleware::admin();

        $pembayaranModel = $this->model('PembayaranModel');
        $bookingModel = $this->model('BookingModel');

        $pembayaran = $pembayaranModel->getPembayaranById($idPembayaran);

        $pembayaranModel->updateStatusVerifikasi(
            $idPembayaran,
            'ditolak'
        );

        $bookingModel->updateStatus(
            $pembayaran['id_booking'],
            'menunggu_pembayaran'
        );

        header('Location: ' . BASEURL . '/pembayaran');
    }

}