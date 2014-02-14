<?
$link = mysqli_connect("localhost","root","rootsqladm") or die("Ошибка! Подключение к базе не установлено:<br>".mysql_error()); 
$db = mysqli_select_db($link,"form") or die("невозможно выбрать таблицу");

function defender_xss($arr){
    $filter = array("<", ">"); 
     foreach($arr as $num=>$xss){
        $arr[$num]=str_replace ($filter, "|", $xss);
     }
       return $arr;
} 
?>