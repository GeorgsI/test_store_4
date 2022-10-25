<?php
namespace app\views;

class PreviewInsert {
      public function render($data)
    {

    
         
        
         $elemFormUpdate = "<form  class='form formRegistration' id='formRegistrationUser'>
                <div id='autherror'></div><div class='form-innerWrepper'><div class='form-elementWrepper'>
                <input type='hidden' name='idUser' id='idUser' value='{$data[0]['id_user']}'>
                <h2 class='form-title'>Редактирование</h2></div>
                <div class='form-elementWrepper'><input class='field formRegistration' placeholder='Имя' name='name' id='name' type='text' value='{$data[0]['Name']}'></div>
                <div class='form-elementWrepper'><input class='field formRegistration' placeholder='Фамилия' name='surname'  id='surname' type='text' value='{$data[0]['surname']}'></div>
                <div class='form-elementWrepper'><input class='field formRegistration' placeholder='Отчество' name='patronymic'  id='patronymic' type='text' value='{$data[0]['patronymic']}' ></div>
                <div class='form-elementWrepper'><input class='field formRegistration' placeholder='e-mail' name='email'  id='email' type='email' value='{$data[0]['email']}'></div>
                
                <div class='form-elementWrepper'><input class='btn form-btn formRegistration update-admin-btn' type='button'  value='Сохранить' title='Сохранить' onClick='updateadmin()'></div>
                <div class='form-elementWrepper' ><button  type='button' class='btn form-btn  form-btn-updateUserClose'  title='Назад'  onClick='closeFormUpdate()'>Назад</button></div> </div></form>";
             
             
            $answer['error'] = "";                                   
           
            $answer['wrepperForm'] =  $elemFormUpdate;   
            
            echo json_encode($answer);
         
        
        
        
    }
}
