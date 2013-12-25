<?php
include "image.php";
$value = $_POST['rankSelect'];
if($value=='Ocena')
{
    //image::setSort('rate');
    //echo image::getSort();
    header("Location: rankingi.php?rank=rate");
}
else if($value=='Data dodania')
{
    //image::setSort('addDate');   
    //echo image::getSort();
    header("Location: rankingi.php?rank=addDate");
}



