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
            $table->string('specialty_code')->unique();
            $table->string('specialty');
            $table->boolean('disabled');
            $table->integer('added_by')->unsigned();
            $table->timestamps();
            $table->foreign('added_by')->references('id')->on('users');
        });
        DB::table('event_specialty')->insert([
            [
                'specialty_code'    => 'CC',
                'specialty'         => 'Clinical Chemistry',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'HM',
                'specialty'         => 'Haematology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'MM',
                'specialty'         => 'Microbiology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'RAD',
                'specialty'         => 'Radiology',
                'disabled'          => 0,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'BT',
                'specialty'         => 'Blood Transfusion',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'HI',
                'specialty'         => 'Histopathology',
                'disabled'          => 0,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'CY',
                'specialty'         => 'Cytology',
                'disabled'          => 0,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'NG',
                'specialty'         => 'Non-Gynae Cytology',
                'disabled'          => 0,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'IM',
                'specialty'         => 'Immunology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'MED',
                'specialty'         => 'Medicine',
                'disabled'          => 0,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'SUR',
                'specialty'         => 'Surgery',
                'disabled'          => 0,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'CAN',
                'specialty'         => 'Cancer Care',
                'disabled'          => 0,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'VV',
                'specialty'         => 'Virology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'CAR',
                'specialty'         => 'Cardiothoracic',
                'disabled'          => 0,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'PO',
                'specialty'         => 'To Be Deleted',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'HCHC',
                'specialty'         => 'To Be Deleted',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty_code'    => 'CSS',
                'specialty'         => 'To Be Deleted',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ]
        ]);
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
