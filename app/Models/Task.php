<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'priority',
        'is_completed',
        'is_paid',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_users');
    }

    // Define the relationship to the creator of the task
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
