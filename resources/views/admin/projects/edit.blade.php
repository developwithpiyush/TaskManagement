<x-app-layout>
    <x-slot name="header">
            <div>
                <p class="workspace-eyebrow">Projects</p>
                <h2 class="workspace-title">
            Edit Project
                </h2>
            </div>
    </x-slot>

    <div class="workspace-content">
        <div class="workspace-card workspace-form-card">

                <form
                    method="POST"
                    action="{{ route('admin.projects.update', $project) }}"
                    class="space-y-6"
                >
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-sm text-gray-700">
                            Project Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $project->name) }}"
                            class="mt-1 block w-full rounded-lg border-gray-300"
                            required
                        />

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">
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
                            class="mt-1 block w-full rounded-lg border-gray-300"
                        >{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">
                            Status
                        </label>

                        <select
                            name="status"
                            class="mt-1 block w-full rounded-lg border-gray-300"
                        >
                            @foreach(['active', 'completed', 'archived'] as $status)
                                <option
                                    value="{{ $status }}"
                                    @selected(old('status', $project->status) === $status)
                                >
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                Start Date
                            </label>

                            <input
                                type="date"
                                name="start_date"
                                value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300"
                            />
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                End Date
                            </label>

                            <input
                                type="date"
                                name="end_date"
                                value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300"
                            />
                        </div>

                    </div>

                    <div class="flex justify-end gap-3">

                        <a
                            href="{{ route('admin.projects.index') }}"
                            class="workspace-button-secondary"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="workspace-button-primary"
                        >
                            Update Project
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>