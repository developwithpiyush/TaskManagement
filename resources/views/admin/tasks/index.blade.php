<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="workspace-eyebrow">Workspace</p>
                <h2 class="workspace-title">
                Tasks
                </h2>
            </div>

            <a
                href="{{ route('admin.tasks.create') }}"
                class="workspace-button-primary">
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

            <div class="workspace-card workspace-filter mb-6">

                <form
                    method="GET"
                    action="{{ route('admin.tasks.index') }}"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search tasks..."
                        class="rounded-lg border-gray-300" />

                    <select
                        name="project_id"
                        class="rounded-lg border-gray-300">
                        <option value="">All Projects</option>

                        @foreach($projects as $project)
                        <option
                            value="{{ $project->id }}"
                            @selected(request('project_id')==$project->id)
                            >
                            {{ $project->name }}
                        </option>
                        @endforeach
                    </select>

                    <select
                        name="assigned_to"
                        class="rounded-lg border-gray-300">
                        <option value="">All Employees</option>

                        @foreach($employees as $employee)
                        <option
                            value="{{ $employee->id }}"
                            @selected(request('assigned_to')==$employee->id)
                            >
                            {{ $employee->name }}
                        </option>
                        @endforeach
                    </select>

                    <select
                        name="status"
                        class="rounded-lg border-gray-300">
                        <option value="">All Statuses</option>

                        @foreach([
                        'pending',
                        'in_progress',
                        'completed',
                        'cancelled'
                        ] as $status)
                        <option
                            value="{{ $status }}"
                            @selected(request('status')===$status)>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                        @endforeach
                    </select>

                    <select
                        name="priority"
                        class="rounded-lg border-gray-300">
                        <option value="">All Priorities</option>

                        @foreach(['low', 'medium', 'high'] as $priority)
                        <option
                            value="{{ $priority }}"
                            @selected(request('priority')===$priority)>
                            {{ ucfirst($priority) }}
                        </option>
                        @endforeach
                    </select>

                    <div class="md:col-span-2 lg:col-span-5 flex gap-3">

                        <button
                            type="submit"
                            class="workspace-button-primary">
                            Filter
                        </button>

                        <a
                            href="{{ route('admin.tasks.index') }}"
                            class="workspace-button-secondary">
                            Reset
                        </a>

                    </div>

                </form>

            </div>

            <div class="workspace-card overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="workspace-table min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                    Task
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                    Project
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                    Assigned To
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                    Priority
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                    Due Date
                                </th>

                                <th class="px-6 py-3 text-right text-xs uppercase text-gray-500">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @forelse($tasks as $task)

                            <tr>

                                <td class="px-6 py-4">
                                    <a
                                        href="{{ route('admin.tasks.show', $task) }}"
                                        class="workspace-link">
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
                                    <span class="workspace-badge workspace-badge-amber">{{ ucfirst($task->priority) }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="workspace-badge workspace-badge-blue">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $task->due_date?->format('d M Y') ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-right whitespace-nowrap">

                                    <a
                                        href="{{ route('admin.tasks.edit', $task) }}"
                                        class="workspace-link mr-3">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.tasks.destroy', $task) }}"
                                        method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Delete this task?')">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="font-semibold text-rose-600 hover:text-rose-700">
                                            Delete
                                        </button>
                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td
                                    colspan="7"
                                    class="px-6 py-8 text-center text-gray-500">
                                    No tasks found.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>

                <div class="p-6">
                    {{ $tasks->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>