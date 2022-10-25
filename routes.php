<?php

$return = [
    "#^index.php$#" => ["Page1", "render"],
    "#^PromoAll/(\d+)$#" => ["PromoAll", "render", 1],
    "#^Authorization$#" => ["Authorization", "render"],
    "#^Registration$#" => ["Registration", "render"],
    
    "#^AjaxRegistr$#" => ["AjaxRegistr", "render"],
    "#^LogIn$#" => ["Authorization", "logIn"],
    "#^LogOut$#" => ["Authorization", "LogOut"],
    
   
    "#^InsertAdmin$#" => ["Admin", "insert"],
    "#^PreviewInsert$#" => ["Admin", "previewInsert"],
    "#^AdminDelit$#" => ["Admin", "delit"],
    
    
    /*"#^Catalog$#" => ["Catalog", "action", []],
   /* "#^Catalog/(\d+)$#" => ["Catalog", "action", []],*/
   
   /* "#^Promo/(\d+)$#" => ["Promo", "action", []],
    "#^Cabinet$#" => ["Promo", "action", ["num" => 1]],*/
    "#^CardProduct/(\d+)$#" => ["CardProduct", "render", 1],
    
    "#^PageCategoryListRender/(\d+)$#" => ["PageCategoryList", "render", 1],
    "#^AjaxAuthorization$#" => ["AjaxAuthorization", "send" ],
    "#^Admin$#" => ["Admin", "render" ],
 
    "#^User$#" => ["User", "render" ],
   /* "#^PageCategoryList/CardProduct/(\d+)$#" => ["CardProduct", "read", 1]*/
   
   "#^Search$#" => ["Search", "render"]
   
];



