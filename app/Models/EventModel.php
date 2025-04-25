<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $allowedFields = ['title', 'description', 'location', 'date'];
    protected $primaryKey = 'id';
    
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;

    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'description' => 'permit_empty|max_length[1000]',
        'location' => 'required|min_length[3]|max_length[255]',
        'date' => 'required|valid_date'
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'Title is required',
            'min_length' => 'Title must be at least 3 characters long',
            'max_length' => 'Title cannot exceed 255 characters'
        ],
        'description' => [
            'max_length' => 'Description cannot exceed 1000 characters'
        ],
        'location' => [
            'required' => 'Location is required',
            'min_length' => 'Location must be at least 3 characters long',
            'max_length' => 'Location cannot exceed 255 characters'
        ],
        'date' => [
            'required' => 'Date is required',
            'valid_date' => 'Date must be a valid date format'
        ]
    ];
}