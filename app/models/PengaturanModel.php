<?php

class PengaturanModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getpengaturan()
    {
        $this->db->query("
            SELECT *
            FROM pengaturan
            LIMIT 1
        ");

        return $this->db->single();
    }

    public function updateBatasPembayaran($menit)
    {
        $this->db->query("
            UPDATE pengaturan
            SET batas_pembayaran_default = :menit
        ");

        $this->db->bind('menit', $menit);

        return $this->db->execute();
    }
}