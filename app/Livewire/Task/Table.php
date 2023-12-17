<?php

namespace App\Livewire\Task;

use App\Models\Project;
use App\Models\Task;
use App\Models\TimeEntry;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $timeEntry;
    public $project_id;
    public $showAll = false;

    public $confirmingDelete = false;

    public $search = '';
    public $deleteId = '';

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteProject()
    {
        Task::query()->findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;

        $this->dispatch('project-statistic-update');
    }

    public function taskStart($id)
    {

        TimeEntry::query()->create([
            'task_id' => $id,
            'start_at' => now()->format('Y-m-d H:i:s'),
        ]);

        Task::query()->findOrFail($id)->update([
            'status' => 'in_progress'
        ]);

        $this->dispatch('project-statistic-update');
    }

    public function taskEnd($id)
    {
        TimeEntry::query()->where('task_id', $id)->update([
            'end_at' => now()->format('Y-m-d H:i:s'),
        ]);

        Task::query()->findOrFail($id)->update([
            'status' => 'completed'
        ]);

        $this->dispatch('project-statistic-update');
    }

    #[On('task-table-update')]
    public function render()
    {

        if ($this->showAll){
            $tasks = Task::query()->search($this->search)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $tasks = Task::query()->where('project_id', $this->project_id)->search($this->search)->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('task.livewire.table', [
            'tasks' => $tasks
        ]);
    }
}
