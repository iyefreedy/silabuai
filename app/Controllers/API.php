<?php

namespace App\Controllers;

use App\Models\LoanModel;
use CodeIgniter\RESTful\ResourceController;

class API extends ResourceController
{
    public function index()
    {
        $loanModel = new LoanModel();
        return $this->respond($loanModel->findAll());
    }
}
