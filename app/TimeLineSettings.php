<?php

namespace PatientTimeLine;

use DB;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class TimeLineSettings extends Model
{
    protected $table = 'time_line_settings';

    /**
     * @param $code
     * @return array
     */
    public function updateTimeLineMaxCluster($code)
    {
        try {
            $this->setting = $code;
            $this->save();
            return array(
                'status' => 200,
                'responseBody' => array(
                    'response' => 'success'
                )
            );
        }
        catch (Exception $e) {
            return array(
                'status' => 400,
                'responseBody' => array(
                    'response' => 'fail',
                    'error' => $e->getMessage()
                )
            );
        }
    }
}
