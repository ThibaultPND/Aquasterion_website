<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        $content = '../app/views/' . $view . '.php';
        if (!file_exists($content)) {
            $content = '../app/views/error/notFound.php';

        }
        extract($data);

        include '../app/views/layouts/layout.php';
    }

    private function view_exist($view_file){
        if (file_exists($view_file)) {
            return true;
        }
        return false;
    }
}