<?php
namespace App\Controllers\V1;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Libraries\ValidateRequest;

class Store extends BaseController
{
    use ResponseTrait;
    
    public function index()
    {
        
        $keyChecking = new ValidateRequest();
        
        $isNotValidated = $keyChecking->key_validate() ? $keyChecking->key_validate() : FALSE;
        if ($isNotValidated)
        {
            return $isNotValidated;
        }
        
        return $this->respond(["status"=>TRUE],200);
        
    }
}