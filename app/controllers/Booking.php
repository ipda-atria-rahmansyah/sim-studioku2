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

        $studioModel = $this->model('StudioModel');
        $bookingModel = $this->model('BookingModel');
        $pengaturanModel = $this->model('PengaturanModel');

        // =========================
        // VALIDASI DASAR (WAJIB DI ATAS)
        // =========================

        if ($_POST['jam_selesai'] <= $_POST['jam_mulai']) {
            die('Jam selesai harus lebih besar dari jam mulai');
        }

        if ($_POST['tanggal_penggunaan'] < date('Y-m-d')) {
            die('Tidak bisa booking tanggal yang sudah lewat');
        }

        // =========================
        // CEK BENTROK
        // =========================

        $bentrok = $bookingModel->cekBentrok(
            $_POST['id_studio'],
            $_POST['tanggal_penggunaan'],
            $_POST['jam_mulai'],
            $_POST['jam_selesai']
        );

        if ($bentrok) {
            die('Jadwal studio sudah dibooking pada jam tersebut');
        }

        // =========================
        // HITUNG DURASI & TOTAL
        // =========================

        $studio = $studioModel->getStudioById($_POST['id_studio']);

        $mulai = strtotime($_POST['jam_mulai']);
        $selesai = strtotime($_POST['jam_selesai']);

        $durasiMenit = ($selesai - $mulai) / 60;

        if ($durasiMenit <= 0) {
            die('Durasi tidak valid');
        }

        $totalHarga = ($durasiMenit / 10) * $studio['harga_per_10_menit'];

        // =========================
        // AMBIL SETTING BATAS BAYAR
        // =========================

        $setting = $pengaturanModel->getSetting();
        $batasMenit = $setting['batas_pembayaran_default'];

        $batasBayar = date(
            'Y-m-d H:i:s',
            strtotime("+$batasMenit minutes")
        );

        // =========================
        // DATA BOOKING
        // =========================

        $data = [
            'id_user' => $_SESSION['id_user'],
            'id_studio' => $_POST['id_studio'],
            'tanggal_penggunaan' => $_POST['tanggal_penggunaan'],
            'jam_mulai' => $_POST['jam_mulai'],
            'jam_selesai' => $_POST['jam_selesai'],
            'durasi_menit' => $durasiMenit,
            'total_harga' => $totalHarga,

            // 🔥 STATUS & DEADLINE
            'status' => 'menunggu_pembayaran',
            'batas_bayar_sampai' => $batasBayar
        ];

        // =========================
        // INSERT
        // =========================

        $bookingModel->tambahBooking($data);

        header('Location: ' . BASEURL . '/booking/history');
        exit;
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

    public function detail($id)
    {
        $bookingModel = $this->model('BookingModel');

        $data['title'] = 'Detail Booking';

        $data['booking'] = $bookingModel->getBookingById($id);

        $this->view('booking/detail', $data);
    }

    public function kalender()
    {
        AuthMiddleware::check();

        $bookingModel = $this->model('BookingModel');

        $data['title'] = 'Kalender Booking';
        $data['booking'] = $bookingModel->getAllBookingWithStudio();

        $this->view('booking/kalender', $data);
    }

    public function getEvents()
    {
        $bookingModel = $this->model('BookingModel');

        $data = $bookingModel->getAllBookingWithStudio();

        $events = [];

        foreach ($data as $b) {

            // WARNA STATUS
            $color = '#6c757d';

            if ($b['status'] == 'dikonfirmasi') {
                $color = '#28a745';
            } elseif ($b['status'] == 'menunggu_pembayaran') {
                $color = '#ffc107';
            } elseif ($b['status'] == 'menunggu_verifikasi') {
                $color = '#17a2b8';
            } elseif ($b['status'] == 'dibatalkan') {
                $color = '#dc3545';
            }

            $events[] = [
                'title' => $b['nama_studio'],
                'start' => $b['tanggal_penggunaan'] . 'T' . $b['jam_mulai'],
                'end'   => $b['tanggal_penggunaan'] . 'T' . $b['jam_selesai'],
                'color' => $color,
                'extendedProps' => [
                    'status' => $b['status']
                ]
            ];
        }

        echo json_encode($events);
    }

    public function fullcalendar()
    {
        AuthMiddleware::check();

        $bookingModel = $this->model('BookingModel');

        $data['title'] = 'Full Calendar Booking';

        $this->view('booking/fullcalendar', $data);
    }


}