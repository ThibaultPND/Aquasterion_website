<?php 
class PoolController extends Controller
{
    public function status() {
        $poolModel = $this->model('Pool');
        $data['DATE'] = $poolModel->getLastMesureDate();
        $data['TEMP'] = $poolModel->getLastValueByName('TEMP');
        $data['ORP'] = $poolModel->getLastValueByName('ORP');
        $data['TURB'] = $poolModel->getLastValueByName('TURB');
        $data['PH'] = $poolModel->getLastValueByName('PH');
 
        $this->view('pool/status', $data);
    }
}
