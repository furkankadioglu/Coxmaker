<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coxtable_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('status')->default(1);
            $table->string('key');
            $table->timestamps();
        });

        Schema::create('coxtable_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tableId')->unsigned();
            $table->string('name');
            $table->timestamps();

          $table->foreign('tableId')->references('id')->on('coxtable_tables')
            ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('coxtable_persons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tableId')->unsigned();
            $table->string('name');
            $table->string('pkey');
            $table->string('email');
            $table->timestamps();

          $table->foreign('tableId')->references('id')->on('coxtable_tables')
            ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('coxtable_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tableId')->unsigned();
            $table->integer('jobId')->unsigned();
            $table->integer('personId')->unsigned();
            $table->integer('point');

            $table->timestamps();

          $table->foreign('tableId')->references('id')->on('coxtable_tables')
            ->onUpdate('cascade')->onDelete('cascade');

          $table->foreign('personId')->references('id')->on('coxtable_persons')
          ->onUpdate('cascade')->onDelete('cascade');

          $table->foreign('jobId')->references('id')->on('coxtable_jobs')
            ->onUpdate('cascade')->onDelete('cascade');


        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coxtable_tables');
        Schema::drop('coxtable_jobs');
        Schema::drop('coxtable_persons');
    }
}
