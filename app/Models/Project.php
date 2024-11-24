<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    CONST PROJECT_STATUS = [
        'pending' => 'Pending',
        'in_progress' => 'In Progress' ,
        'completed' => 'Complete'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class);
    }

    public function employees()
    {
        return $this->belongsToMany(User::class, 'project_users', 'project_id', 'user_id')
                ->withPivot('assigned_by')
                ->withTimestamps();
    }
}
