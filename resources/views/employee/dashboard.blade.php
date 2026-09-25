<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="workspace-eyebrow">Personal workspace</p>
                <h2 class="workspace-title">
                My Dashboard
                </h2>
            </div>

            <a
                href="{{ route('employee.tasks.index') }}"
                class="workspace-button-primary"
            >
                My Tasks
            </a>
        </div>
    </x-slot>

    <div class="workspace-content">

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4">

                <div class="workspace-card workspace-stat">
                    <p class="workspace-stat-label">
                        Total Tasks
                    </p>

                    <p class="workspace-stat-value">
                        {{ $stats['total'] }}
                    </p>
                </div>

                <div class="workspace-card workspace-stat">
                    <p class="workspace-stat-label">
                        Pending
                    </p>

                    <p class="workspace-stat-value">
                        {{ $stats['pending'] }}
                    </p>
                </div>

                <div class="workspace-card workspace-stat">
                    <p class="workspace-stat-label">
                        In Progress
                    </p>

                    <p class="workspace-stat-value">
                        {{ $stats['in_progress'] }}
                    </p>
                </div>

                <div class="workspace-card workspace-stat">
                    <p class="workspace-stat-label">
                        Completed
                    </p>

                    <p class="workspace-stat-value">
                        {{ $stats['completed'] }}
                    </p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>