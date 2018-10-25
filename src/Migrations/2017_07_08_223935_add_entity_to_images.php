<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEntityToImages extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table(config('cms.db-prefix', '').'images', function (Blueprint $table) {
            $table->integer('entity_id')->nullable();
            $table->string('entity_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Dropping these columns seems to break tests
    }
}
