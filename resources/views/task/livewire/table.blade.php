<div>

    <div class="relative bg-white dark:bg-gray-800 sm:rounded-lg">
        <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
            <div class="w-full">
                <form class="flex items-center">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                 viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search"
                               type="text"
                               id="search"
                               class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Search" required="">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-flow-row-dense gap-8 mb-6 lg:mb-16 md:grid-cols-2 " wire:loading.remove>
        @forelse($tasks as $task)
            <div class="py-6 w-full relative bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <div class="flex flex-col items-center pb-10">
                    <div class="flex">

                    @switch($task->status)
                            @case('open')
                                <x-secondary-button class="mr-2" wire:click="taskStart({{$task->id}})">
                                    {{ __('Start execution') }}
                                </x-secondary-button>
                                @break

                            @case('in_progress')
                                <x-button class="mr-2" wire:click="taskEnd({{$task->id}})">
                                    {{ __('Task accomplished') }}
                                </x-button>
                                @break

                            @case('completed')
                                <x-secondary-button disabled class="mr-2">
                                    {{ __('Start execution') }}
                                </x-secondary-button>
                                @break
                        @endswitch

                        <x-danger-button wire:click="confirmDelete({{$task->id}})" wire:loading.attr="disabled">
                            {{ __('Delete task') }}
                        </x-danger-button>
                    </div>

                    @switch($task->status)
                        @case('open')
                            <span
                                class="mt-5 inline-flex items-center bg-indigo-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-indigo-900 dark:text-indigo-300">
                                 <span class="w-2 h-2 me-1 bg-indigo-500 rounded-full"></span> Available
                            </span>
                            @break

                        @case('in_progress')
                            <span
                                class="mt-5 inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                 <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span> In progress
                            </span>
                            @break

                        @case('completed')
                            <span
                                class="mt-5 inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                 <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span> Completed
                            </span>
                            @break
                    @endswitch

                    <h2 class="mt-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><small>project> </small>{{ $task->project->name }}</h2>
                    <h3 class="row mt-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">task description</h3>
                    <svg class="w-[12px] h-[12px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"/>
                    </svg>
                    <span class="text-center mt-1 p-4 text-sm text-gray-500 dark:text-gray-400">
                        {{ $task->description }}
                    </span>
                </div>
            </div>
        @empty
            <div
                class="py-6 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center">
                    <h4 class="text-1xl tracking-tight text-gray-900 dark:text-white">Tasks not found</h4>
                </div>
            </div>
            <div
                class="py-6 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center">
                    <h4 class="text-1xl tracking-tight text-gray-900 dark:text-white">Tasks not found</h4>
                </div>
            </div>
        @endforelse
    </div>

    <div wire:loading.flex class="grid grid-flow-row-dense gap-8 mb-6 lg:mb-16 md:grid-cols-2 ">
        <div
            class="py-6 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col items-center">
                <div role="status">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                         viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor"/>
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-2">
        {{ $tasks->links() }}
    </div>

    <x-dialog-modal wire:model.live="confirmingDelete">
        <x-slot name="title">
            {{ __('Delete a task') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Do you really wanna delete the task?') }}
        </x-slot>

        <x-slot name="footer">

            <x-secondary-button wire:click="$toggle('confirmingDelete')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteProject" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

</div>
