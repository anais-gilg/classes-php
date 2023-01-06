<?php

session_start() ;

require('user.php') ;

$logout = new User() ;
$logout->disConnect() ;



?>