<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="workspace-eyebrow">Workspace</p>
                <h2 class="workspace-title">
                Projects
                </h2>
            </div>

            <a
                href="{{ route('admin.projects.create') }}"
                class="workspace-button-primary"
            >
                New Project
            </a>
        </div>
    </x-slot>

    <div class="workspace-content">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="workspace-card overflow-hidden">

                <table class="workspace-table min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                Name
                            </th>

                            <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                Status
                            </th>

                            <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                Tasks
                            </th>

                            <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                Start Date
                            </th>

                            <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                End Date
                            </th>

                            <th class="px-6 py-3 text-right text-xs uppercase text-gray-500">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($projects as $project)
                            <tr>
                                <td class="px-6 py-4 font-medium">
                                    {{ $project->name }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="workspace-badge workspace-badge-blue">{{ ucfirst($project->status) }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $project->tasks_count }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $project->start_date?->format('d M Y') ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $project->end_date?->format('d M Y') ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a
                                        href="{{ route('admin.projects.edit', $project) }}"
                                        class="workspace-link mr-4"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.projects.destroy', $project) }}"
                                        class="inline"
                                        onsubmit="return confirm('Delete this project? All related tasks will also be deleted.')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="font-semibold text-rose-600 hover:text-rose-700"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="6"
                                    class="px-6 py-8 text-center text-gray-500"
                                >
                                    No projects found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-6">
                    {{ $projects->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>