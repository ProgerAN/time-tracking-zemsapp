<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('task.index');
    }

    public function show(Task $task)
    {
        return view('task.show', [
            'task' => $task,
        ]);
    }
}
