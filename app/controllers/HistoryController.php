<?php
require_once '../app/models/History.php';
class HistoryController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new History();
    }

    public function measures()
    {
        if (!isLoggedIn()) {
            redirect('auth/login?message=Bien essayé');
        }
        $data['history'] = $this->model->getMeasures();

        $this->view('history/measures', $data);
    }
    public function modification()
    {
        if (!isLoggedIn()) {
            redirect('auth/login?message=Bien essayé');
        }
        $data['history'] = $this->model->getUserAction();

        $this->view('history/modification', $data);
    }
}