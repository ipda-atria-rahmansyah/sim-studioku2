<?php

class Dashboard extends Controller
{
    public function index()
    {
        AuthMiddleware::check();

        // 🔥 AUTO EXPIRE DI SINI
        $bookingModel = $this->model('BookingModel');
        $bookingModel->expireBooking();

        if ($_SESSION['role'] == 'admin') {

            $pembayaranModel = $this->model('PembayaranModel');

            $data['total_booking'] = $bookingModel->countAll();
            $data['pending_booking'] = $bookingModel->countByStatus('menunggu_pembayaran');
            $data['selesai_booking'] = $bookingModel->countByStatus('selesai');

            $data['income'] = $pembayaranModel->totalIncome();

            $data['title'] = 'Dashboard Admin';

            $this->view('dashboard/admin', $data);

        } else {

            $idUser = $_SESSION['id_user'];

            $data['total_booking'] = $bookingModel->countByUser($idUser);
            $data['pending_booking'] = $bookingModel->countByUserStatus($idUser, 'menunggu_pembayaran');
            $data['proses_booking'] = $bookingModel->countByUserStatus($idUser, 'menunggu_verifikasi');
            $data['selesai_booking'] = $bookingModel->countByUserStatus($idUser, 'dikonfirmasi');

            $data['title'] = 'Dashboard Customer';

            $this->view('dashboard/customer', $data);
        }
    }
}