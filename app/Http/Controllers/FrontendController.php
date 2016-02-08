<?php

namespace PatientTimeLine\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PatientTimeLine\Event;
use PatientTimeLine\Events;
use PatientTimeLine\Http\Requests;
use PatientTimeLine\Http\Controllers\Controller;

use DB;
use PatientTimeLine\EventSpecialtyCode;
use PatientTimeLine\TimeLineSettings;

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

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function patient($id)
    {
        $events = new Events();

        if(!$events->getAllEventsWithCodes($id))
        {
            return view('frontend/patient/notFound');
        }

        // This will be used to return patient data
        // The id here will be inserted into the template to post to the above function
        // That will then be rendered onto the patients page
        return view('frontend/patient/record', array(
            'patientId' => $id,
            'patientData' => $events->prepareEventDataForTemplate($id),
            'patientEvents' => $events->getAllEventsWithCodes($id),
            'timeLineClusterMaxSettings' => TimeLineSettings::where('setting_code', '=', 'cluster_max')->first()
        ));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
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
            $request->session()->put('patientId', $request->input('patientName'));
            return response(json_encode(array(
                'url' => url('patient/'.$request->input('patientName')),
                'status' => 'success'
            )), 200, array('application/json'));
        }
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function getEvent(Request $request)
    {
        $event = new Event();
        $response = $event->getEvent($request->input('data'), $request->session()->get('patientId'));

        return response(json_encode($response['responseBody']), $response['status'])
            ->header('Content-Type', 'application/json');
    }
}
