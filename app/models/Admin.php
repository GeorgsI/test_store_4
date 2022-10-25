<?php

namespace app\models;

class Admin extends Model{
    
   
    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);
        //$this->data = 'Данные страницы Admin';
        
        
        if(isset($_SESSION['statusUser']) == "admin"){
        
        
        $categories = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user`";
        $t = $this->connectDB->read($categories);
        
        
        $this->data =  $t ;
        
        //var_dump($t);
        
        } 
    }
    

   

    public function getData()
    {
        return $this->data;
    }
    

}
