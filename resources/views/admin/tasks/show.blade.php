<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="workspace-eyebrow">Tasks</p>
                <h2 class="workspace-title">
                Task Details
                </h2>
            </div>

            <a
                href="{{ route('admin.tasks.edit', $task) }}"
                class="workspace-button-primary"
            >
                Edit Task
            </a>
        </div>
    </x-slot>

    <div class="workspace-content">
        <div class="workspace-card workspace-form-card max-w-4xl">

                <h1 class="text-2xl font-bold">
                    {{ $task->title }}
                </h1>

                <p class="mt-4 text-gray-600">
                    {{ $task->description ?: 'No description provided.' }}
                </p>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm text-gray-500">
                            Project
                        </p>

                        <p class="font-medium">
                            {{ $task->project->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Assigned To
                        </p>

                        <p class="font-medium">
                            {{ $task->assignee->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Priority
                        </p>

                        <p class="font-medium">
                            <span class="workspace-badge workspace-badge-amber">{{ ucfirst($task->priority) }}</span>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Status
                        </p>

                        <p class="font-medium">
                            <span class="workspace-badge workspace-badge-blue">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Due Date
                        </p>

                        <p class="font-medium">
                            {{ $task->due_date?->format('d M Y') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Created By
                        </p>

                        <p class="font-medium">
                            {{ $task->creator->name }}
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>