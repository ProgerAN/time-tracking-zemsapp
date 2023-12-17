<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Statistic extends Component
{

    public Project $project;

    public function totalHours()
    {
        return $this->project->timeEntries->sum(function ($timeEntry) {
            $startTime = Carbon::parse($timeEntry->start_at);
            $endTime = $timeEntry->end_at ? Carbon::parse($timeEntry->end_at) : null;
            if ($startTime && $endTime) {
                return $startTime->diffInHours($endTime);
            }
            return 0;
        });
    }
    #[On('project-statistic-update')]
    public function render()
    {
        return view('project.livewire.statistic', [
            'total_task' => $this->project->tasks()->count(),
            'total_task_completed' => $this->project->tasks()->where('status', 'completed')->count(),
            'total_hours_spent' => $this->totalHours(),
        ]);
    }
}
