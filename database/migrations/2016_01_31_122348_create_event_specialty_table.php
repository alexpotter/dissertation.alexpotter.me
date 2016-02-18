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
        DB::table('event_specialty')->insert([
            [
                'specialty'         => 'Radiology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'CT',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Nuclear Medicine',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Gynae Cytology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Histopathology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Biochemistry',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Haematology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Microbiology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'MRI',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Ultrasound',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Mammography',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Cancer Care',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Ophthalmology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Virology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Point of Care Testing',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Medicine & Elderly Care',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Surgery',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Trauma and Orthopaedics',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Obstetrics, Midwifery & Gynaecology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Blood transfusion',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Non-Gynae Cytology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Southern Health NHS Foundation Trust',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Obstetrics',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'Immunology',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'specialty'         => 'eQuest Requesting',
                'disabled'          => 1,
                'added_by'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
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
