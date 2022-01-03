<?php

use Silber\Bouncer\Database\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class m03_Roles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Capsule::schema()->hasTable('abilities')) {
            Capsule::schema()->create(Models::table('abilities'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('title')->nullable();
                $table->bigInteger('entity_id')->unsigned()->nullable();
                $table->string('entity_type')->nullable();
                $table->boolean('only_owned')->default(false);
                $table->json('options')->nullable();
                $table->integer('scope')->nullable()->index();
                $table->timestamps();
            });

            echo ' -- The abilities table was created successfully -- ';
        } else {
            echo ' -- The abilities table already exists -- ';
        }

        if (!Capsule::schema()->hasTable('roles')) {
            Capsule::schema()->create(Models::table('roles'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('title')->nullable();
                $table->integer('level')->unsigned()->nullable();
                $table->integer('scope')->nullable()->index();
                $table->timestamps();

                $table->unique(
                    ['name', 'scope'],
                    'roles_name_unique'
                );
            });
            echo ' -- The roles table was created successfully -- ';
        } else {
            echo ' -- The roles table already exists -- ';
        }

        if (!Capsule::schema()->hasTable('assigned_roles')) {
            Capsule::schema()->create(Models::table('assigned_roles'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('role_id')->unsigned()->index();
                $table->bigInteger('entity_id')->unsigned();
                $table->string('entity_type');
                $table->bigInteger('restricted_to_id')->unsigned()->nullable();
                $table->string('restricted_to_type')->nullable();
                $table->integer('scope')->nullable()->index();

                $table->index(
                    ['entity_id', 'entity_type', 'scope'],
                    'assigned_roles_entity_index'
                );

                $table->foreign('role_id')
                    ->references('id')->on(Models::table('roles'))
                    ->onUpdate('cascade')->onDelete('cascade');
            });
            echo ' -- The assigned_roles table was created successfully -- ';
        } else {
            echo ' -- The assigned_roles table already exists -- ';
        }

        if (!Capsule::schema()->hasTable('permissions')) {
            Capsule::schema()->create(Models::table('permissions'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('ability_id')->unsigned()->index();
                $table->bigInteger('entity_id')->unsigned()->nullable();
                $table->string('entity_type')->nullable();
                $table->boolean('forbidden')->default(false);
                $table->integer('scope')->nullable()->index();

                $table->index(
                    ['entity_id', 'entity_type', 'scope'],
                    'permissions_entity_index'
                );

                $table->foreign('ability_id')
                    ->references('id')->on(Models::table('abilities'))
                    ->onUpdate('cascade')->onDelete('cascade');
            });
            echo ' -- The permissions table was created successfully -- ';
        } else {
            echo ' -- The permissions table already exists -- ';
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->drop(Models::table('permissions'));
        echo ' -- The permissions table was successfully removed -- \n';
        Capsule::schema()->drop(Models::table('assigned_roles'));
        echo ' -- The assigned_roles table was successfully removed -- \n';
        Capsule::schema()->drop(Models::table('roles'));
        echo ' -- The roles table was successfully removed -- \n';
        Capsule::schema()->drop(Models::table('abilities'));
        echo ' -- The abilities table was successfully removed -- \n';
    }
}
