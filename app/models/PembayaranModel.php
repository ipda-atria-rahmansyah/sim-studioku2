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
        $query = "
        INSERT INTO pembayaran
        (
            id_booking,
            bukti_pembayaran,
            tanggal_bayar,
            status_verifikasi
        )
        VALUES
        (
            :id_booking,
            :bukti,
            NOW(),
            'menunggu'
        )
        ";

        $this->db->query($query);

        $this->db->bind(
            ':id_booking',
            $data['id_booking']
        );

        $this->db->bind(
            ':bukti',
            $data['bukti']
        );

        $this->db->execute();

        return $this->db->rowCount();
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
}