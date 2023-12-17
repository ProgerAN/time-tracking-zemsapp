
<div>

    <div class="mt-5">
        <x-button wire:click="confirmAddTask" wire:loading.attr="disabled">
            {{ __('Add Task') }}
        </x-button>
    </div>


    <x-dialog-modal wire:model.live="confirmingAddTask">
        <x-slot name="title">
            {{ __('Add a new task') }}
        </x-slot>


        <x-slot name="content">
            @if($showAll)
                {{ __('Specify the project and description of the task.') }}
            @else
                {{ __('Specify the description of the future task.') }}
            @endif

            <div class="mt-4" x-data="{}" x-on:confirming-add-project.window="setTimeout(() => $refs.name.focus(), 250)">

                @if($showAll)
                    <select wire:model="project_id" id="project_id" class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{$project->name}}</option>
                        @endforeach
                    </select>

                    <x-input-error for="project_id" class="mt-2" />
                @endif


                <x-input type="text" class="mt-1 block w-3/4"
                         autocomplete="current-name"
                         placeholder="{{ __('Description task') }}"
                         x-ref="description"
                         wire:model="description"
                         wire:keydown.enter="addTask" />

                <x-input-error for="description" class="mt-2" />

            </div>
        </x-slot>

        <x-slot name="footer">

            <x-secondary-button wire:click="$toggle('confirmingAddTask')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="addTask" wire:loading.attr="disabled">
                {{ __('Add task') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
