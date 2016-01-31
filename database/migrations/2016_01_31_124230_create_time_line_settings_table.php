<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateTimeLineSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_line_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('setting_code')->unique();
            $table->string('description');
            $table->integer('added_by')->unsigned();
            $table->timestamps();
            $table->foreign('added_by')->references('id')->on('users');
        });
        DB::table('time_line_settings')->insert([
            'setting_code'  => 'cluster_max',
            'description'   => 'Maximum number of items that may stack within one row',
            'added_by'      => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('time_line_settings');
    }
}
