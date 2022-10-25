<?php
namespace app\views\templates;


class PromoALL {
    public $out;

    public function render($data){
        $out = '';
        
        
       $out .= "<section class='superPrise__Block'>
                <div class='superPrise__container'>
                    <div class='content-block'>
                    <h2 class='superPrise__title head-title'>
                        Супер цена
                    </h2>
                    <ul class='superPrise__list'>";
       
       var_dump($data);
        
                if(isset($data))
                {
                    
                    
                    forEach($data['promoGoods'] as $value)
                    { 
                        //echo gettype((double)$value['priceRose']);
                        $out .="
                            
                            <li class='superPrise__item'>
                            <!--a href='index.php?page=PageCardProduct&num={$value['id_goods']}'-->
                              <a href='/store/CardProduct/{$value['id_goods']}'> 
                                <span class='mark'>".round(((double)$value['priceRose']/(double)$value['promoPrise']-1)*100)."% {$value['label']}</span>
                                <span class='superPrise__item-photo-wrepper'>
                                    <picture>
                                        <source srcset='/store/images//".strstr($value['photo'], '.', true).".webp' type='image/webp'>
                                        <img src='/store/images/{$value['photo']}' class='superPrise__item-img' alt=''>
                                    </picture>
                                </span>
                                <span class='superPrise__innertextWrepper'>
                                    <span class='superPrise__item-title'>
                                        {$value['title_goods']}
                                    </span>
                                    <ul class='list-price'>
                                        <li class='list-price__item-oldprise'>{$value['priceRose']}<span class='currency'>BYN<span></span></li>
                                        <li class='list-price__item-newprise'>{$value['promoPrise']}<span class='currency'>BYN<span></span></li>
                                    </ul>
                                </span>
                                </a>
                            </li>";    
   
                    }
                    
                   
                    
                }
                
                
                
                
                else{
                     $out = "<p>Пока акций нет<p>";
                }
                
                $out .= "</ul> 
                    <a href='/store/index.php' class='superPrise-all__btn btn'>Назад</a>   
                </div>";
                
                 
                    if($data['count']>1){
                        
                     
                       
                       
                       
                        
                        $out .="<section class='pagination-Block'>
                                    <div class='pagination__container'>
                                        <div class='pagination__cntent'>
                                        <ul class='pagination-list'>";
                                            $page=1;
                                            for($i=1; $i<$data['count']; $i++){

                                                $out .="<li class='pagination-item'>
                                                            <a class='pagination-href' href='/store/PromoAll/{$i}'>".$page."</a>
                                                        </li>";
                                                $page++;
                                            }
  
                                $out .="</ul>
                                        </div>
                                    </div>
                                </div>
                            </section>"; 
                    }
                
                
          $out .= "</section>";
    echo $out;
}
}