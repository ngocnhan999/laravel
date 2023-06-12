<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Student;

class AddNewColumnReferenceStudentInformationsTable extends Migration
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
            $table->unsignedBigInteger('reference_id', false)->after('uid');
            $table->string('reference_type', 255)->default(addslashes(Student::class))->after('reference_id');
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
