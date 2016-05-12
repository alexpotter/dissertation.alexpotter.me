<?php

namespace PatientTimeLine;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'SBCDS_PATIENT_MASTER';
    public $timestamps = false;
    protected $events;

    public function getPatientEvents()
    {
        $events = new Events();

        try {
            return $events->prepareEventDataForTemplate($this->BCI_ID);
        }
        catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
