<?php
define("DB_NAME","OAUTHCOOP");
define("DB_HOST","localhost");
define("pass","boluwatife");
define("DB_USER","root");

$db = @mysqli_connect(DB_HOST,DB_USER,pass,DB_NAME) OR die ('could not connect to MySQL : ' . mysqli_connect_error() );
?>