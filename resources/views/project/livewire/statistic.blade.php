<div>
    <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 sm:grid-cols-3 dark:text-white">
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-3xl md:text-4xl font-extrabold" wire:loading.class="opacity-50">{{ $total_task }}
                pcs
            </dt>
            <dd class="font-light text-gray-500 dark:text-gray-400">Total tasks</dd>
        </div>
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-3xl md:text-4xl font-extrabold" wire:loading.class="opacity-50">{{ $total_task_completed }}
                pcs
            </dt>
            <dd class="font-light text-gray-500 dark:text-gray-400">Tasks completed</dd>
        </div>
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-3xl md:text-4xl font-extrabold" wire:loading.class="opacity-50">{{ $total_hours_spent }} hr</dt>
            <dd class="font-light text-gray-500 dark:text-gray-400">Time spent at work</dd>
        </div>
    </dl>
</div>
