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
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('image')->nullable()->after('bio');
            $table->string('phone')->nullable()->after('image');
            $table->text('address')->nullable()->after('phone');
            $table->text('education')->nullable()->after('address');
            $table->string('hospital_clinic_name')->nullable()->after('education');
            $table->string('working_hours')->nullable()->after('hospital_clinic_name');
            $table->string('languages')->nullable()->after('working_hours');
            $table->text('certifications')->nullable()->after('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn([
                'image',
                'phone',
                'address',
                'education',
                'hospital_clinic_name',
                'working_hours',
                'languages',
                'certifications',
            ]);
        });
    }
};
