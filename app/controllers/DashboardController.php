<?php

class DashboardController extends Controller
{
    public function index()
    {
        if (!isLoggedIn()) {
            redirect('auth/login');
        }

        $this->view('dashboard/index');
    }
}
