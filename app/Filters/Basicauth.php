<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;


class Basicauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $request      = \Config\Services::request();
        $apiKey = $request->header('X-API-KEY') ? $request->getHeaderLine('X-API-KEY') : "";
        if (!$apiKey)
        {
            header("Content-type: application/json");
            echo json_encode(array("status"=>FALSE,"message"=>"Invalid Credentials"));
            die();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //$apiKey = $request->header('X-API-KEY') ? $request->getHeaderLine('X-API-KEY') : "";
        //header("X-API-KEY: ".$apiKey);
    }
}
