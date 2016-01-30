<?php

namespace Patienttimeline;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    private $eventNames = array(
        'CC'        => 'Clinical Chemistry',
        'HM'        => 'Haematology',
        'MM'        => 'Microbiology',
        'RAD'       => 'Radiology',
        'BT'        => 'Blood Transfusion',
        'HI'        => 'Histopathology',
        'CY'        => 'Cytology',
        'NG'        => 'Non-Gynae Cytology',
        'IM'        => 'Immunology',
        'MED'       => 'Medicine',
        'SUR'       => 'Surgery',
        'CAN'       => 'Cancer Care',
        'VV'        => 'Virology',
        'CAR'       => 'Cardiothoracic',
        'PO'        => 'To Be Deleted',
        'HCHC'      => 'To Be Deleted',
        'CSS'       => 'TO BE Deleted'
    );


    private $exclusions = array(
        'CC',
        'HM',
        'MM',
        'BT',
        'IM',
        'VV',
        'CAR',
        'PO',
        'HCHC',
        'CSS'
    );

    public function _construct()
    {

    }

    public function checkEventIsNotExcluded($code)
    {
        if (in_array($code, $this->exclusions))
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
        return (array_key_exists($eventCode, $this->eventNames)) ? $this->eventNames[$eventCode] : $eventCode;
    }
}
