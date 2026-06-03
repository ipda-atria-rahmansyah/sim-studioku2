<?php

class BookingModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function tambahBooking($data)
    {
        $query = "
        INSERT INTO booking
        (
            id_user,
            id_studio,
            tanggal_booking,
            tanggal_penggunaan,
            jam_mulai,
            jam_selesai,
            durasi_menit,
            total_harga,
            status
        )
        VALUES
        (
            :id_user,
            :id_studio,
            NOW(),
            :tanggal_penggunaan,
            :jam_mulai,
            :jam_selesai,
            :durasi_menit,
            :total_harga,
            'menunggu_pembayaran'
        )
        ";

        $this->db->query($query);

        $this->db->bind(':id_user', $data['id_user']);
        $this->db->bind(':id_studio', $data['id_studio']);
        $this->db->bind(':tanggal_penggunaan', $data['tanggal_penggunaan']);
        $this->db->bind(':jam_mulai', $data['jam_mulai']);
        $this->db->bind(':jam_selesai', $data['jam_selesai']);
        $this->db->bind(':durasi_menit', $data['durasi_menit']);
        $this->db->bind(':total_harga', $data['total_harga']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cekBentrok(
        $idStudio,
        $tanggal,
        $jamMulai,
        $jamSelesai
    )
    {
        $query = "
        SELECT *
        FROM booking
        WHERE id_studio = :id_studio
        AND tanggal_penggunaan = :tanggal
        AND status != 'ditolak'
        AND (
            jam_mulai < :jam_selesai
            AND
            jam_selesai > :jam_mulai
        )
        ";

        $this->db->query($query);

        $this->db->bind(':id_studio', $idStudio);
        $this->db->bind(':tanggal', $tanggal);
        $this->db->bind(':jam_mulai', $jamMulai);
        $this->db->bind(':jam_selesai', $jamSelesai);

        return $this->db->single();
    }

    public function getBookingByUser($idUser)
    {
        $query = "
        SELECT
            b.*,
            s.nama_studio
        FROM booking b
        JOIN studio s
            ON b.id_studio = s.id_studio
        WHERE b.id_user = :id_user
        ORDER BY b.id_booking DESC
        ";

        $this->db->query($query);

        $this->db->bind(':id_user', $idUser);

        return $this->db->resultSet();
    }

    public function updateStatus(
        $idBooking,
        $status
    )
    {
        $this->db->query(
            "UPDATE booking
            SET status = :status
            WHERE id_booking = :id"
        );

        $this->db->bind(
            ':status',
            $status
        );

        $this->db->bind(
            ':id',
            $idBooking
        );

        $this->db->execute();
    }
}