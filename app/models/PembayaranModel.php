<?php

class PembayaranModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function tambahPembayaran($data)
{
    $this->db->query("
        INSERT INTO pembayaran
        (id_booking, bukti_pembayaran, status_verifikasi, tanggal_bayar)
        VALUES
        (:id_booking, :bukti, 'pending', NOW())
    ");

    $this->db->bind(':id_booking', $data['id_booking']);
    $this->db->bind(':bukti', $data['bukti']);

    $this->db->execute();
}

    public function getAllPembayaran()
    {   
        $query = "
        SELECT
            p.*,
            b.id_booking,
            b.total_harga,
            b.status,
            u.nama
        FROM pembayaran p
        JOIN booking b
            ON p.id_booking = b.id_booking
        JOIN user u
            ON b.id_user = u.id_user
        ORDER BY p.id_pembayaran DESC
        ";

        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function updateStatusVerifikasi(
        $idPembayaran,
        $status
    )
    {
        $this->db->query(
            "UPDATE pembayaran
            SET status_verifikasi = :status
            WHERE id_pembayaran = :id"
        );

        $this->db->bind(
            ':status',
            $status
        );

        $this->db->bind(
            ':id',
            $idPembayaran
        );

        $this->db->execute();
    }

    public function getPembayaranById(
        $idPembayaran
    )
    {
        $this->db->query(
            "SELECT *
            FROM pembayaran
            WHERE id_pembayaran = :id"
        );

        $this->db->bind(
            ':id',
            $idPembayaran
        );

        return $this->db->single();
    }

    public function totalIncome()
    {
        $this->db->query("
            SELECT SUM(b.total_harga) as total
            FROM pembayaran p
            JOIN booking b ON p.id_booking = b.id_booking
            WHERE p.status_verifikasi = 'disetujui'
        ");

        return $this->db->single()['total'];
    }
}