<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project : : ') . $project->name }}
        </h2>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

                    <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-10 lg:px-6">
                        <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 sm:grid-cols-3 dark:text-white">
                            <div class="flex flex-col items-center justify-center">
                                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $project->tasks()->count() }}
                                    pcs
                                </dt>
                                <dd class="font-light text-gray-500 dark:text-gray-400">Total tasks</dd>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $project->tasks()->where('status', 'completed')->count()  }}
                                    pcs
                                </dt>
                                <dd class="font-light text-gray-500 dark:text-gray-400">Tasks completed</dd>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $totalHours }} hr</dt>
                                <dd class="font-light text-gray-500 dark:text-gray-400">Time spent at work</dd>
                            </div>
                        </dl>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

                    <div class="relative overflow-x-auto sm:rounded-lg ">
                        <div
                            class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                            <div>
                                <h5 class="mr-3 font-semibold dark:text-white">Tasks list</h5>
                                <p class="text-gray-500 dark:text-gray-400">Manage existing tasks or create new
                                    ones.</p>
                            </div>

                            @livewire('task.add', ['project_id' => $project->id])
                        </div>

                        @livewire('task.table', ['project_id' => $project->id])
                    </div>

                </div>

            </div>
        </div>
    </div>


</x-app-layout>
