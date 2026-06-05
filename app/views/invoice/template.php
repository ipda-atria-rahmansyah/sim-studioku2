<!DOCTYPE html>
<html>
<head>
    <title>Invoice Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        hr {
            margin: 10px 0;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background: #f5f5f5;
            text-align: left;
            padding: 8px;
        }

        td {
            padding: 8px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
        }

        .total-box {
            margin-top: 15px;
            text-align: right;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<h2>INVOICE BOOKING STUDIO</h2>
<hr>

<div class="info">
    <p><b>Invoice:</b> <?= $data['invoice_number']; ?></p>
    <p><b>Nama Customer:</b> <?= $data['booking']['nama']; ?></p>
    <p><b>Studio:</b> <?= $data['booking']['nama_studio']; ?></p>
    <p><b>Tanggal Penggunaan:</b> <?= $data['booking']['tanggal_penggunaan']; ?></p>
    <p><b>Jam:</b> <?= $data['booking']['jam_mulai']; ?> - <?= $data['booking']['jam_selesai']; ?></p>
    <p><b>Status:</b> <?= $data['booking']['status']; ?></p>
</div>

<table>
    <tr>
        <th>ID Booking</th>
        <td><?= $data['booking']['id_booking']; ?></td>
    </tr>
    <tr>
        <th>Durasi</th>
        <td><?= $data['booking']['durasi_menit']; ?> menit</td>
    </tr>
    <tr>
        <th>Total Harga</th>
        <td>Rp <?= number_format($data['booking']['total_harga']); ?></td>
    </tr>
</table>

<div class="total-box">
    TOTAL BAYAR: Rp <?= number_format($data['booking']['total_harga']); ?>
</div>


<div class="footer">
    Terima kasih telah melakukan booking 🎉<br>
    Simpan invoice ini sebagai bukti transaksi
</div>

</body>
</html>