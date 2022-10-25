<?php
namespace app\views;

class Search implements View{
    public function render($data)
    {
        $header = new templates\Header();
        $header->render();
       
  

     
        
       
        echo "<main class='main'>";
        
            $resultSearch = new templates\ResultSearch();
            $resultSearch->render($data);      

        echo "</main>";
        
        $footer = new templates\Footer();
        $footer->render();

    }   
}
