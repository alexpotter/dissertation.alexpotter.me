<?php

namespace PatientTimeLine;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'SBCDS_PATIENT_MASTER';
    public $timestamps = false;
    protected $events;

    public function getPatientEvents()
    {
        $this->events = Event::where('BCI_ID', $this->BCI_ID)
            ->orderBy('EVENT_DATE', 'asc')
            ->get();

        try {
            $patientData = array();

            foreach ($this->events as $event)
            {
                $clinicalEvent = new EventSpecialtyCode();

                $content = ($event->EVENT_DETAIL != '') ? $event->EVENT_DETAIL : 'Unknown';

                if ($clinicalEvent->checkEventIsNotExcluded($event->CLINICAL_SPECIALTY))
                {
                    $dateTime = explode(' ', $event->EVENT_DATE);
                    $dateArray = explode('-', $dateTime[0]);
                    $timeArray = explode(':', $dateTime[1]);

                    $patientData[] = array(
                        'content' => $content,
                        'start' => array(
                            'year' => $dateArray[0],
                            'month' => $dateArray[1],
                            'day' => $dateArray[2],
                            'hour' => $timeArray[0],
                            'minute' => $timeArray[1],
                            'second' => 0
                        ),
                        'group' => $event->CLINICAL_SPECIALTY,
                        'cssClass' => str_replace(' ', '-', $event->CLINICAL_SPECIALTY),
                        'type' => 'box',
                        'id' => $event->UNIQUE_ID
                    );
                }
            }

            return $patientData;
        }
        catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
