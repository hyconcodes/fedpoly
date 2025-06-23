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
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->after('matric_no')->nullable();
            $table->string('phone')->after('gender')->nullable();
            $table->string('address')->after('phone')->nullable();
            $table->string('year_of_entry')->after('address')->nullable();
            $table->foreignId('school_id')->after('id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('program_id')->after('school_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->after('program_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('avatar')->after('password')->nullable();
            $table->date('dob')->after('avatar')->nullable();
            $table->string('father_name')->after('dob')->nullable();
            $table->string('father_occupation')->after('father_name')->nullable();
            $table->string('mother_name')->after('father_occupation')->nullable();
            $table->string('mother_occupation')->after('mother_name')->nullable();
            $table->string('father_phone')->after('mother_occupation')->nullable();
            $table->string('mother_phone')->after('father_phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('year_of_entry');
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
            $table->dropForeign(['program_id']);
            $table->dropColumn('program_id');
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
            $table->dropColumn('avatar');
            $table->dropColumn('dob');
            $table->dropColumn('father_name');
            $table->dropColumn('father_occupation');
            $table->dropColumn('mother_name');
            $table->dropColumn('mother_occupation');
            $table->dropColumn('father_phone');
            $table->dropColumn('mother_phone');
        });
    }
};
