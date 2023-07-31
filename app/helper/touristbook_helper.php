<?php 

if (!function_exists('getRouteName')) {    
function getRouteName(){
  
    $routeName = request()->route()->getName();

    return $routeName;
}
}

 ?>