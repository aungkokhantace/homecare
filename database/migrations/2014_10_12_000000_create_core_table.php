<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('core_settings', function(Blueprint $table) {
            $table->string('code');
            $table->string('type');
            $table->string('value');
            $table->string('description');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary(array('code','type'));

        });

        Schema::create('core_syncs_tables', function(Blueprint $table) {
            $table->increments('id');
            $table->string('table_name');
            $table->integer('version');
            $table->integer('active')->default(1);

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('core_roles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

        });


        Schema::create('core_users', function(Blueprint $table) {
            $table->string('id');
            $table->string('name', 255);
//            $table->string('staff_id')->unique();
            $table->string('password', 64);
            $table->string('phone', 45);
            $table->string('email')->unique();
            $table->decimal('fees',10,2)->nullable();
//            $table->string('description')->nullable();
//            $table->string('display_name')->nullable();
            $table->string('display_image')->nullable()->default('');
            $table->text('mobile_image')->nullable();
            $table->unsignedInteger('role_id');
//            $table->text('about_me');
            $table->text('address');

//            $table->string('country',2)->default('');
//            $table->string('language',10)->default('en');
            $table->integer('active')->default(1);;
            $table->dateTime('last_activity')->nullable();
            $table->rememberToken();

            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');

            $table->foreign('role_id')
                ->references('id')->on('core_roles')
                ->onDelete('restrict');
        });

        Schema::create('core_permissions',function(Blueprint $table){
            $table->increments('id');
            $table->string('module')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('position')->nullable();
            $table->string('url')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('core_permission_role',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');
            $table->tinyInteger('position')->default(1);

            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(array('role_id','permission_id'));
            $table->foreign('role_id')
                ->references('id')->on('core_roles')
                ->onDelete('restrict');
            $table->foreign('permission_id')
                ->references('id')->on('core_permissions')
                ->onDelete('restrict');
        });

        Schema::create('core_configs',function(Blueprint $table){
            $table->string('code',50);
            $table->string('type',50);
            $table->string('value',255)->nullable();
            $table->string('description',255)->nullable();

            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->primary(array('code','type'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core_permission_role');
        Schema::drop('core_permissions');
        Schema::drop('core_users');
        Schema::drop('core_roles');
        Schema::drop('core_configs');
        Schema::drop('core_syncs_tables');
        Schema::drop('core_settings');
    }
}
