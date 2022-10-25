<?php
namespace Core;
header("Content-type: application/json; charset=utf-8");
/*


$requestJSON = file_get_contents('php://input');

$requestData = json_decode($requestJSON);




$answer['error'] = "";                                   
$answer['message'] = $requestData->id;   



 echo json_encode($answer);*/


class updateAdmin {

    protected $action;
    protected $data;
    protected $parameters;
    public $connectDB;

    public function __construct($data )
    {  
        $this->data= $data;
        
    }


    public function update()
    {
       
       
 //include_once('settings.php');
        include_once('settings.php');
        include_once('ConnectDB.php');
        $this->connectDB = new ConnectDB(HOST, USER, PASSWORD ,DATABASE, CHARSET);
        
        $requestData = json_decode($this->data);

       
       // $this->connectDB = new ConnectDB(HOST, USER, PASSWORD ,DATABASE, CHARSET);

       
        
        
        
        $updateSql = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus`  `address` FROM `user` WHERE `id_user` = :id";
        
        
        $delRow = ['id'=> (int)$requestData->id];
        $updateDataRow = $this->connectDB->read($updateSql , $delRow );

        
        
    
    
        $elemFormUpdate = "<form  class='form formRegistration' id='formRegistrationUser'>
                <div id='autherror'></div><div class='form-innerWrepper'><div class='form-elementWrepper'>
                <input type='hidden' name='idUser' id='idUser' value='{$requestData->id}'>
                <h2 class='form-title'>Редактирование</h2></div>
                <div class='form-elementWrepper'><input class='field formRegistration' placeholder='Имя' name='name' id='name' type='text' value='{$updateDataRow[0]['Name']}'></div>
                <div class='form-elementWrepper'><input class='field formRegistration' placeholder='Фамилия' name='surname'  id='surname' type='text' value='{$updateDataRow[0]['surname']}'></div>
                <div class='form-elementWrepper'><input class='field formRegistration' placeholder='Отчество' name='patronymic'  id='patronymic' type='text' value='{$updateDataRow[0]['patronymic']}' ></div>
                <div class='form-elementWrepper'><input class='field formRegistration' placeholder='e-mail' name='email'  id='email' type='email' value='{$updateDataRow[0]['email']}'></div>
                
                <div class='form-elementWrepper'><input class='btn form-btn formRegistration update-admin-btn' type='button'  value='Зарегистрироваться' title='Зарегистрироваться' onClick='updateadmin(this)'></div>
                <div class='form-elementWrepper' ><button  type='button' class='btn form-btn  form-btn-updateUserClose'  title='Назад'  onClick='closeFormUpdate()' >Назад</button></div> </div></form>";
    
   
        $answer['error'] = "";                                   
        $answer['wrepperForm'] =  $elemFormUpdate;   

       echo json_encode($answer);
    }
    
    
    
    
   
  
}


$delitAdmin = new updateAdmin(file_get_contents('php://input'));    
$delitAdmin->update(); 