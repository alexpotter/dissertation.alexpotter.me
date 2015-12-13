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

    public function patient($id)
    {

        $patientData = array(
            array(
                "content" => "Radiology",
                "start" => array(
                    "year" => 1982,
                    "month" => 02,
                    'day' => 1
                ),
                "group" => "Radiology",
                "type" => "box"
            ),
            array(
                "content" => "Radiology",
                "start" => array(
                    "year" => 1982,
                    "month" => 02,
                    'day' => 1
                ),
                "group" => "Radiology",
                "type" => "box"
            )
        );

        // This will be used to return patient data
        // The id here will be inserted into the template to post to the above function
        // That will then be rendered onto the patients page
        return view('frontend/patient/record', array(
            'patientId' => $id,
            'patientData' => $patientData
        ));
    }

    public function searchPatient(Request $request)
    {
        // If many patients return many as JSON
        // If one patient return redirect
        // Else return 400
        if ($request->input('patientName') == 'bad') {
            return response(json_encode(array(
                'status' => 'fail',
                'msg' => 'No patients exists'
            )), 400, array('application/json'));
        }
        else {
            return response(json_encode(array(
                'url' => url('patient/'.$request->input('patientName')),
                'status' => 'success'
            )), 200, array('application/json'));
        }
    }
}
