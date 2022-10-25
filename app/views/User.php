<?php

namespace app\views;

class User implements View{
    public function render($data)
    {
        $header = new templates\Header();
        $header->render();
        
        
        echo 'PAGE User!<br/>';
        echo "<p>Ваш статус: ".$_SESSION['statusUser']."</p>";
        echo "<p>Ваше имя: ".$_SESSION['nameUser']."</p>";
         
        
        echo "<main class='main'>";
        
        
        echo "<div class='wrepperOutBtn'>
            <div class='outBtn__container'>

                <div class='innerWrepperOutBtn'>
                    <a href='/store/LogOut' class='btn outBtn__cab'>Выход</a>
                </div>
            </div>
        </div>";
        
      
        
        echo '</main>';
        
        $be = new templates\Footer();
        $be->render();

    }   
}
