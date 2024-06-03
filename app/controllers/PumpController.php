<?php 
class PumpController extends Controller
{
    public function add_del(){
        $this->view('pump/add_del');
    }
    public function limites(){
        $this->view('pump/limites');
    }
    public function mode(){
        $this->view('pump/mode');
    }
}
