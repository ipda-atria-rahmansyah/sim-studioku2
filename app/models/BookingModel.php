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
        $this->db->query("
            INSERT INTO booking (
                id_user,
                id_studio,
                tanggal_penggunaan,
                jam_mulai,
                jam_selesai,
                durasi_menit,
                total_harga,
                status,
                batas_pembayaran,
                batas_bayar_sampai
            )
            VALUES (
                :id_user,
                :id_studio,
                :tanggal_penggunaan,
                :jam_mulai,
                :jam_selesai,
                :durasi_menit,
                :total_harga,
                :status,
                :batas_pembayaran,
                :batas_bayar_sampai
            )
        ");

        $this->db->bind(':id_user', $data['id_user']);
        $this->db->bind(':id_studio', $data['id_studio']);
        $this->db->bind(':tanggal_penggunaan', $data['tanggal_penggunaan']);
        $this->db->bind(':jam_mulai', $data['jam_mulai']);
        $this->db->bind(':jam_selesai', $data['jam_selesai']);
        $this->db->bind(':durasi_menit', $data['durasi_menit']);
        $this->db->bind(':total_harga', $data['total_harga']);
        $this->db->bind(':status', $data['status']);

        // 🔥 INI YANG KAMU LUPA / ERROR
        $this->db->bind(':batas_pembayaran', $data['batas_pembayaran']);
        $this->db->bind(':batas_bayar_sampai', $data['batas_bayar_sampai']);

        return $this->db->execute();
    }

    public function cekBentrok($idStudio, $tanggal, $jamMulai, $jamSelesai)
    {
        $this->db->query("
            SELECT * FROM booking
            WHERE id_studio = :id_studio
            AND tanggal_penggunaan = :tanggal
            AND status != 'kadaluarsa'
            AND status != 'dibatalkan'
            AND (
                (jam_mulai < :jam_selesai AND jam_selesai > :jam_mulai)
            )
        ");

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

    public function expireBooking()
    {
        $this->db->query("
            UPDATE booking
            SET status = 'kadaluarsa'
            WHERE status = 'menunggu_pembayaran'
            AND batas_bayar_sampai < NOW()
        ");

        $this->db->execute();
    }

    public function getBookingById($id)
    {
        $this->db->query("
            SELECT b.*, s.nama_studio, u.nama
            FROM booking b
            JOIN studio s ON b.id_studio = s.id_studio
            JOIN user u ON b.id_user = u.id_user
            WHERE b.id_booking = :id
        ");

        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function countAll()
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking");
        return $this->db->single()['total'];
    }

    public function countByStatus($status)
    {
        $this->db->query("
            SELECT COUNT(*) as total 
            FROM booking 
            WHERE status = :status
        ");

        $this->db->bind(':status', $status);

        return $this->db->single()['total'];
    }

    public function getAllBookingWithStudio()
    {
        $this->db->query("
            SELECT 
                b.*,
                s.nama_studio
            FROM booking b
            JOIN studio s ON b.id_studio = s.id_studio
            ORDER BY b.tanggal_penggunaan ASC
        ");

        return $this->db->resultSet();
    }

    public function countByUser($idUser)
    {
        $this->db->query("
            SELECT COUNT(*) as total
            FROM booking
            WHERE id_user = :id_user
        ");

        $this->db->bind(':id_user', $idUser);

        return $this->db->single()['total'];
    }

    public function countByUserStatus($idUser, $status)
    {
        $this->db->query("
            SELECT COUNT(*) as total
            FROM booking
            WHERE id_user = :id_user
            AND status = :status
        ");

        $this->db->bind(':id_user', $idUser);
        $this->db->bind(':status', $status);

        return $this->db->single()['total'];
    }

    public function insert($data)
    {
        $this->db->query("
            INSERT INTO booking
            (id_user, id_studio, tanggal_penggunaan, jam_mulai, jam_selesai, durasi_menit, total_harga, status, batas_bayar_sampai)
            VALUES
            (:id_user, :id_studio, :tanggal_penggunaan, :jam_mulai, :jam_selesai, :durasi_menit, :total_harga, :status, :batas_bayar_sampai)
        ");

        $this->db->bind(':id_user', $data['id_user']);
        $this->db->bind(':id_studio', $data['id_studio']);
        $this->db->bind(':tanggal_penggunaan', $data['tanggal_penggunaan']);
        $this->db->bind(':jam_mulai', $data['jam_mulai']);
        $this->db->bind(':jam_selesai', $data['jam_selesai']);
        $this->db->bind(':durasi_menit', $data['durasi_menit']);
        $this->db->bind(':total_harga', $data['total_harga']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':batas_bayar_sampai', $data['batas_bayar_sampai']);

        return $this->db->execute();
    }

    public function generateInvoiceNumber()
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking");
        $data = $this->db->single();

        $next = $data['total'] + 1;

        return 'INV-' . date('Y') . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    }
    

    
}