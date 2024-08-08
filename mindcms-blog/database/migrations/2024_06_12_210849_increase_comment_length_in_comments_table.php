<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IncreaseCommentLengthInCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 /*       Schema::table('comments', function (Blueprint $table) {
//            $table->string('comment', 500)->change();
            $table->longText('comment')->change();
        });*/


        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('comment');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->longText('comment');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
/*        Schema::table('comments', function (Blueprint $table) {
//            $table->string('comment', 255)->change();
            $table->string('comment', 500)->change();
        });*/


        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('comment');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->string('comment', 500);
        });
    }
}
