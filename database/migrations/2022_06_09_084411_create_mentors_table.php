<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->string('display_name', 120);
            $table->text('description')->nullable();
            $table->tinyInteger('gender', false)->nullable();
            $table->string('region')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone', 25)->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->string('email_verify_token', 120)->nullable();
            $table->rememberToken();
            $table->string('google_id')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
        Schema::create('mentor_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('mentor_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action', 120);
            $table->text('user_agent')->nullable();
            $table->string('reference_url', 255)->nullable();
            $table->string('reference_name', 255)->nullable();
            $table->string('ip_address', 39)->nullable();
            $table->integer('mentor_id')->unsigned()->references('id')->on('mentors')->index();
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
        Schema::dropIfExists('mentors');
        Schema::dropIfExists('mentor_password_resets');
        Schema::dropIfExists('mentor_activity_logs');
    }
}
