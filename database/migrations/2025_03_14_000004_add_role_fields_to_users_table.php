<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('unique_id', 12)->nullable()->after('email');
            $table->string('role', 20)->nullable()->after('unique_id'); // super_admin, teacher, student
            $table->unsignedBigInteger('role_id')->nullable()->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['unique_id', 'role', 'role_id']);
        });
    }
};
