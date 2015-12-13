<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

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
        // SELECT data from db
        $events = DB::table('SBCDS_CLINICAL_EVENT')->where('BCI_ID', $id)->orderBy('EVENT_DATE', 'asc')->get();

        if(!$events)
        {
            return view('frontend/patient/patientNotFound');
        }

        // Patient data
        $patientData = array();
        $counter = 0;

        foreach ($events as $event)
        {
            $content = DB::table('SBCDS_EVENT_CODES')->where('REQUEST_CODE', $event->EVENT_TYPE)->where('REQUEST_TYPE', $event->SPECIALTY)->get();
            $content = ($content) ? $content[0]->DISPLAY_NAME : 'Unknown';

            $date = explode(' ', $event->EVENT_DATE)[0];
            $dateArray = explode('-', $date);

            $patientData[$counter] = array(
                'content' => $content,
                'start' => array(
                    'year' => $dateArray[0],
                    'month' => $dateArray[1],
                    'day' => $dateArray[2]
                ),
                'group' => $event->SPECIALTY,
                'type' => 'box'
            );

            $counter ++;
        }

        // This will be used to return patient data
        // The id here will be inserted into the template to post to the above function
        // That will then be rendered onto the patients page
        return view('frontend/patient/record', array(
            'patientId' => $id,
            'patientData' => $patientData,
            'patientEvents' => $events
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
