<?php

use App\Models\Mentor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMentorIdMentorInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentor_information', function (Blueprint $table) {
            $table->uuid('uid')->default(DB::raw('(UUID())'))->index()->after('id');
            $table->unsignedBigInteger('reference_id', false)->after('uid');
            $table->string('reference_type', 255)->default(addslashes(Mentor::class))->after('reference_id');
            $table->tinyInteger('status')->default(0)->nullable();
            $table->unsignedBigInteger('mentor_id', false)->unsigned()->references('id')->on('mentors')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentor_information', function (Blueprint $table) {
            //
        });
    }
}
