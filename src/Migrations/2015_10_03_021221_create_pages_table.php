<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('pages')) {
            Schema::create('pages', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('title');
                $table->string('url');
                $table->text('entry')->nullable();
                $table->string('seo_description')->nullable();
                $table->string('seo_keywords')->nullable();
                $table->integer('is_published')->default(0);
                $table->integer('template_id')->default(0);
                $table->timestamps();
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
        Schema::drop('pages');
    }

}
