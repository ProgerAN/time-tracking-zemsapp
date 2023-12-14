<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

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
        Project::query()->find($this->deleteId)->delete();
        $this->confirmingDelete = false;
    }


    #[On('projects-table-update')]
    public function render()
    {
        return view('project.livewire.table', [
            'projects' => Project::search($this->search)->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
