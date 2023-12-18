<?php
namespace App\Response;
use App\Enum\EnumResponseStatus;


abstract class ResponseAbstract
{
    public static function toArray($data, int $code = 200, $status = EnumResponseStatus::STATUS_SUCCESS): \Laminas\Diactoros\Response
    {
        $response = new \Laminas\Diactoros\Response;

        $response->getBody()->write(json_encode([
            "status" => $status,
            "result" => $data
        ]));

        return $response->withStatus($code);
    }
}