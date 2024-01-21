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
        Schema::create('project_leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fname');
            $table->string('gender');
            $table->string('rollno')->unique();
            $table->string('email')->unique();
            $table->string('contact_info')->nullable();
            $table->string('cnic')->unique();
            $table->string('project_id');
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->text('address');
            $table->tinyInteger('status')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_leads');
    }
};
