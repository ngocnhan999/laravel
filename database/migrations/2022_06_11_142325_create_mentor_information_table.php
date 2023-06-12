<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_information', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 120);
            $table->string('last_name', 120);
            $table->string('display_name', 120)->nullable();
            $table->string('email')->unique();
            $table->string('phone', 25)->nullable();
            $table->tinyInteger('gender', false, true)->nullable();
            $table->string('gender_description',255)->nullable();
            $table->date('dob')->nullable();
            $table->string('region',255)->nullable();
            $table->string('address',255)->nullable();
            $table->unsignedBigInteger('province_id', false)->nullable();
            $table->string('majors',255)->nullable();
            $table->string('school_level',255)->nullable();
            $table->string('work_experience',255)->nullable();
            $table->string('work_field',255)->nullable();
            $table->string('company_name',255)->nullable();
            $table->string('position',255)->nullable();
            $table->tinyInteger('member', false)->nullable();
            $table->string('member_time',255)->nullable();
            $table->tinyInteger('experience', false)->nullable();
            $table->string('experience_time',255)->nullable();
            $table->tinyInteger('mentor', false)->nullable();
            $table->string('mentor_relative',255)->nullable();
            $table->tinyInteger('commit_mentor', false)->nullable();
            $table->tinyInteger('year_mentor', false)->nullable();
            $table->string('join_mentor',255)->nullable();
            $table->string('connect_mentor',255)->nullable();
            $table->tinyInteger('student_mentor', false)->nullable();
            $table->string('request_mentor',255)->nullable();
            $table->string('know_program',255)->nullable();
            $table->string('idea',255)->nullable();
            $table->text('introduce')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentor_information');
    }
}
