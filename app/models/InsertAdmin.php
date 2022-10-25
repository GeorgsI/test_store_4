<?php
namespace app\models;

class InsertAdmin extends Model{
    
   
    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);


        $requestData = json_decode($parameters);
      

       
       
        
        
        $updateSql = "UPDATE `user` SET `Name`=:name,`patronymic`=:patronymic,`surname`=:surname,`email`=:email WHERE `id_user`= :id";

        $delRow = ['id'=> (int)$requestData->id, 'name' => $requestData->name, 'patronymic'=>$requestData->patronymic, 'surname'=>$requestData->surname, 'email'=>$requestData->email];
        $updateDataRow = $this->connectDB->read($updateSql , $delRow );

        
        
        $categories = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user`";
        $t = $this->connectDB->read($categories);
        
        
        $this->data = $t;
        
        
        
        
 
   
    }
    
 
    public function getData()
    {
        return $this->data;
    }
    

}
