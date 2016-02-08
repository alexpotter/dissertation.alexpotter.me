<?php

namespace PatientTimeLine;

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
        $events = DB::table('SBCDS_CLINICAL_EVENT')
            ->leftJoin('SBCDS_EVENT_CODES', function($join) {
                $join->on('SBCDS_EVENT_CODES.REQUEST_CODE', '=', 'SBCDS_CLINICAL_EVENT.EVENT_CONTEXT')
                    ->on('SBCDS_EVENT_CODES.REQUEST_TYPE', '=', 'SBCDS_CLINICAL_EVENT.SPECIALTY');
            })
            ->where('BCI_ID', $id)
            ->orderBy('EVENT_DATE', 'asc')
            ->get();

        return ($events) ?: false;
    }

    /**
     * @param $id
     * @return array
     */
    public function prepareEventDataForTemplate($id)
    {
        // Patient data
        $patientData = array();
        $counter = 0;

        foreach ($this->getAllEventsWithCodes($id) as $event)
        {
            $clinicalEvent = new EventSpecialtyCode();

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
                        'hour' => $timeArray[0] + 1,
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

        return $patientData;
    }
}
