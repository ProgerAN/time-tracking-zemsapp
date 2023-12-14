<?php

namespace App\Livewire\Task;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Add extends Component
{
    public $confirmingAddTask = false;

    #[Validate('required')]
    public $description = '';


    public function confirmAddTask()
    {
        $this->resetErrorBag();

        $this->description = '';

        $this->dispatch('confirming-add-task');

        $this->confirmingAddTask = true;
    }


    public function addTask(Request $request, Task $task)
    {
        $this->resetErrorBag();
        $this->validate();

        $task::query()->create([
            'description' => $this->name,
            'user_id' => Auth::user()->id,
        ]);

        $this->confirmingAddTask = false;
        $this->dispatch('task-table-update');
    }


    public function render()
    {
        return view('task.livewire.add');
    }
}
