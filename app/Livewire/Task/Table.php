<?php

namespace App\Livewire\Task;

use App\Models\Project;
use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $project_id;

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
        Task::query()->find($this->deleteId)->delete();
        $this->confirmingDelete = false;
    }


    #[On('projects-table-update')]
    public function render()
    {
        return view('task.livewire.table', [
            'tasks' => Task::query()->where('project_id', $this->project_id)->search($this->search)->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
