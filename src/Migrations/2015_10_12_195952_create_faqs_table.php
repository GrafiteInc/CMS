<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFAQSTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('faqs')) {
            Schema::create('faqs', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('question');
                $table->text('answer');
                $table->boolean('is_published')->default(0);
                $table->timestamps();
            });
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faqs');
    }

}
