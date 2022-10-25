<?php
namespace app\controllers;

class AjaxRegistr {
    
    private $page = 'page1';//имя страницы по умолчанию page1
    private $action = 'read'; //CRUD-операции, по умолчанию read
    private $parameters; //массив остальных параметров запроса
   
    
    public function __construct($arr)
    {
        $this->parameters = $arr;
        $this->analyzeRequest($this->parameters );
    }
    
    
    protected function analyzeRequest()
    { 
       // var_dump($this->parameters);
        
        if (!empty($this->parameters[0]))
        { 
            $this->page = $this->parameters[0];
            unset($this->parameters[0]);
        }
        if (!empty($this->parameters[1]))
        {    $method = $this->parameters[1];
            unset($this->parameters[1]);
        }
        
       
        /*var_dump($this->action);
        var_dump($this->page);
        var_dump($method);*/
        
        
        
        $this->$method($this->page, $this->action, $this->parameters);
       
    }

  
    
    
    
    public function render($class, $action, $params )
    {
        
       // var_dump($this->parameters );
        //Модель:
        $className = '\app\models\\'.$class;
        $model = new $className();
        $model->execute($action, $params);
        
        //Вид:
      /*  $className = '\app\views\\'.$class;//имя класса view с пространством имен (например /views/page1)
        $view = new $className();
        $view->render($model->getData());*/
    }
    
    
    
    
    
}
