<?php

namespace PatientTimeLine\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PatientTimeLine\Event;
use PatientTimeLine\Events;
use PatientTimeLine\Http\Requests;
use PatientTimeLine\Http\Controllers\Controller;

use PatientTimeLine\EventSpecialtyCode;
use PatientTimeLine\Patient;
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
        $patient = Patient::where('BCI_ID', $id)->first();
        $eventSpecialties = new EventSpecialtyCode();

        try {
            $patientEvents = $patient->getEvents();
        }
        catch (Exception $e) {
            return view('frontend/patient/notFound');
        }

        // This will be used to return patient data
        // The id here will be inserted into the template to post to the above function
        // That will then be rendered onto the patients page
        return view('frontend/patient/timeline', array(
            'patientId' => $id,
            'patientEvents' => $patientEvents,
            'timeLineClusterMaxSettings' => TimeLineSettings::where('setting_code', 'cluster_max')->first(),
            'activeSpecialties' => $eventSpecialties->getEnabledEventSpecialties(),
            'patient' => $patient,
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
        $patientExists = Event::where('BCI_ID', $request->patientId)->orderBy('EVENT_DATE', 'asc')->first();

        if(!$patientExists)
        {
            return response(json_encode(array(
                'status' => 'fail',
                'msg' => 'No patient found'
            )), 400)->header('Content-Type', 'application/json');
        }
        else
        {
            return response(json_encode(array(
                'url' => route('patientTimeLine', $request->patientId),
                'patientId' => $request->patientId,
                'status' => 'success'
            )), 200)->header('Content-Type', 'application/json');
        }
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function getEvent(Request $request)
    {
        $event = new Event();
        $response = $event->getEvent($request->input('id'));

        return response(json_encode($response['responseBody']), $response['status'])
            ->header('Content-Type', 'application/json');
    }

    /**
     * @param Request $request
     * @return $this
     * @throws Exception
     */
    public function redrawTimeLine(Request $request)
    {
        $patient = Patient::where('BCI_ID', $request->patientId)->first();

        return response(json_encode($patient->getEventsByEnabledSpecialtyCodes($request->input('enabledSpecialties'))), 200)
            ->header('Content-Type', 'application/json');
    }
}
