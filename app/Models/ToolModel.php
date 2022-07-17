<?php

namespace App\Models;

use CodeIgniter\Model;

class ToolModel extends Model
{
    protected $table            = 'tools';
    protected $allowedFields    = ['room_id', 'tool_name', 'tool_slug', 'tool_description', 'tool_quantity', 'image', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function rooms()
    {
        return $this->select('tools.*, rooms.room_name')->join('rooms', 'tools.room_id=rooms.id', 'left');
    }
}
