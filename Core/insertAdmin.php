<?php

namespace Core;


class insertAdmin {

    protected $action;
    protected $data;
    protected $parameters;
    public $connectDB;

    public function __construct($data )
    {  
        $this->data= $data;
        
    }


    public function insert()
    {
       
       
 //include_once('settings.php');
        include_once('settings.php');
        include_once('ConnectDB.php');
        $this->connectDB = new ConnectDB(HOST, USER, PASSWORD ,DATABASE, CHARSET);
        $requestData = json_decode($this->data);
        $this->connectDB = new ConnectDB(HOST, USER, PASSWORD ,DATABASE, CHARSET);

       
       
        
        
        $updateSql = "UPDATE `user` SET `Name`=:name,`patronymic`=:patronymic,`surname`=:surname,`email`=:email WHERE `id_user`= :id";

        $delRow = ['id'=> (int)$requestData->id, 'name' => $requestData->name, 'patronymic'=>$requestData->patronymic, 'surname'=>$requestData->surname, 'email'=>$requestData->email];
        $updateDataRow = $this->connectDB->read($updateSql , $delRow );

        
        
 
        $answer['error'] = "";                                   
        $answer['message'] =  $this->renderForm();   

       echo json_encode($answer);
    }
    
    
    
    
    public function renderForm(){
        
       // if(isset($_SESSION['statusUser']) == "admin"){
        
        
            $categories = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user`";
            $t = $this->connectDB->read($categories);

            
            $out = "<div id='auth'><div id='autherror'></div><table ><caption>Таблица размеров обуви</caption>
                    <tr>
                     <th>Россия</th>
                     <th>Великобритания</th>
                     <th>Европа</th>
                     <th>Длина ступни, см</th>
                    </tr>";

             foreach ($t as $value){
             $out .= "<tr><td>{$value['Name']}</td>
                                <td>{$value['patronymic']}</td>
                                <td>{$value['surname']}</td>
                                <td>{$value['email']}</td>
                                <td>{$value['userStatus_id_userStatus']}</td>
                                ";
                             if((int)$value['userStatus_id_userStatus']  == 3){
                                $out .= "<td><input type='button' value='Обновить' disabled class='btn admin-update-user block-use' data-updateuser='{$value['id_user']}'></td>                       
                                         <td><input type='button' value='Удалить' disabled class='btn admin-dell-user block-use' data-deluser='{$value['id_user']}'></td></tr>";
                                }
                                else{
                                    $out .= "<td><input type='button' value='Обновить' class='btn admin-update-user' data-updateuser='{$value['id_user']}'></td>                       
                                                <td><input type='button' value='Удалить' class='btn admin-dell-user' data-deluser='{$value['id_user']}'></td></tr>";
                                }
                            
                            
                            
                            
                            
             }
               $out .= "</table></div>";

           

            return  $out;
    //    }  
    }
  
}


$delitAdmin = new insertAdmin(file_get_contents('php://input'));    
$delitAdmin->insert(); 