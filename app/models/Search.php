<?php
namespace app\models;
use core\Verification;

class Search extends Model{
    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);
       // $this->data = 'Данные страницы User';
        //include_once('settings.php');
        
        //var_dump($_POST['searchField']);
    
        if(isset($_POST['searchField']) && !empty($_POST['searchField'])){ 
            
           // Foo::aStaticMethod();
            
        
            $expressions = explode(" ", $_POST['searchField']);
            
            
          
            
            $countWords = count($expressions);
            $expCount = 0;
            
            $sqlSearch = "SELECT * FROM `goods` WHERE ";

            foreach($expressions as $value){

                $valueClean = Verification::out($value);
                
                
                $expCount++;
                if($expCount < $countWords){ 
                    $sqlSearch .= "CONCAT(`title_goods`,`YN`,`description`) LIKE '%".$valueClean."%' OR ";
                }
                else{
                     $sqlSearch .= " CONCAT(`title_goods`,`YN`,`description`) LIKE '%".$valueClean."%'";
                }

            }


            $this->data = $this->connectDB->read($sqlSearch);
        }
        else{
           $this->data = 'Нет результатов'; 
        }
        
    }
    
    
   

    public function getData()
    {
        return $this->data;
    }   
}
