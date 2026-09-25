<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Employees
        |--------------------------------------------------------------------------
        */

        $john = User::create([
            'name' => 'John Employee',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);

        $jane = User::create([
            'name' => 'Jane Employee',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Projects
        |--------------------------------------------------------------------------
        */

        $crmProject = Project::create([
            'name' => 'CRM System',
            'description' => 'Customer relationship management system.',
            'status' => 'active',
            'start_date' => now()->subDays(10)->toDateString(),
            'end_date' => now()->addDays(30)->toDateString(),
            'created_by' => $admin->id,
        ]);

        $hrProject = Project::create([
            'name' => 'HR Management System',
            'description' => 'Internal HR management application.',
            'status' => 'active',
            'start_date' => now()->subDays(5)->toDateString(),
            'end_date' => now()->addDays(45)->toDateString(),
            'created_by' => $admin->id,
        ]);

        $ecommerceProject = Project::create([
            'name' => 'E-Commerce Platform',
            'description' => 'Online shopping platform.',
            'status' => 'completed',
            'start_date' => now()->subDays(60)->toDateString(),
            'end_date' => now()->subDays(5)->toDateString(),
            'created_by' => $admin->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Tasks
        |--------------------------------------------------------------------------
        */

        Task::create([
            'project_id' => $crmProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Create customer API',
            'description' => 'Create CRUD APIs for customer management.',
            'priority' => 'high',
            'status' => 'in_progress',
            'due_date' => now()->addDays(5)->toDateString(),
        ]);

        Task::create([
            'project_id' => $crmProject->id,
            'assigned_to' => $jane->id,
            'created_by' => $admin->id,
            'title' => 'Build customer listing',
            'description' => 'Build customer listing with search and pagination.',
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => now()->addDays(8)->toDateString(),
        ]);

        Task::create([
            'project_id' => $hrProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Employee management module',
            'description' => 'Implement employee CRUD functionality.',
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => now()->addDays(12)->toDateString(),
        ]);

        Task::create([
            'project_id' => $hrProject->id,
            'assigned_to' => $jane->id,
            'created_by' => $admin->id,
            'title' => 'HR dashboard',
            'description' => 'Create HR dashboard statistics.',
            'priority' => 'medium',
            'status' => 'completed',
            'due_date' => now()->subDays(2)->toDateString(),
        ]);

        Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);
        Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);Task::create([
            'project_id' => $ecommerceProject->id,
            'assigned_to' => $john->id,
            'created_by' => $admin->id,
            'title' => 'Payment integration',
            'description' => 'Integrate payment gateway.',
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(10)->toDateString(),
        ]);
    }
}