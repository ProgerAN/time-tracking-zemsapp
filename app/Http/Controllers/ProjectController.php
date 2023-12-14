<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        return view('project.index');
    }

    public function show(Project $project)
    {
        return view('project.show', [
            'project' => $project
        ]);
    }

}
