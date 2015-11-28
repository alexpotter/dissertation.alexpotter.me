<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Index will need to be changed to patient name for look up.
        return view('frontend/index');
    }

    public function getRecords(Request $request)
    {
        $patientData = array(
            'events' => array(
                array(
                    'start_date' => array(
                        'year'      => '1980',
                        'month'     => '01',
                        'day'       => '21',
                        'hour'      => '10',
                        'minute'    => '20',
                    ),
                    'text' => array(
                        'headline'  => '<i class=\'fa fa-square green\'></i> Birth',
                        'text'      => 'Patient was born in DGH. <br>Notes here <a href=\'#\' target=\'_blank\'>Foo</a>'
                    ),
                    'unique_id' => '22',
                    'group'     => 'Miscellaneous'
                ),
                array(
                    'start_date' => array(
                        'year'      => '2010',
                        'month'     => '01',
                        'day'       => '21',
                        'hour'      => '10',
                        'minute'    => '20',
                    ),
                    'text' => array(
                        'headline'  => '<i class=\'fa fa-square green\'></i> Birth',
                        'text'      => 'Patient was born in DGH. <br>Notes here <a href=\'#\' target=\'_blank\'>Foo</a>'
                    ),
                    'unique_id' => '23',
                    'group'     => 'Foo'
                )
            )
        );
        return response(json_encode($patientData), 200, array('application/json'));
    }

    public function patient($id)
    {
        // This will be used to return patient data
        // The id here will be inserted into the template to post to the above function
        // That will then be rendered onto the patients page
        return view('frontend/patient/record', array(
            'patientId' => $id
        ));
    }

    public function searchPatient(Request $request)
    {
        // If many patients return many as JSON
        // If one patient return redirect
        // Else return 400
        return response(json_encode(array(
            'url' => url('patient/'.$request->input('patientName'))
        )), 200, array('application/json'));
    }
}
