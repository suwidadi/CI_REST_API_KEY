<?php
namespace App\Controllers\V1;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\LotteStoreModel;
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
        $storeModel = new LotteStoreModel();
        //$data = $storeModel->find(['STR_CD'=>'06001']);
        $column     = array('STR_CD','STR_NM','ADDR1','ADDR2','OPEN_DY','CLOSE_DY');
        $where      = array('STR_CD'=>'06001');

        $data       = $storeModel->sql_execute("SELECT STR_CD,STR_NM,ADDR1,ADDR2,OPEN_DY,CLOSE_DY FROM STORE WHERE STR_CD='06001'");
        
        if ($data){
            return $this->respond(["status"=>TRUE,"message"=>$data],200);
        } else {
            return $this->respondNoContent();
        }
        
    }
}