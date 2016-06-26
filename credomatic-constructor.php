<?php

class CredomaticModel
{
    private static $services = [
        '3dsecure' => [
            'endpoint'  => '',
            'data'      => '',
            'parser'    => function($data) {
                return $data;
            }
        ],
        'esocket' => [
            'endpoint'  => '',
            'data'      => '',
            'parser'    => function($data) {
                return $data;
            }
        ],
    ];

    public function __construct($type)
    {
        $this->setUpService($type);
    }

    public function setData()
    {

    }

    public function setUpService($type)
    {
        try {
            $this->setType();
        } catch (Execption $e) {
            $this->error($e->getMessage());
        }
    }

    private function setType($type)
    {
        if ($this->isValidType($type)) {
            $this->type = $type;
        } else {
            throw new Execption('Is not a valid service type');
        }
    }

    private function isValidType($type)
    {
        return in_array($type, self::$services);
    }

    private function makeRequest()
    {
    }

    private function error($message)
    {
        return RestResponse::sendError($message);
    }

}
