<?php
namespace app\models;
//use core\ConnectDB;
use \PDO;
class PromoAll extends Model{

    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);
        //$this->data = 'Данные страницы Promo';
        //include_once('settings.php');
        $AllData = [];
        
        $sql_read_count = "SELECT COUNT(id_goods)  FROM `goods`
            INNER JOIN kitpromo
            ON goods.id_goods = kitpromo.goods_id_goods
            INNER JOIN promolabel
            ON kitpromo.goods_id_goods = promolabel.id_promoLabel
            GROUP BY id_goods";
        
        $itemCount = $this->connectDB->executeCount($sql_read_count);
        $AllData +=['count' => $itemCount ];
        
        
         //var_dump($AllData);

      /*  $sql = "SELECT DISTINCT id_goods,`title_goods`,`code`,`YN`,`priceRose`,`photo`, label,`promoPrise` FROM `goods`
            INNER JOIN kitpromo
            ON goods.id_goods = kitpromo.goods_id_goods
            INNER JOIN promolabel
            ON kitpromo.goods_id_goods = promolabel.id_promoLabel";*/
        
        var_dump((int)$parameters[2]);
        $page = (int)$parameters[2];
        $elemCount = 2;
        $count_page = ceil($itemCount / $elemCount);// всего страниц
        $firstNumber = ($page - 1) * $elemCount;
        
        
        
        
        
        $sql = "SELECT DISTINCT id_goods,`title_goods`,`code`,`YN`,`priceRose`,`photo`, label,`promoPrise` FROM `goods`
            INNER JOIN kitpromo
            ON goods.id_goods = kitpromo.goods_id_goods
            INNER JOIN promolabel
            ON kitpromo.promoLabel_id_promoLabel  = promolabel.id_promoLabel ORDER BY `id_goods` DESC LIMIT ".$firstNumber.",".$elemCount;
        

        
        $t = $this->connectDB->$action($sql);
        $this->data =  $t ;  
        //var_dump($t);
        $AllData +=['promoGoods' => $t];  
        $this->data = $AllData;
    }
    
    
   

    public function getData()
    {
        
        return $this->data;
    }
    
}

