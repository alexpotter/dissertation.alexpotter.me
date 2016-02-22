<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateEventSpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_specialty', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('specialty_code')->unique();
            $table->string('specialty')->unique();
            $table->boolean('disabled');
            $table->integer('added_by')->unsigned();
            $table->timestamps();
            $table->foreign('added_by')->references('id')->on('users');
        });

        $events = DB::table('SBCDS_CLINICAL_EVENT')->groupBy('CLINICAL_SPECIALTY')->get();

        foreach($events as $event)
        {
            DB::table('event_specialty')->insert([
                'specialty'         => $event->CLINICAL_SPECIALTY,
                'disabled'          => 0,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_specialty');
    }
}
