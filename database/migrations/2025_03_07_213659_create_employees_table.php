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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained();
            // $table->foreignId('department_id')->nullable()->constrained();
            $table->string('employee_number')->unique();
            $table->date('birth_date');
            $table->date('hire_date');
            $table->enum('contract_type', ['CDI', 'CDD', 'Stage', 'Freelance']);
            $table->date('contract_start_date');
            $table->date('contract_end_date')->nullable();
            $table->decimal('salary', 10, 2);
            $table->string('position');
            $table->json('additional_info')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};