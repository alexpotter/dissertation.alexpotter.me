<?php

namespace PatientTimeLine;

use Exception;

class Patient
{
    protected $id;
    protected $events;

    /**
     * Patient constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->events = new Events();
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getPatientEvents()
    {
        try {
            return $this->events->prepareEventDataForTemplate($this->id);
        }
        catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
