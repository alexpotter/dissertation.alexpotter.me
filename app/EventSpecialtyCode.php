<?php

namespace PatientTimeLine;

use DB;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class EventSpecialtyCode extends Model
{
    protected $table = 'event_specialty';

    /**
     * @param $specialty
     * @return bool
     */
    public function checkEventIsNotExcluded($specialty)
    {
        if (DB::table('event_specialty')->where('specialty', $specialty)->where('disabled', 1)->get())
        {
            return false;
        }
        else
        {
            return true;
        }
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

    /**
     * @return mixed
     */
    public function getEnabledEventSpecialties()
    {
        return $this->where('disabled', 0)->orderBy('specialty')->get();
    }
}
