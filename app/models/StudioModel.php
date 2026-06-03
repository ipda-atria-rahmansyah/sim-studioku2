<?php

class StudioModel
{
    private $table = 'studio';

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllStudio()
    {
        $this->db->query(
            "SELECT * FROM studio
             ORDER BY id_studio DESC"
        );

        return $this->db->resultSet();
    }

    public function tambahStudio($data)
    {
        $query = "
            INSERT INTO studio
            (
                nama_studio,
                harga_per_10_menit,
                deskripsi,
                foto,
                kapasitas,
                status
            )
            VALUES
            (
                :nama_studio,
                :harga,
                :deskripsi,
                :foto,
                :kapasitas,
                :status
            )
        ";

        $this->db->query($query);

        $this->db->bind(':nama_studio', $data['nama_studio']);
        $this->db->bind(':harga', $data['harga_per_10_menit']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':foto', $data['foto']);
        $this->db->bind(':kapasitas', $data['kapasitas']);
        $this->db->bind(':status',$data['status']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getStudioById($id)
    {
        $this->db->query(
            "SELECT * FROM studio
            WHERE id_studio = :id"
        );

        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function updateStudio($data)
    {
        $query = "
            UPDATE studio
            SET
                nama_studio = :nama,
                harga_per_10_menit = :harga,
                deskripsi = :deskripsi,
                kapasitas = :kapasitas,
                foto = :foto,
                status = :status
            WHERE id_studio = :id
        ";

        $this->db->query($query);

        $this->db->bind(':nama',$data['nama']);
        $this->db->bind(':harga',$data['harga']);
        $this->db->bind(':deskripsi',$data['deskripsi']);
        $this->db->bind(':kapasitas',$data['kapasitas']);
        $this->db->bind(':foto', $data['foto']);
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':status',$data['status']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteStudio($id)
    {
        $this->db->query(
            "DELETE FROM studio
            WHERE id_studio = :id"
        );

        $this->db->bind(':id',$id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getStudioAktif()
    {
        $this->db->query(
            "SELECT *
            FROM studio
            WHERE status = 'aktif'
            ORDER BY nama_studio"
        );

        return $this->db->resultSet();
    }
}