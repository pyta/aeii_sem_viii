<?php
//$id = null;
$returnvalue = false;
$lor= $_POST['id'];
if($lor!=null && strlen($lor)>0)
{ 
    $returnvalue = true;
}
echo json_encode($returnvalue);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

