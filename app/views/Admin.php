<?php
namespace app\views;

class Admin {
    public function render($data)
    {

        
        $header = new templates\Header();
        $header->render();
        
       
   
       
       
        
      
        echo "<main class = 'main'>";
        $Admin = new templates\Admin();
        echo $Admin->render($data);
        
        echo "<div class='wrepperOutBtn'>
            <div class='outBtn__container'>

                <div class='innerWrepperOutBtn'>
                    <a href='/store/LogOut' class='btn outBtn__cab'>Выход</a>
                </div>
            </div>
        </div>";
        
        echo "</main >";
        
       
        
        $footer = new templates\Footer();
        $footer->render();
        
        
    }
}
