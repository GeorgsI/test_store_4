<?php

namespace app\views\templates;

class Admin {

    public function render($data)
    {
    
    
        
        
    $out = "<section class='cab-Block'>
                <div class='cab__container'>
                <div class='cab-title'>
        
                <h2> {$_SESSION['statusUser']} {$_SESSION['nameUser'] }</h2></div>";  
                
                
    $out .= "<div class='cab-mainWrepper'>
            <div id='auth'><div id='autherror'></div>
                <table class='cab-tab'>
                    <caption class='cab-tab-title'>Таблица пользователей</caption>
            <tr>
             <th class='cab-tab__nameCol'>Имя</th>
             <th class='cab-tab__nameCol'>Отчество</th>
             <th class='cab-tab__nameCol'>Фамилия</th>
             <th class='cab-tab__nameCol'>e-mail</th>
             <th class='cab-tab__nameCol'>Статус</th>
            </tr>";
     
     foreach ($data as $value){
     $out .= "<tr><td class='cab-tab__cell'>{$value['Name']}</td>
                        <td class='cab-tab__cell'>{$value['patronymic']}</td>
                        <td class='cab-tab__cell'>{$value['surname']}</td>
                        <td class='cab-tab__cell'>{$value['email']}</td>
                        <td class='cab-tab__cell'>{$value['userStatus_id_userStatus']}</td>"; 
        if((int)$value['userStatus_id_userStatus']  == 3){
               $out .= "<td class='cab-tab__cell'><input type='button' value='Обновить' disabled class='btn admin-update-user block-use' data-updateuser='{$value['id_user']}'></td>                       
                        <td class='cab-tab__cell'><input type='button' value='Удалить' disabled class='btn admin-dell-user block-use' data-deluser='{$value['id_user']}'></td></tr>";
        }
        else{
            $out .= "<td><input type='button' value='Обновить' class='btn admin-update-user' data-updateuser='{$value['id_user']}' onClick='updateUserForm(this)'></td>                       
                        <td><input type='button' value='Удалить' class='btn admin-dell-user' data-deluser='{$value['id_user']}' onClick='adminDellUser(this)'></td></tr>";
        }
     
    }
       $out .= "</table></div></div></div></section>";

        echo   $out;
    }
}
