<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->string('title')->after('story_id');
        });
    }

    public function down()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }

};
