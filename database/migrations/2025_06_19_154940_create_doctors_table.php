<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('phone_number')->nullable();
            $table->integer('experience')->unsigned();
            $table->text('description')->nullable();
            $table->text('bio')->nullable();
            $table->text('qualifications')->nullable();
            $table->text('experience_details')->nullable();
            $table->text('activism')->nullable();
            $table->text('special_interests')->nullable();
            $table->string('profile_image')->nullable();
            $table->integer('patients_satisfied')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};