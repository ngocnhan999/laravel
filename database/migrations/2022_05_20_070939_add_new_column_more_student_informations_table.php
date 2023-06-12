<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnMoreStudentInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_information', function (Blueprint $table) {
            //
            $table->longText('personalSharing')->nullable()->after('family_members');
            $table->string('ethnic', 120)->nullable()->after('dob');
            $table->string('address', 255)->after('province_id');
            $table->string('facebook_url')->nullable()->after('photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_information', function (Blueprint $table) {
            //
        });
    }
}
