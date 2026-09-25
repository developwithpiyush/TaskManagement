<x-app-layout>
    <x-slot name="header">
            <div>
                <p class="workspace-eyebrow">Personal workspace</p>
                <h2 class="workspace-title">
            My Tasks
                </h2>
            </div>
    </x-slot>

    <div class="workspace-content">

            <div class="workspace-card workspace-filter mb-6">

                <form
                    method="GET"
                    action="{{ route('employee.tasks.index') }}"
                    class="flex flex-col md:flex-row gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search my tasks..."class="flex-1 rounded-lg border-gray-300" />

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
                                @selected(request('priority') === $priority)>
                                {{ ucfirst($priority) }}
                            </option>
                        @endforeach
                    </select>

                    <button
                        type="submit"
                        class="workspace-button-primary">
                        Filter
                    </button>

                    <a
                        href="{{ route('employee.tasks.index') }}"
                        class="workspace-button-secondary">
                        Reset
                    </a>

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
                                    Priority
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                    Due Date
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @forelse($tasks as $task)

                            <tr>

                                <td class="px-6 py-4">
                                    <a
                                        href="{{ route('employee.tasks.show', $task) }}"
                                        class="workspace-link">
                                        {{ $task->title }}
                                    </a>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $task->project->name }}
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

                            </tr>

                            @empty

                            <tr>
                                <td
                                    colspan="5"
                                    class="px-6 py-8 text-center text-gray-500">
                                    No tasks assigned to you.
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