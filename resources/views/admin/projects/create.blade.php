<x-app-layout>
    <x-slot name="header">
            <div>
                <p class="workspace-eyebrow">Projects</p>
                <h2 class="workspace-title">
            Create Project
                </h2>
            </div>
    </x-slot>

    <div class="workspace-content">
        <div class="workspace-card workspace-form-card">

                <form
                    method="POST"
                    action="{{ route('admin.projects.store') }}"
                    class="space-y-6">
                    @csrf

                    <div>
                        <label class="block font-medium text-sm text-gray-700">
                            Project Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="mt-1 block w-full rounded-lg border-gray-300"
                            required />

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
                            class="mt-1 block w-full rounded-lg border-gray-300">{{ old('description') }}</textarea>

                        @error('description')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">
                            Status
                        </label>

                        <select
                            name="status"
                            class="mt-1 block w-full rounded-lg border-gray-300">
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="archived">Archived</option>
                        </select>

                        @error('status')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                Start Date
                            </label>

                            <input
                                type="date"
                                name="start_date"
                                value="{{ old('start_date') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                End Date
                            </label>

                            <input
                                type="date"
                                name="end_date"
                                value="{{ old('end_date') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300" />
                        </div>

                    </div>

                    <div class="flex justify-end gap-3">

                        <a
                            href="{{ route('admin.projects.index') }}"
                            class="workspace-button-secondary">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="workspace-button-primary">
                            Create Project
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>