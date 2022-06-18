<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Room extends ResourceController
{
    protected $modelName = 'App\Models\Room';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }
}
