<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Scope;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'status', 'project_id'];

    public $enumStatus = ['open', 'in_progress', 'completed'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function timeEntries(): HasMany
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('description', 'like', "%{$value}%");
    }
}
