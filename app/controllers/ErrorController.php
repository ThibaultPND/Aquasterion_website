<?php 
class ErrorController extends Controller
{
    public function notFound() {
        $this->view('error/notFound');
    }
}
