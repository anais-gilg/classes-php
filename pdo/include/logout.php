<?php

session_start() ;

require('user-pdo.php') ;

$logout = new User() ;
$logout->disConnect() ;

?>