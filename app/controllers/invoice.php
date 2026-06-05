<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Dompdf\Dompdf;

class Invoice extends Controller
{
    public function generate($id_booking)
    {
        AuthMiddleware::check();

        $bookingModel = $this->model('BookingModel');

        // ambil data booking
        $booking = $bookingModel->getBookingById($id_booking);

        if (!$booking) {
            die("Booking tidak ditemukan");
        }

        // invoice number
        $data['invoice_number'] =
            'INV-' . date('Y') . '-' . str_pad($id_booking, 5, '0', STR_PAD_LEFT);

        $data['booking'] = $booking;

        // =========================
        // RENDER PDF (TANPA QR)
        // =========================

        ob_start();
        $this->view('invoice/template', $data);
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("invoice-booking.pdf", ["Attachment" => true]);
    }
}