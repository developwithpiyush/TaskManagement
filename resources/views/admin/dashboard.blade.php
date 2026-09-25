<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="workspace-eyebrow">Overview</p>
                <h2 class="workspace-title">
                Admin Dashboard
                </h2>
            </div>

            <a
                href="{{ route('admin.tasks.create') }}"
                class="workspace-button-primary"
            >
                Create Task
            </a>
        </div>
    </x-slot>

    <div class="workspace-content">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">

                <div class="workspace-card workspace-stat">
                    <p class="workspace-stat-label">Projects</p>
                    <p class="workspace-stat-value">
                        {{ $stats['projects'] }}
                    </p>
                </div>

                <div class="workspace-card workspace-stat">
                    <p class="workspace-stat-label">Total Tasks</p>
                    <p class="workspace-stat-value">
                        {{ $stats['tasks'] }}
                    </p>
                </div>

                <div class="workspace-card workspace-stat">
                    <p class="workspace-stat-label">Pending</p>
                    <p class="workspace-stat-value">
                        {{ $stats['pending_tasks'] }}
                    </p>
                </div>

                <div class="workspace-card workspace-stat">
                    <p class="workspace-stat-label">In Progress</p>
                    <p class="workspace-stat-value">
                        {{ $stats['in_progress_tasks'] }}
                    </p>
                </div>

                <div class="workspace-card workspace-stat">
                    <p class="workspace-stat-label">Completed</p>
                    <p class="workspace-stat-value">
                        {{ $stats['completed_tasks'] }}
                    </p>
                </div>

                <div class="workspace-card workspace-stat">
                    <p class="workspace-stat-label">Overdue</p>
                    <p class="workspace-stat-value text-rose-600">
                        {{ $stats['overdue_tasks'] }}
                    </p>
                </div>

            </div>

            <div class="workspace-card mt-8 overflow-hidden">

                <div class="workspace-card-header">
                    <h3>
                        Recent Tasks
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="workspace-table min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Task
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Project
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Employee
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Status
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($recentTasks as $task)
                                <tr>
                                    <td class="px-6 py-4">
                                        <a
                                            href="{{ route('admin.tasks.show', $task) }}"
                                            class="workspace-link"
                                        >
                                            {{ $task->title }}
                                        </a>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $task->project->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $task->assignee->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="workspace-badge workspace-badge-blue">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                        No tasks found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>