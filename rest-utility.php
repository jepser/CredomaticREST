<?php

class RestResponse
{
    private static function setHeaders($success)
    {
        self::setResponseCode($success);
        header('Content-Type: application/json');
    }

    private static function setResponseCode($success = true)
    {
        $code = ($success == false) ? 400 : 200;
        http_response_code($code);
    }

    private static function buildResponse($data = null, $sucess = true)
    {
        $formattedData = [
            'success' => $success,
            'data' => $data,
        ];

        return json_encode($formattedData);
    }

    private static function sendResponse($success, $data)
    {
        $restData = self::buildResponse($success, $data);
        self::setHeaders($success);

        echo $restData;
    }

    public static function sendError($data)
    {
        self::sendResponse(false, $data);
    }

    public static function sendSuccess($data)
    {
        self::sendResponse(true, $data);
    }
}
