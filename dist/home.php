<?php
    include("includes/sessionconnected.php");

    include("includes/head.php");

    include("includes/loader.php");

    include("includes/top_navbar.php");

    include("includes/menu.php");

    if($fonction==3 OR $statutuser==2){
        include("interface/ui_home_user.php");  
    }else{
        include("interface/ui_home.php");
    }
    

    include("includes/script.php");

?>





