<?php

namespace PatientTimeLine;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'SBCDS_CLINICAL_EVENT';

    /**
     * @param $inputs
     * @param $id
     * @return array
     */
    public function getEvent($inputs, $id)
    {
        $queryParams = array();

        foreach ($inputs as $input)
        {
            $queryParams[] = $input['v'];
        }

        $dateTime = explode('T', $queryParams[0]);
        $date = explode('-', $dateTime[0]);
        $timeObject = explode('.', $dateTime[1]);
        $time = explode(':', $timeObject[0]);

        $searchDate = $date[0].'-'.$date[1].'-'.$date[2].' '.$time[0].':'.$time[1].':'.$time[2];

        $return = $this->where('BCI_ID', $id)->where('SPECIALTY', $queryParams[4])->where('EVENT_DATE', $searchDate)->get();

        return array(
            'status' => 400,
            'response' => 'fail',
            'responseBody' => array(
                'data' => $return,
                'error' => 'Not fully functional'
            )
        );
    }
}
