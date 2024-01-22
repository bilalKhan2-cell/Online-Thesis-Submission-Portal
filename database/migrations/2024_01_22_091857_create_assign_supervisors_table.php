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
        Schema::create('assign_supervisors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('team_id')->unsigned();
            $table->bigInteger('supervisor_id')->unsigned();
            $table->string('thesis_title');
            $table->text('thesis_description');
            $table->integer('marks')->unsigned();
            $table->tinyInteger('is_edit_allowed')->unsigned();
            $table->tinyInteger('is_marks_edit_allowed')->unsigned();
            $table->tinyInteger('status')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('project_leads');
            $table->foreign('supervisor_id')->references('id')->on('supervisors');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_supervisors');
    }
};
