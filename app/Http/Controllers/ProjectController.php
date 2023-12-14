<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        return view('project.index');
    }

    public function show(Project $project)
    {
        $totalHours = $project->timeEntries->sum(function ($timeEntry) {
            $startTime = Carbon::parse($timeEntry->start_at);
            $endTime = $timeEntry->end_at ? Carbon::parse($timeEntry->end_at) : null;
            if ($startTime && $endTime) {
                return $startTime->diffInHours($endTime);
            }
            return 0;
        });

        return view('project.show', [
            'project' => $project,
            'totalHours' => $totalHours
        ]);
    }

}
