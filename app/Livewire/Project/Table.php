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

    public $editedId = '';
    public $name = '';
    public $deleteId = '';

    public function editName($id)
    {
        $this->name = Project::query()->findOrFail($id)->name;
        $this->editedId = $id;
    }
    public function saveName($id)
    {

        Project::query()->findOrFail($id)->update([
            'name' => $this->name,
        ]);

        $this->editedId = null;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteProject()
    {
        Project::query()->findOrFail($this->deleteId)->delete();
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
