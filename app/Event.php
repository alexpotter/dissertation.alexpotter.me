<?php

namespace Patienttimeline;

use DB;
use Mockery\CountValidator\Exception;

class Event
{
    public function _construct()
    {

    }

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

    public function getEventNameByCode($eventCode)
    {
        $eventCodeRow = DB::table('event_specialty')->where('specialty_code', '=', $eventCode)->get();
        return ($eventCodeRow) ? $eventCodeRow[0]->specialty : $eventCode;
    }

    public function updateEventStatus($input)
    {
        try {
            $event = DB::table('event_specialty')->where('id', '=', $input)->get();
            if (isset($event[0]))
            {
                ($event[0]->disabled == 1) ? DB::table('event_specialty')->where('id', $input)->update(['disabled' => 0]) : DB::table('event_specialty')->where('id', $input)->update(['disabled' => 1]);
                return array(
                    'status' => 200,
                    'responseBody' => array(
                        'response' => 'success',
                        'id' => $input,
                        'code' => $event[0]->specialty_code,
                        'specialty' => $event[0]->specialty,
                        'enabledOrDisabled' => ($event[0]->disabled == 1) ? 'Enabled' : 'Disabled',
                        'url' => url('admin/timeline/specialty/update'),
                        'token' => csrf_token()
                    )
                );
            }
            else
            {
                return array(
                    'status' => 400,
                    'responseBody' => array(
                        'response' => 'fail',
                        'id' => $input,
                        'error' => 'Specialty not found'
                    )
                );
            }
        }
        catch (Exception $e) {
            return array(
                'status' => 400,
                'responseBody' => array(
                    'response' => 'fail',
                    'id' => $input,
                    'error' => $e->getMessage()
                )
            );
        }
    }
}
