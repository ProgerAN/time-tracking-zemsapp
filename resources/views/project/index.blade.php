<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

                    <div class="relative overflow-x-auto sm:rounded-lg ">
                        <div
                            class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                            <div>
                                <h5 class="mr-3 font-semibold dark:text-white">Projects list</h5>
                                <p class="text-gray-500 dark:text-gray-400">Manage existing projects or create new
                                    ones.</p>
                            </div>

                            @livewire('project.add')
                        </div>

                        @livewire('project.table')
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
