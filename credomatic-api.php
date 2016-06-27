<?php

class CredomaticAPI
{
    public function __construct($service)
    {
        $this->credomatic = new CredomaticModel($service);
    }

    public function sell($data)
    {
        $this->credomatic->transaction('sell', $data);
    }

    public function authorize($data)
    {
        $this->credomatic->transaction('sell', $data);
    }

    public function refund($transactionId)
    {
        $this->credomatic->transaction('sell', $data);
    }

    private function transactionDenied()
    {
        
    }

    private function transactionApprove()
    {

    }
}
