<?php

namespace PatientTimeLine;

use DB;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class EventSpecialtyCodea extends Model
{
    protected $table = 'event_specialty';

    /**
     * @param $code
     * @return bool
     */
    public function checkEventIsNotExcluded($code)
    {
        if (DB::table('event_specialty')->where('specialty_code', '=', $code)->where('disabled', '=', 1)->get())
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * @param $eventCode
     * @return mixed
     */
    public function getEventNameByCode($eventCode)
    {
        $eventCodeRow = DB::table('event_specialty')->where('specialty_code', '=', $eventCode)->get();
        return ($eventCodeRow) ? $eventCodeRow[0]->specialty : $eventCode;
    }

    /**
     * @return array
     */
    public function updateEventStatus()
    {
        $this->disabled = ($this->disabled == 1) ? 0 : 1;
        $this->save();
        return array(
            'status' => 200,
            'responseBody' => array(
                'response' => 'success',
                'id' => $this->id,
                'code' => $this->specialty_code,
                'specialty' => $this->specialty,
                'enabledOrDisabled' => ($this->disabled != 1) ? 'Enabled' : 'Disabled',
                'url' => url('admin/timeline/specialty/update'),
                'token' => csrf_token()
            )
        );
    }
}
