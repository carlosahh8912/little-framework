<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class m02_Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Capsule::schema()->hasTable('posts')) {
            Capsule::schema()->create('posts', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });

            echo ' -- Create posts table -- ';
        }else{
            echo ' -- Table posts already exist -- ';
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('posts');
        echo ' -- Successfull drop users posts -- ';
    }
}
