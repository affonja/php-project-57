<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'status_id', 'created_by_id', 'assigned_to_id'
    ];
    protected $appends = ['author_name', 'status_name', 'executor_name'];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getAuthorNameAttribute()
    {
        return $this->author->name;
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function getStatusNameAttribute()
    {
        return $this->status->name;
    }

    public function executor()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function getExecutorNameAttribute()
    {
        return $this->executor->name;
    }

    protected static function booted()
    {
        static::addGlobalScope('withRelations', function ($query) {
            $query->with(['author', 'status', 'executor']);
        });
    }
}
