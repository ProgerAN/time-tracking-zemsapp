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



    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >
        <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Project name
            </th>
            <th scope="col" class="px-6 py-3">
                Project owner
            </th>
            <th scope="col" class="px-6 py-3">
                Joined
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>

        <tbody wire:loading.remove>
        @forelse($projects as $project)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $project->name }}
                </th>
                <th scope=""
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $project->user->name }}
                </th>
                <th scope=""
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $project->created_at }}
                </th>
                <td class="px-6 py-4">
                    <x-button wire:navigate href="{{route('project-show', $project->id)}}">
                        {{ __('Open project / tasks') }}
                    </x-button>
                    <x-danger-button wire:click="confirmDelete({{$project->id}})" wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-danger-button>
                </td>
            </tr>
        @empty
            <tr class="bg-white">
                <td colspan="4" class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap text-center">
                    No products found.
                </td>
            </tr>
        @endforelse
        </tbody>

    </table>

    <div wire:loading.flex class="flex items-center justify-center w-full mt-2">
        <div role="status">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="mt-2">
        {{ $projects->links() }}
    </div>

    <x-dialog-modal wire:model.live="confirmingDelete">
        <x-slot name="title">
            {{ __('Delete a project') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Do you really wanna delete the project?') }}
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
