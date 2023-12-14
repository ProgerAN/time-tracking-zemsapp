<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Add extends Component
{

    public $confirmingAddProject = false;

    #[Validate('required')]
    public $name = '';


    public function confirmAddProject()
    {
        $this->resetErrorBag();

        $this->name = '';

        $this->dispatch('confirming-add-project');

        $this->confirmingAddProject = true;
    }


    public function addProject(Request $request, Project $project)
    {
        $this->resetErrorBag();
        $this->validate();

        $project::query()->create([
            'name' => $this->name,
            'user_id' => Auth::user()->id,
        ]);

        $this->confirmingAddProject = false;
        $this->dispatch('projects-table-update');
    }


    public function render()
    {
        return view('project.livewire.add');
    }
}
