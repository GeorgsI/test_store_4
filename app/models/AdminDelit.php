<?php
namespace app\models;

class AdminDelit extends Model{
    
   
    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);

        
        $requestData = json_decode($parameters);

        
        $delitSql = "DELETE FROM `user` WHERE `id_user` =:id";
        $delRow = ['id'=> (int)$requestData->id];
        $this->connectDB->delit( $delitSql , $delRow);

        
        $categories = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user`";
        $t = $this->connectDB->read($categories);
        
        
       
        
        $this->data = $t ;
        
        
        
        
       /* $answer['error'] = "";                                   
        $answer['message'] = $this->renderForm();   



       echo json_encode($answer);*/
       
       
       
      
    }
    
    
    
    
    
    /*public function renderForm(){
        
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
                                <td>{$value['userStatus_id_userStatus']}</td>";
                                    

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

        //$this->data = 'Данные страницы Admin';
        
       /* header("Content-type: application/json; charset=utf-8");



        $requestJSON = file_get_contents('php://input');


        $requestData = json_decode($requestJSON);
        
        
        
        if(isset($_SESSION['statusUser']) == "admin"){
        
         
            
            
            
            
        
        $delitSql = "DELETE FROM `user` WHERE `id_user` =:id";
      /*  $delRow = ['id'=>  $requestData->id (int)$parameters[2]];
       /* $this->connectDB->delit( $delitSql , $delRow );
         
         
         
        $cat = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user`";
        $t = $this->connectDB->read($cat);
         
        
        $this->data =  $t ;
 
        
        $answer['error'] = "";                                   
        $answer['message'] =  $this->data;   
              
          
            

        echo json_encode($answer);
       // var_dump($parameters);
        
       } 
 
    }*/
    

   

    public function getData()
    {
        return $this->data;
    }
    

}

