<?php

namespace PatientTimeLine;

use Exception;
use Illuminate\Support\Facades\DB;

class Events
{
    /**
     * @param $id
     * @return bool
     */
    public function getAllEventsWithCodes($id)
    {
        // SELECT data from db
//        $events = DB::table('SBCDS_CLINICAL_EVENT')
//            ->leftJoin('SBCDS_EVENT_CODES', function($join) {
//                $join->on('SBCDS_EVENT_CODES.REQUEST_CODE', '=', 'SBCDS_CLINICAL_EVENT.EVENT_CONTEXT')
//                    ->on('SBCDS_EVENT_CODES.REQUEST_TYPE', '=', 'SBCDS_CLINICAL_EVENT.SPECIALTY');
//            })
//            ->where('BCI_ID', $id)
//            ->orderBy('EVENT_DATE', 'asc')
//            ->get();

        $events = DB::table('SBCDS_CLINICAL_EVENT')
            ->where('BCI_ID', $id)
            ->orderBy('EVENT_DATE', 'asc')
            ->get();

        return ($events) ?: false;
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function prepareEventDataForTemplate($id)
    {
        // Patient data
        $patientData = array();
        $counter = 0;

        if (!$this->getAllEventsWithCodes($id))
        {
            throw new Exception('No events found');
        }

        foreach ($this->getAllEventsWithCodes($id) as $event)
        {
            $clinicalEvent = new EventSpecialtyCode();

            $content = ($event->EVENT_DETAIL != '') ? $event->EVENT_DETAIL : 'Unknown';

            if ($clinicalEvent->checkEventIsNotExcluded($event->CLINICAL_SPECIALTY))
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
                        'hour' => $timeArray[0] + 1,
                        'minute' => $timeArray[1],
                        'second' => 0
//                        'second' => $timeArray[2]
                    ),
//                    'group' => $clinicalEvent->getEventNameByCode($event->SPECIALTY),
                    'group' => $event->CLINICAL_SPECIALTY,
                    'cssClass' => $event->CLINICAL_SPECIALTY,
                    'type' => 'box',
                    'id' => $event->UNIQUE_ID
                );

                $counter ++;
            }
        }

        return $patientData;
    }
}
