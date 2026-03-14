<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id', 12)->unique();
            $table->string('full_name');
            $table->string('parent_contact_number');
            $table->string('parent_email');
            $table->date('dob');
            $table->date('date_of_join');
            $table->decimal('weekly_max_hours', 5, 2);
            $table->decimal('daily_max_hours', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
