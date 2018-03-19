<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLangToTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table(config('cms.db-prefix', '').'translations', function (Blueprint $table) {
            $table->string('language')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(config('cms.db-prefix', '').'translations', function ($table) {
            $table->dropColumn('language');
        });
    }
}
