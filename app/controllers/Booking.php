<?php

class Booking extends Controller
{
    public function index()
    {
        AuthMiddleware::customer();

        $studioModel = $this->model(
            'StudioModel'
        );

        $data['title'] = 'Booking Studio';

        $data['studio'] =
            $studioModel->getStudioAktif();

        $this->view(
            'booking/index',
            $data
        );
    }

    public function create($id)
    {
        AuthMiddleware::customer();

        $studioModel = $this->model(
            'StudioModel'
        );

        $data['studio'] =
            $studioModel->getStudioById($id);

        $data['title'] =
            'Form Booking';

        $this->view(
            'booking/create',
            $data
        );
    }

    public function store()
    {
        AuthMiddleware::customer();

        $studioModel = $this->model(
            'StudioModel'
        );

        $bookingModel = $this->model(
            'BookingModel'
        );

        $studio =
            $studioModel->getStudioById(
                $_POST['id_studio']
            );

        $mulai =
            strtotime($_POST['jam_mulai']);

        $selesai =
            strtotime($_POST['jam_selesai']);

        $durasiMenit =
            ($selesai - $mulai) / 60;

        $totalHarga =
            ($durasiMenit / 10)
            *
            $studio['harga_per_10_menit'];

        $data = [

            'id_user' =>
                $_SESSION['id_user'],

            'id_studio' =>
                $_POST['id_studio'],

            'tanggal_penggunaan' =>
                $_POST['tanggal_penggunaan'],

            'jam_mulai' =>
                $_POST['jam_mulai'],

            'jam_selesai' =>
                $_POST['jam_selesai'],

            'durasi_menit' =>
                $durasiMenit,

            'total_harga' =>
                $totalHarga

        ];

        $bentrok = $bookingModel->cekBentrok(
        $_POST['id_studio'],
        $_POST['tanggal_penggunaan'],
        $_POST['jam_mulai'],
        $_POST['jam_selesai']
        );

        if($bentrok)
        {
            die('Jadwal studio sudah dibooking pada jam tersebut');
        }

        $bookingModel->tambahBooking(
            $data
        );

        header(
            'Location: '
            . BASEURL .
            '/booking/history'
        );

        if($durasiMenit <= 0)
        {
            die('Jam selesai harus lebih besar dari jam mulai');
        }

        if(
            $_POST['tanggal_penggunaan']
            <
            date('Y-m-d')
        )
        {
            die('Tidak bisa booking tanggal yang sudah lewat');
        }
    }

    public function history()
    {
        AuthMiddleware::customer();

        $bookingModel =
            $this->model('BookingModel');

        $data['title'] =
            'Riwayat Booking';

        $data['booking'] =
            $bookingModel->getBookingByUser(
                $_SESSION['id_user']
            );

        $this->view(
            'booking/history',
            $data
        );
    }
}