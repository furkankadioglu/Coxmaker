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

       \DB::table('coxtable_tables')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Astrology Project',
                'status' => 1,
                'key' => '642dc1cf3cc6717f44afc13a86196a75704205',
                'created_at' => '2016-09-10 04:36:45',
                'updated_at' => '2016-09-10 04:36:45',
            ),
        ));




        });

        \DB::table('coxtable_persons')->insert(array (
            0 => 
            array (
                'id' => 97,
                'tableId' => 2,
                'name' => 'Furkan',
                'pkey' => '',
                'email' => 'furkan.kadioglu@gmail.com',
                'created_at' => '2016-09-10 04:36:45',
                'updated_at' => '2016-09-10 04:36:45',
            ),
            1 => 
            array (
                'id' => 98,
                'tableId' => 2,
                'name' => 'Fatih',
                'pkey' => '',
                'email' => 'furkan.kadioglu@gmail.com',
                'created_at' => '2016-09-10 04:36:47',
                'updated_at' => '2016-09-10 04:36:47',
            ),
            2 => 
            array (
                'id' => 99,
                'tableId' => 2,
                'name' => 'Ali',
                'pkey' => '',
                'email' => 'furkan.kadioglu@gmail.com',
                'created_at' => '2016-09-10 04:36:50',
                'updated_at' => '2016-09-10 04:36:50',
            ),
            3 => 
            array (
                'id' => 100,
                'tableId' => 2,
                'name' => 'Volkan',
                'pkey' => '',
                'email' => 'furkan.kadioglu@gmail.com',
                'created_at' => '2016-09-10 04:36:52',
                'updated_at' => '2016-09-10 04:36:52',
            ),
        ));

        \DB::table('coxtable_jobs')->insert(array (
            0 => 
            array (
                'id' => 102,
                'tableId' => 2,
                'name' => 'Motor',
                'created_at' => '2016-09-10 04:36:55',
                'updated_at' => '2016-09-10 04:36:55',
            ),
            1 => 
            array (
                'id' => 103,
                'tableId' => 2,
                'name' => 'UI',
                'created_at' => '2016-09-10 04:36:55',
                'updated_at' => '2016-09-10 04:36:55',
            ),
            2 => 
            array (
                'id' => 104,
                'tableId' => 2,
                'name' => 'Tasarım',
                'created_at' => '2016-09-10 04:36:55',
                'updated_at' => '2016-09-10 04:36:55',
            ),
            3 => 
            array (
                'id' => 105,
                'tableId' => 2,
                'name' => 'Application',
                'created_at' => '2016-09-10 04:36:55',
                'updated_at' => '2016-09-10 04:36:55',
            ),
            4 => 
            array (
                'id' => 106,
                'tableId' => 2,
                'name' => 'Fikir',
                'created_at' => '2016-09-10 04:36:55',
                'updated_at' => '2016-09-10 04:36:55',
            ),
            5 => 
            array (
                'id' => 107,
                'tableId' => 2,
                'name' => 'Proje Yönetimi',
                'created_at' => '2016-09-10 04:36:55',
                'updated_at' => '2016-09-10 04:36:55',
            ),
        ));

               \DB::table('coxtable_results')->insert(array (
            0 => 
            array (
                'id' => 49,
                'tableId' => 2,
                'jobId' => 102,
                'personId' => 97,
                'point' => 28,
                'created_at' => '2016-09-10 04:38:39',
                'updated_at' => '2016-09-10 04:38:39',
            ),
            1 => 
            array (
                'id' => 50,
                'tableId' => 2,
                'jobId' => 103,
                'personId' => 97,
                'point' => 13,
                'created_at' => '2016-09-10 04:38:39',
                'updated_at' => '2016-09-10 04:38:39',
            ),
            2 => 
            array (
                'id' => 51,
                'tableId' => 2,
                'jobId' => 104,
                'personId' => 97,
                'point' => 17,
                'created_at' => '2016-09-10 04:38:39',
                'updated_at' => '2016-09-10 04:38:39',
            ),
            3 => 
            array (
                'id' => 52,
                'tableId' => 2,
                'jobId' => 105,
                'personId' => 97,
                'point' => 23,
                'created_at' => '2016-09-10 04:38:39',
                'updated_at' => '2016-09-10 04:38:39',
            ),
            4 => 
            array (
                'id' => 53,
                'tableId' => 2,
                'jobId' => 106,
                'personId' => 97,
                'point' => 14,
                'created_at' => '2016-09-10 04:38:39',
                'updated_at' => '2016-09-10 04:38:39',
            ),
            5 => 
            array (
                'id' => 54,
                'tableId' => 2,
                'jobId' => 107,
                'personId' => 97,
                'point' => 5,
                'created_at' => '2016-09-10 04:38:39',
                'updated_at' => '2016-09-10 04:38:39',
            ),
            6 => 
            array (
                'id' => 55,
                'tableId' => 2,
                'jobId' => 102,
                'personId' => 98,
                'point' => 20,
                'created_at' => '2016-09-10 04:39:42',
                'updated_at' => '2016-09-10 04:39:42',
            ),
            7 => 
            array (
                'id' => 56,
                'tableId' => 2,
                'jobId' => 103,
                'personId' => 98,
                'point' => 17,
                'created_at' => '2016-09-10 04:39:42',
                'updated_at' => '2016-09-10 04:39:42',
            ),
            8 => 
            array (
                'id' => 57,
                'tableId' => 2,
                'jobId' => 104,
                'personId' => 98,
                'point' => 19,
                'created_at' => '2016-09-10 04:39:42',
                'updated_at' => '2016-09-10 04:39:42',
            ),
            9 => 
            array (
                'id' => 58,
                'tableId' => 2,
                'jobId' => 105,
                'personId' => 98,
                'point' => 18,
                'created_at' => '2016-09-10 04:39:42',
                'updated_at' => '2016-09-10 04:39:42',
            ),
            10 => 
            array (
                'id' => 59,
                'tableId' => 2,
                'jobId' => 106,
                'personId' => 98,
                'point' => 16,
                'created_at' => '2016-09-10 04:39:42',
                'updated_at' => '2016-09-10 04:39:42',
            ),
            11 => 
            array (
                'id' => 60,
                'tableId' => 2,
                'jobId' => 107,
                'personId' => 98,
                'point' => 10,
                'created_at' => '2016-09-10 04:39:42',
                'updated_at' => '2016-09-10 04:39:42',
            ),
            12 => 
            array (
                'id' => 61,
                'tableId' => 2,
                'jobId' => 102,
                'personId' => 99,
                'point' => 20,
                'created_at' => '2016-09-10 04:40:27',
                'updated_at' => '2016-09-10 04:40:27',
            ),
            13 => 
            array (
                'id' => 62,
                'tableId' => 2,
                'jobId' => 103,
                'personId' => 99,
                'point' => 15,
                'created_at' => '2016-09-10 04:40:27',
                'updated_at' => '2016-09-10 04:40:27',
            ),
            14 => 
            array (
                'id' => 63,
                'tableId' => 2,
                'jobId' => 104,
                'personId' => 99,
                'point' => 15,
                'created_at' => '2016-09-10 04:40:27',
                'updated_at' => '2016-09-10 04:40:27',
            ),
            15 => 
            array (
                'id' => 64,
                'tableId' => 2,
                'jobId' => 105,
                'personId' => 99,
                'point' => 20,
                'created_at' => '2016-09-10 04:40:27',
                'updated_at' => '2016-09-10 04:40:27',
            ),
            16 => 
            array (
                'id' => 65,
                'tableId' => 2,
                'jobId' => 106,
                'personId' => 99,
                'point' => 20,
                'created_at' => '2016-09-10 04:40:27',
                'updated_at' => '2016-09-10 04:40:27',
            ),
            17 => 
            array (
                'id' => 66,
                'tableId' => 2,
                'jobId' => 107,
                'personId' => 99,
                'point' => 10,
                'created_at' => '2016-09-10 04:40:27',
                'updated_at' => '2016-09-10 04:40:27',
            ),
            18 => 
            array (
                'id' => 67,
                'tableId' => 2,
                'jobId' => 102,
                'personId' => 100,
                'point' => 33,
                'created_at' => '2016-09-10 04:41:17',
                'updated_at' => '2016-09-10 04:41:17',
            ),
            19 => 
            array (
                'id' => 68,
                'tableId' => 2,
                'jobId' => 103,
                'personId' => 100,
                'point' => 19,
                'created_at' => '2016-09-10 04:41:17',
                'updated_at' => '2016-09-10 04:41:17',
            ),
            20 => 
            array (
                'id' => 69,
                'tableId' => 2,
                'jobId' => 104,
                'personId' => 100,
                'point' => 19,
                'created_at' => '2016-09-10 04:41:17',
                'updated_at' => '2016-09-10 04:41:17',
            ),
            21 => 
            array (
                'id' => 70,
                'tableId' => 2,
                'jobId' => 105,
                'personId' => 100,
                'point' => 19,
                'created_at' => '2016-09-10 04:41:17',
                'updated_at' => '2016-09-10 04:41:17',
            ),
            22 => 
            array (
                'id' => 71,
                'tableId' => 2,
                'jobId' => 106,
                'personId' => 100,
                'point' => 5,
                'created_at' => '2016-09-10 04:41:17',
                'updated_at' => '2016-09-10 04:41:17',
            ),
            23 => 
            array (
                'id' => 72,
                'tableId' => 2,
                'jobId' => 107,
                'personId' => 100,
                'point' => 5,
                'created_at' => '2016-09-10 04:41:17',
                'updated_at' => '2016-09-10 04:41:17',
            ),
        ));




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
