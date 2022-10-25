<?php
namespace app\views\templates;


class ResultSearch {
     public function render($data){ 
         
        var_dump($data);
        $out = "<section class='firstBlock'>
        <div class='resultSearch__container'>
            <div class='resultSearch__content'>";
            if(isset($data) && is_array($data)){   
            $out .= " <ul class='resultSearch__list searchResult-list'>";
            forEach($data as $value){
                $out .= "<li class='searchResult__item'>
                            <a href='/store/PageCategoryListRender/{$value['id_goods']}' class='searchResult__href' >
                                <span class='searchResult__img img-resultSearch' >
                                    <picture>
                                        <source srcset='/store/images/".strstr($value['photo'], '.', true).".webp' type='image/webp'>
                                        <img src='/store/images/{$value['photo']}' class='img-resultSearch__img' alt=''>
                                    </picture>
                                </span>
                                <span class='searchResult__contentText textResult__wrepper'>
                                    <ul class='textResult__list'>
                                        <li class='textResult-item'> 
                                            <h2 class='textResult__titleList'>{$value['title_goods']}</h2>
                                        </li>";   
                                            
                                    if(isset($value['promoPrise']) && $value['promoPrise'] !=0.00 || $value['promoPrise'] !=''){
                                            $out.= "<li class='textResult-item'> 
                                                        <span>Старая цена: </span>
                                                        <span class='list-price__item-oldprise'>{$value['priceRose']}</span>
                                                    </li>
                                                    <li class='textResult-item'>
                                                        <span class='goodsList-info-item'>Акция:</span>
                                                        <span class='goodsList-info-item'>{$value['promoPrise']}</span>
                                                    </li>";
                                        }
                                        else{
                                            $out.= "<li class='textResult-item' >
                                                        <span class='goodsList-info-item'>{$value['priceRose']}</span>
                                                    </li>";
                                        }
                                    

                        $out .= "</ul></span>
                            </a>
                        </li>";  
            }   
        $out .= "</ul>";
            }
            else{
                $out .= "<p>Пусто</p>";  
            }    
            
             $out .= "</div>   
            </div> 
        </section>";
       echo $out;
    }
}
