
<div>

    <div class="mt-5">
        <x-button wire:click="confirmAddProject" wire:loading.attr="disabled">
            {{ __('Add project') }}
        </x-button>
    </div>


    <x-dialog-modal wire:model.live="confirmingAddProject">
        <x-slot name="title">
            {{ __('Add a new project') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Specify the name of the future project.') }}

            <div class="mt-4" x-data="{}" x-on:confirming-add-project.window="setTimeout(() => $refs.name.focus(), 250)">
                <x-input type="text" class="mt-1 block w-3/4"
                         autocomplete="current-name"
                         placeholder="{{ __('Project name') }}"
                         x-ref="name"
                         wire:model="name"
                         wire:keydown.enter="addProject" />

                <x-input-error for="name" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">

            <x-secondary-button wire:click="$toggle('confirmingAddProject')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="addProject" wire:loading.attr="disabled">
                {{ __('Add project') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
