<?php


namespace app\controllers;


class Authorization {
    
    private $page = 'Page1';//имя страницы по умолчанию page1
    private $action = 'read'; //CRUD-операции, по умолчанию read
    private $parameters; //массив остальных параметров запроса
    
    
    
    public function __construct($arr)
    {
        $this->parameters = $arr;
        $this->analyzeRequest($this->parameters);
    }
    
    
    protected function analyzeRequest()
    { 
        var_dump($this->parameters);
        if (!empty($this->parameters[0]))
        { 
            $this->page = $this->parameters[0];
            unset($this->parameters[0]);
        }
        if (!empty($this->parameters[1]))
        {   $method = $this->parameters[1];
            unset($this->parameters[1]);
        }

        var_dump($this->parameters);
        var_dump($this->action);
        var_dump($this->page);
        var_dump($method);
        
        //$method = $this->method;
        $this->$method($this->page, $this->action ,$this->parameters);
    }

    public function render($class, $action, $params )
    {
        //Модель:
        $className = '\app\models\\'.$class;
        $model = new $className();
        $model->execute($action,$params);
        
        //Вид:
        $className = '\app\views\\'.$class;//имя класса view с пространством имен (например /views/page1)
        $view = new $className();
        $view->render($model->getData());
    }
    
    
    public function logIn($class, $action, $params )
    {
        $class = 'logIn';
        var_dump($class);
        var_dump($action);
        var_dump($params);
        
        //Модель:
        $className = '\app\models\\'.$class;
        $model = new $className();
        $model->execute($action,$params);
        
        $data = $model->getData();
        
        var_dump($data);
        
        
        if(is_array($data)){
           
            
            $_SESSION['statusUser'] = $data[0]['title_status'];
            $_SESSION['nameUser'] = $data[0]['Name'];
            header('Location: '.'/store/'.ucfirst($data[0]['title_status']));
            
        }
        else{
            //Вид:
            $class = 'Authorization';
            $className = '\app\views\\'.$class;//имя класса view с пространством имен (например /views/page1)
            $view = new $className();
            $view->render($model->getData());
        }
  
    }
    
    
    
    public function logOut($class, $action, $params )
    {
        
        if(isset($_SESSION['statusUser'])){
            
            session_destroy();
            header('Location: '.'/store/index.php');
            
        }
        
       
    }
    
    
   
}
