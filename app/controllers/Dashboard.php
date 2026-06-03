<?php

class Dashboard extends Controller
{
    public function index()
    {
        AuthMiddleware::check();

        if ($_SESSION['role'] == 'admin') {

            $data['title'] = 'Dashboard Admin';

            $this->view(
                'dashboard/admin',
                $data
            );

        } else {

            $data['title'] = 'Dashboard Customer';

            $this->view(
                'dashboard/customer',
                $data
            );
        }
    }
}