<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateRolesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->timestamps();
        });
        //Insert into DB
        /*DB::table('roles')->insert(
            array(
                'role_name' => 'Super Admin'
            ),
        );
        DB::table('roles')->insert(
            array(
                'role_name' => 'Admin'
            ),
        );
        DB::table('roles')->insert(
            array(
                'role_name' => 'Advertiser'
            ),
        );
        DB::table('roles')->insert(
            array(
                'role_name' => 'Publisher'
            ),
        );*/
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
