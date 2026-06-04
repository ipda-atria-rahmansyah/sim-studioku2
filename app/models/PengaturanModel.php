<?php

class PengaturanModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getSetting()
    {
        $this->db->query("SELECT * FROM pengaturan LIMIT 1");
        return $this->db->single();
    }
}