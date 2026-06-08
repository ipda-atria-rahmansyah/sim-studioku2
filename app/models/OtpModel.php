<?php
class OtpModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // SIMPAN OTP
    public function createOtp($id_user, $kode)
    {
        $this->db->query("
            INSERT INTO otp (id_user, kode_otp, expired_at)
            VALUES (:id_user, :kode, DATE_ADD(NOW(), INTERVAL 5 MINUTE))
        ");

        $this->db->bind(':id_user', $id_user);
        $this->db->bind(':kode', $kode);

        return $this->db->execute();
    }

    // CEK OTP VALID
    public function getValidOtp($id_user, $kode)
    {
        $this->db->query("
            SELECT * FROM otp
            WHERE id_user = :id_user
            AND kode_otp = :kode
            AND expired_at >= NOW()
            AND is_used = 0
            ORDER BY id_otp DESC
            LIMIT 1
        ");

        $this->db->bind(':id_user', $id_user);
        $this->db->bind(':kode', $kode);

        return $this->db->single();
    }

    // MARK OTP SUDAH DIPAKAI
    public function markUsed($id_otp)
    {
        $this->db->query("
            UPDATE otp
            SET is_used = 1
            WHERE id_otp = :id_otp
        ");

        $this->db->bind(':id_otp', $id_otp);

        return $this->db->execute();
    }
}