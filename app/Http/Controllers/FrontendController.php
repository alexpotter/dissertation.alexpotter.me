<?php

namespace Patienttimeline\Http\Controllers;

use Illuminate\Http\Request;
use Patienttimeline\Http\Requests;
use Patienttimeline\Http\Controllers\Controller;

use DB;
use Patienttimeline\Event;

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
        $events = DB::table('SBCDS_CLINICAL_EVENT')
            ->leftJoin('SBCDS_EVENT_CODES', function($join) {
                $join->on('SBCDS_EVENT_CODES.REQUEST_CODE', '=', 'SBCDS_CLINICAL_EVENT.EVENT_CONTEXT')
                    ->on('SBCDS_EVENT_CODES.REQUEST_TYPE', '=', 'SBCDS_CLINICAL_EVENT.SPECIALTY');
            })
            ->where('BCI_ID', $id)
            ->orderBy('EVENT_DATE', 'asc')
            ->get();

        if(!$events)
        {
            return view('frontend/patient/notFound');
        }

        // Patient data
        $patientData = array();
        $counter = 0;

        foreach ($events as $event)
        {
            $clinicalEvent = new Event();

            $content = ($event->DISPLAY_NAME != '') ? $event->DISPLAY_NAME : 'Unknown';

            if ($clinicalEvent->checkEventIsNotExcluded($event->SPECIALTY))
            {
                $dateTime = explode(' ', $event->EVENT_DATE);
                $dateArray = explode('-', $dateTime[0]);
                $timeArray = explode(':', $dateTime[1]);

                $patientData[$counter] = array(
                    'content' => $content,
                    'start' => array(
                        'year' => $dateArray[0],
                        'month' => $dateArray[1],
                        'day' => $dateArray[2],
                        'hour' => $timeArray[0],
                        'minute' => $timeArray[1],
                        'second' => $timeArray[2]
                    ),
                    'group' => $clinicalEvent->getEventNameByCode($event->SPECIALTY),
                    'cssClass' => $event->SPECIALTY,
                    'type' => 'box'
                );

                $counter ++;
            }
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
        $patient = DB::table('SBCDS_CLINICAL_EVENT')->where('BCI_ID', $request->input('patientName'))->orderBy('EVENT_DATE', 'asc')->get();

        if(!$patient)
        {
            return response(json_encode(array(
                'status' => 'fail',
                'msg' => 'No patient found'
            )), 400, array('application/json'));
        }
        else
        {
            return response(json_encode(array(
                'url' => url('patient/'.$request->input('patientName')),
                'status' => 'success'
            )), 200, array('application/json'));
        }
    }
}
