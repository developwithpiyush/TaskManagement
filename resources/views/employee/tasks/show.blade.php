<x-app-layout>
    <x-slot name="header">
            <div>
                <p class="workspace-eyebrow">My Tasks</p>
                <h2 class="workspace-title">
            Task Details
                </h2>
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
                            Priority
                        </p>

                        <p class="font-medium">
                            <span class="workspace-badge workspace-badge-amber">{{ ucfirst($task->priority) }}</span>
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

                <div class="mt-8 border-t pt-6">

                    <label
                        for="task-status"
                        class="block font-medium text-gray-700 mb-2"
                    >
                        Update Status
                    </label>

                    <select
                        id="task-status"
                        data-task-id="{{ $task->id }}"
                        class="w-full md:w-1/2 rounded-lg border-gray-300"
                    >

                        @foreach([
                            'pending',
                            'in_progress',
                            'completed',
                            'cancelled'
                        ] as $status)

                            <option
                                value="{{ $status }}"
                                @selected($task->status === $status)
                            >
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>

                        @endforeach

                    </select>

                    <p
                        id="status-message"
                        class="mt-3 text-sm hidden"
                    ></p>

                </div>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const select = document.getElementById('task-status');
            const message = document.getElementById('status-message');

            select.addEventListener('change', async function () {

                const taskId = this.dataset.taskId;
                const status = this.value;

                select.disabled = true;

                message.classList.add('hidden');

                try {

                    const response = await fetch(
                        `/employee/tasks/${taskId}/status`,
                        {
                            method: 'PATCH',

                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN':
                                    document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).getAttribute('content'),
                            },

                            body: JSON.stringify({
                                status: status
                            })
                        }
                    );

                    const responseText = await response.text();
                    let data = {};

                    try {
                        data = responseText ? JSON.parse(responseText) : {};
                    } catch {
                        data = {};
                    }

                    if (!response.ok) {
                        throw new Error(
                            data.message ||
                            `Unable to update task status (${response.status}).`
                        );
                    }

                    message.textContent = data.message;

                    message.classList.remove(
                        'hidden',
                        'text-red-600'
                    );

                    message.classList.add(
                        'text-green-600'
                    );

                } catch (error) {

                    message.textContent = error.message;

                    message.classList.remove(
                        'hidden',
                        'text-green-600'
                    );

                    message.classList.add(
                        'text-red-600'
                    );

                } finally {

                    select.disabled = false;
                }
            });
        });
    </script>
</x-app-layout>