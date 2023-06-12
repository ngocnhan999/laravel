<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('students', 'facebook_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('facebook_id')->nullable();
            });
        }
        if (!Schema::hasColumn('students', 'google_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('google_id')->nullable();
            });
        }
        if (!Schema::hasColumn('students', 'active')) {
            Schema::table('students', function (Blueprint $table) {

                $table->boolean('active')->default(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
            $table->dropColumn('facebook_id');
            $table->dropColumn('google_id');
            $table->dropColumn('active');
        });
    }
}
