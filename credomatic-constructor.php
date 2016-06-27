<?php

class CredomaticModel
{
    private static $services = [
        '3dsecure' => [
            'endpoint'  => '',
            'sandboxEndpoint'   => '',
            'data'      => '',
            'parser'    => function($data) {
                return $data;
            }
        ],
        'esocket' => [
            'endpoint'  => '',
            'sandboxEndpoint'   => '',
            'data'      => '',
            'parser'    => function($data) {
                return $data;
            }
        ],
    ];

    private static $dataStructure = [
        ''  => ''
    ];

    private static $transactionStructure = [
        'id'    => [
            'default'   => 0,
            'original'  => '',
            'type'      => 'int'
            'required'  => true
        ]
    ];

    private static $transactionsMap = [
        'sell',
        'authorize',
        'refund'
    ];

    public function __construct($key, $secret, $type, $options = [], $sandbox = false)
    {
        $this->setUpService($type);
    }

    public function setData()
    {

    }

    public function setUpService($key, $secret, $type = '3dsecure', $options = [])
    {
        try {
            $this->setServiceType($type);
            $this->setConf($key, $secret, $options);
        } catch (Execption $e) {
            $this->error($e->getMessage());
        }
    }

    private function setConf($key, $secret, $options = [])
    {
        $this->key = $key;
        $this->secret = $secret;

        $options = $this->setOptions($options);

    }

    private function isValidData($type, $data)
    {
        $options = $this->$type;

        foreach ($options as $key => $option) {

            $currentItem = $data[$key];
            $errors = [];

            if ($option['required'] && (!isset($currentItem) || empty($currentItem))) {
                $errors[] = "Element is required for transaction: $key";
            }

            if ($option['type'] != gettype($currentItem)) {
                $errors[] = "Element type if wrong: $key ";
            }

            if (!empty($errors)) {
                throw new Exception($errors);
            }

        }
    }

    private function setOptions($options)
    {
        //to do saniziting options object
        $this->options = $options;
    }

    private function createTransactionToken($data)
    {
        return md5("{$this->token}|{$this->key}");
    }

    private function setServiceType($type)
    {
        if ($this->isValidType($type)) {
            $this->type = $type;
        } else {
            throw new Exception('Is not a valid service type');
        }
    }

    private function isValidType($type)
    {
        return in_array($type, self::$services);
    }

    private function makeRequest()
    {
        curl();
        return $request;
    }

    public function parser($data)
    {
        return $services[$this->type]['parser']($data);
    }

    private function error($message)
    {
        return RestResponse::sendError($message);
    }
}
