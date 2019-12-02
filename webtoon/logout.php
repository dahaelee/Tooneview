<?php
    session_start();
    $res=session_destroy();
    if($res){
        header('Location: home.php');
    }
?>
<meta http-equiv="refresh" content="0;url=home.php" />