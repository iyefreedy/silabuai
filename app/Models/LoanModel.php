<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'loans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['room_id', 'start_time', 'end_time', 'status', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function findAll(int $limit = 0, int $offset = 0)
    {
        $builder = $this->builder();
        if ($limit > 0) {
            $builder->limit($limit);
        }
        if ($offset > 0) {
            $builder->offset($offset);
        }
        return $builder
            ->select('loans.*, loans.start_time AS start, loans.end_time AS end, rooms.room_name AS title')
            ->join('rooms', 'loans.room_id=rooms.id', 'left')
            ->get()
            ->getResult();
    }
}
