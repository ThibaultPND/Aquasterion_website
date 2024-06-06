<?php
class AlertsController extends Controller
{
    public function mode()
    {
        $this->view('alerts/mode');
    }
    public function modify()
    {
        $model = $this->model('Alert');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            foreach ($_POST['limits'] as $limiteId => $limitData) {
                if (isset($limitData['action']) && $limitData['action'] === 'delete') {
                    $model->deleteAlert($limiteId);
                } else {
                    $model->updateAlert($limiteId, $limitData['limite_name'], $limitData['data_name'], $limitData['data_type']);
                }
            }
            if (isset($_POST['add_limit'])) {
                $model->addNewAlert();
            }
             
        }
        $data['alertsLimits'] = $model->getAlertsLimits();
        $this->view('alerts/modify', $data);
    }

    public function add_del()
    {
        $this->view('alerts/add_del');
    }
}
