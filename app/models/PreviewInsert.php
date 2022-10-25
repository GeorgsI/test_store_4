<?php
namespace app\models;


class PreviewInsert extends Model{
    
   
    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);

        
        $requestData = json_decode($parameters);


        $updateSql = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus`  `address` FROM `user` WHERE `id_user` = :id";
        
        
        $delRow = ['id'=> (int)$requestData->id];
        $updateDataRow = $this->connectDB->read($updateSql , $delRow );
       
        
        $this->data = $updateDataRow;
        
   
       
       
      
    }
    
 
    public function getData()
    {
        return $this->data;
    }
    

}


