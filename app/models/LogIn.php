<?php
namespace app\models;

class LogIn extends Model{
    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);

        if (!empty($_POST['login']) && !empty($_POST['password']) )
        {
            
            $login =  $_POST['login'] ;
            $password =  $_POST['password'] ;
            
           // echo '<p>' . $login . ', здравствуйте' . '</p>';


            if(mb_strlen($password) > 10){
                
                $this->data = 'Ошибка. Длинный пароль.';
            }
            elseif(mb_strlen($password) < 8){
               
                $this->data = 'Ошибка. Короткий пароль не меншье 8.';
            }
            elseif(!preg_match("/^[A-Za-z0-9\_\*\.]{8,10}$/", $password)){
               
               $this->data = 'Ошибка. В поле пароль не допустимый символ.';
            }
            elseif(mb_strlen($login) > 10){
                
                $this->data = 'Ошибка. Длинный логин';
            }
            elseif(mb_strlen($login) < 3){
              
                $this->data = 'Ошибка. Короткий логин не меншье 3';
            }
            elseif(!preg_match("/^[A-Za-z0-9]{3,10}$/", $login)){
                
                $this->data = 'Ошибка. В поле логин не допустимый символ.';
            }
            else{

               //$sql = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user` WHERE `login` = :login";

                
                $sql = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus`, `title_status` FROM `user` 
                        INNER JOIN userstatus
                        ON user.userStatus_id_userStatus =  userstatus.`id_userStatus`
                        WHERE `login` = :login";

                $arguments = ['login'=>$login];   
                $result = $this->connectDB->read($sql, $arguments);

              //  var_dump($result);




                if(/*isset($result[0]['login']) == $login &&*/ password_verify($password, $result[0]['password'])){
 
                    $this->data = $result;  
    
                }
                else{
                    $this->data = 'Ошибка.' ;
                }


            }   
    
        } else {
           $this->data = '<p>Ошибка при авторизации, заполниете поля.</p>';
        }

    }       

    public function getData()
    {
        return $this->data;
    }   
}
