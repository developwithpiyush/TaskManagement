<x-app-layout>
    <x-slot name="header">
            <div>
                <p class="workspace-eyebrow">Tasks</p>
                <h2 class="workspace-title">
            Create Task
                </h2>
            </div>
    </x-slot>

    <div class="workspace-content">
        <div class="workspace-card workspace-form-card">

                <form
                    method="POST"
                    action="{{ route('admin.tasks.store') }}"
                    class="space-y-6">
                    @csrf

                    <div>
                        <label class="block font-medium text-sm text-gray-700">
                            Project
                        </label>

                        <select
                            name="project_id"
                            class="mt-1 w-full rounded-lg border-gray-300"
                            required>
                            <option value="">Select Project</option>

                            @foreach($projects as $project)
                            <option
                                value="{{ $project->id }}"
                                @selected(old('project_id')==$project->id)
                                >
                                {{ $project->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('project_id')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">
                            Assign Employee
                        </label>

                        <select
                            name="assigned_to"
                            class="mt-1 w-full rounded-lg border-gray-300"
                            required>
                            <option value="">Select Employee</option>

                            @foreach($employees as $employee)
                            <option
                                value="{{ $employee->id }}"
                                @selected(old('assigned_to')==$employee->id)
                                >
                                {{ $employee->name }}
                                ({{ $employee->email }})
                            </option>
                            @endforeach
                        </select>

                        @error('assigned_to')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">
                            Task Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="mt-1 w-full rounded-lg border-gray-300"
                            required />

                        @error('title')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="mt-1 w-full rounded-lg border-gray-300">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                Priority
                            </label>

                            <select
                                name="priority"
                                class="mt-1 w-full rounded-lg border-gray-300">
                                @foreach(['low', 'medium', 'high'] as $priority)
                                <option
                                    value="{{ $priority }}"
                                    @selected(old('priority', 'medium' )===$priority)>
                                    {{ ucfirst($priority) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                Status
                            </label>

                            <select
                                name="status"
                                class="mt-1 w-full rounded-lg border-gray-300">
                                @foreach([
                                'pending',
                                'in_progress',
                                'completed',
                                'cancelled'
                                ] as $status)
                                <option
                                    value="{{ $status }}"
                                    @selected(old('status', 'pending' )===$status)>
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                Due Date
                            </label>

                            <input
                                type="date"
                                name="due_date"
                                value="{{ old('due_date') }}"
                                class="mt-1 w-full rounded-lg border-gray-300" />
                        </div>

                    </div>

                    <div class="flex justify-end gap-3">

                        <a
                            href="{{ route('admin.tasks.index') }}"
                            class="workspace-button-secondary">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="workspace-button-primary">
                            Create Task
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>