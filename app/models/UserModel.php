<?php

class UserModel
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function tambahUser($data)
    {
        $query = "INSERT INTO user
                    (nama,email,no_hp,password,role,status)
                  VALUES
                    (:nama,:email,:no_hp,:password,:role,:status)";

        $this->db->query($query);

        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':no_hp', $data['no_hp']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', 'customer');
        $this->db->bind(':status', 'aktif');

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getUserByEmail($email)
    {
        $this->db->query(
            "SELECT * FROM user WHERE email = :email"
        );

        $this->db->bind(':email', $email);

        return $this->db->single();
    }
}