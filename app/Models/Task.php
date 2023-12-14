<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'status', 'project_id'];

    public $enumStatus = ['open', 'in_progress', 'completed'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('description', 'like', "%{$value}%");
    }
}
