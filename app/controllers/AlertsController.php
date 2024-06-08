<?php
require_once '../app/models/Alerts.php';
class AlertsController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Alerts();
    }
    public function limites()
    {
        if (!isLoggedIn()) {
            redirect('auth/login?message=Bien essayé');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            foreach ($_POST['limits'] as $limiteId => $limitData) {
                $this->model->updateAlert($limiteId, $limitData['limite_name'], $limitData['data_name'], $limitData['data_type']);
            }

        }
        $data['alertsLimits'] = $this->model->getAlertsLimits();
        $this->view('alerts/limites', $data);
    }

    public function messages()
    {
        if (!isLoggedIn()) {
            redirect('auth/login?message=Bien essayé');
        }
        $this->view('alerts/messages');
    }
}
