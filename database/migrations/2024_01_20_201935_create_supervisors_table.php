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
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fname');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('contact_info');
            $table->string('cnic')->unique();
            $table->text('address');
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisors');
    }
};
