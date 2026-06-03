<?php

class Studio extends Controller
{
    public function index()
    {
        AuthMiddleware::admin();

        $studioModel = $this->model(
            'StudioModel'
        );

        $data['title'] = 'Data Studio';

        $data['studio'] =
            $studioModel->getAllStudio();

        $this->view(
            'studio/index',
            $data
        );
    }

    public function create()
    {
        AuthMiddleware::admin();

        $data['title'] = 'Tambah Studio';

        $this->view('studio/create', $data);
    }

    public function store()
    {
        AuthMiddleware::admin();

        $studioModel = $this->model('StudioModel');

        $foto = '';

        if (!empty($_FILES['foto']['name'])) {

            $foto = time() . '_' . $_FILES['foto']['name'];

            move_uploaded_file(
                $_FILES['foto']['tmp_name'],
                '../public/uploads/studio/' . $foto
            );
        }

        $data = [
            'nama_studio' => $_POST['nama_studio'],
            'harga_per_10_menit' => $_POST['harga_per_10_menit'],
            'deskripsi' => $_POST['deskripsi'],
            'foto' => $foto,
            'kapasitas' => $_POST['kapasitas'],
            'status' => $_POST['status']
        ];

        $studioModel->tambahStudio($data);

        header('Location: ' . BASEURL . '/studio');
        exit;
    }

    public function edit($id)
    {
        AuthMiddleware::admin();

        $studioModel = $this->model('StudioModel');

        $data['title'] = 'Edit Studio';

        $data['studio'] =
            $studioModel->getStudioById($id);

        $this->view(
            'studio/edit',
            $data
        );
    }

    public function update()
    {
        AuthMiddleware::admin();

        $studioModel = $this->model('StudioModel');

        $studio = $studioModel->getStudioById(
            $_POST['id_studio']
        );

        $foto = $studio['foto'];

        if (!empty($_FILES['foto']['name'])) {

            if (
                !empty($foto) &&
                file_exists('../public/uploads/studio/' . $foto)
            ) {
                unlink('../public/uploads/studio/' . $foto);
            }

            $foto =
                time() . '_' .
                $_FILES['foto']['name'];

            move_uploaded_file(
                $_FILES['foto']['tmp_name'],
                '../public/uploads/studio/' . $foto
            );
        }

        $data = [

            'id' => $_POST['id_studio'],
            'nama' => $_POST['nama_studio'],
            'harga' => $_POST['harga_per_10_menit'],
            'deskripsi' => $_POST['deskripsi'],
            'kapasitas' => $_POST['kapasitas'],
            'status' => $_POST['status'],
            'foto' => $foto

        ];

        $studioModel->updateStudio($data);

        header('Location: ' . BASEURL . '/studio');
    }

    public function delete($id)
    {
        AuthMiddleware::admin();

        $studioModel = $this->model('StudioModel');

        $studio = $studioModel->getStudioById($id);

        if (
            !empty($studio['foto']) &&
            file_exists('../public/uploads/studio/' . $studio['foto'])
        ) {
            unlink('../public/uploads/studio/' . $studio['foto']);
        }

        $studioModel->deleteStudio($id);

        header('Location: ' . BASEURL . '/studio');
        exit;
    }
}