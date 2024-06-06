<?php
class HistoryController extends Controller
{
    public function measures()
    {
        $model = $this->model('History');
        $data['history'] = $model->getMeasures();

        $this->view('history/measures',$data);
    }
    public function modification()
    {
        $model = $this->model('History');
        $data['history'] = $model->getUserAction();
        
        $this->view('history/modification',$data);
    }
}