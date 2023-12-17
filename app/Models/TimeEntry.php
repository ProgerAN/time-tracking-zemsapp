<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class TimeEntry extends Model
{
    use HasFactory;

    protected $fillable = ['start_at', 'end_at', 'task_id'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function diffMinutes(): int
    {
        if (!empty($this->start_at) && !empty($this->end_at)) {
            $start_at=Carbon::parse($this->start_at);
            $end_at=Carbon::parse($this->end_at);

            return $end_at->diffInMinutes($start_at);
        }

        return 0;
    }

    public function inProgress (): TimeEntry
    {
        return $this->whereNotNull('start_at');
    }
    public function completed(): TimeEntry
    {
        return $this->whereNotNull('end_at');
    }
}
