<?php

namespace PatientTimeLine;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'SBCDS_CLINICAL_EVENT';

    /**
     * @param $id
     * @return array
     */
    public function getEvent($id)
    {
        return array(
            'status' => 400,
            'response' => 'fail',
            'responseBody' => array(
                'data' => $this->where('UNIQUE_ID', $id)->first(),
                'error' => 'Not fully functional'
            )
        );
    }
}
