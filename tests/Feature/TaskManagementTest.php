<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_cannot_access_employee_routes(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('employee.dashboard'))
            ->assertForbidden();
    }

    public function test_employee_cannot_access_admin_routes(): void
    {
        $employee = User::factory()->create(['role' => 'employee']);

        $this->actingAs($employee)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_employee_cannot_view_another_employees_task(): void
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $otherEmployee = User::factory()->create(['role' => 'employee']);
        $task = $this->createTask($otherEmployee);

        $this->actingAs($employee)
            ->get(route('employee.tasks.show', $task))
            ->assertForbidden();
    }

    public function test_employee_can_update_their_own_task_status(): void
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $task = $this->createTask($employee);

        $this->actingAs($employee)
            ->patchJson(route('employee.tasks.status', $task), [
                'status' => 'completed',
            ])
            ->assertOk()
            ->assertJsonPath('data.status', 'completed');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'completed',
        ]);
    }

    public function test_employee_can_update_their_own_task_status_through_the_api(): void
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $task = $this->createTask($employee);

        $this->actingAs($employee, 'sanctum')
            ->patchJson("/api/v1/tasks/{$task->id}/status", [
                'status' => 'in_progress',
            ])
            ->assertOk()
            ->assertJsonPath('data.status', 'in_progress');
    }

    public function test_employee_cannot_update_another_employees_task_through_the_api(): void
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $otherEmployee = User::factory()->create(['role' => 'employee']);
        $task = $this->createTask($otherEmployee);

        $this->actingAs($employee, 'sanctum')
            ->patchJson("/api/v1/tasks/{$task->id}/status", [
                'status' => 'completed',
            ])
            ->assertForbidden();
    }

    public function test_admin_api_task_list_supports_search_and_priority_filters(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $employee = User::factory()->create(['role' => 'employee']);
        $matchingTask = $this->createTask($employee, [
            'title' => 'High priority API task',
            'priority' => 'high',
        ]);
        $this->createTask($employee, [
            'title' => 'Low priority task',
            'priority' => 'low',
        ]);

        $this->actingAs($admin, 'sanctum')
            ->getJson('/api/v1/tasks?search=High&priority=high')
            ->assertOk()
            ->assertJsonPath('data.0.id', $matchingTask->id)
            ->assertJsonCount(1, 'data');
    }

    private function createTask(User $assignee, array $overrides = []): Task
    {
        $admin = User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);
        $project = Project::create([
            'name' => 'Test Project '.fake()->unique()->word(),
            'description' => 'Project for feature tests.',
            'status' => 'active',
            'created_by' => $admin->id,
        ]);

        return Task::create(array_merge([
            'project_id' => $project->id,
            'assigned_to' => $assignee->id,
            'created_by' => $admin->id,
            'title' => 'Test task',
            'description' => 'Task for feature tests.',
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => now()->addDays(5)->toDateString(),
        ], $overrides));
    }
}
