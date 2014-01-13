<?php
session_start();
include_once 'includes/config.php';
if(Admin::IsLogin()) Admin::ShowAdminPanel();
else Admin::ShowLoginFomrm();
?>
