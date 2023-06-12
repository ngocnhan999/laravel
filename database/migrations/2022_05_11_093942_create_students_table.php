<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('display_name', 120);
            $table->text('description')->nullable();
            $table->tinyInteger('gender', false)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('dob')->nullable();
            $table->string('phone', 25)->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->string('email_verify_token', 120)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('student_information', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->default(DB::raw('(UUID())'))->index();
            $table->integer('year', false);
            $table->tinyInteger('region', false);
            $table->string('first_name', 120);
            $table->string('last_name', 120);
            $table->string('display_name', 120);
            $table->string('phone', 25)->nullable();
            $table->unsignedBigInteger('province_id', false)->nullable();
            $table->tinyInteger('gender', false, true)->nullable();
            $table->date('dob')->nullable();
            $table->json('personal_info')->nullable()->comment('Thông tin cá nhân');
            $table->json('academic_info')->nullable();
            $table->json('experience_info')->nullable();
            $table->json('finance_info')->nullable();
            $table->json('family_members')->nullable();
            $table->json('essays')->nullable();
            $table->json('photos')->nullable();
            $table->json('recommendation_letter')->nullable();
            $table->json('confirmation')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->unsignedBigInteger('student_id', false)->unsigned()->references('id')->on('students')->index();
            $table->timestamps();
        });

        Schema::create('student_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('student_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action', 120);
            $table->text('user_agent')->nullable();
            $table->string('reference_url', 255)->nullable();
            $table->string('reference_name', 255)->nullable();
            $table->string('ip_address', 39)->nullable();
            $table->integer('student_id')->unsigned()->references('id')->on('students')->index();
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
        Schema::dropIfExists('students');
        Schema::dropIfExists('student_password_resets');
        Schema::dropIfExists('student_activity_logs');
        Schema::dropIfExists('student_information');
    }
}
