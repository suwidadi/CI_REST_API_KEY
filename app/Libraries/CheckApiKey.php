<?php 
namespace App\Libraries;

use App\Models\AuthenticateModel;

class ValidateRequest {

    protected $response;
    protected $request;
    protected $authModel;

    public function __construct()
    {
        $this->request      = \Config\Services::request();
        $this->response     = \Config\Services::response();
        $this->authModel    = new AuthenticateModel();
    }

    public function key_validate()
    {
        $hasil = FALSE;
        $ipKey = $this->request->getHeaderLine('X-API-KEY');
        if ($ipKey!="")
        {
            $data = $this->authModel->find(['key'=> $ipKey]);

            if (!$data) {
                $hasil = $this->response->setStatusCode(401)->setJSON(["status"=>FALSE,"message"=>"Invalid Key"]);
            } else {
                $arr_ip = explode(",",$data[0]['ip_addresses']);
                foreach ($arr_ip as $keyIP => $valIP) {
                    $theIp[$keyIP] = trim($valIP);
                }
                
                $ip = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $this->request->getHeaderLine('X-FORWARDED-FOR') : $_SERVER['REMOTE_ADDR'];

                if (!in_array($ip,$theIp)){
                    $hasil =  $this->response->setStatusCode(401)->setJSON(["status"=>FALSE,"message"=>$ip." IP Address Not Authorized"]);
                }
            }
        } else {
            $hasil = $this->response->setStatusCode(401)->setJSON(["status"=>FALSE,"message"=>"No API Key Available"]);
        }

        return $hasil;
    }
}