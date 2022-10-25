<?php
namespace app\models;

class AjaxRegistr extends Model{
    
   
    
    function execute($action, $parameters)
    {
       // header("Content-type: application/json; charset=utf-8");
        parent::execute($action, $parameters);
       // $this->data = 'Данные страницы page1';
        
       /* $requestJSON = file_get_contents('php://input');
        $requestData = json_decode($requestJSON);*/
         
       
     //   var_dump($_POST);
        
        
        if (empty($requestData->name) && empty($requestData->surname)&&
         empty($requestData->patronymic) && empty($requestData->email)&& 
         empty($requestData->phone) && empty($requestData->address)&&
         empty($requestData->login) && empty($requestData->password)) 
     {

        include_once './Core/ConnectDB.php';



         if(mb_strlen($_POST['name'])>15 ){
             echo 'Ошибка.';
             echo 'Длинное имя.';
         }
         elseif(!preg_match("/^[A-Я]{1}[а-яё]{1,14}|[а-яё]{2,15}|[A-Z]{1}[a-z]{1,14}|[a-z]{2,15}$/", $_POST['name'])){
             echo 'Ошибка.';
             echo 'В поле имя.';
         }
         elseif(mb_strlen($_POST['surname'])>15 ){
            echo 'Ошибка.';
             echo 'Длинное фамилия.';
         }
         elseif(!preg_match("/^[A-Я]{1}[а-яё]{1,14}|[а-яё]{2,15}|[A-Z]{1}[a-z]{1,14}|[a-z]{2,15}$/", $_POST['surname'])){
             echo 'Ошибка.';
            echo 'В поле фамилия.';
         }
         elseif(mb_strlen($_POST['patronymic'])>15 ){
             echo 'Ошибка.';
             echo 'Длинное отчество.';
         }
         elseif(!preg_match("/^[A-Я]{1}[а-яё]{1,14}|[а-яё]{2,15}|[A-Z]{1}[a-z]{1,14}|[a-z]{2,15}$/", $_POST['patronymic'])){
             echo 'Ошибка.';
            echo'В поле отчество.';
         }
         elseif(mb_strlen($_POST['email'])>15 ){
            echo 'Ошибка.';
             echo 'Длинный e-mail';
         }
         elseif(!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $_POST['email'])){
            echo 'Ошибка.';
             echo 'В поле e-mail.';
         }
         elseif(!preg_match("/^\+\d{2}\(\d{3}\)\d{2}-\d{2}-\d{2}|\d{2}\d{3}-\d{2}-\d{2}|\+\d{12}|\d{12}|\d{9}|\d{7}|\d{3}-\d{2}-\d{2}$/", $_POST['phone'])){
            echo 'Ошибка.';
             echo 'В поле телефон.';
         }
         elseif(mb_strlen($_POST['address'])>40){
            echo 'Ошибка.';
            echo 'Длинный адрес';
         }
         elseif(!preg_match("/[А-ЯЁа-яё0-9\s\,\.]+$/", $_POST['address'])){
             echo 'Ошибка.';
            echo 'В поле адрес.';
         }
         elseif(mb_strlen($_POST['password']) > 10){
            echo 'Ошибка.';
             echo'Длинный пароль.';
         }
         elseif(mb_strlen($_POST['password']) < 8){
             echo 'Ошибка.';
             echo 'Короткий пароль не меншье 8.';
         }
         elseif(!preg_match("/^[A-Za-z0-9\_\*\.]{8,10}$/", $_POST['password'])){
             echo 'Ошибка.';
            echo 'В поле пароль не допустимый символ.';
         }
         elseif(mb_strlen($_POST['login']) > 10){
             echo 'Ошибка.';
             echo 'Длинный логин';
         }
         elseif(mb_strlen($_POST['login']) < 3){
             echo'Ошибка.';
             echo'Короткий логин не меншье 3';
         }
         elseif(!preg_match("/^[A-Za-z0-9]{3,10}$/", $_POST['login'])){
             echo 'Ошибка.';
            echo 'В поле логин не допустимый символ.';
         }
         else{





             //$db = new ConnectDB('localhost', 'root', 'root' ,'store', 'utf8');
             $sql_login = "SELECT COUNT(*) FROM user WHERE login = :login";
             $sql_email = "SELECT COUNT(*) FROM user WHERE email= :email";




             $check_login = $this->connectDB->countRows($sql_login, ['login'=> $_POST['login']]);
             $check_email = $this->connectDB->countRows($sql_email, ['email'=> $_POST['email']]);  

             echo  $check_login;

             if((int)$check_login > 0 ){
                 echo '<p>Логин уже занят</p>';
             }
             elseif((int)$check_email > 0 ){
                echo  '<p>Почта уже занята</p>';
             }
             else{


                $sql = "INSERT INTO `user`( `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userStatus_id_userStatus`, `userPhoto_id_userPhoto`) VALUES (:Name, :patronymic, :surname, :email, :login, :password, :userStatus, :userPhoto)";

                $passwordH = password_hash($_POST['password'], PASSWORD_DEFAULT);      
                $arguments = ['Name'=>$_POST['name'],'patronymic'=> $_POST['patronymic'],'surname'=>$_POST['surname'],'email'=>$_POST['email'],'login'=>$_POST['login'],'password'=>$passwordH,'userStatus'=>1,'userPhoto'=>1];   



                $this->connectDB->write($sql, $arguments);

                echo '<p>Вы зарегистрированы</p>';
             }

         }

     }else{
        echo '<p>Заполните все поля</p>';
     }

        
        
    }       

    public function getData()
    {
        echo $this->data;
    } 
  
}
