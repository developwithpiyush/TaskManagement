<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();

            $table->foreignId('assigned_to')->constrained('users')->cascadeOnDelete();

            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            $table->string('title');

            $table->text('description')->nullable();

            $table->enum('priority', ['low', 'medium','high'])->default('medium');

            $table->enum('status', ['pending', 'in_progress', 'completed','cancelled'])->default('pending');

            $table->date('due_date')->nullable();

            $table->timestamps();

            $table->index(['assigned_to', 'status']);

            $table->index(['project_id', 'status',]);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
