<?php

namespace Patienttimeline;

use DB;

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
}
