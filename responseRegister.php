<?php namespace store;
use Core\ConnectDB;

header("Content-type: text/plain; charset=UTF-8");

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
    
    
    

 
        $db = new ConnectDB('localhost', 'root', 'root' ,'store', 'utf8');
        $sql_login = "SELECT COUNT(*) FROM user WHERE login = :login";
        $sql_email = "SELECT COUNT(*) FROM user WHERE email= :email";


    

        $check_login = $db->countRows($sql_login, ['login'=> $_POST['login']]);
        $check_email = $db->countRows($sql_email, ['email'=> $_POST['email']]);  
        
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



            $db->write($sql, $arguments);
            
            echo '<p>Вы зарегистрированы</p>';
        }
    
    }
    
}else 
{
   echo '<p>Заполните все поля</p>';
}




/*

header("Content-type: application/json; charset=utf-8");


//Получаем данные запроса POST
//это не форма, поэтому они не попадают в $_POST
//получаем данные из php://input
$requestJSON = file_get_contents('php://input');


$requestData = json_decode($requestJSON);

/*

if(!empty($requestData->name) && !empty($requestData->surname)&&
    !empty($requestData->patronymic) && !empty($requestData->email)&& 
    !empty($requestData->phone) && !empty($requestData->address)&&
    !empty($requestData->login) && !empty($requestData->password)){
    //конечно проверка должна быть по полной программе с организацией сессии, а не только на пустоту
    //если проверка успешна
  
    if(mb_strlen($requestData->name)>15 ){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'Длинное имя.';
    }
    elseif(!preg_match("/^[A-Я]{1}[а-яё]{1,14}|[а-яё]{2,15}|[A-Z]{1}[a-z]{1,14}|[a-z]{2,15}$/", $requestData->name)){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'В поле имя.';
    }
    elseif(mb_strlen($requestData->surname)>15 ){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'Длинное фамилия.';
    }
    elseif(!preg_match("/^[A-Я]{1}[а-яё]{1,14}|[а-яё]{2,15}|[A-Z]{1}[a-z]{1,14}|[a-z]{2,15}$/", $requestData->surname)){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'В поле фамилия.';
    }
    elseif(mb_strlen($requestData->patronymic)>15 ){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'Длинное отчество.';
    }
    elseif(!preg_match("/^[A-Я]{1}[а-яё]{1,14}|[а-яё]{2,15}|[A-Z]{1}[a-z]{1,14}|[a-z]{2,15}$/", $requestData->patronymic)){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'В поле отчество.';
    }
    elseif(mb_strlen($requestData->email)>15 ){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'Длинный e-mail';
    }
    elseif(!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $requestData->email)){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'В поле e-mail.';
    }
    elseif(!preg_match("/^\+\d{2}\(\d{3}\)\d{2}-\d{2}-\d{2}|\d{2}\d{3}-\d{2}-\d{2}|\+\d{12}|\d{12}|\d{9}|\d{7}|\d{3}-\d{2}-\d{2}$/", $requestData->phone)){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'В поле телефон.';
    }
    elseif(mb_strlen($requestData->address)>40){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'Длинный адрес';
    }
    elseif(!preg_match("/[А-ЯЁа-яё0-9\s\,\.]+$/", $requestData->address)){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'В поле адрес.';
    }
    elseif(mb_strlen($requestData->password) > 10){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'Длинный пароль.';
    }
    elseif(mb_strlen($requestData->password) < 8){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'Короткий пароль не меншье 8.';
    }
    elseif(!preg_match("/^[A-Za-z0-9\_\*\.]{8,10}$/", $requestData->password)){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'В поле пароль не допустимый символ.';
    }
    elseif(mb_strlen($requestData->login) > 10){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'Длинный логин';
    }
    elseif(mb_strlen($requestData->login) < 3){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'Короткий логин не меншье 3';
    }
    elseif(!preg_match("/^[A-Za-z0-9]{3,10}$/", $requestData->login)){
        $answer['error'] = 'Ошибка.';
        $answer['message'] = 'В поле логин не допустимый символ.';
    }
    else{
        
     */   
        
        
        /*$result=[];
    foreach($requestData as $key => $dataJS){
       $result += [$key => verification($dataJS)];
    }*/
    
    /*include'settings.php';*/
  
/*
    
    $passwordH = password_hash($requestData->password, PASSWORD_DEFAULT); 
    $sql = "INSERT INTO user( Name, patronymic, surname, email, login, password, userStatus_id_userStatus, userPhoto_id_userPhoto) VALUES (:Name, :patronymic, :surname, :email, :login, :password, :userStatus, :userPhoto)";
    $arguments = ["Name"=>$requestData->name,"patronymic"=>$requestData->patronymic,"surname"=>$requestData->surname,"email"=>$requestData->email,"login"=>$requestData->login,"password"=>$passwordH,"userStatus"=>1, "userPhoto"=>1]; 
      
   
        
        
        
        
    
        
           
        
    ///$arguments = ['Name'=>"Dmitry",'patronymic'=>"Dmitry",'surname'=>"Dmitry",'email'=>"Dmitry",'login'=>"Dmitry234",'password'=>$passwordH,'userStatus'=>1, 'userPhoto' => 1];     
    //$arguments = ['Name'=>$result['name'],'patronymic'=> $result['patronymic'],'surname'=>$result['surname'],'email'=>$result['email'],'login'=>$result['login'],'password'=>$result['password'],'userStatus_id_userStatus'=>1]; 
    //$arguments = ['Name'=>$requestData->name,'patronymic'=> $requestData->patronymic,'surname'=>$requestData->surname,'email'=>$requestData->email,'login'=>$requestData->login,'password'=>$passwordH,'userStatus'=>1, 'userPhoto' => 1]; 
    $db = new ConnectDB("localhost", "root", "root" ,"store", "utf8");
    $db->write($sql, $arguments);
        
 
        
        
        
    $answer['error'] = " ";                                   
    $answer['message'] =  $requestData->name." ".$requestData->patronymic.", Вы зарегистрированы!";   
        
        
        
        
    /*    
        
        
    }   
}elseif(empty($requestData->name) || empty($requestData->surname)||
        empty($requestData->patronymic) && empty($requestData->email)|| 
        empty($requestData->phone) || empty($requestData->address)||
        empty($requestData->login) || empty($requestData->password)){

   
    
    
    
    
    
    
    
    $answer['error'] = 'Ошибка при ригестрации';
    $answer['message'] = 'Заполнены не все поля.';
    
    
}
/*function verification($data){  
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
        
    return $data;
        
}
*/


//echo json_encode($answer);




 










