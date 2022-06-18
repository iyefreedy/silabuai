<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Loan extends ResourceController
{
    protected $modelName = 'App\Models\LoanModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }
}
