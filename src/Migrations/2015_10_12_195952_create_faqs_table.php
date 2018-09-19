<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (in_array('faqs', config('cms.active-core-modules'))) {
            Schema::create(config('cms.db-prefix', '').'faqs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('question');
                $table->text('answer');
                $table->boolean('is_published')->default(0);
                $table->nullableTimestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (in_array('faqs', config('cms.active-core-modules'))) {
            Schema::drop(config('cms.db-prefix', '').'faqs');
        }
    }
}
