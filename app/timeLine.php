<?php

namespace Patienttimeline;

use DB;
use Mockery\CountValidator\Exception;

class timeLine
{
    public function _construct()
    {

    }

    /**
     * @param $input
     * @param $code
     * @return array
     */
    public function updateTimeLineMaxCluster($input, $code)
    {
        try {
            DB::table('time_line_settings')->where('setting_code', $code)->update(['setting' => $input]);
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
