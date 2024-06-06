<?php
class PumpController extends Controller
{
    public function add_del()
    {
        $this->view('pump/add_del');
    }
    public function limites()
    {
        $model = $this->model('Pump');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            foreach ($_POST['limits'] as $limiteId => $limitData) {
                if (isset($limitData['action']) && $limitData['action'] === 'delete') {
                    $model->deleteLimit($limiteId);
                } else {
                    $model->updateLimit($limiteId, $limitData['limite_name'], $limitData['data_name'], $limitData['data_type']);
                }
            }
            if (isset($_POST['add_limit'])) {
                $model->addNewLimit();
            }
            
            $model->updateSystem();
        }
        $data['pumpLimits'] = $model->getPumpLimits();
        $this->view('pump/limites', $data);
    }
    public function mode()
    {
        $model = $this->model('Pump');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model->setState($_POST['state']);
            $model->setMode($_POST['mode']);
        }
        $data['current_mode'] = $model->getMode();
        $data['current_state'] = $model->getState();
        $this->view('pump/mode', $data);
    }
}
