<?php
session_start();
include_once 'includes/admin.class.php';
if(Admin::IsLogin()) 
{
    foreach($_SESSION as $k=>$v)unset($_SESSION[$k]);
    header('Location: index.php');
    echo
    '
        <div class="message error-message">
            <p><strong>Wylogowano...</strong></p>
        </div>
    ';
}
?>
